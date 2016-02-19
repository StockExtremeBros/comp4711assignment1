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
                var_dump($stock);
                
                //Force the stock to be Uppercase first and lowercase for the rest.
                $stock = ucfirst(strtolower($stock));
            } else {
                //Grab the most recent $stock transaction here.
                $stock = 'Gold';
            }
            
            $this->data['pagebody'] =  'stockhistory';
            
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
                $stock == 'Gold';
            }
            foreach ($stockTrans as $trans)
            {
                $cells[] = $this->parser->parse('_cell', (array) $picture, true);
            }
                
                
            $this->load->library('table');
            $parms = array(
                'table_open' => '<table class="gallery">',
                'cell_start' => '<td class="oneimage">',
                'cell_alt_start' => '<td class="oneimage">'
            );
            $this->table->set_template($parms);

            $rows = $this->table->make_columns($cells, 3);
            $this->data['thetable'] = $this->table->generate($rows);
            
            $this->data['move_table'];
            $this->data['trans_table'];
            
            $this->render();
	}
}