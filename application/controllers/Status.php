<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends Application {
    
    function __construct()
    {
        parent::__construct();
        
    }
    
    public function index()
    {
        $this->load->helper('request_helper');
    }
    
}
