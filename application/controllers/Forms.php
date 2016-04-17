<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends Application {
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * Opens a new session with the username supplied in the
     * login field. Password is ignored.
     */
    public function login()
    {
        $this->load->library('session');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->players->checkPassword($username, $password))
        {
            if ($this->players->isAdmin($username))
            {
                $this->session->set_userdata('is_admin', true);
            }
            $this->session->set_userdata('current_user', $username);
            redirect(base_url()); 
        }
        else
        {
            redirect(base_url());
        }
    }
    
    /**
     * Destroy the session upon logout
     */
    public function logout()
    {
        session_destroy();
        redirect(base_url());
    }
    
}
