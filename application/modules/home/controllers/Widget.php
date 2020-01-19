<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Widget extends MY_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function slider(){
		$this->load->helper('directory');
		$map = directory_map('gs://touristix.appspot.com/assets/image/slider/', 1);
		$arr_img_ext = array('png','jpg','gif');
		$arr_img = array();
		foreach($map as $k=>$v){
			$ext_file = explode('.',$v);
			if(in_array($ext_file[1],$arr_img_ext)){
				$arr_img[]=$v;
			}
		}
		$data['ls_img']=$arr_img;
		return $this->load->view('widget_caraousel',$data,true);
	} 

	function last_org($limit=10){
		$this->db->limit(10);
		$this->db->order_by('id','desc');
		$res = $this->db->get('orgs')->result_array();
		print_r($res);
	}
	
}