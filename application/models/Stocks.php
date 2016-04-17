<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Stocks extends CI_Model{
   
    //Create the Stocks model
    function __construct() {
        parent::__construct();
    }
    
    function insertNewStocks($newStocks)
    {
        //var_dump("Moves like Jaegar");
        //var_dump($this->all());
        //var_dump("Moves like Jaegar");
        $this->db->empty_table('stocks');
        
        foreach($newStocks as $stock)
        {
            $data = array(
            'Code' => $stock["code"],
            'Name' => $stock["name"],
            'Value' => $stock["value"],
            'Category' => $stock["category"]
            );
            $this->db->insert('stocks', $data); 
        }
    }
    
    // Grab all of the information from the Stocks table
    function all()
    {
        $this->db->order_by("name", "desc"); 
        $query = $this->db->get('stocks');
        return $query->result_array();
    }
    
    //Grab all information relating to a particular stock.
    function getStock($stock)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('stocks');
        
        foreach ($query as $record)
            if ($record['Name'] == $stock)
                    return $record;
            return null;
    }
    
    //Get all of the Names and Values from the stocks table.
    function getStockNameValue()
    {
        $query = $this->db->query('SELECT Name, Value FROM stocks ORDER BY Name desc');
        return $query->result_array();
    }
    
    //Get all of the names of the stocks from the stocks table.
    function getStockNames()
    {
        //$this->db->order_by("id", "desc");
        $query = $this->db->query('SELECT Name FROM stocks ORDER BY Name desc');
        return $query->result();
    }
    
    //Get the Code and Value from the stocks table using its name.
    function getStockCodeFromName($Name)
    {
        $sql = "SELECT Code, Value FROM stocks WHERE Name = ? LIMIT 1";
        $query = $this->db->query($sql, array($Name));
        
        foreach($query->result_array() as $row)
        {
            return $row;
        }
        return null;
    }
    
    //Get all of the codes from the stocks table.
    function getStockCodes()
    {
        $query = $this->db->query('SELECT Code FROM stocks');
        return $query->result();
    }
    
    //Get only name and value from the stocks table with a stock's code.
    function getStockNameFromCode($Code)
    {
        $sql = "SELECT Name, Value FROM stocks WHERE Code = ? LIMIT 1";
        $query = $this->db->query($sql, array($Code));
        
        return $query->result_array();
    }
    
    function getStockValueByName($name)
    {
        $sql = "SELECT Value FROM stocks where Name = ? LIMIT 1";
        $query = $this->db->query($sql, array($name));
        
        foreach($query->result_array() as $row)
        {
            return $row['Value'];
        }
        return null;
    }
}
