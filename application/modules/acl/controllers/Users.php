<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Admin {
	
	function __construct() {
		parent::__construct();
		//$this->__init();
		$this->data['tpl']='single';
		$this->data['icon']='fa fa-cogs';
		$this->data['subicon']='fa fa-university';
		$this->data['title']='Users';
		$this->data['table_name'] = 'users';
		$this->data['content']='';				
		$this->data['css']=css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'].=css_asset('bootstrap3-wysihtml5.min.css','bootstrap-wysihtml5');
		$this->data['js']=js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js'].=js_asset('bootstrap3-wysihtml5.all.min.js','bootstrap-wysihtml5');
	}


	function index(){
		// $meta = $this->meta('acl/groups/',true);
		$this->load->library('form_validation');
		$mydata['auth_meta'] = $this->meta('acl/users/',true);
		//print_r($mydata);die;
		$mydata['tbl_icon']=$this->data['subicon'];
		$mydata['tbl_title']=$this->data['title'];
		$mydata['tbl']='mytabel';

		$mydata['groups'] = $this->db->get('groups')->result();
		$mydata['orgs'] = $this->db->get('orgs')->result();

		$arr_tree = $this->the_org_child_tree($_SESSION['user_org']);

		if(count($arr_tree)){
			$mydata['tree_org']=$arr_tree;
		}else{
			$mydata['tree_org']=array($_SESSION['user_org']);
		}
		
		$this->data['content']=$this->load->view('grid_users',$mydata,true);
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
		$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'email,username';
		$order = (isset($_GET['order'])) ? $_GET['order'] : 'asc';

		$SQL_BASE="SELECT * FROM (
		SELECT 
			a2.*,  
			GROUP_CONCAT(orgs.name SEPARATOR ', ') AS orgs, 
			GROUP_CONCAT(orgs.id SEPARATOR ', ') as orgs_id 
		FROM (
			SELECT 
			users.id,
			users.username,
			users.email, 
			users.first_name,
			users.last_name,  
			GROUP_CONCAT(groups.name SEPARATOR ', ') AS groups,
			GROUP_CONCAT(groups.id SEPARATOR ', ') as groups_id 
			FROM users
			LEFT JOIN users_groups ON users_groups.user_id = users.id
			LEFT JOIN groups ON users_groups.group_id = groups.id
			GROUP BY users.id) AS a2
			LEFT JOIN users_orgs ON users_orgs.user_id = a2.id
			LEFT JOIN orgs ON orgs.id = users_orgs.org_id
			GROUP BY a2.id) AS a1 ";
		
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

		$this->load->library('form_validation');

		$ret=array(
			'resp'=>false,
			'message'=>'Gagal Menambah Data'
		);

		$this->form_validation->set_rules('first_name','First name','trim');
  		$this->form_validation->set_rules('last_name','Last name','trim');
  		$this->form_validation->set_rules('company','Company','trim');
  		$this->form_validation->set_rules('phone','Phone','trim');
  		$this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]');
  		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
  		$this->form_validation->set_rules('password','Password','required');
  		$this->form_validation->set_rules('groups[]','Groups','required|integer');
  		$this->form_validation->set_rules('orgs[]','Orgs','required|integer');
		
		if($this->form_validation->run()===FALSE){
			$ret=array(
				'resp'=>false,
				'message'=> validation_errors()
			);
		}else{
			$username=$_POST['username'];
			$password=$_POST['password'];
			$email   =$_POST['email'];
			$group_ids = $this->input->post('groups');
			$orgs = $this->input->post('orgs');

			$additional_data = array(
      			'first_name' => $this->input->post('first_name'),
      			'last_name' => $this->input->post('last_name'),
      			'company' => $this->input->post('company'),
     			'phone' => $this->input->post('phone')
    		);


			if ($this->ion_auth->register($username, $password, $email, $additional_data,$group_ids)) {
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				
				$user_id=$this->getLastInserted('users','id');
				if (!empty($orgs)){
					foreach ($orgs as $org_id){
						$data['user_id']=$user_id;
						$data['org_id']=$org_id;

						$this->db->insert('users_orgs', $data); 
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