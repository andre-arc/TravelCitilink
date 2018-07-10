<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PenerimaanModel extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}


  public function get(){
  	return $this->db->get('tbl_pelanggan');
  }

}

/* End of file BarangModel.php */
/* Location: ./application/models/BarangModel.php */