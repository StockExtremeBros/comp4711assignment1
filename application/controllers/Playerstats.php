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
    public function index()
    {
        $this->load->library('table');
        $this->load->model('players');
        $this->load->model('transactions');
        $this->load->model('stocks');
        
        $this->data['pagebody'] = 'player_stats';
        
        //get current player
        if (isset($_SESSION['current_user']))
        {
            $current_player = $_SESSION['current_user'];
            $this->data['player'] = $current_player;
            
            //show current player's transactions
            $this->display_player_recent_activity($current_player);
            
            //show current player's holdings
            $this->display_player_current_holdings($current_player);
        }
        
        if (isset($_POST['players']))
        {
            $current_player = $_POST['players'];
            $this->data['player'] = $current_player;
            
            //show current player's transactions
            $this->display_player_recent_activity($current_player);
            
            //show current player's holdings
            $this->display_player_current_holdings($current_player);
        }
        //fill dropdown with player names
        $this->fill_drop_down();
        
        $this->render();
    }
    
    function fill_drop_down()
    {
        $allPlayers = $this->players->getPlayerNames();
        $players = '<option value="">(choose a player)</option>';
        
        foreach($allPlayers as $row)
        { 
             $players .= '<option value="'.$row->player.'">'.$row->player.'</option>';
        }
        $this->data['dropdown'] = $players;
    }
    
    function display_player_recent_activity($player)
    {
        $curr_player_trans = $this->transactions->getPlayerTransactions($player);
        $this->table->set_heading('Date and Time', 'Stock', 'Transaction', 'Quantity');
        foreach($curr_player_trans as $row)
        { 
             $this->table->add_row($row->DateTime, $row->Stock, $row->Trans, $row->Quantity);
        }
        $this->data['act_table'] = $this->table->generate();
    }
    
    function display_player_current_holdings($player)
    {
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
            $this->table->add_row($row->Code, $total);
        }
        
        $this->data['holding_table'] = $this->table->generate();
    }
}
