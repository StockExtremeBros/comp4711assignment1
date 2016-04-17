<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GamePlay extends Application{

    function __construct()
    {
	parent::__construct();
    }
    public function index($current_player = null)
    {
        // Check if 'current_user' has been set yet this session
        // If not, the user is not logged in
        if (!array_key_exists('current_user', $_SESSION))
        {
            $this->data['pagebody'] = 'login_notice';
        }
        else
        {
            $this->load->helper('request');
            $this->load->helper('form');
            $this->load->helper('date');
            
            $this->load->library('table');
            
            $status = $this->gamestatus->getGameState();

            get_stocks();
        
            $this->data['pagebody'] = 'game_play';
        
            if($current_player != null)
            {
                //Force the player to be Uppercase first and lowercase for the rest.
                $current_player = ucfirst(strtolower($current_player));
            } else {
                //get current player
                if (isset($_SESSION['current_user']))
                {
                    $current_player = $_SESSION['current_user'];
                }
            }
        
            $this->data['player'] = $current_player;
            
            $this->data['status'] = $this->gamestatus->getCurrent();
            $this->data['equity'] = $this->get_player_equity($current_player);
            
            //$this->populate_recent_activity($current_player);
            $this->get_latest_movements(5);
            
            //show current player's holdings
            $this->populate_holdings($current_player);
            
            $this->data['stockdropdown'] = $this->populate_stock_dropdown();
        }
        $this->render();
    }
    
    function get_latest_movements($number)
    {
        $result = get_movements($number);
        $movements = array();
        foreach($result as $movement)
        {
            $timestamp = $movement['datetime'];
            $movement['datetime'] = unix_to_human($timestamp);
            array_push($movements, $movement);
        }
        $tabletemp = array(
            'table_open'        => '<table class="player-holdings table table-striped table-hover">',
            'heading_row_start' => '<tr>',
            'row_start'         => '<tr class="player-holding-row">',
            'row_alt_start'         => '<tr class="player-holding-row">',
            'heading_cell_start'    => '<th class="cell">',
            'heading_cell_end'      => '</th>'
        );
        $this->table->set_template($tabletemp);
        $this->table->set_heading('Datetime', 'Stock code', 'Action', 'Amount');       
        $this->data['move_table'] = $this->table->generate($movements);
    }
    
    // gets the current holdings for a player and display it in a table.
    function populate_holdings($player)
    {
        $tabletemp = array(
            'table_open'        => '<table class="player-holdings table table-striped table-hover">',
            'heading_row_start' => '<tr>',
            'row_start'         => '<tr class="player-holding-row">',
            'row_alt_start'         => '<tr class="player-holding-row">',
            'heading_cell_start'    => '<th class="cell">',
            'heading_cell_end'      => '</th>'
        );
        $this->table->set_template($tabletemp);
        $this->table->set_heading('Stock', 'Quantity');
        $allStocks = $this->stocks->getStockCodes();
        foreach ($allStocks as $row)
        {
            $total = 0;
            $player_stock = $this->transactions->getPlayerTransactionsForStock($player, $row->Code);
            foreach ($player_stock as $trans)
            {
                if ($trans->Trans == 'buy')
                {
                    $total += $trans->Quantity;
                }else if ($trans->Trans == 'sell')
                {
                    $total -= $trans->Quantity;
                }
            }
            $stock = $this->stocks->getStockNameFromCode($row->Code);
            $this->table->add_row($stock[0]['Name'], $total);
        }
        
        $this->data['holding_table'] = $this->table->generate();
    }
    
    function buy_stock()
    {
        $status = $this->gamestatus->getGameState();
        if (strcmp($status,'3') === 0) //open
        {
            $player = $_SESSION['current_user'];
            $this->load->helper('request');
            $selected_stock = $this->input->post('stocks');
            $quantity = $this->input->post('buy-quantity');
            //get token
            $token = '88a4e5fbc44c80aa0490b96f070ffa18';
            //get team
            $team = 'o03';
            $result = buy_request($token, $team, $player, $selected_stock, $quantity);
            $xml = simplexml_load_string($result);
            if (isset($xml->message))
            {
                //error
                //parse message?
                echo (string) $xml->message;
            } else {
                //things to save to DB
                $token = $xml->token;
                var_dump((string) $token);
                $stock = $xml->stock;
                var_dump((string)$stock);
                $player = $xml->player;
                var_dump((string)$player);
                $amount = $xml->amount;
                var_dump((string)$amount);
                $dt = $xml->datetime; //do we need to save this?
                var_dump((string)$dt);

                $this->transactions->saveTransaction($token, $player, $stock, 'buy', $amount, $dt);
            }
        } else {
            //redirect(base_url().'/gameplay');
            echo "not open";
        }       
    }
    
    function sell_stock()
    {
        $selected_stock = $this->input->post('stocks');
        var_dump($selected_stock);
        $quantity = $this->input->post('sell-quantity');
        var_dump($quantity);
        //get token
        //get team
        //get certificate
        //$result = sell_request($token, $team, $current_player, $selected_stock, $quantity, $certificate);
    }
    
    function populate_stock_dropdown()
    {
        $stocks = $this->stocks->getStockCodes();
        $options = array();
        foreach($stocks as $key=>$value)
        {
            $options[$value->Code] = $value->Code;
        }
        return form_dropdown('stocks', $options);
    }
}
