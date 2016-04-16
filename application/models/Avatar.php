<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Avatar extends CI_Model{
    /*Attributes:
     * Player ==> Primary/Foreign key       = player name
     * Path                                 = absolute file path
     * Image                                = image name
     */
    
    // THIS IS NOT IMPELEMENTED YET AND UNTESTED!!!!!
    function __construct() 
    {
        parent::__construct();
    }
    
    //Grab all the information from the avatar table.
    function all()
    {
        $this->db->order_by("player");
        $query = $this->db->get('avatars');
        
        return $query->result_array();
    }
    
    function getAvatar($player)
    {
        $sql = "SELECT * FROM avatars WHERE Player = ? LIMIT 1";
        $query = $this->db->query($sql, array($Name));
        return $query->result_array();
    }
    
    function findPlayer($player)
    {
        $sql = "SELECT Player FROM avatars WHERE Player = ?";
        $query = $this->db->query($sql, array($player));
        return $query->result_array();
    }
    
    // Uploads an entirely new player.
    function uploadNewPlayer($player, $path, $image)
    {
        //Untested
        $exists = $this->findPlayer($player);
        var_dump($exists);
        if(isset($exists) || !empty($exists))
        {
            //Error, the player already exists in the table.
            return false;
        }
        $sql = "INSERT INTO avatars (Player, Path, Image) VALUES ('".$player."', '".$path."', '".$image."')";
        $this->db->query($sql);
        
        return true;
    }
    
    // Replaces an existing avatar with a new one.
    function replaceAvatar($player, $path, $image)
    {
        // Untested
        $sql = "REPLACE INTO avatars VALUES ('".$player."', '".$path."', '".$image."')";
        $this->db->query($sql);
    }
}
