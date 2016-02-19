<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Transactions extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function all()
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('transactions');
        return $query->result_array();
    }
    
    function getPlayerTransactions($player)
    {
        $this->db->order_by("id", "desc");
        $queryString = sprintf("SELECT * FROM transactions WHERE player='%s' ORDER BY DateTime DESC", $player);
        $query = $this->db->query($queryString);
        return $query->result();   
    }
    
    function getPlayerTransactionsForStock($player, $stock)
    {
        //$this->db->order_by("id", "desc");
        $queryString = sprintf("SELECT Trans, Quantity FROM transactions WHERE player='%s' AND stock='%s'", $player, $stock);
        $query = $this->db->query($queryString);
        return $query->result();   
    }
}
