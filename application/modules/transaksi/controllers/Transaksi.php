<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		$this->load->model("M_transaksi");
	}
	
	function index() {
		$this->data['css'] =  css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css','limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css','select2');

		$this->data['js']  =  js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js','limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');

		$meta = $this->meta('transaksi/',true);
		$this->data['auth_meta'] = $meta['act'];
		$this->data['icon']      = $meta['icon'];
		$this->data['title']     = $meta['title'];


		$this->data['content']=$this->load->view('transaksi',$this->data,true);
		$this->display($this->data);
	}

	public function get_json($id_transaksi=null)
	{
		$ret = array(
			'total'=>0,
			'rows'=>array()
		);
		header('Content-Type: application/json');
		
		$limit  = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$search = (isset($_GET['search'])) ? $_GET['search'] : '';
		$sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 't.tgl_transaksi';
		$order  = (isset($_GET['order'])) ? $_GET['order'] : 'desc';

		$SQL_BASE='
			select * from transaksi as t join orgs as o on o.id=t.id_mitra 
		';
		
		if($search<>''){
			//get where
			$SQL_BASE.='WHERE ';
			$SQL_BASE.='t.id_transaksi like "%'.$search.'%" OR ';
			$SQL_BASE.='t.id_tiket like "%'.$search.'%" OR ';
			$SQL_BASE.='t.tgl_transaksi like "%'.$search.'%" OR ';
			$SQL_BASE.='t.total_hrg like "%'.$search.'%" OR ';
			
			$ls_data=$this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
						
			//get where with limit
			$SQL=($sort) ? $SQL_BASE.' ORDER BY '.$sort.' '.$order : $SQL_BASE;
			$SQL.=' LIMIT '.$offset.','.$limit;
			$ls_data_limit=$this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;

		}else{
            if($id_transaksi != null){
                $SQL_BASE.='WHERE id_transaksi="'.$id_transaksi.'"';
            }
			//get all
			$ls_data=$this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
			//get limit
			$SQL=($sort) ? $SQL_BASE.' ORDER BY '.$sort.' '.$order : $SQL_BASE;
			$SQL.=' LIMIT '.$offset.','.$limit;
			$ls_data_limit=$this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;
		}
		
		echo json_encode($ret);
	}
    

	function checkout(){
			$this->data['css'] = css_asset('style.css', '');
			$this->data['css'] .= css_asset('select2.min.css','select2');
			$this->data['css'] .= css_asset('bootstrap-datepicker.min.css', 'bootstrap-datepicker');
	
			$this->data['js']  =  js_asset('bootstrap-table.min.js','bootstrap-table');
			$this->data['js']  .= js_asset('select2.full.min.js','select2');
			$this->data['js'] .= js_asset('bootstrap-datepicker.min.js', 'bootstrap-datepicker');
			$this->data['js'] .= js_asset('bootstrap-datepicker.id.min.js', 'bootstrap-datepicker');
			$this->data['js'] .= "<script> var options={format: 'dd-mm-yyyy',todayHighlight: true,autoclose: true, daysOfWeekDisabled: '0',daysOfWeekHighlighted: '0',language: 'id',locale: 'id',};$('.kewarganegaraan').select2();$('.tgl-lahir').datepicker(options);</script>";
	
	
			$tiket = $this->input->post('id_tiket');
			$this->data['detail_tiket'] = $this->M_transaksi->getDetailTiket($tiket);
			$this->data['kewarganegaraan'] = $this->M_transaksi->getCountry();
			$this->data['content']=$this->load->view('checkout',$this->data,true);

			$this->db->where('id', $this->session->userdata('user_org'));
			$org = $this->db->get('orgs')->row();

			if($this->data['detail_tiket'][0]->harga > $org->jml_kas){
				echo "<script>alert('Kas Tidak Mencukupi')</script>";
				redirect('transaksi/konfirmasi');
			}else{
				$this->display($this->data);
			}
			// 
	}

	function final(){
		$this->data['css'] = css_asset('style.css', '');
		$this->data['css'] .= css_asset('select2.min.css','select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css', 'bootstrap-datepicker');

		$this->data['js']  =  js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');
		$this->data['js'] .= js_asset('bootstrap-datepicker.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= js_asset('bootstrap-datepicker.id.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= "<script> var options={format: 'dd-mm-yyyy',todayHighlight: true,autoclose: true, daysOfWeekDisabled: '0',daysOfWeekHighlighted: '0',language: 'id',locale: 'id',};$('.kewarganegaraan').select2();$('.tgl-lahir').datepicker(options);</script>";


		$this->data['detail_tiket'] = json_decode($this->input->post('detail_tiket'));
		if(count($this->input->post('nm_penumpang')) > 0){

			$data_penumpang = array();

			$i = 0;
			foreach ($this->input->post('nm_penumpang') as $p) {
				$data_penumpang[] = (object) array(
					'nm_penumpang' => $p,
					'tgl_lahir' => $this->input->post('tgl_lahir')[$i],
					'kewarganegaraan' => $this->input->post('kewarganegaraan')[$i],
					'no_pass' => $this->input->post('no_pass')[$i],
					'no_ktp' => $this->input->post('no_ktp')[$i]
				);
			}

			$this->data['data_penumpang'] = $data_penumpang;
		}

		$this->data['pemesan'] = (object) array(
			'nama_pemesan' => $this->input->post('nm_pemesan'),
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp')
		);

		$this->data['content']=$this->load->view('final',$this->data,true);
		$this->display($this->data);

	}

	function proses(){
		$detail_tiket = json_decode($this->input->post('detail_tiket'));
		$data_penumpang = json_decode($this->input->post('data_penumpang'));
		$pemesan = json_decode($this->input->post('pemesan'));
		$org_id= $this->session->userdata('user_org');
		$status = true;

		$total_hrg=0;
		foreach($detail_tiket as $t){
			$jml_penumpang = count($data_penumpang);
			if($t->jml_seat < $jml_penumpang){
				$status &= false;
			}

			$total_hrg += $t->harga;
		}
		$total_hrg *= count($data_penumpang);

		$customer = array(
			'nama_customer' => $pemesan->nama_pemesan,
			'email' => $pemesan->email,
			'hp' => $pemesan->no_hp,
			'mitra' => $org_id
		);

		if($status &= $this->db->insert('customer', $customer)){
			$id_customer =$this->db->insert_id();

			$transaksi = array(
				'id_mitra' => $org_id,
				'id_customer' => $id_customer,
				'total_hrg' => $total_hrg
			);

			if($status &= $this->db->insert('transaksi', $transaksi)){
				$id_transaksi =$this->db->insert_id();

				foreach ($detail_tiket as $t) {
					$detail_transaksi[] = array(
						'id_tiket' => $t->id_tiket,
						'id_transaksi' => $id_transaksi,
						'hrg_tiket' => $t->harga
					);
		
				}
				$status &= $this->db->insert_batch('detail_transaksi', $detail_transaksi);

				if($status){
					foreach ($detail_tiket as $t) {
						$buyer = $this->M_transaksi->getBuyer($t->id_tiket);
						$tiket = array('jml_seat' => $t->jml_seat-$jml_penumpang);

						switch ($buyer) {
							case 10: $tiket['harga'] = $t->harga+150000;  break;
							case 30: $tiket['harga'] = $t->harga+150000; break;
							case 50: $tiket['harga'] = $t->harga+150000; break;
							case 90: $tiket['harga'] = $t->harga+150000; break;
							case 120: $tiket['harga'] = $t->harga+150000; break;
							}

					$status &= $this->db->update('tiket', $tiket, array('id_tiket' => $t->id_tiket));
					}	
				}

				foreach ($data_penumpang as $p) {
					$penumpang[] = array(
						'id_transaksi' => $id_transaksi,
						'nama_penumpang' => $p->nm_penumpang,
						'tgl_lahir' => $p->tgl_lahir,
						'kewarganegaraan' => $p->kewarganegaraan,
						'nik' => $p->no_ktp,
						'no_passport' => $p->no_pass
					);
				}	

				
				$status = $this->db->insert_batch('penumpang', $penumpang);
				
				//echo $this->db->last_query();
			}
		}
		if($status){
			redirect('transaksi/detail/'.$id_transaksi);
		}

		

	}

	function detail($id_transaksi){
		$this->data['css'] = css_asset('style.css', '');
		$this->data['css'] .= css_asset('select2.min.css','select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css', 'bootstrap-datepicker');

		$this->data['js']  =  js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');
		$this->data['js'] .= js_asset('bootstrap-datepicker.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= js_asset('bootstrap-datepicker.id.min.js', 'bootstrap-datepicker');
		// $this->data['js'] .= "<script> var options={format: 'dd-mm-yyyy',todayHighlight: true,autoclose: true, daysOfWeekDisabled: '0',daysOfWeekHighlighted: '0',language: 'id',locale: 'id',};$('.kewarganegaraan').select2();$('.tgl-lahir').datepicker(options);</script>";
		
		$this->data['detail_transaksi'] = $this->db->where('id_transaksi', $id_transaksi)->get('transaksi')->row();
		$this->data['detail_tiket'] = $this->M_transaksi->getDetailTiket($id_transaksi);
		// $this->data['pemesan'] = $this->M_transaksi->getCustomer($id_transaksi);
		$this->data['data_penumpang'] = $this->M_transaksi->getDetailPenumpang($id_transaksi);

		$this->data['content']=$this->load->view('detail',$this->data,true);
		$this->display($this->data);
	}

	public function bayar($id_transaksi){
		$status = true;
		$status &= $this->db->update('transaksi', array('konfirmasi_bayar' => 1), array('id_transaksi' => $id_transaksi));

		if($status){
			redirect('transaksi');
		}
	}

	public function print($id_transaksi){
		$detail_transaksi = $this->db->where('id_transaksi', $id_transaksi)->get('transaksi')->row();
		$detail_tiket = $this->M_transaksi->getDetailTiket($id_transaksi);
		// $pemesan = $this->M_transaksi->getCustomer($id_transaksi);
		$data_penumpang = $this->M_transaksi->getDetailPenumpang($id_transaksi);

		//load mPDF library
		$this->load->library('pdf');
		 

		// $html=$this->load->view('print', $this->data,true);
		// $this->load->view('print', $this->data);

		//this the the PDF filename that user will get to download
		// $pdfFilePath ='Tiket.pdf';
 
		
		// //actually, you can pass mPDF parameter on this load() function
		// $pdf = $this->m_pdf->load();
		// //generate the PDF!
		// $pdf->WriteHTML($html);
		// //offer it to user via browser download! (The PDF won't be saved on your server HDD)
		// $pdf->Output($pdfFilePath, "D");
		$pdf = new FPDF('p','mm','A5');

			$pdf->AddPage();
			// setting jenis font yang akan digunakan
			$pdf->Image('https://cdn.pixabay.com/photo/2015/07/09/13/05/citilink-837863_960_720.png',10,6,30,0,'PNG');
			$pdf->SetFont('Arial','B',14);
			// mencetak string 
			$pdf->Cell(150,7,'PT.Ubudiyah Aviation Indonesia',0,1,'C');
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(150,5,'E-Tiket',0,1,'C');

			$pdf->Cell(10,5,'',0,1); // space

			$pdf->SetFont('Arial','B',10);

			$pdf->Cell(10,6,'Detail Pemesanan ',0,1);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,6,'Kode : UB-BTJ00 '.$detail_transaksi->id_transaksi,0,1);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,6,'Tanggal Pemesanan: '.$detail_transaksi->tgl_transaksi,0,1);
			$pdf->Cell(10,6,'Status: Konfirm',0,1);

			$pdf->Cell(10,5,'',0,1); // space

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,6,'Detail Penumpang ',0,1);

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(30,6,'Nama',1,0);
			$pdf->Cell(30,6,'Jenis Kelamin',1,0);
			$pdf->Cell(20,6,'Kategori',1,1);

			$pdf->SetFont('Arial','',10);
			foreach($data_penumpang as $p){
				$pdf->Cell(30,6,$p->nama_penumpang,1,0);
				$pdf->Cell(30,6,'Jenis Kelamin',1,0);
				$pdf->Cell(20,6,'Dewasa',1,1);
			}

			$pdf->Cell(10,7,'',0,1);

			
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(10,6,'Keberangkatan ',0,1);

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(42,6,'Tanggal Keberangkatan',1,0);
			$pdf->Cell(55,6,'Rute',1,0);
			$pdf->Cell(20,6,'Maskapai',1,0);
			$pdf->Cell(15,6,'Harga',1,1);

			$pdf->SetFont('Arial','',10);
			foreach ($detail_tiket as $t) {
				$pdf->Cell(42,6,$t->tgl_berangkat." ".$t->waktu,1,0);
				$pdf->Cell(55,6,$t->kota_asal."(".$t->dari.") - ".$t->kota_tujuan."(".$t->tujuan.")",1,0);
				$pdf->Cell(20,6,'Citilink',1,0);
				$pdf->Cell(15,6,$t->hrg_tiket,1,1);
			}

			$pdf->Cell(10,7,'',0,1);
			$pdf->Line(10, $pdf->GetY(), 140, $pdf->GetY());

			// Memberikan space kebawah agar tidak terlalu rapat
			$pdf->Cell(10,7,'',0,1);

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(15,6,"Total Harga : Rp.".$detail_transaksi->total_hrg,0,1);

			// $pdf->SetFont('Arial','B',10);
			// $pdf->Cell(10,6,'NO',1,0);
			// $pdf->Cell(43,6,'TANGGAL TRANSAKSI',1,0);
			// $pdf->Cell(27,6,'KODE PNR',1,0);
			// $pdf->Cell(15,6,'DARI',1,0);
			// $pdf->Cell(18,6,'TUJUAN',1,0);
			// $pdf->Cell(22,6,'MASKAPAI',1,0);
			// $pdf->Cell(18,6,'TOTAL',1,0);
			// $pdf->Cell(35,6,'TGL BERANGKAT',1,1);
		
       	// Memberikan space kebawah agar tidak terlalu rapat
			$pdf->Cell(10,7,'',0,1);

		//	$pdf->SetFont('Arial','B',10);

			//$pdf->Cell(15,6,"BARANG BERBAHAYA ");
        // $pdf->SetFont('Arial','',10);

        // $query = $this->db->query("SELECT transaksi.tgl_transaksi,transaksi.id_transaksi as id_tran,kode_pnr,tgl_berangkat,waktu,dari,tujuan,maskapai,harga FROM transaksi,detail_transaksi,orgs,tiket where transaksi.id_mitra=orgs.id AND tiket.id_tiket=detail_transaksi.id_tiket AND transaksi.id_transaksi=detail_transaksi.id_transaksi AND orgs.id='$filter' AND tgl_transaksi between '$tgl_mulai' and '$tgl_akhir' ORDER BY id_tran DESC")->result();




        // foreach ($query as $row){
        //     $pdf->Cell(10,6,$row->id_tran,1,0);
        //     $pdf->Cell(43,6,$row->tgl_transaksi,1,0);
        //     $pdf->Cell(27,6,$row->kode_pnr,1,0);
        //     $pdf->Cell(15,6,$row->dari,1,0);
        //     $pdf->Cell(18,6,$row->tujuan,1,0);
        //     $pdf->Cell(22,6,$row->maskapai,1,0);
        //     $pdf->Cell(18,6,$row->harga,1,0);
        //     $pdf->Cell(35,6,$row->tgl_berangkat,1,0);   
        // }

        $pdf->Output();


	}
	
}