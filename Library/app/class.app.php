<?php

class App extends singleton{

    
    private $db;
    private $db_try =0;
            
    function init() {
        $this->db = db::getInstance();
        

    }

    
    function getDB()
    {
        return $this->db;
    }
    function reconnectDB()
    {
        while(!$this->checkDBConnection() && ++$this->db_try<=config::getInstance()->DB_MAX_TRY)
            $this->getDB()->connection->reconnect();
        if($this->checkDBConnection())
            $this->db_try   =0;
        else
            throw new Exception;
    }
    function checkDBConnection()
    {
        return $this->getDB()->connection->ping();
    }

}