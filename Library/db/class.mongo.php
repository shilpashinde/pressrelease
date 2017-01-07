<?php
class mongo_db extends singleton
{
    private $mongo;
    protected function __construct() {
        $server = "mongodb://".((config::getInstance()->MONGO_USER)?(config::getInstance()->MONGO_USER).":".config::getInstance()->MONGO_PASS."@":"").  config::getInstance()->MONGO_HOST.":" . config::getInstance()->MONGO_PORT;
        $this->mongo    = new MongoClient($server);
    }
    public function getDB($db)
    {
        return $this->mongo->$db;
    }
}