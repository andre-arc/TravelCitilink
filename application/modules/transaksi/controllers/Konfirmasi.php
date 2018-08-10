<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends MY_Admin {
	
	function __construct() {
		parent::__construct();
		//$this->__init();
		$this->data['tpl']='single';
		$this->data['icon']='fa fa-cogs';
		$this->data['subicon']='fa fa-university';
		$this->data['title']='Konfirmasi Pembayaran';
		$this->data['table_name'] = 'users';
		$this->data['content']='';				
		$this->data['css']=css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'].=css_asset('bootstrap3-wysihtml5.min.css','bootstrap-wysihtml5');
		$this->data['js']=js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js'].=js_asset('bootstrap3-wysihtml5.all.min.js','bootstrap-wysihtml5');
		$this->load->model('KonfirmasiModel');
	}


	function index(){
		// $meta = $this->meta('acl/groups/',true);
		$this->load->library('form_validation');
		$mydata['auth_meta'] = $this->meta('transaksi/konfirmasi/',true);
		//print_r($mydata);die;
		$mydata['tbl_icon']=$this->data['subicon'];
		$mydata['tbl_title']=$this->data['title'];
		$mydata['tbl']='mytabel';

		$mydata['groups'] = $this->db->get('groups')->result();
		
		 $mydata['cabang'] = $this->KonfirmasiModel->get_transaksi();

		// echo $this->db->last_query();	
		$arr_tree = $this->the_org_child_tree($_SESSION['user_org']);

		if(count($arr_tree)){
			$mydata['tree_org']=$arr_tree;
		}else{
			$mydata['tree_org']=array($_SESSION['user_org']);
		}
		
		$this->data['content']=$this->load->view('konfirmasi',$mydata,true);
		$this->display();
	

	}


	function get_json(){
		$ret = array(
			'total'=>0,
			'rows'=>array()
		);
		header('Content-Type: application/json');
		
		$limit=isset($_GET['limit']) ? $_GET['limit'] : 10;
		$offset=isset($_GET['offset']) ? $_GET['offset'] : 0;
		$search=(isset($_GET['search'])) ? $_GET['search'] : '';
		$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'atas_nama,nominal';
		$order = (isset($_GET['order'])) ? $_GET['order'] : 'asc';

		$SQL_BASE="SELECT * from konfirmasi_pembayaran";
		
		if($search<>''){
			//get where
			$SQL_BASE.='WHERE ';
			$SQL_BASE.='lower(a1.email) like "%'.strtolower($search).'%" OR ';
			$SQL_BASE.='lower(a1.username) like "%'.strtolower($search).'%" ';
			$ls_data=$this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
						
			//get where with limit
			$SQL=($sort) ? $SQL_BASE.' ORDER BY '.$sort.' '.$order : $SQL_BASE;
			$SQL.=' LIMIT '.$offset.','.$limit;
			$ls_data_limit=$this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;

		}else{
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
	
	function add(){
		$ret = array(
			'success' => false,
			'msg' 	=>	'Gagal Menambah Data');
	
	
	$data['bank_tujuan'] =$_POST['bank_tujuan'];
	$data['bank_anda']	= $_POST['bank_anda'];
	$data['atas_nama']	= $_POST['atas_nama'];
	$data['metode']		= $_POST['metode'];
	$data['nominal']	= $_POST['nominal'];
	$data['tgl_tranfers']= $_POST['tgl_tranfers'];
	$data['id_transaksi'] = $_POST['id_transaksi'];
	//$data['status']		= $_POST['status'];
	//$data['id_users']	= $_POST['id_users'];

	$this->db->insert('konfirmasi_pembayaran', $data);

	$last_insert_id = $this->db->insert_id();

	if($last_insert_id){
		$ret=array(
			'success'=>true,
			'msg' =>'Berhasil Menambah data');

	}

	echo json_encode($ret);
}

	function getLastInserted($table, $id) {
		$this->db->select_max($id);
		$Q = $this->db->get($table);
		$row = $Q->row_array();
		return $row[$id];
 	}
	
	function edit(){

		$id = $this->input->post('id') ? $this->input->post('id') : $id;
		$this->load->library('form_validation');

		$ret=array(
			'resp'=>false,
			'message'=>'Gagal Mengubah Data'
		);

		$this->form_validation->set_rules('first_name','First name','trim');
  		$this->form_validation->set_rules('last_name','Last name','trim');
 		$this->form_validation->set_rules('company','Company','trim');
  		$this->form_validation->set_rules('phone','Phone','trim');
  		$this->form_validation->set_rules('username','Username','trim|required');
  		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
  		$this->form_validation->set_rules('groups[]','Groups','required|integer');
  		$this->form_validation->set_rules('id','User ID','trim|integer|required');
  		// $this->form_validation->set_rules('orgs[]','Orgs','required|integer');

  		if($this->form_validation->run()===FALSE){
			$ret=array(
				'resp'=>false,
				'message'=> validation_errors()
			);
		}else{
			$id = $this->input->post('id');
    		$data_edit = array(
      			'username' => $this->input->post('username'),
      			'email' => $this->input->post('email'),
      			'first_name' => $this->input->post('first_name'),
      			'last_name' => $this->input->post('last_name'),
      			'company' => $this->input->post('company'),
      			'phone' => $this->input->post('phone')
    		);

    		 if(strlen($this->input->post('password'))>=0) $data_edit['password'] = $this->input->post('password');

    		$this->ion_auth->update($id, $data_edit);

    		//Update the groups user belongs to
    		$groups = $this->input->post('groups');
    		if (isset($groups) && !empty($groups)){
      			$this->ion_auth->remove_from_group('', $id);
      			foreach ($groups as $group){
        			$this->ion_auth->add_to_group($group, $id);
      			}
    		}

    		//Update the orgs user belongs to
    		$orgs = $this->input->post('orgs');
    		if (isset($orgs) && !empty($orgs)){
      			$this->db->delete('users_orgs', array('user_id' => $id));
      			foreach ($orgs as $org_id){

      				$data['user_id']=$id;
					$data['org_id']=$org_id;

        			$this->db->insert('users_orgs', $data); 
      			}
    		}

    		$this->session->set_flashdata('message',$this->ion_auth->messages());
    		$ret=array(
				'resp'=>true,
				'message'=>'Berhasil Mengubah Data'
			);

		}

		echo json_encode($ret);
	
	}
	
	function del(){
		$id=$_POST['id'];
		//delete records
		$this->db->delete('users', array('id' => $id));
		$ret=array(
			'resp'=>true,
			'message'=>'Berhasil Menghapus Data.'
		);
		
		echo json_encode($ret);
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

	function get_users_groups(){
		$user_id=$_POST['id'];

		$this->db->select('*');
		$this->db->from('users_groups');
		$this->db->where('user_id',$user_id);

		$ls_data = $this->db->get()->result_array();
		
		$ret['rows']=$ls_data;

		echo json_encode($ret);
	}
		
}