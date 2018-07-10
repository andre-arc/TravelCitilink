<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		$this->data['tpl']='single';
	}


	function index() {
		$this->data['css']=css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'].=css_asset('bootstrap-iconpicker.min.css','bootstrap-iconpicker');
		$this->data['css'].=css_asset('select2.min.css','select2');
		$this->data['js']=js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js'].=js_asset('iconset/iconset-fontawesome-4.3.0.min.js','bootstrap-iconpicker');
		$this->data['js'].=js_asset('bootstrap-iconpicker.min.js','bootstrap-iconpicker');
		$this->data['js'].=js_asset('select2.full.min.js','select2');
		
		$meta = $this->meta('acl/menus/',true);
		$this->data['auth_meta']=$meta['act'];
		$this->data['icon']=$meta['icon'];
		$this->data['title']=$meta['title'];
		//$data['ls_menus']=	$this->db->get_where('menus',array('parent_id'=>0))->result_array(); 		
		//menus all.
		$this->db->order_by('list_order','asc');
		$this->data['ls_menu']=$this->db->get('menus')->result_array();
		$this->data['content']=$this->load->view('grid_menus',$this->data,true);
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
		$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'list_order';
		$order = (isset($_GET['order'])) ? $_GET['order'] : 'asc';

		$SQL_BASE='
			select *,
			IFNULL((select name from menus mp where mp.id=menus.parent_id),"PARENT") as parent_name
			from menus
		';
		
		if($search<>''){
			//get where
			$SQL_BASE.='WHERE ';
			$SQL_BASE.='name like "%'.$search.'%" OR ';
			$SQL_BASE.='path like "%'.$search.'%" ';
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
        //echo $this->db->last
		echo json_encode($ret);		
	}
	
	function act_add(){
		$ret=array(
			'success'=>false,
			'msg'=>'Gagal Menambah Data'
		);
		
		$data['parent_id']=$_POST['parent_id'];
		$data['name']=$_POST['name'];
		$data['path']=$_POST['path'];
		$data['list_order']=$_POST['list_order'];
		$data['icon']=$_POST['icon'];
		$data['remark']=$_POST['remark'];
		$data['flag']=$_POST['flag'];
		$this->db->insert('menus', $data); 
		$last_insert_id=$this->db->insert_id();
		if($last_insert_id){
			$ret=array(
				'success'=>true,
				'msg'=>'Berhasil Menambah Data'
			);		
		}
		echo json_encode($ret);	
	}
	
	function act_edit(){
		$ret=array(
			'success'=>false,
			'msg'=>'Gagal Mengubah Data'
		);
		
		$data['parent_id']=$_POST['parent_id'];
		$data['name']=$_POST['name'];
		$data['path']=$_POST['path'];
		$data['list_order']=$_POST['list_order'];
		$data['icon']=$_POST['icon'];
		$data['remark']=$_POST['remark'];
		$data['flag']=$_POST['flag'];
		$this->db->update('menus', $data,array('id'=>$_POST['id'])); 
		$ret=array(
				'success'=>true,
				'msg'=>'Berhasil Mengubah Data'
			);
		echo json_encode($ret);		
	}
	
	function act_del(){
		$id=$_POST['id'];
		//delete records
		$this->db->delete('menus', array('id' => $id));
		$ret=array(
			'success'=>true,
			'msg'=>'Berhasil Menghapus Data.'
		);
		
		echo json_encode($ret);
	}
		
}