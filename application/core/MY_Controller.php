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
        // Load form helper library
        //$this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
        // Load session library
        $this->load->library('session');
        // Load database
        $this->load->model('players');
    }

    /**
     * Render this page
     */
    function render()
    {
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
	$this->load->helper('url');
        $this->data['dependencies'] = $this->parser->parse('_dependencies', $this->data, true);
        
        $navbar =  $this->parser->parse('_navbar', $this->data, true);
        $this->data['header'] = $navbar;
        $this->data['footer'] = $this->load->view('_footer', $this->data, true);
        $this->data['data'] = &$this->data;

        //$this->data['dependencies'] //conains all css, js scripts, resources, imgs, etc.
        //$this->data['header'] //this contains the navbar and title of the page.
        //$this->data['content'] // content of the page, depends on page
	$this->parser->parse('_template', $this->data);
    }
    
    function auth_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        var_dump($this->data);
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
    
    function create_navbar()
    {   
        $rows = array();
        foreach ($this->choices as $navitem)
            $rows[] = (array) $navitem;
        $parms['records'] = $rows;
        $this->data['navitems'] = $this->parser->parse('_navbar',$parms, true);
    }

}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */