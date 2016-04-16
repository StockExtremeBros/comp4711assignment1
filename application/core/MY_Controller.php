<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;		  // identifier for our content
    protected $choices = array(// our menu navbar
	'Home' => '/', 
        'Stock History' => '/stock', 
        'Profile' => '/profile'
    );
    
    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */
    function __construct()
    {
	parent::__construct();
	$this->data = array();
	$this->data['pagetitle'] = 'StockExtremeBros';
        $this->load->library('parser');
        // Load 
        $this->load->library('form_validation');
        // Load session library
        $this->load->library('session');
        // Load databases
        $this->load->model('players');
        $this->load->model('stocks');
        $this->load->model('transactions');
        // Load url helper
        $this->load->helper('url');
    }

    /**
     * Render this page
     */
    function render()
    {
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['dependencies'] = $this->parser->parse('_dependencies', $this->data, true);
        $this->data['footer'] = $this->load->view('_footer', $this->data, true);
        
        // Check if the user is logged in via the php session
        if (array_key_exists('current_user', $_SESSION)) {
            $this->data['current_user'] = $_SESSION['current_user'];
            $navbar =  $this->parser->parse('_navbar_loggedin', $this->data, true);
        } else {
            $navbar =  $this->parser->parse('_navbar_loggedout', $this->data, true);
        }
        $this->data['header'] = $navbar;
        
        $this->data['data'] = &$this->data;
	$this->parser->parse('_template', $this->data);
    }
    
    // Authenticate the user
    function auth_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if(isset($this->session->userdata['logged_in'])){
                $this->data['username'] = $this->session->userdata['logged_in'];
                $this->load->view('welcome_message');
            }else{
                $this->data['username'] = false;
            }
            
        } else {
            $login_data = $this->input->post('username');

            $result = $this->players->getPlayer($login_data);
            if ($result != null) {

                $this->data['username'] = $result;
            } else {
                $this->data['error_message'] = 'Invalid Username';
            }
            var_dump($this->data);
        }
        $this->load->view('welcome_message');
    }
    
    //Create the navigate bar with the nav-items in the $choices variable
    function create_navbar()
    {   
        $rows = array();
        
        foreach ($this->choices as $navitem)
        {
            $rows[] = (array) $navitem;
        }
  
        $parms['records'] = $rows;
        $this->data['navitems'] = $this->parser->parse('_navbar',$parms, true);
    }
    
    /*
     * Create the player's equity uses the player's transactions in stocks.
     */
    function get_player_equity($player)
    {
        $allStocks = $this->stocks->all();
        $equity = 0;
        foreach ($allStocks as $row)
        {
            $total = 0;
            $player_stock = $this->transactions->getPlayerTransactionsForStock($player, $row['Code']);
            foreach ($player_stock as $trans)
            {
                if ($trans->Trans == 'buy')
                {
                    $total += $trans->Quantity;
                }else if ($trans->Trans == 'sell')
                {
                    $total -= $trans->Quantity;
                }
            }
            $equity += ($total * $row['Value']);
        }
        return $equity;
    }

}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */