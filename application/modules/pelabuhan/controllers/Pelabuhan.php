<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelabuhan extends MY_Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelabuhanModel');
	}

	public function index()
	{
		$this->data['css'] =  css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css','limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css','select2');

		$this->data['js']  =  js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js','limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');

		$meta = $this->meta('pelabuhan/',true);
		$this->data['auth_meta'] = $meta['act'];
		$this->data['icon']      = $meta['icon'];
		$this->data['title']     = $meta['title'];

		//chain select country
		$this->data['negara'] =$this->pelabuhanModel->get_negara();

		$this->data['content']   = $this->load->view('pelabuhan', $this->data,true);
		$this->display($this->data);
	}

	function get_provinsi(){
		$id= $this->input->post('id');
		$data= $this->pelabuhanModel->get_provinsi($id);
		echo json_encode($data);
	}

	function get_kota(){
		$id=$this->input->post('id');
		$data=$this->pelabuhanModel->get_kota($id);
		echo json_encode($data);
	}

	public function get_json($jenis=null)
	{
		$ret = array(
			'total'=>0,
			'rows'=>array()
		);
		header('Content-Type: application/json');
		
		$limit  = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$search = (isset($_GET['search'])) ? $_GET['search'] : '';
		$sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 'kode';
		$order  = (isset($_GET['order'])) ? $_GET['order'] : 'asc';

		$SQL_BASE='
			select * from pelabuhan,negara,provinsi,kota WHERE pelabuhan.id_negara=negara.id AND pelabuhan.id_provinsi=provinsi.id AND pelabuhan.id_kota=kota.id
		';
		
		if($search<>''){
			//get where
			$SQL_BASE.='WHERE ';
			$SQL_BASE.='kode like "%'.$search.'%" OR ';
			$SQL_BASE.='nm_pelabuhan like "%'.$search.'%" OR ';
			$SQL_BASE.='keterangan like "%'.$search.'%" OR ';
			$SQL_BASE.='jenis like "%'.$search.'%" OR ';
			
			$ls_data=$this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
						
			//get where with limit
			$SQL=($sort) ? $SQL_BASE.' ORDER BY '.$sort.' '.$order : $SQL_BASE;
			$SQL.=' LIMIT '.$offset.','.$limit;
			$ls_data_limit=$this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;

		}else{
            if($jenis != null){
                $SQL_BASE.='WHERE jenis="'.$jenis.'"';
            }
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
    
    public function getpembeli($id){
       $ret = array();
		header('Content-Type: application/json');
        
        $SQL_BASE='
			select *
			from tbl_pelanggan
            where id_pelanggan="'.$id.'";
		';
        
        $ls_data=$this->db->query($SQL_BASE)->result_object();
        $ret = $ls_data;
        
        echo json_encode($ret);
    }

	function act_add(){
		$ret=array(
			'success'=>false,
			'msg'=>'Gagal Menambah Data'
		);
		
		
		$data['nm_pelabuhan']=$_POST['nm_pelabuhan'];
		$data['kode']=$_POST['kode'];
		$data['keterangan']=$_POST['keterangan'];
		$data['id_negara']=$_POST['id_negara'];
		$data['id_provinsi']=$_POST['id_provinsi'];
		$data['id_kota']=$_POST['id_kota'];

		$this->db->insert('pelabuhan', $data);

		$last_insert_id = $this->db->insert_id();

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
		
		$data['nm_pelabuhan']=$_POST['nm_pelabuhan'];
		$data['kode']=$_POST['kode'];
		$data['keterangan']=$_POST['keterangan'];
		$data['id_negara']=$_POST['id_negara'];
		$data['id_provinsi']=$_POST['id_provinsi'];
		$data['id_kota']=$_POST['id_kota'];
		

		$this->db->update('pelabuhan', $data,array('id'=>$_POST['id']));

		if ($this->db->affected_rows()) {
			$ret=array(
				'success'=>true,
				'msg'=>'Berhasil Mengubah Data'
			);
		}
		echo json_encode($ret);		
	}
	
	function act_del(){
		$ret=array(
			'success'=>false,
			'msg'=>'Gagal Menghapus Data'
		);

		$id=$_POST['id'];
		//delete records
		$this->db->delete('pelabuhan', array('id' => $id));

		if ($this->db->affected_rows()) {
			$ret=array(
				'success'=>true,
				'msg'=>'Berhasil Menghapus Data.'
			);
		}
		
		echo json_encode($ret);
	}

	public function cek_nama($nama)
	{
		$nama = str_replace('%20', ' ', $nama);
		$where = array('nm_barang' => $nama);
		$this->db->get_where('barang', $where);
		if ($this->db->affected_rows()) {
			echo "Nama sudah digunakan";
		}
		else{
			echo "";
		}
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */