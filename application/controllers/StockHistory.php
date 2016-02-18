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
            
            $this->render();
	}
}