<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		$this->data['tpl']='single';
	}
	
	function index() {

		$this->data['content']=$this->load->view('dashboard',$this->data,true);
		$this->display($this->data);
	}
		
		
	
}