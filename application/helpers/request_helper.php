<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//http://bsx.jlparry.com/buy?token=3a3b991110d18050a790d4a865e1daa0&player=gc&team=o03&stock=FBN&quantity=2

if (! function_exists('buy_request'))
{
    function buy_request($token, $team, $player, $stock, $quantity) {
        $this->load->library('curl');
        $result = $this->curl->simple_post('http://bsx.jlparry.com/buy',
                array('team' => $team,
                      'token' => $token,
                      'player' => $player,
                      'stock' => $stock,
                      'quantity' => $quantity)
                );
        var_dump($result);
        return $result;
        //<certificate>
//<token>95a0f</token>
//<stock>FBN</stock>
//<agent>o03</agent>
//<player>gc</player>
//<amount>2</amount>
//<datetime>1460834307</datetime>
//</certificate>
}
}

function process_buy_request($result)
{
    $xml = simplexml_load_string($result);
    if (isset($xml->error))
    {
        //error
        return $xml->error->message;
    } else {
        $cert = $xml->certificate;
        
        //things to save to DB
        $cert_token = $cert->token;
        $stock = $cert->stock;
        $player = $cert->player;
        $amount = $cert->amount;
        $dt = $cert->datetime; //do we need to save this?
    }
}

function get_token()
{
    $website = file_get_contents("http://bsx.jlparry.com/register?team=O03&name=stockextremebros&password=tuesday");
    $xml = simplexml_load_string($website);

    if (isset($xml->error))
    {
        //error
        return $xml->error->message;
    }
    else
    {
        return $xml->token;
    }
        
}

//http://bsx.jlparry.com/sell?token=3a3b991110d18050a790d4a865e1daa0&player=gc&team=o03&stock=FBN&quantity=2&certificate=95a0f
if (! function_exists('sell_request'))
{
    function sell_request($token, $team, $player, $stock, $quantity, $certificate) {
        $this->load->library('curl');
        $result = $this->curl->simple_post('http://bsx.jlparry.com/sell',
                array('team' => $team,
                      'token' => $token,
                      'player' => $player,
                      'stock' => $stock,
                      'quantity' => $quantity,
                      'certificate' => $certificate)
                );
        var_dump($result);
        return $result;
    }
}

function process_sell_request($result)
{
    $xml = simplexml_load_string($result);
    if (isset($xml->error))
    {
        //error
        return $xml->error->message;
    } else {
        $cert = $xml->certificate;
        
        //things to save to DB
        $cert_token = $cert->token;
        $stock = $cert->stock;
        $player = $cert->player;
        $amount = $cert->amount;
        $dt = $cert->datetime; //do we need to save this?
    }
}

//http://bsx.jlparry.com/register?team=O03&name=stockextremebros&password=tuesday

if (! function_exists('register_request'))
{
    function register_request($team, $name, $password) {
        $this->load->library('curl');
        $result = $this->curl->simple_post('http://bsx.jlparry.com/register',
                array('team' => $team,
                      'name' => $name,
                      'password' => $password)
                );
        var_dump($result);
        return $result;
    }
}

if (! function_exists('get_movements'))
{
    function get_movements($num) {
        $CI =& get_instance();
        $CI->load->library('curl');
        $result = $CI->curl->simple_get('http://www.comp4711bsx.local/data/movement/'.$num);
        $strings = explode("\n", $result);
        $keys = str_getcsv($strings[0]);
        array_splice($strings, 0, 1); // remove keys
        $move = array();
        $j = 0;
        //foreach ($strings as $line) {
        for ($k = count($strings) - 1; $k > 0; $k--) {
            $csv = str_getcsv($strings[$k]);
            for ($i = 1; $i < count($csv); $i++)
            {
                if (!is_null($csv[$i])) // for some reason, the last line is an empty string
                {
                    $temp = $keys[$i];
                    $move[$j][$temp] = $csv[$i];
                }
            }
            $j++;
        }
        return $move;
    }
}

function get_stocks()
{
    $CI =& get_instance();
    $CI->load->library('curl');
    $CI->load->model('stocks');
    $result = $CI->curl->simple_get('http://bsx.jlparry.com/data/stocks/');
    $strings = explode("\n", $result);
    
    $keys = str_getcsv($strings[0]);
    
    array_splice($strings, 0, 1); // remove keys
    //var_dump($strings);
    $stocks = array();
    $j = 0;
    for ($k = count($strings) - 1; $k > 0; $k--) {
        $csv = str_getcsv($strings[$k]);
        //var_dump($csv);
        for ($i = 0; $i < count($csv); $i++)
        {
            if (!is_null($csv[$i])) // for some reason, the last line is an empty string
            {
                $temp = $keys[$i];
                $stocks[$j][$temp] = $csv[$i];
            }
        }
        $j++;
    }
    
    $CI->stocks->insertNewStocks($stocks);
    return $stocks;
}

function get_transactions()
{
    $CI =& get_instance();
    $CI->load->library('curl');
    $CI->load->model('stocks');
    $result = $CI->curl->simple_get('http://bsx.jlparry.com/data/stocks/');
    $strings = explode("\n", $result);
    
    $keys = str_getcsv($strings[0]);
    
    array_splice($strings, 0, 1); // remove keys
    //var_dump($strings);
    $stocks = array();
    $j = 0;
    for ($k = count($strings) - 1; $k > 0; $k--) {
        $csv = str_getcsv($strings[$k]);
        //var_dump($csv);
        for ($i = 0; $i < count($csv); $i++)
        {
            if (!is_null($csv[$i])) // for some reason, the last line is an empty string
            {
                $temp = $keys[$i];
                $stocks[$j][$temp] = $csv[$i];
            }
        }
        $j++;
    }
    
    $CI->stocks->insertNewStocks($stocks);
    return $stocks;
}
