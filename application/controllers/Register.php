<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Application {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if (array_key_exists('register_failed', $_SESSION))
        {
            $this->data['pagebody'] = 'registration_failed';
            session_destroy();
        }
        else if (array_key_exists('current_user', $_SESSION))
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
        $this->load->library('session');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password-confirm'),
                PASSWORD_DEFAULT);
        if ($this->players->addPlayer($username, $password))
        {
            $this->session->set_userdata('current_user', $username);
            redirect(base_url());
        }
        else
        {
            $this->session->set_userdata('register_failed', true);
            redirect(base_url() . '/register');
        }
    }
}
