<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembeli extends MY_Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pembeliModel');
	}

	public function index()
	{
		$this->data['css'] =  css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css','limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css','select2');

		$this->data['js']  =  js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js','limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');

		$meta = $this->meta('pembeli/',true);
		$this->data['auth_meta'] = $meta['act'];
		$this->data['icon']      = $meta['icon'];
		$this->data['title']     = $meta['title'];

		$this->data['content']   = $this->load->view('pembeli', $this->data,true);
		$this->display($this->data);
	}

	public function get_json($kategori=null)
	{
		$ret = array(
			'total'=>0,
			'rows'=>array()
		);
		header('Content-Type: application/json');
		
		$limit  = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$search = (isset($_GET['search'])) ? $_GET['search'] : '';
		$sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 'email';
		$order  = (isset($_GET['order'])) ? $_GET['order'] : 'asc';

		$SQL_BASE='
			select *
			from customer
		';
		
		if($search<>''){
			//get where
			$SQL_BASE.='WHERE ';
			$SQL_BASE.='nama_customer like "%'.$search.'%" OR ';
			$SQL_BASE.='hp like "%'.$search.'%" OR ';
			$SQL_BASE.='email like "%'.$search.'%"';
			
			
			$ls_data=$this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
						
			//get where with limit
			$SQL=($sort) ? $SQL_BASE.' ORDER BY '.$sort.' '.$order : $SQL_BASE;
			$SQL.=' LIMIT '.$offset.','.$limit;
			$ls_data_limit=$this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;

		}else{
            if($kategori != null){
                $SQL_BASE.='WHERE kategori="'.$kategori.'"';
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
			from customer
            where id_customer="'.$id.'";
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
		
		
		$data['nm_pelanggan']=$_POST['nm_pelanggan'];
		$data['no_kk']=$_POST['no_kk'];
		$data['nik']=$_POST['nik'];
		$data['hp']=$_POST['hp'];
		$data['kategori']=$_POST['kategori'];
		$data['keterangan']=$_POST['keterangan'];
		$data['alamat_pelanggan']=$_POST['alamat_pelanggan'];

		$config['imagedir']='assets/qrcode/';
		$config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
 
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)

		

		
		$no_kk=$_POST['no_kk'];	
		$params['data']= $no_kk;
		$params['level']='H';
		$params['size']=10;
		$params['savename']= $config['imagedir'].$no_kk.'.png';
		
		$data['qrcode']=$this->ciqrcode->generate($params,$config);
	

		$this->db->insert('tbl_pelanggan', $data);

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
		
		$data['nm_pelanggan']=$_POST['nm_pelanggan'];
		$data['kategori']=$_POST['kategori'];
		$data['no_kk']=$_POST['no_kk'];
		$data['nik']=$_POST['nik'];
		$data['hp']=$_POST['hp'];
		$data['alamat_pelanggan']=$_POST['alamat_pelanggan'];
		$data['keterangan']=$_POST['keterangan'];
		

		$this->db->update('tbl_pelanggan', $data,array('id_pelanggan'=>$_POST['id']));

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

		$id=$_POST['id_pelanggan'];
		//delete records
		$this->db->delete('tbl_pelanggan', array('id_pelanggan' => $id));

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