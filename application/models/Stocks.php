<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Stocks extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function all()
    {
        $this->db->order_by("name", "desc"); // change "name" back to "id" in assign 2
        $query = $this->db->get('stocks');
        return $query->result_array();
    }
    
    function getStock($stock)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('stocks');
        
        foreach ($query as $record)
            if ($record['Code'] == $stock)
                    return $record;
            return null;
    }

    function getStockNames()
    {
        //$this->db->order_by("id", "desc");
        $query = $this->db->query('SELECT Name FROM stocks');
        return $query->result();
    }

    
    function getStockCodes()
    {
        $query = $this->db->query('SELECT Code FROM stocks');
        return $query->result();
    }
}
