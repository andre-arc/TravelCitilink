<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lookbook extends MY_Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('lookbookModel');
	}

	public function index()
	{
		$this->data['css'] =  css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css','limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css','select2');

		$this->data['js']  =  js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js','limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');

		$meta = $this->meta('lookbook/',true);
		$this->data['auth_meta'] = $meta['act'];
		$this->data['icon']      = $meta['icon'];
		$this->data['title']     = $meta['title'];

		$this->data['content']   = $this->load->view('lookbook', $this->data,true);
		$this->display($this->data);
	}

	public function get_json($id_lookbook=null)
	{
		$ret = array(
			'total'=>0,
			'rows'=>array()
		);
		header('Content-Type: application/json');
		
		$limit  = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$search = (isset($_GET['search'])) ? $_GET['search'] : '';
		$sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 'id_lookbook';
		$order  = (isset($_GET['order'])) ? $_GET['order'] : 'asc';

		$SQL_BASE='
			select *
			from tbl_lookbook,tbl_pelanggan,orgs
		';
		
		if($search<>''){
			//get where
			$SQL_BASE.='WHERE ';
			$SQL_BASE.='jml_tabung like "%'.$search.'%" OR ';
			
			
			$ls_data=$this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
						
			//get where with limit
			$SQL=($sort) ? $SQL_BASE.' ORDER BY '.$sort.' '.$order : $SQL_BASE;
			$SQL.=' LIMIT '.$offset.','.$limit;
			$ls_data_limit=$this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;

		}else{

            if($id_lookbook != null){
                $SQL_BASE.='WHERE id_lookbook="'.$id_lookbook.'"';
            }
			//get all
			$SQL_BASE.='WHERE tbl_lookbook.id_pangkalan=orgs.id AND tbl_lookbook.id_pembeli=tbl_pelanggan.id_pelanggan';
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
    
    public function getPembeli($id){
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
		
		$data['nm_barang']=$_POST['nm_barang'];
		$data['jenis_unit']=$_POST['jenis_unit'];
		$data['merk']=$_POST['merk'];
		$data['stok']=$_POST['stok'];
		$data['ket_barang']=$_POST['ket_barang'];
		$data['satuan_barang']=$_POST['satuan_barang'];

		$this->db->insert('barang', $data);

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
		
		$data['nm_barang']=$_POST['nm_barang'];
		$data['jenis_unit']=$_POST['jenis_unit'];
		$data['merk']=$_POST['merk'];
		$data['stok']=$_POST['stok'];
		$data['ket_barang']=$_POST['ket_barang'];
		$data['satuan_barang']=$_POST['satuan_barang'];

		$this->db->update('barang', $data,array('id_barang'=>$_POST['id']));

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

		$id=$_POST['id_pembeli'];
		//delete records
		$this->db->delete('tbl_pembeli', array('id_pembeli' => $id));

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