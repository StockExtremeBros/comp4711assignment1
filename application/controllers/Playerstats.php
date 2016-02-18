<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlayerStats
 *
 * @author Gabriella
 */
class PlayerStats extends Application{
    
    function __construct()
    {
	parent::__construct();
    }
    public function index()
    {
        $this->load->library('table');
        $this->load->model('players');
        
        $this->data['pagebody'] = 'player_stats';
        
        //fill dropdown with player names
        $allPlayers = $this->players->getPlayerNames();
        $players = '';
        foreach($allPlayers as $row)
        { 
             $players .= '<option value="'.$row->player.'">'.$row->player.'</option>';
        }
        $this->data['dropdown'] = $players;
        
        $this->render();
    }
}
