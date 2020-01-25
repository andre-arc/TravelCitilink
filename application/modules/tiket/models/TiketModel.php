<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TiketModel extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}


	public function get()
	{
		return $this->db->get('tiket');
	}



	function get_pelabuhan()
	{
		$hasil = $this->db->query("SELECT * FROM pelabuhan");
		return $hasil;
	}
}

/* End of file BarangModel.php */
/* Location: ./application/models/BarangModel.php */
