<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Transactions extends CI_Model{
    
    //Create the transactions model
    function __construct() {
        parent::__construct();
    }
    
    //Grab all of the information from the Transactions table.
    function all()
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('transactions');
        return $query->result_array();
    }
    
    //Grab a specific player's transactions
    function getPlayerTransactions($player)
    {
        $this->db->order_by("id", "desc");
        $queryString = sprintf("SELECT * FROM transactions WHERE player='%s' ORDER BY DateTime DESC", $player);
        $query = $this->db->query($queryString);
        return $query->result();   
    }
    
    //Get a player's transaction in regards to a specific stock
    function getPlayerTransactionsForStock($player, $stock)
    {
        //$this->db->order_by("id", "desc");
        $queryString = sprintf("SELECT Trans, Quantity FROM transactions WHERE player='%s' AND stock='%s'", $player, $stock);
        $query = $this->db->query($queryString);
        return $query->result();   
    }
    
    //Get a stock's transaction history in descending time order.
    function getStockTransaction($stock)
    {
        $sql = "SELECT * FROM transactions WHERE Stock = ? ORDER BY DateTime DESC";
        $query = $this->db->query($sql, array($stock));
        
        return $query->result();
    }
    
    //Get the most recent stock transaction
    function getRecentStockTransaction()
    {
        $sql = "SELECT * FROM transactions ORDER BY DateTime DESC LIMIT 1";
        $query = $this->db->query($sql);
        var_dump($query);
        return $query->result_array();
    }
    
    function saveTransaction($cert, $player, $stock, $type, $quantity, $datetime)
    {
        $sql = sprintf("INSERT INTO transactions (DateTime, Player, Stock, Trans, Quantity, Certificate) VALUES ('%s', '%s', '%s', '%s', '%d', '%s')",
                $datetime, $player, $stock, $type, $quantity, $cert);
        $query = $this->db->query($sql);
    }
}
