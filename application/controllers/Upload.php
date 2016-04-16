<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Upload extends Application {

    public function __construct()
    {
        parent::__construct();
    }
  
    //if index is loaded
    public function index() {
        //load the helper library
        $this->load->helper('form');
        $this->load->helper('url');
        
        //Set the message for the first time
        $data = array('msg' => "Upload File");

        $data['upload_data'] = '';

        //load the view/upload.php with $data
        $this->load->view('_upload_form', $data);
    
		
    }


}
