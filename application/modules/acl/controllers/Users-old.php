<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		$this->data['tpl']='single';
	}
	
	function index() {
		$this->data['css']=css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['js']=js_asset('bootstrap-table.min.js','bootstrap-table');
		
		$meta = $this->meta('acl/users/',true);
		$this->data['auth_meta']=$meta['act'];
		$this->data['icon']=$meta['icon'];
		$this->data['title']=$meta['title'];

		$this->data['ls_org']=$this->db->select('id,name')->from('orgs')->order_by('name')->get()->result_array();
		$obj_groups=$this->ion_auth->groups()->result();
		$this->data['ls_groups']=	$array = json_decode(json_encode($obj_groups), true); 
		
		$this->data['content']=$this->load->view('grid_users',$this->data,true);
		$this->display($this->data);
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
		$sort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
		$order = (isset($_GET['order'])) ? $_GET['order'] : '';

		$SQL_BASE='
			select 
			u.id,
			username,
			first_name,
			last_name,
			phone,
			email,
			g.name as grp_name,
			ug.group_id as grp_id,
			o.name as org_name,
			uo.org_id as org_id
			from
			((((users u left join users_groups ug on ug.user_id=u.id)
			left join groups g on g.id=ug.group_id)
			left join users_orgs uo on uo.user_id=u.id) 
			left join orgs o on o.id=uo.org_id)
		';
		
		if($search<>''){
			//get where
			$SQL_BASE.='WHERE ';
			$SQL_BASE.='first_name like "%'.$search.'%" OR ';
			$SQL_BASE.='last_name like "%'.$search.'%" OR ';
			$SQL_BASE.='phone like "%'.$search.'%" OR ';
			$SQL_BASE.='email like "%'.$search.'%" OR ';
			$SQL_BASE.='grp_name like "%'.$search.'%" OR ';
			$SQL_BASE.='org_name like "%'.$search.'%" ';
			$ls_data=$this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
						
			//get where with limit
			$SQL=$SQL_BASE.' LIMIT '.$offset.','.$limit;
			$ls_data_limit=$this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;

		}else{
			//get all
			$ls_data=$this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
			//get limit
			$SQL=$SQL_BASE.' LIMIT '.$offset.','.$limit;
			$ls_data_limit=$this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;
		}

		echo json_encode($ret);		
	}
	
	function act_add(){
		$resp=array(
			'success'=>false,
			'msg'=>'GAGAL'
		);		
		
		//add user
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$email = strip_tags($_POST['email']);
		$additional_data = array(
			'first_name' => strip_tags($_POST['first_name']),
			'last_name' => strip_tags($_POST['last_name']),
			'phone' => strip_tags($_POST['phone'])
		);
		$group_id=array(strip_tags($_POST['groups']));
		$new_user_id = $this->ion_auth->register($username, $password, $email, $additional_data,$group_id);
		if($new_user_id){
			$resp=array(
			'success'=>true,
			'msg'=>'Penambahan User berhasil'
			);
			//tambahkan wilayah :
			$data = array(
					'user_id' => $new_user_id,
					'org_id' => strip_tags($_POST['org_id'])
			);
			$this->db->insert('users_orgs',$data);
			
			$insert_id = $this->db->insert_id();
			if($insert_id){
				$resp=array(
				'success'=>true,
				'msg'=>'Penambahan User, User Group & Wilayah Berhasil.'
				);								
			}else{
				$resp=array(
				'success'=>false,
				'msg'=>'Penambahan Wilayah Gagal.'
				);				
			}
		}else{
			$resp=array(
			'success'=>false,
			'msg'=>'Penambahan User Gagal.'
			);		
		}
		echo json_encode($resp);
	}
	
	function act_edit(){
		$resp=array(
			'success'=>false,
			'msg'=>'GAGAL'
		);		
		//update user
		$id=$_POST['id'];
		$data=array(
			'username'=>$_POST['username'],
			'email'=>$_POST['email'],
			'phone'=>$_POST['phone'],
			'first_name'=>$_POST['first_name'],
			'last_name'=>$_POST['last_name'],
		);
		if(isset($_POST['profile_rst_pass'])) $data['password']=$_POST['password'];
		
		$upd_usr=$this->ion_auth->update($id, $data);
		if($upd_usr){
			$resp=array(
				'success'=>true,
				'msg'=>'Berhasil Update User.'
			);
			
			//update group
			
			$this->db->update('users_groups', array('group_id'=>$_POST['groups']), array('user_id' => $id));
			$this->db->update('users_orgs', array('org_id'=>$_POST['org_id']), array('user_id' => $id));
			$resp=array(
						'success'=>true,
						'msg'=>'Berhasil Update User, Group User dan Wilayah User.'
					);
		}else{
			$resp=array(
				'success'=>false,
				'msg'=>'Gagal Update User.'
			);		
		}
		
		echo json_encode($resp);
	}
	
	
	function act_del(){
		$resp=array(
			'success'=>false,
			'msg'=>'GAGAL'
		);
		
		$user_id = $_POST['id'];
		//hapus wilayah
		 $this->db->delete('users_kec', array('user_id' => $user_id)); 
		$num_del = $this->db->affected_rows();
		if($num_del){
			$resp=array(
				'success'=>true,
				'msg'=>'Berhasil menghapus wilayah user.'
			);			
			//hapus user group
			$rem_group_user = $this->ion_auth->remove_from_group(NULL, $user_id);
			if($rem_group_user){
				$resp=array(
					'success'=>true,
					'msg'=>'Berhasil menghapus wilayah user, group user.'
				);			
				//hapus user
				$del_user = $this->ion_auth->delete_user($user_id);
				if($del_user){
					$resp=array(
						'success'=>true,
						'msg'=>'Berhasil menghapus wilayah user, group_user dan data user.'
					);				
				}else{
					$resp=array(
						'success'=>false,
						'msg'=>'Gagal menghapus user.'
					);				
				}
			}else{
				$resp=array(
					'success'=>false,
					'msg'=>'Gagal menghapus group user.'
				);			
			}
		}else{
			$resp=array(
				'success'=>false,
				'msg'=>'Gagal menghapus wilayah user.'
			);
		
		}

		
		echo json_encode($resp);		
	}
	
	
}