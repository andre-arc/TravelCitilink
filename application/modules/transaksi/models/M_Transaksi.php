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
       }else{
        $query = $this->db->query('select t.*,
        (select nm_kota from bandara as b join kota as k on b.id_kota=k.id where b.kode=t.dari) as kota_asal, 
         (select nm_kota from bandara as b join kota as k on b.id_kota=k.id where b.kode=t.tujuan) as kota_tujuan 
            from transaksi as tr 
            join detail_transaksi as dt on dt.id_transaksi=tr.id_transaksi
            join tiket as t on dt.id_tiket=t.id_tiket
            where tr.id_transaksi="'.$data.'"');
       }

       $result = $query->result();
       return $result;
    }

    public function getDetailPenumpang($id_transaksi){
        $this->db->select('p.*')
                 ->from('penumpang as p')
                 ->join('transaksi as t', 'p.id_transaksi=t.id_transaksi', 'left')
                 ->where('t.id_transaksi', $id_transaksi);
        
        $result = $this->db->get()->result();
        return $result;
    }

    public function getBuyer($id_tiket){
        $this->db->select('count(p.id_penumpang) as jml_penumpang')
                 ->from('penumpang as p')
                 ->join('transaksi as t', 'p.id_transaksi=t.id_transaksi', 'left')
                 ->join('detail_transaksi as dt', 'dt.id_transaksi=t.id_transaksi', 'left')
                 ->where('dt.id_tiket', $id_tiket);
        
        $result = $this->db->get()->row();
        return $result->jml_penumpang;
    }

    // public function getCustomer(){
    //     $this->db->select('c.*')
    //              ->from('customer as c')
    //              ->join
    // }


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