<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Report extends MY_Admin{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('lookbookModel');
		 $this->load->library('pdf');
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

			
       		$filter = $this->input->post('filter');
            $tgl_mulai = $this->input->post('tgl_mulai');
            $tgl_akhir = $this->input->post('tgl_akhir');

			$tgl_mulai = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_mulai)));
            $tgl_akhir = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_akhir)));
            
       

		$pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'PT. Ubudiyah Aviation Indonesia Banda Aceh',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'DAFTAR TRANSAKSI PENJUALAN TIKET',0,1,'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'NO',1,0);
        $pdf->Cell(43,6,'TANGGAL TRANSAKSI',1,0);
        $pdf->Cell(27,6,'KODE PNR',1,0);
        $pdf->Cell(15,6,'DARI',1,0);
        $pdf->Cell(18,6,'TUJUAN',1,0);
        $pdf->Cell(22,6,'MASKAPAI',1,0);
        $pdf->Cell(18,6,'TOTAL',1,0);
        $pdf->Cell(35,6,'TGL BERANGKAT',1,1);
       

        $pdf->SetFont('Arial','',10);

        $query = $this->db->query("SELECT transaksi.tgl_transaksi,transaksi.id_transaksi as id_tran,kode_pnr,tgl_berangkat,waktu,dari,tujuan,maskapai,harga FROM transaksi,detail_transaksi,orgs,tiket where transaksi.id_mitra=orgs.id AND tiket.id_tiket=detail_transaksi.id_tiket AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND orgs.id='$filter' AND tgl_transaksi between '$tgl_mulai' and '$tgl_akhir' ORDER BY id_tran DESC")->result();




        foreach ($query as $row){
            $pdf->Cell(10,6,$row->id_tran,1,0);
            $pdf->Cell(43,6,$row->tgl_transaksi,1,0);
            $pdf->Cell(27,6,$row->kode_pnr,1,0);
            $pdf->Cell(15,6,$row->dari,1,0);
            $pdf->Cell(18,6,$row->tujuan,1,0);
            $pdf->Cell(22,6,$row->maskapai,1,0);
            $pdf->Cell(18,6,$row->harga,1,0);
            $pdf->Cell(35,6,$row->tgl_berangkat,1,0);   
        }

        $pdf->Output();
	}






















	public function tes(){
		$query = $this->db->query("call get_laporan('2018-3-1', 1);");
		$row = $query->all_result();
		echo json_encode($row);
	}
}

?>