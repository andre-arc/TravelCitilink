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
		$this->data['css'] = css_asset('style.css', '');

		$data['asal'] = $this->input->get('asal');
		$data['tujuan'] = $this->input->get('tujuan');
		$data['tgl_berangkat'] = $this->__validate_date($this->input->get('tgl_berangkat')) ? date('Y-m-d', strtotime($this->input->get('tgl_berangkat'))) : redirect(base_url());
		$data['tgl_kembali'] = $this->input->get('pp') ?  $this->__validate_date($this->input->get('tgl_kembali')) ? date('Y-m-d', strtotime($this->input->get('tgl_kembali'))) : redirect(base_url()) : 'null';



		//echo json_encode($data);
		$this->data['result'] = $this->M_dashboard->getTicket($data);
		$this->data['content'] = $this->load->view('list_tiket', $this->data, true);

		$this->display($this->data);
		// echo json_encode($result);
		//echo $this->db->last_query();
	}


	function change_profile()
	{
		$result = array(
			'resp' => false,
			'message' => 'Ada yang salah pada saat mengedit profil anda.'
		);
		if (isset($_POST['profile_id'])) {
			$id_user = $_POST['profile_id'];
			//ion auth edit user
			$data = array(
				'first_name' => $_POST['profile_first_name'],
				'last_name' => $_POST['profile_last_name'],
				'email' => $_POST['profile_email'],
				'phone' => $_POST['profile_phone']
			);

			//ion auth edit password user
			if (isset($_POST['profile_rst_pass'])) {
				$data['password'] = $_POST['profile_password'];
				$msg_passwd = "Edit Password berhasil.\n\rSilahkan logout untuk menguji data anda.";
			} else {
				$msg_passwd = '';
			}
			$res = $this->ion_auth->update($id_user, $data);
			if ($res) {
				$result = array(
					'resp' => TRUE,
					'message' => "Edit profil berhasil.\n\r" . $msg_passwd
				);
			} else {
				$result = array(
					'resp' => FALSE,
					'message' => "Edit profil gagal.\n\rSilahkan ulangi."
				);
			}
		} else {
			$result = array(
				'resp' => false,
				'message' => "Ada yang salah pada saat mengedit profil anda."
			);
		}
		echo json_encode($result);
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
