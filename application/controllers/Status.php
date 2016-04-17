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
        //$this->load->model('gamestatus');
        var_dump(get_token());
        //get_stocks();
        
        
    }
    
}
