<?php

defined("NO_DIRECT") or die("You are not suppose to access it directly");

class Home_repository extends Model {

    function index() {
        
		$search = "";
		$search_by_body = @$_POST['src_body'];
		if(!empty($search_by_body)) $search .= " AND p.body LIKE '%$search_by_body%'"; 
		$search_by_city = @$_POST['src_city'];
		if(!empty($search_by_city)) $search .= " AND u.city LIKE '%$search_by_city%'"; 
		$search_by_state = @$_POST['src_state'];
		if(!empty($search_by_state)) $search .= " AND u.state LIKE '%$search_by_state%'"; 
		$search_by_country = @$_POST['src_country'];
		if(!empty($search_by_country)) $search .= " AND u.country LIKE '%$search_by_country%'"; 
		$where = "WHERE 1 $search";
        /*if (isset($_SESSION['user']) && !@$_SESSION['user']['details']->is_super_user) {
            $where = " WHERE r.user_id=" . (int) @$_SESSION['user']['details']->id;
        }
        elseif(!isset($_SESSION['user']))
        {
            
        }*/
        $db = db::getInstance();
        
        $query  = "SELECT p.*,c.name as company_name, u.name AS user_name,is_super_user 
        FROM `pressrelease` p 
        INNER JOIN `users` u ON u.id = p.created_by 
        INNER JOIN  `company` c ON c.id = p.company 
		$where
		ORDER BY p.release_date DESC, u.name ASC,u.city ASC
        LIMIT 0 , 10";
        
        $result = $db->query($query);
        $rows   = array();
        while($row    = @$result->fetch_object())
                $rows[] = $row;
        
        $this->view->load("header");
        $this->view->show();

        $this->view->load("home");
        $this->view->set("base_url","http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?q=login");
        
        $this->view->set("rows",$rows);
        $this->view->show();
        $this->view->load("footer");
        $this->view->show();
    }
	
}