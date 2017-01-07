<?php
class db extends singleton
{
    
    private $connection;
    
    protected function __construct()
    {
       
        
        $this->connection   = new mysqli(config::getInstance()->DB_HOST,  config::getInstance()->DB_USERNAME,  config::getInstance()->DB_PASSWORD,  config::getInstance()->DB_NAME,  config::getInstance()->DB_PORT);
        if ($this->connection->connect_errno)
            die("Connection failed with : ".$this->connection->connect_error);
    }
    
    function query($query)
    {
        if($result = $this->connection->query($query))
            return $result;
        return FALSE;
        
    }
    public function getConnection()
    {
        return $this->connection;
    }

    public function __call($name, $arguments) {
        if(!method_exists($this, $name) && method_exists($this->connection, $name))
            return call_user_func_array(array($this->connection,$name),$arguments);
    }
}