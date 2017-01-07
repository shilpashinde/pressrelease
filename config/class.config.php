<?php
require_once dirname(__FILE__).DS."server.php";
class config extends singleton
{
    private $__data = array(
        "LOCAL"=>array(
            'DB_USERNAME'   => 'root',
            'DB_PASSWORD'   => '',
            'DB_HOST'       => 'localhost',
            'DB_PORT'       => '3306',
            'DB_NAME'       => 'pressrelease'
            
        )
    );


    public function __get($name) {
        if(!defined("SERVER"))
            define ("SERVER", "LOCAL");
        if(isset($this->__data[$name]))
            return $this->__data[$name];
        elseif(isset($this->__data[SERVER][$name]))
            return $this->__data[SERVER][$name];
        else
            return FALSE;
    }
}