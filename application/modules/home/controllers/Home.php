<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_dashboard');
	}

	function index()
	{
		$this->session->unset_userdata('selected_tiket');

		$this->data['css'] = css_asset('style.css', '');
		$this->data['css'] .=  css_asset('bootstrap-table.min.css', 'bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css', 'limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css', 'select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css', 'bootstrap-datepicker');

		$this->data['js']  =  js_asset('bootstrap-table.min.js', 'bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js', 'limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js', 'select2');
		$this->data['js'] .= js_asset('bootstrap-datepicker.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= js_asset('bootstrap-datepicker.id.min.js', 'bootstrap-datepicker');


		$this->data['pelabuhan'] = $this->M_dashboard->getPelabuhan();

		$this->data['content'] = $this->load->view('dashboard', $this->data, true);
		$this->display($this->data);
	}

	function search()
	{
		$this->session->unset_userdata('selected_tiket');

		$this->data['css'] = css_asset('style.css', '');
		$data['asal'] = $this->input->get('asal');
		$data['tujuan'] = $this->input->get('tujuan');
		$data['tgl_berangkat'] = $this->__validate_date($this->input->get('tgl_berangkat')) ? date('Y-m-d', strtotime($this->input->get('tgl_berangkat'))) : redirect(base_url());
		$data['tgl_kembali'] = $this->input->get('pp') ?  $this->__validate_date($this->input->get('tgl_kembali')) ? date('Y-m-d', strtotime($this->input->get('tgl_kembali'))) : redirect(base_url()) : 'null';

		//echo json_encode($data);

		$this->data['content'] = $this->load->view('list_tiket', $this->data, true);

		$this->display($this->data);
		// echo json_encode($result);
		//echo $this->db->last_query();
	}

	function getJsonTiket()
	{
		$html = '';
		$data['asal'] = $this->input->post('asal');
		$data['tujuan'] = $this->input->post('tujuan');
		$data['tgl_berangkat'] = $this->input->post('tgl_berangkat');

		$result = $this->M_dashboard->getTicket($data);

		if (!empty($result)) {
			$html .= "<form action='" . base_url('transaksi/checkout') . "' method='POST' id='form-checkout'>";

			$html .= form_hidden('adult', $this->input->post('adult'));
			$html .= form_hidden('child', $this->input->post('child'));
			$html .= form_hidden('infant', $this->input->post('infant'));

			foreach ($result as $r) {
				$html .= '<div class="panel" style="margin-bottom: 7px;">
								<div class="modal-header">
									<div class="row">
										<div class="col-md-3">
											<h4 class="list-title">
												<span id="title_act"></span> Jenis Kapal <i class="fa fa-angle-down"></i></h4>
										</div>
										<div class="col-md-2">
											<h4 class="list-title">
												<span id="title_act"></span> Waktu Berangkat <i class="fa fa-angle-down"></i></h4>
										</div>
										<div class="col-md-4">
											<h4 class="list-title">
												<span id="title_act"></span> Rute Keberangkatan <i class="fa fa-angle-down"></i></h4>
										</div>
										<div class="col-md-3">
											<h4 class="list-title" style="text-align: left">
												<span id="title_act"></span> Harga <i class="fa fa-angle-down"></i></h4>
										</div>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-3" style="text-align: center;">
												<img style="margin-left: 10%;margin-top: -22px;margin-bottom: -18px;" src="'.$this->config->item('asset_url').'assets/image/'. $r->logo_kapal.'" alt="'.$r->nama_kapal.'">
												<h4>'.$r->nama_kapal.'</h4>
												<h5 class="text-center">Executive</h5>
											</div>
											<div class="col-md-2 time">
												<span>
													' . $r->tgl_berangkat . " | " . $r->waktu . '
													<br>

												</span>
											</div>
											<div class="col-md-4 detail-tiket">

												' . $r->dari . " <i class='fa  fa-angle-right'></i> " . $r->tujuan . '
												<br>

											</div>
											<div class="col-md-3">
												<div class="row" style="padding-top: 45px;">
													<div class="col-sm-6 col-xs-6">
														<div class="harga">
															<span>' . convertToRupiah($r->hrg_dewasa) . '</span>
														</div>
													</div>
													<div class="col-sm-6 col-xs-6">
														<div class="hrgbutton">
															<button type="button" class="btn btn-info tiket_btn pull-right" btn-id="' . $r->id_tiket . '">Pilih</button>
														</div>
													</div>
												</div>



											</div>



											</form>
										</div>
									</div>
								</div>
							</div>';
				$html .= form_close();
			}
		} else {
			$html .= ' <div class="panel">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12 text-center">
											Tidak ada Data
										</div>
									</div>
								</div>
							</div>';
		}

		echo $html;
	}

	function selectTiket()
	{
		$id = $this->input->post('id_tiket');
		if (!$this->session->userdata('selected_tiket')) {
			$this->session->set_userdata('selected_tiket', array($id));
		} else {
			$data = $this->session->userdata('selected_tiket');
			$data[] = $id;
			$this->session->set_userdata('selected_tiket', $data);
		}

		echo true;
	}


	function newsletter()
	{
		$ret = array(
			'success' => false,
			'msg' => 'Gagal Menambah Data'
		);

		$data['email'] = $_POST['email'];
		$this->db->insert('newsletter', $data);

		$last_insert_id = $this->db->insert_id();

		if ($last_insert_id) {
			$ret = array(
				'success' => true,
				'msg' => 'Berhasil Menambah Data'
			);
		}
		echo json_encode($ret);
	}

	function __validate_date($date)
	{
		$date_now = date("Y-m-d");

		if ($date > $date_now) {
			return true;
		} else {
			return false;
		}
	}
}
