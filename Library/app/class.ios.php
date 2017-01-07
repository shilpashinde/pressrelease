<?php

class ios_App extends App
{
    private $apns;
    function init() {
        parent::init();
        $this->apns = new ApnsPHP_Push(ApnsPHP_Abstract::ENVIRONMENT_SANDBOX, config::getInstance()->APNS_CERT);
        $this->apns->setProviderCertificatePassphrase(config::getInstance()->APNS_PASS);
    }
    function connect() {
        try {
            $this->apns->connect();
        } catch (Exception $e) {
            
        }
    }
    function closeConnection()
    {
        $this->apns->close();
    }
    function reconnect()
    {
        $this->closeAPNS();
        $this->connectToAPNS();
    }
    
   
}