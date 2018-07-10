<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan extends MY_Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('PenerimaanModel');
	}

	public function index()
	{

		$this->data['css'] = css_asset('sweetalert2.min.css','limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css','select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css','bootstrap-datepicker');
		$this->data['css'] .= '<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>';

		$this->data['js']  = js_asset('sweetalert2.min.js','limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');
			$this->data['js']  .= js_asset('bootstrap-datepicker.min.js','bootstrap-datepicker');
		$this->data['js']  .= js_asset('bootstrap-datepicker.id.min.js','bootstrap-datepicker');
		 $this->data['js'] .= '<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>';
		

		$meta = $this->meta('penerimaan/',true);
		$this->data['auth_meta'] = $meta['act'];
		$this->data['icon']      = $meta['icon'];
		$this->data['title']     = $meta['title'];


		$this->data['content']   = $this->load->view('penerimaan', $this->data,true);
		$this->display($this->data);
	}

	public function get_table()
	{
	    $periode=$this->input->post('periode');
	    $org_id = $this->session->userdata('user_org');
		$this->data['pangkalan']   = $this->db->query("SELECT * FROM `orgs` WHERE parent_id = $org_id")->result();

		$extract = explode(" ", $periode);
		$listBulan = array(
					"januari" => 1,
					"februari" => 2,
					"maret" => 3,
					"april" => 4,
					"mei" => 5,
					"juni" => 6,
					"juli" => 7,
					"agustus" => 8,
					"september" => 9,
					"oktober" => 10,
					"november" => 11,
					"desember" => 12,
					);
		$namaBulan = strtolower($extract[0]);
		$bulan = $listBulan[$namaBulan];
		$tahun = $extract[1];
		$date = $tahun."-".$bulan."-1";

		$this->data['lastDate'] = date('t', strtotime($date));
		$this->data['date'] = $date;
		$this->data['bulan'] = $bulan;
		$this->data['nm_bulan'] =$namaBulan;
		$this->data['tahun'] = $tahun;

		
		
		
	    $this->load->view('table_input', $this->data );
	}
    
	
	function act_edit(){
		$ret=array(
			'success'=>false,
			'msg'=>'Gagal Mengubah Data'
		);
		

		if($this->input->post('name') == 'jml_tabung'){
			$jml_tabung= $this->input->post('value');
			$id_penerimaan = $this->input->post('pk');

			$this->db->update('tbl_penerimaan', array('jml_tabung' => $jml_tabung), array('id_penerimaan' => $id_penerimaan));

			if ($this->db->affected_rows()) {
				$ret=array(
					'success'=>true,
					'msg'=>'Berhasil Mengubah Data'
				);
			}
		}

		
		echo json_encode($ret);		
	}
	
	function act_del(){
		$ret=array(
			'success'=>false,
			'msg'=>'Gagal Menghapus Data'
		);

		$id=$_POST['id_pelanggan'];
		//delete records
		$this->db->delete('tbl_pelanggan', array('id_pelanggan' => $id));

		if ($this->db->affected_rows()) {
			$ret=array(
				'success'=>true,
				'msg'=>'Berhasil Menghapus Data.'
			);
		}
		
		echo json_encode($ret);
	}

	public function cek_nama($nama)
	{
		$nama = str_replace('%20', ' ', $nama);
		$where = array('nm_barang' => $nama);
		$this->db->get_where('barang', $where);
		if ($this->db->affected_rows()) {
			echo "Nama sudah digunakan";
		}
		else{
			echo "";
		}
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */