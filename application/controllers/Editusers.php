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
        $this->data['pagebody'] = 'editusers';
        
        $users = $this->players->getPlayerNames();
        
        $tabletemp = array(
            'table_open' => '<table class="user-list table table-striped">'
        );
        $this->table->set_template($tabletemp);
        
        $this->table->set_heading('User', '');
        $this->data['users_table'] = $this->table->generate($users);
        $this->render();
    }
}
