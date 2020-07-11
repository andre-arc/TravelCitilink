<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once BASEPATH . 'dotenv/autoloader.php';
$dotenv = new Dotenv\Dotenv(FCPATH);
$dotenv->load();

require_once __DIR__ . '../../../vendor/autoload.php';


class MidtransPayment {

    function __construct(){
        \Midtrans\Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = getenv('MIDTRANS_PRODUCTION') == 'true' ? true : false;
    }

    public function vt_web($params) {
        return \Midtrans\Snap::createTransaction($params)->redirect_url;
    }

}