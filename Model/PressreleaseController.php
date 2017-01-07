<?php

defined("NO_DIRECT") or die("You are not suppose to access it directly");

class PressreleaseController extends Controller {
    function details()
    {
        $db = db::getInstance();
        $id = (int)$_GET['id'];
        $query  = "SELECT p.*,c.name as company_name,c.email as company_email, u.name AS user_name 
        FROM `pressrelease` p 
        INNER JOIN `users` u ON u.id = p.created_by 
        INNER JOIN  `company` c ON c.id = p.company 
        WHERE p.id = $id";
        
        $result = $db->query($query);
        
        if($row    = @$result->fetch_object())
        {
            
        }
        else
        {
            $_SESSION['messages'][] = array("type" => "error", "message" => "Something went wrong");
            header('Location: index.php');
            die('<script>document.location="index.php";</script>');
        }
        
        $this->view->load("header");
        $this->view->show();
       
        $this->view->load("details");
        $this->view->set("base_url","http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?q=login");
        
        $this->view->set("row",$row);
        $this->view->show();
        $this->view->load("footer");
        $this->view->show();
    }
    function edit()
    {
        $db = db::getInstance();
        $id = (int)@$_GET['id'];
        $query  = "SELECT p.*,c.name as company_name,c.email as company_email, u.name AS user_name,is_super_user 
        FROM `pressrelease` p 
        INNER JOIN `users` u ON u.id = p.created_by 
        INNER JOIN  `company` c ON c.id = p.company 
        WHERE p.id = $id";
        
        $result = $db->query($query);
        		        
        if($row    = @$result->fetch_object())
        {
	
		if($_SESSION['user']['details']->is_super_user == 0){
            if($row->created_by != $_SESSION['user']['details']->id)
			{
                $_SESSION['messages'][] = array("type" => "error", "message" => "You cannot edit this article");
                header('Location: index.php');
                die('<script>document.location="index.php";</script>');
            }
		 }
			
        }
        
        if(isset($_POST['save_press']))
        {
            
			
			
			$heading    = $db->real_escape_string($_POST['heading']);
            $body       = $db->real_escape_string($_POST['body']);
            $summary    = $db->real_escape_string($_POST['summary']);
            $release    = date("Y-m-d H:i:s",strtotime($_POST['release_date']));
			$company    = (int)$_POST['company'];
            $company_name    = $_POST['company_name'];
			$company_email    = $_POST['company_email'];
            $created    = (@$row->created_by)?$row->created_by:$_SESSION['user']['details']->id;
			if($company == "O"){
            $query      = "INSERT INTO `company` VALUE ($id,'$company_name','$company_email')";
			$db->query($query);
			$query    = "SELECT MAX( id ) FROM `company`";
			$company     = $db->query($query);
			}
			
            $query      = "REPLACE INTO `pressrelease` VALUE ($id,'$heading','$summary','$body',$company,'$release',$created,1)";
            if($db->query($query))
            {
                $_SESSION['messages'][] = array("type" => "successs", "message" => "Successfully saved the article");
                header('Location: index.php');
                die('<script>document.location="index.php";</script>');
            }
        }
        
        $companies    = array();
        
        $query    = "SELECT * FROM `company`";
        $result     = $db->query($query);
        while($rec  = $result->fetch_object())
        {
            $companies[] = $rec;
        }
        
         $this->view->load("header");
        $this->view->show();
       
        $this->view->load("edit_press");
        $this->view->set("base_url","http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?q=login");
        
        $this->view->set("row",$row);
        $this->view->set("companies",$companies);
        $this->view->show();
        $this->view->load("footer");
        $this->view->show();
    }
	function delete()
    {
        $db = db::getInstance();
        $id = (int)@$_GET['id'];
       
			
		$query      = "DELETE FROM `pressrelease` WHERE id=$id";
		if($db->query($query))
		{
			$_SESSION['messages'][] = array("type" => "successs", "message" => "Article has been deleted");
			header('Location: index.php');
			die('<script>document.location="index.php";</script>');
		}
    }
	
}