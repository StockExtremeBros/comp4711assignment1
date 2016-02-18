<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        // Check if 'current_user' has been set yet this session
        // If not, the user is not logged in
        if (!array_key_exists('current_user', $_SESSION))
        {
            $this->data['pagebody'] = 'login_notice';
        }
        else
        {
            $this->load->library('parser');
            $this->populate_stocks();
            $this->populate_profiles();
            $this->data['pagebody'] =  'homepage';
        }
        $this->render();
    }
    
    public function populate_stocks()
    {
        $stocks = $this->stocks->all();
        
        foreach ($stocks as $s)
        {
            $cells[] = $this->parser->parse('_cell_stocksummary', (array) $s, true);
        }
        
        $this->load->library('table');
        $tabletemp = array(
            'table_open' => '<table class="stock-summary table table-striped table-hover">',
            'row_start'  => '<tr class="stock-summary">'
        );
        $this->table->set_template($tabletemp);
        
        $this->table->set_heading('Stock', 'Current Stock Value');
        $rows = $this->table->make_columns($cells, 1);
        $this->data['stockoverview'] = $this->table->generate($rows);
    }
    
    public function populate_profiles()
    {
        $players = $this->players->all();
        
        foreach ($players as $playa)
        {
            $cells[] = $this->parser->parse('_cell_playersummary', (array) $playa, true);
        }
        
        $this->load->library('table');
        $tabletemp = array(
            'table_open' => '<table class="player-summary table table-striped table-hover">',
            'row_start'  => '<tr class="player-summary">'
        );
        $this->table->set_template($tabletemp);
        
        $this->table->set_heading('Player', 'Current Cash', 'Current Equity');
        $rows = $this->table->make_columns($cells, 1);
        $this->data['playeroverview'] = $this->table->generate($rows);
    }
}
