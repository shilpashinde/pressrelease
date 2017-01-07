<?php

class View {

    protected $file;
    protected $_data = array();

    public function __construct() {
        
    }

    public function load($file) {

        $filename = $file . ".view.php";
        if (SYSTEM_PATH)
            $filename = SYSTEM_PATH . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $file . ".view.php";

        if (!file_exists($filename)) {
            echo "Error loading template file ($filename).";
            return FALSE;
        }
        $this->file = $filename;
    }

    public function set($key, $value) {
        $this->_data[$key] = $value;
    }

    public function show() {
        if (!file_exists($this->file)) {
            echo "Error loading template file ($this->file).";
            return FALSE;
        }
        extract($this->_data);
        include $this->file;
        return TRUE;
    }

}