<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlayerStats
 *
 * @author Gabriella
 */
class PlayerStats extends Application{
    
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
            var_dump($_SESSION);
            $this->load->library('table');
        
            $this->data['pagebody'] = 'player_stats';
        
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
            
            $this->data['equity'] = $this->get_player_equity($current_player);
            
            //show current player's transactions
            $this->populate_recent_activity($current_player);
            
            //show current player's holdings
            $this->populate_holdings($current_player);
      
            //fill dropdown with player names
            $this->fill_drop_down();
        }
        $this->render();
    }
    
    // gets player names from database and fills dropdown
    function fill_drop_down()
    {
        $allPlayers = $this->players->getPlayerNames();
        $players = '<li>None</li>';
        foreach($allPlayers as $row)
        { 
             $players .= '<li><a href="/profiles/'.$row->player.'">'.$row->player.'</a></li>';
        }
        $this->data['dropdownoptions'] = $players;
    }
    
    // gets the recent activity for a player and display it in a table
    function populate_recent_activity($player)
    {
        $curr_player_trans = $this->transactions->getPlayerTransactions($player);
        $tabletemp = array(
            'table_open'        => '<table class="player-activity table table-striped table-hover">',
            'heading_row_start' => '<tr>',
            'row_start'         => '<tr class="player-activity-row">',
            'row_alt_start'         => '<tr class="player-activity-row">',
            'heading_cell_start'    => '<th class="cell">',
            'heading_cell_end'      => '</th>'
        );
        $this->table->set_template($tabletemp);
        $this->table->set_heading('Date and Time', 'Stock', 'Transaction', 'Quantity');
        if ($curr_player_trans == null)
        {
            $this->table->add_row("No data", "No data", "No data", "No data");
        } else {
            foreach($curr_player_trans as $row)
            { 
                $stock = $this->stocks->getStockNameFromCode($row->Stock);
                $this->table->add_row($row->DateTime, $stock[0]['Name'], $row->Trans, $row->Quantity);
            }
        }
        
        $this->data['act_table'] = $this->table->generate();
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
}