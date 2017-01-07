<?php

defined("NO_DIRECT") or die("You are not suppose to access it directly");

class LoginController extends Controller {

    function index() {

        if (isset($_SESSION['user'])) {
            header("Location: index.php");
            die('<script>document.location.href="index.php"');
        }
        $db = db::getInstance();
        if (isset($_COOKIE['authentication'])) {



            $username = $db->real_escape_string(@$_COOKIE['authentication']);


            $query = "SELECT * FROM users WHERE md5( concat( `username` , '::', `password` ) ) ='$username' AND status=1";



            $result = $db->query($query);



            if ($row = @$result->fetch_object()) {

                unset($row->password);
                $_SESSION['user']['details'] = $row;



                $rurl = "index.php";
                if (isset($_REQUEST['redirect_url']) && filter_var(urldecode($_REQUEST['redirect_url']), FILTER_VALIDATE_URL))
                    $rurl = urldecode($_REQUEST['redirect_url']);
                unset($_COOKIE['redirect_url']);
                header("Location: $rurl");
                die('<script>document.location.href="' . $rurl . '"');
            }
        }

        if (isset($_POST['login_submit'])) {


            $username = $db->real_escape_string(@$_POST['usrname']);
            $password = md5(@$_POST['pass']);

            $query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND status=1";
            $result = $db->query($query);

            $output = array("success" => FALSE);


            if ($row = @$result->fetch_object()) {

                unset($row->password);
                $_SESSION['user']['details'] = $row;
                $rurl = "index.php";
                if (isset($_REQUEST['redirect_url']) && filter_var(urldecode($_REQUEST['redirect_url']), FILTER_VALIDATE_URL))
                    $rurl = urldecode($_REQUEST['redirect_url']);
                $rurl;
                header("Location: $rurl");
                die('<script>document.location.href="' . $rurl . '"');
            }
         else {
            $_SESSION['messages'][] = array("type" => "error", "message" => "Invalid Username/Password");
        }
        }

        $this->view->load("header");
        $this->view->show();
        //$this->view->load("menu");
        //$this->view->show();
        $this->view->load("login");
        $this->view->show();
        $this->view->load("footer");
        $this->view->show();
    }


    function logout() {
        if (isset($_SESSION['user']))
            unset($_SESSION['user']);
        setcookie('authentication', "", time() - 100);
        header("Location: index.php");
        die('<script>document.location.href="index.php"');
    }

}