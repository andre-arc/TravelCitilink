<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends MY_Controller {
	
	function __construct(){
		$this->data['tpl']='login';
	}
	
	function index() {
		if(!$this->ion_auth->logged_in()){
		$this->data['content']=$this->load->view('form_forgot','',true);
		$this->display();
		}else{
			redirect(site_url('/dashboard/'));
		}
	}
	
}