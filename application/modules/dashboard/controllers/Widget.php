<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Widget extends MY_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function last_org($limit=10){
		$this->db->limit(10);
		$this->db->order_by('id','desc');
		$res = $this->db->get('orgs')->result_array();
		print_r($res);
	}
	
}