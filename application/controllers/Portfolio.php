<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

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
	public function index($player = null)
	{
            if($player == null)
            {
                
            }

            //$this->load->view('test');
          /** //This grabs all the players and their info
            * $players = $this->players->all(); // Grab all players
            * $players[0]['Player']; //Grabs the first index's player's name
            */
            $this->data['pagebody'] =  'test';
            $this->render();
	}
}

/* 
 <a href="/order/cancel/{order_num}" class="btn btn-large btn-danger">Forget about it</a>
 *  */