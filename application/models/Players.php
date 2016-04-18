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
        $query = $this->db->query('SELECT Player FROM players');
        return $query->result();
    }
    
    function addPlayer($player, $password)
    {
        // INSERT for players table
        $data = array('Player' => $player, 'Cash' => 5000);
        $query = $this->db->insert_string('players', $data);
        if (!$this->db->query($query))
        {
            return false;
        }
        
        // INSERT for passwords table
        $data = array('Player' => $player, 'Password' => $password);
        $query = $this->db->insert_string('passwords', $data);
        return $this->db->query($query);
    }
    
    function removePlayer($player)
    {
        $tables = array('passwords', 'avatars', 'transactions', 'players');
        $this->db->where('Player', $player);
        return $this->db->delete($tables);
    }
    
    function checkPassword($player, $password)
    {
        $query = $this->db->query('SELECT Password FROM passwords '
                . 'WHERE player = \'' . $player . '\'');
        return password_verify($password, $query->result()[0]->Password);
    }
    
    function isAdmin($player)
    {
        $query = $this->db->query('SELECT Role FROM passwords '
                . 'WHERE player = \'' . $player . '\'');
        if ($query->result()[0]->Role == 'Admin')
        {
            return true;
        }
        return false;
    }
    
    function getPlayerCash($player)
    {
        $query = $this->db->query('SELECT Cash FROM players WHERE player = \'' . $player . '\'');
        $cash = $query->result()[0]->Cash;
        return $cash;
    }
    
    function spentCash($price, $amount, $player)
    {
        $cash_spent = $price * $amount;
        $query = $this->db->query('SELECT Cash FROM players WHERE player = \'' . $player . '\'');
        $current_cash = $query->result()[0]->Cash;
        $new_cash = $current_cash - $cash_spent;
        $query = $this->db->query('UPDATE players SET Cash = ' . $new_cash . ' WHERE player = \'' . $player . '\'');
    }
    
    function gainedCash($price, $amount, $player)
    {
        $cash_spent = $price * $amount;
        $query = $this->db->query('SELECT Cash FROM players WHERE player = \'' . $player . '\'');
        $current_cash = $query->result()[0]->Cash;
        $new_cash = $current_cash + $cash_spent;
        $query = $this->db->query('UPDATE players SET Cash = ' . $new_cash . ' WHERE player = \'' . $player . '\'');
    }
    
    function resetCash()
    {
        $query = $this->db->query('UPDATE players SET Cash = 5000');
    }
}
