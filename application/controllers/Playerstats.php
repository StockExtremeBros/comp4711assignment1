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
        $this->load->library('table');
        $this->load->model('players');
        $this->load->model('transactions');
        $this->load->model('stocks');
        
        $this->data['pagebody'] = 'player_stats';
        
        if($current_player != null)
        {
            //Force the stock to be Uppercase first and lowercase for the rest.
            $current_player = ucfirst(strtolower($current_player));
        } else {
            //get current player
            if (isset($_SESSION['current_user']))
            {
                $current_player = $_SESSION['current_user'];
            }
        }
        
        $this->data['player'] = $current_player;
            
        //show current player's transactions
        $this->populate_recent_activity($current_player);
            
        //show current player's holdings
        $this->populate_holdings($current_player);
      
        //fill dropdown with player names
        $this->fill_drop_down();
        
        $this->render();
    }
    
    function fill_drop_down()
    {
        $allPlayers = $this->players->getPlayerNames();
        $players = '';
        foreach($allPlayers as $row)
        { 
             $players .= '<option value="'.$row->player.'">'.$row->player.'</option>';
        }
        $this->data['dropdown'] = $players;
    }
    
    function populate_recent_activity($player)
    {
        $curr_player_trans = $this->transactions->getPlayerTransactions($player);
        $tabletemp = array(
            'table_open'        => '<table class="stock-summary table table-striped table-hover">',
            'heading_row_start' => '<tr>',
            'row_start'         => '<tr class="stock-summary-row">',
            'row_alt_start'         => '<tr class="stock-summary-row">'
        );
        $this->table->set_template($tabletemp);
        $this->table->set_heading('Date and Time', 'Stock', 'Transaction', 'Quantity');
        if ($curr_player_trans == null)
        {
            $this->table->add_row("No data", "No data", "No data", "No data");
        } else {
            foreach($curr_player_trans as $row)
            { 
                $this->table->add_row($row->DateTime, $row->Stock, $row->Trans, $row->Quantity);
            }
        }
        
        $this->data['act_table'] = $this->table->generate();
    }
    
    function populate_holdings($player)
    {
        $tabletemp = array(
            'table_open'        => '<table class="player-summary table table-striped table-hover">',
            'heading_row_start' => '<tr>',
            'row_start'         => '<tr class="player-summary-row">',
            'row_alt_start'         => '<tr class="player-summary-row">'
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
            $this->table->add_row($row->Code, $total);
        }
        
        $this->data['holding_table'] = $this->table->generate();
    }
}
