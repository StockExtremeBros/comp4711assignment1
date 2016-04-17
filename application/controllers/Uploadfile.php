<?php

class Uploadfile extends Application {
	
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }


    function upload_it() 
    {
        $this->load->model('avatar');

        //load the helper
        $this->load->helper('form');

        //Configure
        //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
        $config['upload_path'] = 'assets/pictures/avatars/';

        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png';
        
        $config['overwrite'] = TRUE;

        //load the upload library
        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        $this->upload->set_allowed_types('*');

        $this->data['msg'] = 'This is a message';
        $this->data['upload_data'] = 'uploads to the assets/pictures/avatars/ folder.';

        //if not successful, set the error message        
        if (!$this->upload->do_upload('userfile')) 
        {
            $this->data['msg'] = $this->upload->display_errors();
            $this->data['file_name'] = "";
        } 
        else 
        { //else, set the success message
            $this->data['msg'] = "Upload success!";
            $this->data['file_name'] = strtolower($this->upload->data()['file_name']);
            
            $file_name = $this->data['file_name'];
            $path = '/assets/pictures/avatars/'.$this->data['file_name'];
            $player = $this->data['current_user'];
            
            $this->avatar->uploadNewPlayer($player, $path, $file_name);
            
            $this->create_avatar($player);
            // Contents of the uploading stuff to be used later.
            //var_dump($this->upload->data());
        }

        $this->data['pagebody'] = '_upload_form';
        $this->render();
    }

}
