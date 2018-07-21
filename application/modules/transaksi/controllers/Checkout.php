<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		$this->data['tpl']='single';
	}
	
	function index() {

        $tiket = $this->input->post('id_tiket');
		$this->data['content']=$this->load->view('checkout',$this->data,true);
		$this->display($this->data);
	}
		
	
	
	
}