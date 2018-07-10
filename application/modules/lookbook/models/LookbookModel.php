<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LookbookModel extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}


	public function _get_data_laporan($bulan, $tahun, $id){
		$data = array();

		for ($i=1; $i <= 31 ; $i++) { 
			$tanggal = $i;
			$this->db->select('l.jml_tabung')
							->from('tbl_lookbook as l')
							->join('tbl_pelanggan as p', 'l.id_pembeli=p.id_pelanggan', 'LEFT')
							->where('p.id_pelanggan', $id)
							->where('DAY(l.tanggal)', $tanggal)
							->where('MONTH(l.tanggal)', $bulan)
							->where('YEAR(l.tanggal)', $tahun);

			$query = $this->db->get();
			 echo $this->db->last_query();
			 echo "<hr>";
		}

		// if($query){
		// 	return $query->result_object();
		// }
		// else{
		// 	return false;
		// }
	}

}

/* End of file BarangModel.php */
/* Location: ./application/models/BarangModel.php */