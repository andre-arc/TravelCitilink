<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		$this->data['tpl']='single';
		$this->load->model("M_transaksi");
	}
	
	function index() {

		$this->data['content']=$this->load->view('transaksi',$this->data,true);
		$this->display($this->data);
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
			$this->display($this->data);
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
						$buyer = $this->M_transaksi->getBuyer($tiket->id_tiket);
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

				$status &= $this->db->insert_batch('penumpang', $penumpang);
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
		$this->data['detail_transaksi'] = $this->db->where('id_transaksi', $id_transaksi)->get('transaksi')->row();
		$this->data['detail_tiket'] = $this->M_transaksi->getDetailTiket($id_transaksi);
		$this->data['data_penumpang'] = $this->M_transaksi->getDetailPenumpang($id_transaksi);

		//load mPDF library
		$this->load->library('m_pdf');
		 

		// $html=$this->load->view('print', $this->data,true);
		$this->load->view('print', $this->data);

		//this the the PDF filename that user will get to download
		// $pdfFilePath ='Tiket.pdf';
 
		
		// //actually, you can pass mPDF parameter on this load() function
		// $pdf = $this->m_pdf->load();
		// //generate the PDF!
		// $pdf->WriteHTML($html);
		// //offer it to user via browser download! (The PDF won't be saved on your server HDD)
		// $pdf->Output($pdfFilePath, "D");
	}
	
}