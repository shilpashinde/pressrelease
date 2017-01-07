<?php

class Controller
{
    protected $view;
    public function __construct() {
        
        $this->view = new View();
    }
    public function index()
    {
        echo "Please Add an Index Funtion to your controller";
    }
}