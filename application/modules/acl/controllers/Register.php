<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {
	
	function __construct(){
		$this->data['tpl']='login';

	}
	
	function index() {
		if(!$this->ion_auth->logged_in()){
		$this->data['content']=$this->load->view('form_register','',true);
		$this->display();
		}else{
			redirect(site_url('/dashboard/'));
		}
	}

	public function add(){
		$this->load->library('form_validation');

		$ret=array(
				'resp'=>false,
				'message'=>'gagal daftar'
		);

		$this->form_validation->set_rules('email','email','trim');
		$this->form_validation->set_rules('password','password','trim');
		$this->form_validation->set_rules('phone','phone','trim');

		if($this->form_validation->run() === FALSE){
			$ret= array(
				'resp'=>false,
				'message'=> validation_errors());
		}else{
			
		$orgs = array('770');
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$additional_data = array(
								'first_name' => 'umum',
								'last_name' => 'umum',
								);
		$group_ids = array('3'); // Sets user to admin.

		

			if($this->ion_auth->register($username, $password, $email, $additional_data, $group_ids,$orgs)){
				$this->session->set_flashdata('message',$this->ion_auth->messages());


				$user_id=$this->getLastInserted('users','id');
				if(!empty($orgs)){
					foreach($orgs as $org_id){
						$data['user_id'] = $user_id;
						$data['org_id'] = $org_id;
						$this->db->insert('users_orgs',$data);
					}
				}

				$ret=array(
					'resp'=>true,
					'message'=>'Berhasil Menambah Data'
				);

			}else{
				$ret=array(
					'resp'=>true,
					'message'=> $this->ion_auth->errors()
				);
			}

		}
	//	echo $this->db->last_query();
		echo json_encode($ret);	
		redirect('acl/login/');

	}
	function getLastInserted($table, $id) {
		$this->db->select_max($id);
		$Q = $this->db->get($table);
		$row = $Q->row_array();
		return $row[$id];
 	}
 	function get_users_orgs(){
		$user_id=$_POST['id'];

		$this->db->select('*');
		$this->db->from('users_orgs');
		$this->db->where('user_id',$user_id);

		$ls_data = $this->db->get()->result_array();
		
		$ret['data_orgs']=$ls_data;

		echo json_encode($ret);
		
	}
	
}