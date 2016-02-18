<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Players extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function all()
    {
        $this->db->order_by("player", "desc"); // change "player" back to "id" in assign 2
        $query = $this->db->get('players');
        return $query->result_array();
    }
    
    function getPlayer($player)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('players');
        
        foreach ($query as $record)
            if ($record['Player'] == $player)
                    return $record;
            return null;
    }
}
