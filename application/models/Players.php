<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Players extends CI_Model{
    
    //Create the Players model
    function __construct() {
        parent::__construct();
    }
    
    //Grab all of the information from the Players table.
    function all()
    {
        $query = $this->db->query('SELECT Player, Cash FROM players');
        return $query->result_array();
    }
    
    //Get a specific player's information from the Players table.
    function getPlayer($player)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('players');
        
        foreach ($query as $record)
            if ($record['Player'] == $player)
                    return $record;
            return null;
    }
    
    //Check to see if this "player" is registered in the database.
    function isPlayer($player)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('players');
        
        foreach ($query as $record)
            if ($record['Player'] == $player)
                    return true;
            return false;
    }
    
    //Get all of the player names from the player table.
    function getPlayerNames()
    {
        //$this->db->order_by("id", "desc");
        $query = $this->db->query('SELECT player FROM players');
        return $query->result();
    }
}
