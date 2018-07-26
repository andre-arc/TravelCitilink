<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

  public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
    
    public function getDetailTiket($data)
    {
       

       if(is_array($data)){
        $query = $this->db->query('select t.*,
                             (select nm_kota from bandara as b join kota as k on b.id_kota=k.id where b.kode=t.dari) as kota_asal, 
                              (select nm_kota from bandara as b join kota as k on b.id_kota=k.id where b.kode=t.tujuan) as kota_tujuan 
                          from tiket as t where t.id_tiket in ("'.implode(',', $data).'")');
       }

       $result = $query->result();
       return $result;
    }


    public function getCountry(){
        $this->db->select('id, name')
                 ->from('negara')
                 ->order_by('name', 'asc');

        $res = $this->db->get()->result();

        $data[0] = "Pilih Kewarganegaraan";
        foreach($res as $r){
          $data[$r->id] = $r->name;
        }

        return $data;
    }
}