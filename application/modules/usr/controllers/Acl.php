<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acl extends MY_Controller {

	function __construct(){
		$this->data['tpl']='home';
	}

	function index() {
		$this->display();
	}

}
