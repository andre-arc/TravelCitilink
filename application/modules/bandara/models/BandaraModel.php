<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BandaraModel extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}


  public function get(){
  	return $this->db->get('tbl_pelanggan');
  }



  function get_negara(){
		$hasil=$this->db->query("SELECT * FROM negara");
		return $hasil;
	}

	function get_provinsi($id){
		$hasil=$this->db->query("SELECT * FROM provinsi WHERE id_negara='$id'");
		return $hasil->result();
	}

	function get_kota($id){
		$hasil=$this->db->query("SELECT * FROM kota WHERE id_prov='$id'");
		return $hasil->result();
	}

}

/* End of file BarangModel.php */
/* Location: ./application/models/BarangModel.php */