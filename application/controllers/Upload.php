<?php

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
        $this->data['msg'] = "uploads to the assets/pictures/avatars/ folder";
        $this->data['upload_data'] = "No uploaded file data yet.";
        $this->data['file_name'] = "";

        //load the view/upload.php with $data
        $this->data['pagebody'] = '_upload_form';
        $this->load->model('avatar');
        $this->render();
    }


}
