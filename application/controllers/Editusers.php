<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editusers extends Application {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->library('table');
        $this->load->library('parser');
        $this->load->library('session');
        $this->data['pagebody'] = 'editusers';
        
        $users = $this->players->getPlayerNames();
        $rows = array();
        foreach ($users as $user)
        {
            if ($user->Player != $this->session->userdata('current_user'))
            {
                array_push($rows, array($this->parser->parse('_cell_user.php', array('username' => $user->Player), TRUE)));
            }
        }
        
        $tabletemp = array(
            'table_open' => '<table class="user-list table table-striped">'
        );
        $this->table->set_template($tabletemp);
        
        $this->table->set_heading('User');
        $this->data['users_table'] = $this->table->generate($rows);
        $this->render();
    }
    
    public function removeUser()
    {
        $this->load->library('session');
        $username = $this->input->post('user_delete');
        $this->players->removePlayer($username);
        redirect(base_url('/editusers'));
    }
}
