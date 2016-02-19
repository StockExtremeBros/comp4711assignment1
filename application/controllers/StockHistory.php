<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockHistory extends Application {

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
    public function index($stock = null)
    {
        if($stock != null)
        {
            //Force the stock to be Uppercase first and lowercase for the rest.
            $stock = ucfirst(strtolower($stock));
        } else {
            //Grab the most recent $stock transaction here.
            $stock = 'Gold';
        }

        $this->data['pagebody'] =  'stockhistory';
        $this->data['stock'] = $stock;
        //fill dropdown with player names
        $allStocks = $this->stocks->getStockNames();
  
        $stocks = '';
        foreach($allStocks as $row)
        { 
             $stocks .= '<option value="'.$row->Name.'">'.$row->Name.'</option>';
        }
        $this->data['dropdown'] = $stocks;
        
        //Create the Transaction table for the stock
        $stockTrans = $this->transactions->getStockTransaction($stock);
        if($stock == null)
        {
            $stock = 'Gold';
        }
        
        $this->populate_trans($stock);
        $this->populate_move($stock);
        
        $this->render();
    }
    
    public function populate_trans($stock)
    {
        $stockdata = $this->stocks->getStockCodeFromName($stock);
        
        $code = $stockdata['Code'];
        
        $stockTrans = $this->transactions->getStockTransaction($code);

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
            'row_start'  => '<tr class="stock-transaction">'
        );
        $this->table->set_template($tabletemp);

        $this->table->set_heading('Player', 'Date Time', 'Transaction', 'Quantity');
        $rows = $this->table->make_columns($cells, 1);
        
        $this->data['trans_table'] = $this->table->generate($rows);
    }
    
    public function populate_move($stock)
    {
        $stockdata = $this->stocks->getStockCodeFromName($stock);
        
        $code = $stockdata['Code'];

        $stockmoves = $this->movements->getStockMovements($code);
        
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
            'row_start'  => '<tr class="stock-movement">'
        );
        $this->table->set_template($tabletemp);

        $this->table->set_heading('Action', 'Amount', 'Date Time');
        $rows = $this->table->make_columns($cells, 1);
        $this->data['move_table'] = $this->table->generate($rows);
        
    }
}