<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Uploadfile extends Application {
	
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }


    function upload_it() 
    {
        //load the helper
        $this->load->helper('form');

        //Configure
        //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
        $config['upload_path'] = 'assets/pictures/avatars/';

        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png';

        //load the upload library
        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        $this->upload->set_allowed_types('*');

        $data['msg'] = 'This is a message';
        $data['upload_data'] = 'uploads to the assets/pictures/avatars/ folder.';

        // CHECK THE DATABASE HERE TO SEE IF WE HAVE A NEW PLAYER OR WE ARE REPLACING AN IMAGE
        // DO WE HANDLE DELETION? Easy answer, no.

        //if not successful, set the error message
        if (!$this->upload->do_upload('userfile')) 
        {
            $data['msg'] = $this->upload->display_errors();
            $data['file_name'] = "";
        } 
        else 
        { //else, set the success message
            $data['msg'] = "Upload success!";
            $data['file_name'] = $this->upload->data()['file_name'];
            
            // Contents of the uploading stuff to be used later.
            var_dump($this->upload->data());
        }

        $this->parser->parse('_upload_form', $data);
    }

}
