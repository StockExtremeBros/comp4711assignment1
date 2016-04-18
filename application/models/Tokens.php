<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tokens
 *
 * @author Gabriella
 */
class Tokens extends CI_Model{
    
    function __construct() 
    {
        parent::__construct();
    }
    
    function add_token($team, $name, $password)
    {
        $this->load->helper('request');
        $result = register_request($team, $name, $password);
        $xml = simplexml_load_string($result);
        $agent = (string) $xml->team;
        $token = (string) $xml->token;
        $this->db->empty_table('tokens');
        $sql = sprintf("INSERT INTO tokens VALUES ('%s', '%s')",
                $agent, $token);
        $query = $this->db->query($sql);
    }
    
    function get_token()
    {
        $sql = "SELECT * FROM tokens";
        $query = $this->db->query($sql);
        $token = $query->result()[0];
        return $token->Key;
    }
    
    function get_count()
    {
        $sql = "SELECT count(*) as count FROM tokens";
        $query = $this->db->query($sql);
        $result = $query->result()[0];
        return $result->count;
    }
    
    function get_agent()
    {
        $sql = "SELECT * FROM tokens";
        $query = $this->db->query($sql);
        $token = $query->result()[0];
        return $token->Agent;
    }
}
