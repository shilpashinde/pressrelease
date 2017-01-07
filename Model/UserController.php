<?php

defined("NO_DIRECT") or die("You are not suppose to access it directly");

class UserController extends Controller {

    function password() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?q=login');
            die('<script>document.location="index.php?q=login";</script>');
        }
        if (isset($_POST['password_submit'])) {
            $db = db::getInstance();
            $pass = md5($_POST['password_old']);
            $query = "SELECT * FROM `users` WHERE username='{$_SESSION['user']['details']->username}' AND password='$pass' AND status=1";
            $result = $db->query($query);
            if ($result->num_rows) {
                $query = "UPDATE `users` SET password='" . md5($_POST['password']) . "' WHERE username='{$_SESSION['user']['details']->username}'";
                $db->query($query);
                $_SESSION['messages'][] = array("type" => "success", "message" => "Password Changed Successfully");
            } else {
                $_SESSION['messages'][] = array("type" => "error", "message" => "Wrong Password");
            }
        }

        $this->view->load("header");
        $this->view->show();

        $this->view->load("password");
        $this->view->set("base_url", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?q=login");

        $this->view->show();
        $this->view->load("footer");
        $this->view->show();
    }

    function index() {
        define("NUM_USERS_PER_PAGE",10);
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?q=login');
            die('<script>document.location="index.php?q=login";</script>');
        }
        $db = db::getInstance();
        
        $query  = "SELECT count(*) AS total FROM `users`";
        $result = $db->query($query);
        
        $total  = $result->fetch_object()->total;
        $num_pages= ceil($total/NUM_USERS_PER_PAGE);
        
        $query = "SELECT * FROM `users` LIMIT ".NUM_USERS_PER_PAGE;
        $result = $db->query($query);
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        $this->view->load("header");
        $this->view->show();

        $this->view->load("users");
        $this->view->set("num_pages",$num_pages);
        $this->view->set("base_url", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?q=login");
        $this->view->set("rows", $rows);
        $this->view->show();
        $this->view->load("footer");
        $this->view->show();
    }

    function edit() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?q=login');
            die('<script>document.location="index.php?q=login";</script>');
        }

        if (isset($_POST['user_submit'])) {
            $db = db::getInstance();
            $id = (int) @$_REQUEST['id'];
            $query = "SELECT * FROM `users` WHERE id=" . $id;
            $result = $db->query($query);
            $isNew = !(BOOL) $result->num_rows;
            if ($isNew) {
                $name = $db->real_escape_string($_REQUEST['name']);
                $username = $db->real_escape_string($_REQUEST['username']);
                $password = md5($_REQUEST['password']);
                $email = $db->real_escape_string($_REQUEST['email']);
				$city = $db->real_escape_string($_REQUEST['city']);
				$state = $db->real_escape_string($_REQUEST['state']);
				$country = $db->real_escape_string($_REQUEST['country']);
                $isSuper = (int) @$_REQUEST['is_super_user'];
                $status = (int) @$_REQUEST['status'];
                $query = "INSERT INTO `users` (`name`,`username`,`email`,`password`,`city`,`state`,`country`,`is_super_user`,`status`)" .
                        " VALUES ('$name','$username','$email','$password','$city','$state','$country',$isSuper,$status)";
                if ($db->query($query)) {
                    $_SESSION['messages'][] = array("type" => "success", "message" => "User added successfully");

                    
                    header('Location: index.php?q=user');
                    die('<script>document.location="index.php?q=user";</script>');
                }
                else
                    $_SESSION['messages'][] = array("type" => "error", "message" => "Something went wrong");
            }
            else {
                $name = $db->real_escape_string($_REQUEST['name']);
				$city = $db->real_escape_string($_REQUEST['city']);
				$state = $db->real_escape_string($_REQUEST['state']);
				$country = $db->real_escape_string($_REQUEST['country']);
                $password = md5($_REQUEST['password']);
                $isSuper = (int) @$_REQUEST['is_super_user'];
                $status = (int) @$_REQUEST['status'];
                $query = "UPDATE `users` SET `name`='$name',`city`='$city',`state`='$state',`country`='$country',is_super_user=$isSuper,status=$status";
                if (!empty($_REQUEST['password']))
                    $query.=",password='$password'";
                echo $query.=" WHERE id=$id";

                if ($db->query($query)) {
                    $_SESSION['messages'][] = array("type" => "success", "message" => "User Updated successfully");
                    header('Location: index.php?q=user');
                    die('<script>document.location="index.php?q=user";</script>');
                }
                else
                    $_SESSION['messages'][] = array("type" => "error", "message" => "Something went wrong");
            }
        }

        $db = db::getInstance();
        $id = (int) @$_REQUEST['id'];
        $query = "SELECT * FROM `users` WHERE id=" . $id;
        $result = $db->query($query);
        $isNew = !(BOOL) $result->num_rows;
        $row = $result->fetch_object();

        

        $this->view->load("header");
        $this->view->show();

        $this->view->load("edit_user");
        $this->view->set("base_url", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?q=login");
        $this->view->set("row", $row);
        $this->view->set("isNew", $isNew);
        
        $this->view->show();
        $this->view->load("footer");
        $this->view->show();
    }

    function email_check() {
        $email = $_GET['email'];
        $db = db::getInstance();
        $email = $db->real_escape_string($email);
        $query = "SELECT * FROM `users` WHERE email='$email'";
        $result = $db->query($query);
        if ($result->num_rows)
            die('false');
        echo 'true';
    }

    function username_check() {
        $username = $_GET['username'];
        $db = db::getInstance();
        $username = $db->real_escape_string($username);
        $query = "SELECT * FROM `users` WHERE username='$username'";
        $result = $db->query($query);
        if ($result->num_rows)
            die('false');
        echo 'true';
    }

    function forgot() {

        if (isset($_SESSION['user'])) {
            header('Location: index.php');
            die('<script>document.location="index.php";</script>');
        }

        $this->view->load("header");
        $this->view->show();
        $this->view->load("psswd_rst");

        $db = db::getInstance();
        if ((isset($_GET['code']) && isset($_GET['email']))) {
            $email = $db->real_escape_string($_GET['email']);
            $code = $db->real_escape_string($_GET['code']);
            $query = "SELECT * FROM `users` WHERE email='$email' AND code='$code'";
            $result = $db->query($query);
            if ($row = $result->fetch_object()) {
                $_SESSION['forgot_password'] = array('email' => $email, 'code' => $code);
            }
        }
        if (isset($_SESSION['forgot_password'])) {
            if (isset($_POST['password_submit'])) {
                $password = md5($_POST['password']);
                $query = "UPDATE `users` SET password='$password',code=NULL WHERE email='$email' AND code='$code'";
                if ($db->query($query)) {
                    $_SESSION['messages'][] = array("type" => "success", "message" => "Password reset. You will be redirected to login page in 5 seconds");
                } else {
                    $_SESSION['messages'][] = array("type" => "error", "message" => "Something went wrong.");
                }
                $this->view->set("hide_pwd", true);
            }
        } else {
            $_SESSION['messages'][] = array("type" => "error", "message" => "Something went wrong.");
            $this->view->set("hide_pwd", true);
        }
        $this->view->show();
        $this->view->load("footer");
        $this->view->show();
    }

    function reset() {
        ini_set("display_errors", E_ERROR);
        error_reporting(E_ERROR);

        if (isset($_SESSION['user'])) {
            header('Location: index.php');
            die('<script>document.location="index.php";</script>');
        }

        if (isset($_POST['reset_submit'])) {
            $db = db::getInstance();
            $email = $db->real_escape_string($_POST['email']);
            $query = "UPDATE `users` SET code=md5(CONCAT(now(),`password`)) WHERE `email`='$email'";
            $db->query($query);
            $query = "SELECT * FROM `users` WHERE `email`='$email'";
            $result = $db->query($query);
            if ($row = $result->fetch_object()) {

                $_SESSION['messages'][] = array("type" => "success", "message" => "Message containing reset password link is mailed to your email ID");
            } else {
                $_SESSION['messages'][] = array("type" => "error", "message" => "This email is not registered");
            }
        }
        $this->view->load("header");
        $this->view->show();
        $this->view->load("reset");
        $this->view->show();
        $this->view->load("footer");
        $this->view->show();
    }

    function delete() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?q=login');
            die('<script>document.location="index.php?q=login";</script>');
        }
        if (!$_SESSION['user']['details']->id) {
            header('Location: index.php');
            die('<script>document.location="index.php";</script>');
        }
        $id = (int) $_GET['id'];
        $db = db::getInstance();
        if ($_SESSION['user']['details']->id == $id) {
            $_SESSION['messages'][] = array("type" => "error", "message" => "You cannot delete your own account");
        } else {
            $query = "DELETE FROM `users` WHERE id=$id";
            if ($db->query($query))
                $_SESSION['messages'][] = array("type" => "success", "message" => "Successfully deleted");
            else
                $_SESSION['messages'][] = array("type" => "error", "message" => "Something went wrong. Please try again");
        }

        @header('Location: index.php?q=user');
        die('<script>document.location="index.php?q=user";</script>');
    }

    function status() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?q=login');
            die('<script>document.location="index.php?q=login";</script>');
        }
        if (!$_SESSION['user']['details']->id) {
            header('Location: index.php');
            die('<script>document.location="index.php";</script>');
        }
        $id = (int) $_GET['id'];
        $db = db::getInstance();
        if ($_SESSION['user']['details']->id == $id) {
            $_SESSION['messages'][] = array("type" => "error", "message" => "You cannot disable your own account");
        } else {
            
            $query = "UPDATE `users` SET status= NOT status WHERE id=$id";
            if ($db->query($query))
                $_SESSION['messages'][] = array("type" => "success", "message" => "Successfully changed status");
            else
                $_SESSION['messages'][] = array("type" => "error", "message" => "Something went wrong. Please try again.");
        }
        @header('Location: index.php?q=user');
        die('<script>document.location="index.php?q=user";</script>');
    }
    function ajax()
    {
        define("NUM_USERS_PER_PAGE",10);
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?q=login');
            die('<script>document.location="index.php?q=login";</script>');
        }
        $page   = (int)$_GET['page'];
        if(!$page)
            $page=1;
        $offset = NUM_USERS_PER_PAGE*($page-1);
        $output = array("success"=>FALSE);
        $db     = db::getInstance();
        $query = "SELECT * FROM `users` LIMIT $offset,".NUM_USERS_PER_PAGE;
        $result = $db->query($query);
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        $output['success']  = TRUE;
        $output['values']    = $rows;
        print_r(json_encode($output));
        
    }

}