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
	
}