<?php



defined('BASEPATH') OR exit('No direct script access allowed');



// This can be removed if you use __autoload() in config.php OR use Modular Extensions

/** @noinspection PhpIncludeInspection */

// require APPPATH . 'libraries/REST_Controller.php';



/**

 * This is an example of a few basic user interaction methods you could use

 * all done with a hardcoded array

 *

 * @package         CodeIgniter

 * @subpackage      Rest Server

 * @category        Controller

 * @author          Phil Sturgeon, Chris Kacerguis

 * @license         MIT

 * @link            https://github.com/chriskacerguis/codeigniter-restserver

 */




class Tabung extends REST_Controller {



    function __construct()

    {

        // Construct the parent class

        parent::__construct();

         header("Access-Control-Allow-Origin: *");

        // Configure limits on our controller methods

        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php

        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->load->model('Api_model');

        // $this->load->helper(array('form', 'url'));

        // $this->load->library('form_validation');

        // echo $this->config->item('allow_any_cors_domain');

    }





    public function index_post()

    {

        // $this->some_model->update_user( ... );

    		$status = true;
        	$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			
			$data = $request->data;
			$token = $request->token;
			
			if($this->_validate_token($token)){
                $pangkalan = $this->Api_model->_getPangkalan($data->id_pangkalan);
                $statusPelanggan = $this->Api_model->_cekPelanggan($data->id_pelanggan);
                $msg = '';

				if($pangkalan->stock_tbg >= $data->jmlTabung){
                    $status &= true;
                }
                else{
                    $status &= false;
                    $msg .= 'Stok gas tidak mencukupi<br>';
                }


                if($statusPelanggan == true){
                    $status &= true;
                }
                else{
                    $status &= false;
                    $msg .= 'Pelanggan telah membeli Hari Ini <br>';
                }


                 if($status){
                    $tanggal = date('Y-m-d');
                    $id_pembeli = $data->id_pelanggan;
                    $id_pangkalan = $data->id_pangkalan;
                    $jml_tabung = $data->jmlTabung;

                   
                    $this->db->query("CALL insertPembelian('$tanggal', $jml_tabung, $id_pembeli, $id_pangkalan)");
                   
                 }

                   if($status){
                        $output['status'] = true;
                        $output['msg'] = "Data Berhasil di Input";
                    }
                    else{
                        $output['status'] = false;
                        $output['msg'] = $msg;
                    }


			}

            $this->set_response($output, REST_Controller::HTTP_CREATED);

    }



}



