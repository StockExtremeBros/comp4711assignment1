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
        
        try
        {
            $website = file_get_contents("http://www.comp4711bsx.local/status");
            $password = 'tuesday';
            $website.$password;
            $this->xml = simplexml_load_string($website);
            
        } catch(HttpException $e) {
            $error = $e->getMessage();
        } catch(exception $e)
        {
            $error = $e->getMessage();
        }
        
        if(!empty($this->xml))
        {
            isset($this->xml->round) ? $this->status['round'] = $this->xml->round[0] : 0;
            isset($this->xml->state) ? $this->status['state'] = $this->xml->state[0] : 0;
            isset($this->xml->current) ? $this->status['current'] = $this->xml->current[0] : 0;
            isset($this->xml->duration) ? $this->status['duration'] = $this->xml->duration[0] : 0;
            isset($this->xml->upcoming) ? $this->status['upcoming'] = $this->xml->upcoming[0] : 0;
            isset($this->xml->alarm) ? $this->status['round'] = $this->xml->alarm[0] : 0; 
            isset($this->xml->now) ? $this->status['now'] = $this->xml->now[0] : 0;
            isset($this->xml->countdown) ? $this->status['countdown'] = $this->xml->countdown[0] : 0; 
        }
        
        //var_dump($status);
    }
    
    function getCurrentStatus()
    {
        return $this->status;
    }
    
    //tates (0/1/2/3/4 : closed/setup/ready/open/over)
    function getGameState()
    {
        if(isset($this->status['state']))
        {
            return (string) $this->status['state'];
        }
        else
        {
            return 0;
        }
    }
    
    function getCurrent()
    {
        if(isset($this->status['current']))
        {
            return $this->status['current'];
        }
        else
        {
            return 'closed';
        }
    }
}
