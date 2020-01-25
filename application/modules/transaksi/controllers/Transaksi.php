<?php defined('BASEPATH') or exit('No direct script access allowed');

use google\appengine\api\mail\Message;

class Transaksi extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("M_transaksi");
		$this->load->helper("tanggal_indo_helper");
	}

	function index()
	{
		$this->data['css'] =  css_asset('bootstrap-table.min.css', 'bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css', 'limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css', 'select2');

		$this->data['js']  =  js_asset('bootstrap-table.min.js', 'bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js', 'limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js', 'select2');

		$meta = $this->meta('transaksi/', true);
		$this->data['auth_meta'] = $meta['act'];
		$this->data['icon']      = $meta['icon'];
		$this->data['title']     = $meta['title'];




		$this->data['content'] = $this->load->view('transaksi', $this->data, true);
		$this->display($this->data);
	}

	public function get_json($id_transaksi = null)
	{
		$ret = array(
			'total' => 0,
			'rows' => array()
		);
		header('Content-Type: application/json');

		$limit  = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$search = (isset($_GET['search'])) ? $_GET['search'] : '';
		$sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 't.tgl_transaksi';
		$order  = (isset($_GET['order'])) ? $_GET['order'] : 'desc';

		$SQL_BASE = '
			select * from transaksi as t join orgs as o on o.id=t.id_mitra 
		';

		if ($search <> '') {
			//get where
			$SQL_BASE .= 'WHERE ';
			$SQL_BASE .= 't.id_transaksi like "%' . $search . '%" OR ';
			$SQL_BASE .= 't.id_tiket like "%' . $search . '%" OR ';
			$SQL_BASE .= 't.tgl_transaksi like "%' . $search . '%" OR ';
			$SQL_BASE .= 't.total_hrg like "%' . $search . '%" OR ';

			$ls_data = $this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);

			//get where with limit
			$SQL = ($sort) ? $SQL_BASE . ' ORDER BY ' . $sort . ' ' . $order : $SQL_BASE;
			$SQL .= ' LIMIT ' . $offset . ',' . $limit;
			$ls_data_limit = $this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;
		} else {

			if ($id_transaksi != null) {
				$SQL_BASE .= 'WHERE id_transaksi="' . $id_transaksi . '"';
			}
			//get all
			$ls_data = $this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
			//get limit
			$SQL = ($sort) ? $SQL_BASE . ' ORDER BY ' . $sort . ' ' . $order : $SQL_BASE;
			$SQL .= ' LIMIT ' . $offset . ',' . $limit;
			$ls_data_limit = $this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;
		}

		echo json_encode($ret);
	}


	function checkout()
	{
		$this->data['css'] = css_asset('style.css', '');
		$this->data['css'] .= css_asset('select2.min.css', 'select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css', 'bootstrap-datepicker');

		$this->data['js']  =  js_asset('bootstrap-table.min.js', 'bootstrap-table');
		$this->data['js']  .= js_asset('select2.full.min.js', 'select2');
		$this->data['js'] .= js_asset('bootstrap-datepicker.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= js_asset('bootstrap-datepicker.id.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= "<script> var options={format: 'dd-mm-yyyy',todayHighlight: true,autoclose: true, daysOfWeekDisabled: '0',daysOfWeekHighlighted: '0',language: 'id',locale: 'id',};$('.kewarganegaraan').select2();$('.tgl-lahir').datepicker(options);</script>";


		$tiket = $this->session->userdata('selected_tiket');
		$this->data['detail_tiket'] = $this->M_transaksi->getDetailTiket($tiket);
		$this->data['jenis_penumpang'] = $this->M_transaksi->getJenisPenumpang();
		$this->data['jml_penumpang'] = array(
			'Dewasa' => $this->input->post('adult'),
			'Anak' => $this->input->post('child'),
			'Bayi' => $this->input->post('infant'),
		);

		$this->data['content'] = $this->load->view('checkout', $this->data, true);

		if ($this->ion_auth->logged_in()) {
			$org_id = $this->session->userdata('user_org');
		} else {
			$org_id = '777';
		}

		$this->db->where('id', $org_id);
		$org = $this->db->get('orgs')->row();

		$this->display($this->data);
		// 
	}

	function getHarga()
	{
		$id_tiket = $this->input->post('id');
		$jenis_penumpang = $this->input->post('jenis');

		$select = $this->db->select('hrg_tiket')
			->where('id_tiket', $id_tiket)
			->where('jenis_penumpang', $jenis_penumpang)
			->get('detail_tiket')->row();

		echo $select->hrg_tiket;
	}

	public function finalisasi()
	{
		$this->data['css'] = css_asset('style.css', '');
		$this->data['css'] .= css_asset('select2.min.css', 'select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css', 'bootstrap-datepicker');

		$this->data['js']  =  js_asset('bootstrap-table.min.js', 'bootstrap-table');
		$this->data['js']  .= js_asset('select2.full.min.js', 'select2');
		$this->data['js'] .= js_asset('bootstrap-datepicker.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= js_asset('bootstrap-datepicker.id.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= "<script> var options={format: 'dd-mm-yyyy',todayHighlight: true,autoclose: true, daysOfWeekDisabled: '0',daysOfWeekHighlighted: '0',language: 'id',locale: 'id',};$('.kewarganegaraan').select2();$('.tgl-lahir').datepicker(options);</script>";


		$this->data['detail_tiket'] = json_decode($this->input->post('detail_tiket'));
		$this->data['detail_harga'] = json_decode($this->input->post('detail_harga'));
		if (count($this->input->post('nm_penumpang')) > 0) {

			$data_penumpang = array();

			$i = 0;
			foreach ($this->input->post('nm_penumpang') as $p) {
				$select_jenis = $this->db->where('id', $this->input->post('penumpang')[$i])->get('jenis_penumpang')->row();

				$data_penumpang[] = (object) array(
					'nm_penumpang' => $p,
					'jenis_penumpang' => $this->input->post('penumpang')[$i],
					'deskripsi_penumpang' => $select_jenis->nama,
					'harga' => $this->input->post('hrg_tiket')[$i]
				);
				$i++;
			}

			$this->data['data_penumpang'] = $data_penumpang;
		}

		$this->data['pemesan'] = (object) array(
			'nama_pemesan' => $this->input->post('nm_pemesan'),
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp')
		);

		$this->data['content'] = $this->load->view('final', $this->data, true);
		$this->display($this->data);
	}

	function proses()
	{
		$detail_tiket = json_decode($this->input->post('detail_tiket'));
		$detail_harga = json_decode($this->input->post('detail_harga'));
		$data_penumpang = json_decode($this->input->post('data_penumpang'));
		$pemesan = json_decode($this->input->post('pemesan'));

		$status = true;

		$data = array(
			'tiket' => $detail_tiket,
			'penumpang' =>  $data_penumpang,
			'pemesan' => $pemesan
		);

		if ($this->ion_auth->logged_in()) {
			$org_id = $this->session->userdata('user_org');
		} else {
			$org_id = '777';
		}
		$status = true;

		$total_hrg = 0;
		// foreach ($detail_tiket as $t) {
		// 	$jml_penumpang = count($data_penumpang);
		// 	if ($t->jml_seat < $jml_penumpang) {
		// 		$status &= false;
		// 	}

		// 	$total_hrg += $t->harga;
		// }

		foreach ($detail_harga as $d) {
			$total_hrg += $d->harga;
		}

		$data['detail_hrg'] = $detail_harga;
		$data['total_hrg'] = $total_hrg;

		// $total_hrg *= count($data_penumpang);

		$customer = array(
			'nama_customer' => $pemesan->nama_pemesan,
			'email' => $pemesan->email,
			'hp' => $pemesan->no_hp,
			'mitra' => $org_id
		);


		if ($status &= $this->db->insert('customer', $customer) > 0 ? true : false) {

			$id_customer = $this->db->insert_id();
			$token = getToken(6);
			$transaksi = array(
				'id_mitra' => $org_id,
				'id_customer' => $id_customer,
				'total_hrg' => $total_hrg,
				'kode' => $token
			);
			$data['order_id'] = $token;

			if ($status &= $this->db->insert('transaksi', $transaksi) > 0 ? true : false) {
				$id_transaksi = $this->db->insert_id();

				// update data tiket
				// if ($status) {
				// 	foreach ($detail_tiket as $t) {
				// 		$buyer = $this->M_transaksi->getBuyer($t->id_tiket);
				// 		$tiket = array('jml_seat' => $t->jml_seat - $jml_penumpang);

				// 		switch ($buyer) {
				// 			case 10:
				// 				$tiket['harga'] = $t->harga + 150000;
				// 				break;
				// 			case 30:
				// 				$tiket['harga'] = $t->harga + 150000;
				// 				break;
				// 			case 50:
				// 				$tiket['harga'] = $t->harga + 150000;
				// 				break;
				// 			case 90:
				// 				$tiket['harga'] = $t->harga + 150000;
				// 				break;
				// 			case 120:
				// 				$tiket['harga'] = $t->harga + 150000;
				// 				break;
				// 		}

				// 		$status &= $this->db->update('tiket', $tiket, array('id_tiket' => $t->id_tiket));
				// 	}
				// }

				foreach ($detail_tiket as $t) {
					$detail[] = array(
						'id_transaksi' => $id_transaksi,
						'id_tiket' => $t->id_tiket,
					);
				}

				$status &= $this->db->insert_batch('detail_transaksi', $detail) > 0 ? true : false;

				foreach ($data_penumpang as $p) {
					$penumpang[] = array(
						'id_transaksi' => $id_transaksi,
						'nama_penumpang' => $p->nm_penumpang,
						'jenis_penumpang' => $p->jenis_penumpang,
					);
				}


				$status &= $this->db->insert_batch('penumpang', $penumpang) > 0 ? true : false;

				//echo $this->db->last_query();
			}
		}

		//echo $status;
		if ($status) {

			if ($org_id != '777') {
				redirect('transaksi/detail/' . $id_transaksi);
			} else {
				$detail_email = array(
					'id_transaksi' => $id_transaksi,
					'token' => $token,
					'total_hrg' => $total_hrg
				);

				$url = $this->__generate_vtweb($data);
				$update_data = array('url_bayar' => $url);
				$update = $this->db->update('transaksi', $update_data, array('id_transaksi' => $id_transaksi));
				if ($update) {
					$this->__kirimDetailTransaksi($token);
					redirect($url);
				}
			}
		} else {
			var_dump($this->db->error());
		}
	}

	// function tes_mail(){
	// 	try {
	// 		$message = new Message();
	// 		$message->setSender('touristixid@gmail.com');
	// 		$message->addTo('andridarnius@gmail.com');
	// 		$message->setSubject('test');
	// 		$message->setHtmlBody('<h1>tes</h1>');
	// 		$message->send();
	// 		echo 'Mail Sent';
	// 	} catch (InvalidArgumentException $e) {
	// 		echo 'There was an error: '.$e;
	// 	}
	// }

	// function success(){

	// }

	// function pending(){

	// }

	// function error(){

	// }

	function __kirimDetailTransaksi($order_id)
	{

		$this->load->library('mjml');
		$this->load->library('email');
		$data = array();

		$select = $this->db->select('t.*, c.*')
			->from('transaksi as t')
			->join('customer as c', 't.id_customer=c.id_customer')
			->where('t.kode', $order_id)->get()->row();

		$data = array(
			'order_id' => $order_id,
			'nama_customer' => $select->nama_customer,
			'email' => $select->email,
			'url_bayar' => $select->url_bayar,
			'total_hrg' => $select->total_hrg,
			'tgl_transaksi' => $select->tgl_transaksi,
			"subject" => "Konfirmasi Pembayaran Order " . $order_id . " Tiket Kapal Touristix.ID"
		);

		$mjml = $this->load->view('email_konfirmasi_order', $data, true);
		$html = $this->mjml->render($mjml);


		try {
			$message = new Message();
			$message->setSender('touristixid@gmail.com');
			$message->addTo($data['email']);
			$message->setSubject($data['subject']);
			$message->setHtmlBody($html);
			$message->send();
			// echo 'Mail Sent';
			return true;
		} catch (InvalidArgumentException $e) {
			// echo 'There was an error';
			return false;
		}
	}

	function detail($id_transaksi)
	{
		$this->data['css'] = css_asset('style.css', '');
		$this->data['css'] .= css_asset('select2.min.css', 'select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css', 'bootstrap-datepicker');

		$this->data['js']  =  js_asset('bootstrap-table.min.js', 'bootstrap-table');
		$this->data['js']  .= js_asset('select2.full.min.js', 'select2');
		$this->data['js'] .= js_asset('bootstrap-datepicker.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= js_asset('bootstrap-datepicker.id.min.js', 'bootstrap-datepicker');
		// $this->data['js'] .= "<script> var options={format: 'dd-mm-yyyy',todayHighlight: true,autoclose: true, daysOfWeekDisabled: '0',daysOfWeekHighlighted: '0',language: 'id',locale: 'id',};$('.kewarganegaraan').select2();$('.tgl-lahir').datepicker(options);</script>";

		$this->data['detail_transaksi'] = $this->db->where('id_transaksi', $id_transaksi)->get('transaksi')->row();
		$this->data['detail_tiket'] = $this->M_transaksi->getDetailTiket($id_transaksi);
		// $this->data['pemesan'] = $this->M_transaksi->getCustomer($id_transaksi);
		$this->data['data_penumpang'] = $this->M_transaksi->getDetailPenumpang($id_transaksi);

		$this->data['content'] = $this->load->view('detail', $this->data, true);
		$this->display($this->data);
	}

	function __generate_vtweb($data)
	{
		$params = array('server_key' => 'SB-Mid-server-sFpG2wSCF1POs-mwEr7qd3E-', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);

		$transaction_details = array(
			'order_id' 			=> $data['order_id'],
			'gross_amount' 	=> $data['total_hrg']
		);

		// Populate items
		$items = array();

		foreach ($data['detail_hrg'] as $d) {
			$total = 0;
			foreach ($data['tiket'] as $t) {
				$total += $t->{'hrg_' . $d->jenis_penumpang};
			}
			$items[] = array(
				'price' 		=> $total,
				'quantity' 		=> $d->jml_penumpang,
				'name' 			=> 'Tiket Kapal (' . ucwords($d->jenis_penumpang) . ')'
			);
		}

		// echo json_encode($data);
		$nama_customer = explode(" ", $data['pemesan']->nama_pemesan);

		// Populate customer's billing address
		$billing_address = array(
			'first_name' 		=> count($nama_customer) > 0 ? $nama_customer[0]  : '',
			'last_name' 		=> count($nama_customer) > 1 ? $nama_customer[1] : '',
			'phone' 			=> $data['pemesan']->no_hp,
			'country_code'		=> 'IDN'
		);



		// Populate customer's Info
		$customer_details = array(
			'first_name' 		=> count($nama_customer) > 0 ? $nama_customer[0]  : '',
			'last_name' 		=> count($nama_customer) > 1 ? $nama_customer[1] : '',
			'email' 			=> $data['pemesan']->email,
			'phone' 			=> $data['pemesan']->no_hp,
			'billing_address' 	=> $billing_address,
		);

		// Data yang akan dikirim untuk request redirect_url.
		// Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
		$transaction_data = array(
			'payment_type' 			=> 'vtweb',
			'vtweb' 						=> array(
				//'enabled_payments' 	=> ['credit_card'],
				'credit_card_3d_secure' => true
			),
			'transaction_details' => $transaction_details,
			'item_details' 			 => $items,
			'customer_details' 	 => $customer_details
		);

		try {
			$vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
			return $vtweb_url;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function bayar($id_transaksi)
	{
		$status = true;
		$status &= $this->db->update('transaksi', array('konfirmasi_bayar' => 1), array('id_transaksi' => $id_transaksi));

		if ($status) {
			redirect('transaksi');
		}
	}

	function cetakTiket()
	{
		$order_id = $this->input->get('orderId');
		if ($order_id) {
			$detail_transaksi = $this->db->where('status_bayar', 'success')->where('kode', $order_id)->get('transaksi')->row();
			if (count($detail_transaksi) > 0) {

				$select_tiket = $this->db->select('id_tiket')->where('id_transaksi', $detail_transaksi->id_transaksi)->get('detail_transaksi')->result();
				foreach ($select_tiket as $dt) {
					$r[] = $dt->id_tiket;
				}

				$detail_tiket = $this->M_transaksi->getDetailTiket($r);
				$data_penumpang = $this->M_transaksi->getDetailPenumpang($detail_transaksi->id_transaksi);

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
				$pdf = new FPDF('p', 'mm', 'A4');

				$pdf->AddPage();
				// setting jenis font yang akan digunakan
				$pdf->Image('https://storage.googleapis.com/touristix.appspot.com/assets/image/logo.png', 10, 6, 30, 0, 'PNG');
				$pdf->SetFont('Arial', 'B', 14);
				// mencetak string 
				$pdf->Cell(150, 7, 'Touristix', 0, 1, 'C');
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Cell(150, 5, 'E-Tiket', 0, 1, 'C');

				$pdf->Cell(10, 5, '', 0, 1); // space

				$pdf->SetFont('Arial', 'B', 10);

				$pdf->Cell(10, 6, 'Detail Pemesanan ', 0, 1);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(10, 6, 'Kode : ' . $detail_transaksi->kode, 0, 1);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(10, 6, 'Tanggal Pemesanan: ' . $detail_transaksi->tgl_transaksi, 0, 1);
				$pdf->Cell(10, 6, 'Status: ' . $detail_transaksi->status_bayar, 0, 1);

				foreach ($detail_tiket as $t) {
					$pdf->Cell(10, 7, '', 0, 1);
					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(10, 6, 'Keberangkatan ', 0, 1);

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(42, 6, 'Tanggal Keberangkatan', 1, 0);
					$pdf->Cell(80, 6, 'Rute', 1, 0);
					$pdf->Cell(40, 6, 'Kapal', 1, 1);



					$pdf->SetFont('Arial', '', 10);
					$x = $pdf->GetX();
					$y = $pdf->GetY();

					$pdf->MultiCell(42, 6, $t->tgl_berangkat . " " . $t->waktu, 1, 'L');
					$pdf->setXY($x += 42, $y);

					$pdf->MultiCell(80, 6, $t->kota_asal . "(" . $t->dari . ") - " . $t->kota_tujuan . "(" . $t->tujuan . ")", 1, 'L');
					$pdf->setXY($x += 80, $y);

					$pdf->MultiCell(40, 6, $t->nama_kapal, 1, 'L');
					$pdf->Ln(0);

					$pdf->Cell(10, 5, '', 0, 1); // space

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(10, 6, 'Detail Penumpang ', 0, 1);

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(30, 6, 'Nama', 1, 0);
					$pdf->Cell(20, 6, 'Kategori', 1, 0);
					$pdf->Cell(20, 6, 'Harga', 1, 1);

					$pdf->SetFont('Arial', '', 10);
					foreach ($data_penumpang as $p) {
						$pdf->Cell(30, 6, $p->nama_penumpang, 1, 0);
						$pdf->Cell(20, 6, $p->jenis_penumpang, 1, 0);

						$select_harga = $this->db->select('dt.hrg_tiket')
							->join('jenis_penumpang as jp', 'jp.id=dt.jenis_penumpang')
							->where('dt.id_tiket', $t->id_tiket)
							->where('jp.nama', $p->jenis_penumpang)
							->get('detail_tiket as dt')->row();
						$pdf->Cell(20, 6, convertToRupiah($select_harga->hrg_tiket), 1, 1);
					}
				}



				$pdf->Cell(10, 7, '', 0, 1);
				$pdf->Line(10, $pdf->GetY(), 140, $pdf->GetY());

				// Memberikan space kebawah agar tidak terlalu rapat
				$pdf->Cell(10, 7, '', 0, 1);

				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Cell(15, 6, "Total Harga : " . convertToRupiah($detail_transaksi->total_hrg), 0, 1);

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
				$pdf->Cell(10, 7, '', 0, 1);

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

				$pdf->Output('D', 'Bukti Pembayaran Tiket Kapal - ' . $order_id . '.pdf');
			}
		}
	}
}
