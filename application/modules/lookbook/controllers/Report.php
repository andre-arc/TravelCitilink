<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Report extends MY_Admin{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('lookbookModel');
	}


public function index(){
		$this->data['css']  = css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css','limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css','select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css','bootstrap-datepicker');
		
		$this->data['js']   = js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('transaksi.js');
		$this->data['js']  .= js_asset('sweetalert2.min.js','limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');
		$this->data['js']  .= js_asset('bootstrap-datepicker.min.js','bootstrap-datepicker');
		$this->data['js']  .= js_asset('bootstrap-datepicker.id.min.js','bootstrap-datepicker');


		$meta = $this->meta('lookbook/report/',true);
		$this->data['auth_meta']	= $meta['act'];
		$this->data['icon']			= $meta['icon'];
		$this->data['title']		= $meta['title'];

		$org_id = $this->session->userdata('user_org');
		$this->data['cabangs']   = $this->db->query("SELECT * FROM `orgs` WHERE parent_id = $org_id")->result();
		
		$this->data['content'] = $this->load->view('report', $this->data,true);
		$this->display($this->data);

	}


	public function proses_export(){

		$periode = $this->input->post('periode');
		$filter = $this->input->post('filter');

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
		$this->data['filter'] = $filter;
		$this->data['bulan'] = $bulan;
		$this->data['nm_bulan'] = $namaBulan;
		$this->data['tahun'] = $tahun;
		


		

		$this->load->library('m_pdf');
		$this->load->view('lookbook/cetak_lookbook', $this->data);

		// $pdfFilePath='laporan.pdf';
		// $pdf =$this->m_pdf->load();
		// $pdf->WriteHTML($html);
		// $pdf->Output($pdfFilePath,"D");
	}

	public function tes(){
		$query = $this->db->query("call get_laporan('2018-3-1', 1);");
		$row = $query->all_result();
		echo json_encode($row);
	}
}

?>