<?php defined('BASEPATH') or exit('No direct script access allowed');

class Konfirmasi extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		//$this->__init();
		$this->data['tpl'] = 'single';
		$this->data['icon'] = 'fa fa-cogs';
		$this->data['subicon'] = 'fa fa-university';
		$this->data['title'] = 'Konfirmasi Pembayaran';
		$this->data['table_name'] = 'users';
		$this->data['content'] = '';
		$this->data['css'] = css_asset('bootstrap-table.min.css', 'bootstrap-table');
		$this->data['css'] .= css_asset('bootstrap3-wysihtml5.min.css', 'bootstrap-wysihtml5');
		$this->data['js'] = js_asset('bootstrap-table.min.js', 'bootstrap-table');
		$this->data['js'] .= js_asset('bootstrap3-wysihtml5.all.min.js', 'bootstrap-wysihtml5');
		$this->load->model('KonfirmasiModel');
	}


	function index()
	{
		// $meta = $this->meta('acl/groups/',true);
		$this->load->library('form_validation');

		//print_r($mydata);die;


		$this->data['css'] = css_asset('style.css', '');
		$this->data['content'] = $this->load->view('konfirmasi', null, true);
		$this->display();
	}



	function add()
	{
		$ret = array(
			'success' => false,
			'msg' 	=>	'Gagal Menambah Data'
		);

		$select = $this->db->select('*')
			->from('transaksi')
			->where('kode', $this->input->post('kode_transaksi'))
			->get()->row();

		if ($select->konfirmasi_bayar != 1) {
			$data['bank_tujuan'] = $_POST['bank_tujuan'];
			$data['bank_anda']	= $_POST['bank_anda'];
			$data['atas_nama']	= $_POST['atas_nama'];
			$data['metode']		= $_POST['metode'];
			$data['nominal']	= $_POST['nominal'];
			$data['tgl_tranfers'] = $_POST['tgl_tranfers'];
			$data['id_transaksi'] = $select->id_transaksi;
			//$data['status']		= $_POST['status'];
			//$data['id_users']	= $_POST['id_users'];

			$this->db->insert('konfirmasi_pembayaran', $data);

			$last_insert_id = $this->db->insert_id();

			if ($last_insert_id) {
				$ret = array(
					'success' => true,
					'msg' => 'Berhasil Menambah data'
				);
			}
		} else {
			$ret = array(
				'success' => false,
				'msg' => 'Transaksi telah di konfirmasi'
			);
		}

		echo json_encode($ret);
	}
}
