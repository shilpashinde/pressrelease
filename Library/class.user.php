<?php
class user extends singleton
{
    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }
    public function login($username,$password)
    {
        $db     = mongo_db::getInstance()->getDB(config::getInstance()->MONGO_DB);
        $curser = $db->users->find(array("username"=>$username,"password"=>  md5($password)));
        if($curser->count())
        {
            $_SESSION['user']   = $curser->getNext();
            return TRUE;
        }
        return FALSE;
        
    }
    public function isAdmin()
    {
        return $this->isLoggedIn() && ($_SESSION['user']['role']==="admin");
    }
    public function addUser($user)
    {
        if(!$this->isAdmin())
            return FALSE;
        $user['password']   = md5($user['password']);
        return TRUE;
    }
    public function get($key)
    {
        if(isset($_SESSION['user'][$key]))
            return $_SESSION['user'][$key];
        return FALSE;
    }
    public function getRoleValue()
    {
        if(isset($_SESSION['user']['role']) && config::getInstance ()->USER_TYPES[$_SESSION['user']['role']])
            return config::getInstance ()->USER_TYPES[$_SESSION['user']['role']];
        return 0;
    }
    public function logout()
    {
        unset($_SESSION['user']);
    }
}