<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		$this->data['tpl']='single';
	}


	function index() {
		$this->data['css']=css_asset('bootstrap3-wysihtml5.min.css','bootstrap-wysihtml5');
		$this->data['js']=js_asset('bootstrap3-wysihtml5.all.min.js','bootstrap-wysihtml5');
		
		$meta = $this->meta('acl/config/',true);
		$this->data['auth_meta']=$meta['act'];
		$this->data['icon']=$meta['icon'];
		$this->data['title']=$meta['title'];
		$this->data['content']=$this->load->view('form_config',$this->data,true);
		$this->display($this->data);
	}
	
	function save(){
		print_r($_POST);
	}
	
}