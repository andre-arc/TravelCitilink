<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kas extends MY_Admin {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('form');
        $this->load->model('KasModel');
	}
    
    
    public function index(){
     $this->data['css']  = css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css','limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css','select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css','bootstrap-datepicker');
		
		$this->data['js']   = js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js','limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');
		$this->data['js']  .= js_asset('bootstrap-datepicker.min.js','bootstrap-datepicker');
		$this->data['js']  .= js_asset('bootstrap-datepicker.id.min.js','bootstrap-datepicker');
		
		$meta = $this->meta('kas/',true);
		$this->data['auth_meta'] = $meta['act'];
		$this->data['icon']      = $meta['icon'];
		$this->data['title']     = $meta['title'];
        
        $this->data['cabang'] = $this->KasModel->select_cabang();
		$this->data['content']   = $this->load->view('kas',$this->data,true);
		$this->display($this->data);
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
		$sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 'data_kas.tgl_transaksi';
		$order  = (isset($_GET['order'])) ? $_GET['order'] : 'desc';

		$SQL_BASE='
			select * from data_kas, orgs
            where data_kas.org_id=orgs.id ';
        
        $org_id= $this->session->userdata('user_org');
        $group_name= $this->session->userdata('user_group_name');
        if($group_name == 'operator cabang'){
            $SQL_BASE .= "and id_org='$org_id' ";
        }
		
		
		if($search<>''){
			//get where
			$SQL_BASE.='and data_kas.tgl_transaksi like "%'.$search.'%" OR ';
			$SQL_BASE.='data_kas.jumlah like "%'.$search.'%" OR ';
            
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
    
    function act_add(){
		$ret=array(
			'success'=>false,
			'msg'=>'Gagal Menambah Data'
		);
        
        $status = true;
        
        $kas = array(
                        'no_faktur' => isset($_POST['no_faktur']) ? $_POST['no_faktur'] : '-',
                         'org_id' => $_POST['id_cabang'],
                        
                        'tgl_transaksi' => date('Y-m-d', strtotime(str_replace('/', '-', $_POST['tgl_transaksi']))),
                        'jumlah' => $_POST['jumlah']
                    );
        
		$status &= $this->db->insert('data_kas', $kas);

		

		if($status){
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
		
		$data['kategori']         = $_POST['kategori'];
		$data['no_plat']          = $_POST['no_plat'];
		$data['tahun_mobil']      = $_POST['tahun_mobil'];
		$data['merk']             = $_POST['merk'];
		$data['kapasitas']        = $_POST['kapasitas'];
		$data['produk']           = $_POST['produk'];
		$data['nm_supir']         = $_POST['nm_supir'];
		$data['keterangan_mobil'] = $_POST['keterangan_mobil'];

		$this->db->update('mobil', $data,array('no_plat'=>$_POST['plat'])); 
		if($this->db->affected_rows()){
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
			'msg'=>'Gagal Mengubah Data'
		);

		$id_kas=$_POST['id'];
		
		$this->db->delete('data_kas', array('id' => $id_kas));
        if($this->db->affected_rows()){
                $ret=array(
                    'success'=>true,
                    'msg'=>'Berhasil Menghapus Data.'
                );
            }
		
		
		echo json_encode($ret);
	}
}