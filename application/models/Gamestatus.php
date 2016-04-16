<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Gamestatus extends CI_Model{
    
    private $xml = array();
    protected $status = array();
    public $error;
    //round (current round number: [737])
    //state (game state number: [2])
    //current (current game state: [ready]) 
    //duration (seconds for this state: [10])
    //upcoming (game state: [open])
    //alarm (time: [19:18:59])
    //now (time: [19:18:59])
    ////countdown (seconds till next state change: [10])
    //<bsx><round>734</round><state>0</state><countdown/><desc>closed</desc></bsx>
    
    function __construct() {
        parent::__construct();
        
        $status['round'] = 0;
        $status['state'] = GAME_CLOSED;
        $status['current'] = 'closed';
        $status['duration'] = 0;
        $status['upcoming'] = 'closed';
        $status['round'] = '00:00:00'; 
        $status['now'] = '00:00:00';
        $status['countdown'] = 0; 
        
        try
        {
            $website = file_get_contents("http://bsx.jlparry.com/status");
            $this->xml = simplexml_load_string($website);
            
        } catch(HttpException $e) {
            $error = $e->getMessage();
        } catch(exception $e)
        {
            $error = $e->getMessage();
        }
        
        if(!empty($this->xml))
        {
            isset($this->xml->round) ? $status['round'] = $this->xml->round[0] : $status['round'] = 0;
            isset($this->xml->state) ? $status['state'] = $this->xml->state[0] : $status['state'] = GAME_CLOSED;
            isset($this->xml->current) ? $status['current'] = $this->xml->current[0] : 'closed';
            isset($this->xml->duration) ? $status['duration'] = $this->xml->duration[0] : $status['duration'] = 0;
            isset($this->xml->upcoming) ? $status['upcoming'] = $this->xml->upcoming[0] : $status['upcoming'] = 'closed';
            isset($this->xml->alarm) ? $status['round'] = $this->xml->alarm[0] : $status['round'] = '00:00:00'; 
            isset($this->xml->now) ? $status['now'] = $this->xml->now[0] : $status['now'] = '00:00:00';
            isset($this->xml->countdown) ? $status['countdown'] = $this->xml->countdown[0] : $status['countdown'] = 0; 
        }
        
        
        var_dump($status);
    }
}
