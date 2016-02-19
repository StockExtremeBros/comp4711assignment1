<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Movements extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function all()
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('movements');
        return $query->result_array();
    }
    
    function getStockMovements($code)
    {
        $sql = "SELECT * FROM movements WHERE Code = ?";
        $query = $this->db->query($sql, array($code));
        
        return $query->result();
    }
}
