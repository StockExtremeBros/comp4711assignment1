<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        // Check if 'current_user' has been set yet this session
        // If not, the user is not logged in
        if (!array_key_exists('current_user', $_SESSION))
        {
            $this->data['pagebody'] = 'login_notice';
        }
        else
        {
            $this->load->library('parser');
            $this->populate_stocks();
            $this->populate_profiles();
            $this->data['pagebody'] =  'homepage';
        }
        $this->render();
    }
    
    /**
     * Fetches the stock data from the database and creates a table to display
     * the data.
     */
    public function populate_stocks()
    {
        // /stockhistory/{Name}
        $stocks = $this->stocks->getStockNameValue();
        
        $this->load->library('table');
        $tabletemp = array(
            'table_open'            => '<table class="stock-summary table table-striped table-hover text-center">',
            'heading_row_start'     => '<tr>',
            'row_start'             => '<tr class="stock-summary-row">',
            'row_alt_start'         => '<tr class="stock-summary-row">',
            'heading_cell_start'    => '<th class="cell">',
            'heading_cell_end'      => '</th>'
        );
        $this->table->set_template($tabletemp);

        $this->table->set_heading('Stock', 'Current Stock Value');
        $this->data['stockoverview'] = $this->table->generate($stocks);
    }
    
    /**
     * Fetches the player data from the database and creates a table to display
     * the data.
     */
    public function populate_profiles()
    {
        $players = $this->players->all();
        
        foreach ($players as $key => $playa)
        {
            $equity = $this->get_player_equity($playa['Player']);
            $playa["Equity"] = $equity;
            $players[$key] = $playa;
        }
        
        $this->load->library('table');
        $tabletemp = array(
            'table_open'        => '<table class="player-summary table table-striped table-hover">',
            'heading_row_start' => '<tr>',
            'row_start'         => '<tr class="player-summary-row">',
            'row_alt_start'         => '<tr class="player-summary-row">',
            'heading_cell_start'    => '<th class="cell">',
            'heading_cell_end'      => '</th>'
        );
        $this->table->set_template($tabletemp);
        
        $this->table->set_heading('Player', 'Current Cash', 'Current Equity');
        $this->data['playeroverview'] = $this->table->generate($players);
    }
    
    function get_player_equity($player)
    {
        $allStocks = $this->stocks->all();
        $equity = 0;
        foreach ($allStocks as $row)
        {
            $total = 0;
            $player_stock = $this->transactions->getPlayerTransactionsForStock($player, $row['Code']);
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
            $equity += ($total * $row['Value']);
        }
        return $equity;
    }
}
