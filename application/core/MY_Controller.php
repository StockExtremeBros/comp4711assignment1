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
    }

    /**
     * Render this page
     */
    function render()
    {
	$this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
	$this->data['footer'] = $this->load->view('_footer', $this->data, true);
        $this->data['dependencies'] = $this->parser->parse('_dependencies', $this->data, true);
        
        // Check if the user is logged in via the php session
        if (array_key_exists('current_user', $_SESSION)) {
            $navbar =  $this->parser->parse('_navbar_loggedin', $this->data, true);
        } else {
            $navbar =  $this->parser->parse('_navbar_loggedout', $this->data, true);
        }
        
        $this->data['header'] = $navbar;
        $this->data['data'] = &$this->data;
        
        //$this->data['dependencies'] //conains all css, js scripts, resources, imgs, etc.
        //$this->data['header'] //this contains the navbar and title of the page.
        //$this->data['content'] // content of the page, depends on page
	$this->parser->parse('_template', $this->data);
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