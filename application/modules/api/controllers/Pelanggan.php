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




class Pelanggan extends REST_Controller {



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

    public function index_get(){
		$id = $this->get('id');
		$token = $this->get('token');
		$output = array();

			

		if($this->_validate_token($token)){
			$dataPelanggan = $this->Api_model->_getPelanggan($id);
			if(count($dataPelanggan)){
				$jml = $this->Api_model->_getTabungMonthly($dataPelanggan->id_pelanggan);
				$dataPelanggan->{'tbg_bulanan'} = $jml->total;
				$output['status'] = true;
				$output['msg'] = 'Registrasi Berhasil';
				$output['data'] = $dataPelanggan;
			}
		}

		$this->set_response($output);
    }




    public function index_post()

    {

        // $this->some_model->update_user( ... );

    		$status = true;
    		$this->load->library('ciqrcode');
        	$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			$output = array();
			
			$data = $request->data;
			$token = $request->token;
			
			if($this->_validate_token($token)){
				$pelanggan = array(
								'nm_pelanggan' => $data->nama,
								'no_kk' => $data->no_kk,
								'nik' => $data->nik,
								'hp' => $data->no_hp,
								'kategori' => $data->kategori,
								'keterangan' => $data->keterangan,
								'id_pangkalan' => $data->pangkalan,
								'alamat_pelanggan' => $data->alamat
							);

				$config = array(
							'imagedir' => 'assets/qrcode/',
							'cacheable' => true, //boolean, the default is true
							'cachedir' => './assets/', //string, the default is application/cache/
							'errorlog' => './assets/', //string, the default is application/logs/
							'quality' => true, //boolean, the default is true
							'size' => '1024', //interger, the default is 1024
							'black' => array(224,255,255), // array, default is array(255,255,255)
							'white' => array(70,130,180) // array, default is array(0,0,0)
							);

				$dataQr = array(
						"id" => $pelanggan['no_kk'],
						"type" => "gas3kgapp.com"
						);

				$params['data']= json_encode($dataQr);
				$params['level']='H';
				$params['size']=10;
				$params['savename']= $config['imagedir'].$pelanggan['no_kk'].'.png';

				$pelanggan['qrcode']=$params['savename'];
				$status &= $this->db->insert('tbl_pelanggan', $pelanggan);

				if($status){
					$this->ciqrcode->generate($params,$config);
					$status &= true;
				}

				if($status){
					$output['status'] = true;
					$output['msg'] = 'Register Berhasil';
				}
				else{
					$output['status'] = false;
					$output['msg'] = 'Error Register';
				}

			}
		



		 $this->set_response($output);



    }

    public function category_get(){

		$token = $this->get('token');
		$output = array();

		if($this->_validate_token($token)){
			$data = $this->Api_model->_getKatPelanggan();
			$output['status'] = true;
			$output['data'] = $data;
		}

		$this->set_response($output);
    }



}



