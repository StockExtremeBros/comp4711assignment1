<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockHistory extends Application {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://localhost:####/stockhistory/$stock
	 * This controller does not require the $stock variable after the
         * address however, it will initialize to the most recent stock
         * involved in a transaction. Otherwise it will initialize to the
         * stock specified.
	 *
	 * In addition, this cannot be accessed unless the user is logged
         * in.
	 */
    public function index($stock = null)
    {
        // Check if 'current_user' has been set yet this session
        // If not, the user is not logged in
        if (!array_key_exists('current_user', $_SESSION))
        {
            $this->data['pagebody'] = 'login_notice';
        }
        else
        {
            if($stock == null)
            {
                //Grab the most recent $stock transaction here.
                $stock = $this->getMostRecentTransaction();                
            }
            
            //force the stock to adhere to the naming convention of only the
            //first letter being an upper-case. 
            $stock = ucfirst(strtolower($stock));

            $this->data['pagebody'] =  'stockhistory';
            $this->data['stock'] = $stock;
            $this->data['value'] = $this->stocks->getStockValueByName($stock);
            
            $this->populate_dropdown();
            $this->populate_trans($stock);
            $this->populate_move($stock);
        }
        $this->render();
    }
    
    //Get the most recent stock that had a transaction.
    public function getMostRecentTransaction()
    {
        $recent = $this->transactions->getRecentStockTransaction();
        if ($recent == null)
            return null;
        foreach($recent as $key=>$value)
        {
            $code = $value['Stock'];
            $stock = $this->stocks->getStockNameFromCode($code);
        }
        foreach($stock as $key=>$value)
        {
            $name = $value['Name'];
        }
        return $name;
    }
    
    //Create the dropdrop button menu to navigate to other stocks
    public function populate_dropdown()
    {
        //fill dropdown with player names
        $allStocks = $this->stocks->getStockNames();

        $stocks = '';
        foreach($allStocks as $row)
        { 
            $stocks .= '<li><a href="/stockhistory/'.$row->Name.'">'.$row->Name.'</a></li>';
            //redirect(base_url()."stockhistory/".$stock);
            //$stocks .= '<option value="'.$row->Name.'">'.$row->Name.'</option>';
        }
        $this->data['dropdownoptions'] = $stocks;
    }
    
    // Create the stock transaction table
    public function populate_trans($stock)
    {
        $stockdata = $this->stocks->getStockCodeFromName($stock);
        $stockTrans = $this->transactions->getStockTransaction($stockdata['Code']);

        if(empty($stockTrans))
        {
            $stockTrans[] = array(
                'Player' => 'No data',
                'Trans' => 'No data',
                'DateTime' => 'No data',
                'Quantity' => 'No data'
                );
        }
        
        foreach ($stockTrans as $trans)
        {
            $cells[] = $this->parser->parse('_cell_stocktransaction', (array) $trans, true);
        }
        
        $this->load->library('table');
        $tabletemp = array(
            'table_open' => '<table class="stock-transaction table table-striped table-hover">',
            'row_start'  => '<tr class="stock-transaction">',
            'heading_cell_start'    => '<th class="cell">',
            'heading_cell_end'      => '</th>'
        );
        $this->table->set_template($tabletemp);

        $this->table->set_heading('Player', 'Date Time', 'Transaction', 'Quantity');
        $rows = $this->table->make_columns($cells, 1);
        
        $this->data['trans_table'] = $this->table->generate($rows);
    }
    
    //Create the stock movement table.
    public function populate_move($stock)
    {
        $stockdata = $this->stocks->getStockCodeFromName($stock);
        $stockmoves = $this->movements->getStockMovements($stockdata['Code']);
        
        if(empty($stockmoves))
        {
            $stockmoves[] = array(
                'Action' => 'No data',
                'Amount' => 'No data',
                'Datetime' => 'No data'
                );
        }
        
        $cells = array();
        foreach ($stockmoves as $move)
        {
            $cells[] = $this->parser->parse('_cell_stockmovement', (array) $move, true);
        }
        
        $this->load->library('table');
        $tabletemp = array(
            'table_open' => '<table class="stock-movement table table-striped table-hover">',
            'row_start'  => '<tr class="stock-movement">',
            'heading_cell_start'    => '<th class="cell">',
            'heading_cell_end'      => '</th>'
        );
        $this->table->set_template($tabletemp);

        $this->table->set_heading('Action', 'Amount', 'Date Time');
        $rows = $this->table->make_columns($cells, 1);
        $this->data['move_table'] = $this->table->generate($rows);
    }
}