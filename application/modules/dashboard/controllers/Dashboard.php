<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_dashboard');
	}
	
	function index() {

		$this->data['css'] = css_asset('style.css', '');
		$this->data['css'] .=  css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css','limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css','select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css', 'bootstrap-datepicker');

		$this->data['js']  =  js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js','limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');
		$this->data['js'] .= js_asset('bootstrap-datepicker.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= js_asset('bootstrap-datepicker.id.min.js', 'bootstrap-datepicker');
		$this->data['js'] .= "<script> var options={format: 'dd-mm-yyyy',todayHighlight: true,autoclose: true, daysOfWeekDisabled: '0',daysOfWeekHighlighted: '0',language: 'id',locale: 'id',};$('#asal').select2();$('#tujuan').select2();$('#tgl_berangkat').datepicker(options);$('#tgl_kembali').datepicker(options);</script>";


		$this->data['pelabuhan'] = $this->M_dashboard->getPelabuhan();

		$this->data['content']=$this->load->view('dashboard',$this->data,true);
		$this->display($this->data);
	}

	function search(){
		$data['asal'] = $this->input->post('asal');
		$data['tujuan'] = $this->input->post('tujuan');
		$data['tgl_berangkat'] = date('Y-m-d', strtotime($this->input->post('tgl_berangkat')));
		$data['tgl_kembali'] = $this->input->post('pp') ? date('Y-m-d', strtotime($this->input->post('tgl_kembali')))  : 'null';

		$this->data['result'] = $this->M_dashboard->getTicket($data);
		$result['status'] = true;
		$result['html'] = $this->load->view('list_tiket', $this->data, true);
		


		echo json_encode($result);
		// echo $this->db->last_query();
	}
		
	
	function change_profile(){
		$result = array(
			'resp'=>false,
			'message'=>'Ada yang salah pada saat mengedit profil anda.'
		);
		if(isset($_POST['profile_id'])){
			$id_user=$_POST['profile_id'];
			//ion auth edit user
			$data = array(
					'first_name' => $_POST['profile_first_name'],
					'last_name' => $_POST['profile_last_name'],
					'email' => $_POST['profile_email'],
					'phone' => $_POST['profile_phone']
					 );
			
			//ion auth edit password user
			if(isset($_POST['profile_rst_pass'])){
				$data['password']=$_POST['profile_password'];
				$msg_passwd="Edit Password berhasil.\n\rSilahkan logout untuk menguji data anda.";
			}else{
				$msg_passwd='';
			}
			$res = $this->ion_auth->update($id_user, $data);
			if($res){
				$result = array(
					'resp'=>TRUE,
					'message'=>"Edit profil berhasil.\n\r".$msg_passwd
				);				
			}else{
				$result = array(
					'resp'=>FALSE,
					'message'=>"Edit profil gagal.\n\rSilahkan ulangi."
				);			
			}
		}else{
			$result = array(
				'resp'=>false,
				'message'=>"Ada yang salah pada saat mengedit profil anda."
			);			
		}
		echo json_encode($result);
	}	
	
}