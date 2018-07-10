<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	
	function __construct(){
		parent::__construct();
		$this->data['tpl']='login';
	}
	
	function index() {
		if(!$this->ion_auth->logged_in()){
			$this->data['content']=$this->load->view('form_login','',true);
			$this->display();
		}else{
			redirect(site_url('/dashboard/'));
		}
	}
	
	function json_login($is_return=false){
		$res = array();
		if($this->ion_auth->logged_in()){
			$res=array('result'=>true);
		}else{
			if((isset($_POST['user_name'])) && (isset($_POST['user_password']))){
				$ok = $this->ion_auth->login($_POST['user_name'], $_POST['user_password']);
				if($ok){
					$res=array('result'=>true,'msg'=>"Login Berhasil.\r\nSilahkan mengelola aplikasi ini melalui menu Dashboard.");
				}else{
					$res=array(
						'result'=>false,
						'msg'=>"Login Gagal.\r\nUsername/Password Salah.\n\rSilahkan ulangi lagi."
						);
				}
			}else{			
				$res=array(
					'result'=>false,
					'msg'=>"Login Gagal.\r\nUsername/Password belum terisi.\n\rSilahkan ulangi lagi."
				);
			}
		}
		if($is_return){
			return json_encode($res);
		}else{
			echo json_encode($res);		
		}
	}
	
	function logout(){
		$this->ion_auth->logout();
		redirect(site_url(), 'refresh');		
	}
	
	
}