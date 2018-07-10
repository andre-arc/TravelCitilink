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



use \Firebase\JWT\JWT;



class Auth extends REST_Controller {



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

    }





    public function index_post()

    {

        // $this->some_model->update_user( ... );



        	$postdata = file_get_contents("php://input");

			$request = json_decode($postdata);

			$username = $request->username;

			$password = $request->password;



			$ok = $this->ion_auth->login($username, $password);

			// var_dump($ok);

			if ($ok != false) { 

				$userdata = $this->Api_model->_get_userdata($username); 
				$output['status'] = true; 

				$output['token'] = $this->_encrypt($userdata[0]->user_id."|".$userdata[0]->username);
				$output['data'] = $userdata[0];



				// $jwt = $output['token'];

				// $decoded = JWT::decode($jwt, $this->config->item('jwt_key'), array('HS256'));

				// print_r($decoded);
			}
			else

			{

				$output['status'] = false;
				$output['msg'] = 'Password Invalid';

			}


		$this->set_response($output, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code



    }



}



