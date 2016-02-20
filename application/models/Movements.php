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
    
    //Grab all the information from the movements table.
    function all()
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('movements');
        return $query->result_array();
    }
    
    //Get all the Stock movements from a specific code number.
    function getStockMovements($code)
    {
        $sql = "SELECT * FROM movements WHERE Code = ? ORDER BY DateTime DESC";
        $query = $this->db->query($sql, array($code));
        
        return $query->result();
    }
}
