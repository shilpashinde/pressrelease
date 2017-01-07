<?php

class ios_App extends App {

    private $authCode;

    function init() {
        parent::init();
    }

    function connect() {
        try {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.google.com/accounts/ClientLogin");
            $post_fields = "accountType=" . urlencode('GOOGLE')
                    . "&Email=" . urlencode($username)
                    . "&Passwd=" . urlencode($password)
                    . "&source=" . urlencode($source)
                    . "&service=" . urlencode($service);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


            $response = curl_exec($ch);

            curl_close($ch);

            if (strpos($response, '200 OK') === false) {

                preg_match("/Error=([\w|-]+)/", $response, $matches);

                return false;
            }
            preg_match("/(Auth=)([\w|-]+)/", $response, $matches);

            if (!$matches[2]) {


                return false;
            }

            $_SESSION['google_auth_id'] = $matches[2];

            return $matches[2];
        } catch (Exception $e) {
            
        }
    }

    function closeConnection() {
        $this->apns->close();
    }

    function reconnect() {
        $this->closeAPNS();
        $this->connectToAPNS();
    }

}