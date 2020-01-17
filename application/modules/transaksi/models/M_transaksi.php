<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

  public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
    
    public function getDetailTiket($id_ticket)
    {
        if(is_array($id_ticket)){
            $query = $this->db->query('select t.*, k.nama as nama_kapal, k.logo as logo_kapal,
            (select nm_kota from pelabuhan as b join kota as k on b.id_kota=k.id where b.kode=t.dari) as kota_asal, 
             (select nm_kota from pelabuhan as b join kota as k on b.id_kota=k.id where b.kode=t.tujuan) as kota_tujuan, 
             (select hrg_tiket from detail_tiket as dtiket join jenis_penumpang as jp on dtiket.jenis_penumpang=jp.id where dtiket.id_tiket=t.id_tiket and jp.nama="Dewasa") as hrg_dewasa,
             (select hrg_tiket from detail_tiket as dtiket join jenis_penumpang as jp on dtiket.jenis_penumpang=jp.id where dtiket.id_tiket=t.id_tiket and jp.nama="Anak") as hrg_anak,
             (select hrg_tiket from detail_tiket as dtiket join jenis_penumpang as jp on dtiket.jenis_penumpang=jp.id where dtiket.id_tiket=t.id_tiket and jp.nama="Bayi") as hrg_bayi
                from tiket as t 
                join kapal as k on t.id_kapal=k.id
                where t.id_tiket in ('.implode(',', $id_ticket).')');
    
           $result = $query->result();
           return $result;
        }
       
       
    }

    public function getDetailPenumpang($id_transaksi){
        $this->db->select('p.*')
                 ->from('penumpang as p')
                 ->join('transaksi as t', 'p.id_transaksi=t.id_transaksi', 'left')
                 ->where('t.id_transaksi', $id_transaksi);
        
        $result = $this->db->get()->result();
        return $result;
    }

    public function getJenisPenumpang(){
        return $this->db->get('jenis_penumpang')->result();
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

    public function getCustomer($id_transaksi){
        $this->db->select('c.*')
                 ->from('transaksi as t')
                 ->join('customer as c', 't.id_customer=c.id_customer', 'left')
                 ->where('t.id_transaksi', $id_transaksi);
        
         return $this->db->get()->row();
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