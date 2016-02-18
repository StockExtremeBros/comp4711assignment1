<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends Application {

    /**
     * Controller to handle all form submission on the site
     */


    public function login()
    {
        $this->load->library('session');
        $username = $this->input->post("username");
    }
        
}
