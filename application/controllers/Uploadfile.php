<?php

class Uploadfile extends Application {
	
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function default_pic()
    {
        $this->load->model('avatar');
        $this->load->helper('form');
        $player = $this->data['current_user'];    
        $this->avatar->uploadDefault($player);
        
        redirect(base_url());
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

        //if not successful, set the error message        
        if (!$this->upload->do_upload('userfile')) 
        {
            redirect(base_url().'/upload');
        } 
        else 
        {
            
            $file_name = strtolower($this->upload->data()['file_name']);
            $path = '/assets/pictures/avatars/'.$file_name;
            $player = $this->data['current_user'];
            
            $this->avatar->uploadNewPlayer($player, $path, $file_name);
            
            redirect(base_url());
        }
    }

}
