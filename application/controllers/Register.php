<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Application {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if (array_key_exists('current_user', $_SESSION))
        {
            $this->data['pagebody'] = 'nice_try_registration';
        }
        else
        {
            $this->data['pagebody'] = 'registration';
        }
        $this->render();
    }
    
    public function register()
    {
        
    }
}
