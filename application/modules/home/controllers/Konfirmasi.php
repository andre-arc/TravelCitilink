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
		$this->load->model('transaksi/M_transaksi');

		$this->load->helper('tanggal_indo');
	}


	function index()
	{
		// $meta = $this->meta('acl/groups/',true);
		$data = null;

		if($this->input->get('orderId')){
			$this->load->library('form_validation');

			$dataInput = array(
				'email' => $this->input->get('email'),
				'orderId' => $this->input->get('orderId')
			);

			$this->form_validation->set_data($dataInput);

			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('orderId', 'Order Id', 'trim|required');
		
			if (!$this->form_validation->run() == FALSE)
			{
				$order_id = $this->input->get('orderId');
				$email = $this->input->get('email');

				$detail_transaksi = $this->db->join('customer as c', 't.id_customer=c.id_customer')
											 ->where('t.kode', $order_id)
											 ->where('c.email', $email)
											 ->get('transaksi as t')->row();

				if(count($detail_transaksi) > 0){

					$select_tiket = $this->db->select('id_tiket')->where('id_transaksi', $detail_transaksi->id_transaksi)->get('detail_transaksi')->result();
					foreach ($select_tiket as $dt) {
						$r[] = $dt->id_tiket;
					}

					$detail_tiket = $this->M_transaksi->getDetailTiket($r);
					$pemesan = $this->M_transaksi->getCustomer($detail_transaksi->id_transaksi);
					$data_penumpang = $this->M_transaksi->getDetailPenumpang($detail_transaksi->id_transaksi);

					$jenis_penumpang = $this->M_transaksi->getJenisPenumpang();
					$detail_harga = array();
					$total_harga = 0;

					foreach ($jenis_penumpang as $j) {
						$count = 0;
						foreach ($data_penumpang as $dp) {
							if($dp->jenis_penumpang == $j->nama)
								$count++;
						}

						if($count > 0){
							$total = 0;
							foreach ($detail_tiket as $t){
								
								$select_harga = $this->db->select('dt.hrg_tiket')
														->join('jenis_penumpang as jp', 'jp.id=dt.jenis_penumpang')
														->where('dt.id_tiket', $t->id_tiket)
														->where('jp.nama', $j->nama)
														->get('detail_tiket as dt')->row();
								$total += $select_harga->hrg_tiket;
							}

							$detail_harga[] = (object) array(
									'jenis_penumpang' => $j->nama,
									'jml_penumpang' => $count,
									'total_hrg' => $total
							);
							$total_harga += $total * $count;
						}
					}
					
				}

				$data = array(
					'detail_transaksi' => $detail_transaksi,
					'pemesan' => $pemesan,
					'detail_tiket' => $detail_tiket,
					'data_penumpang' => $data_penumpang,
					'detail_harga' =>  $detail_harga,
					'total_harga' => $total_harga,
				);
			}
		}
	

		//print_r($mydata);die;


		$this->data['css'] = css_asset('style.css', '');
		$this->data['content'] = $this->load->view('konfirmasi', $data, true);
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
