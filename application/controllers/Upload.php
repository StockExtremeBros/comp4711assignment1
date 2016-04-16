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
        $data = array('msg'         => "uploads to the assets/pictures/avatars/ folder",
                      'upload_data' => "No uploaded file data yet.",
                      'file_name'   => "");

        //load the view/upload.php with $data
        $this->parser->parse('_upload_form', $data);
    }


}
