<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {
	
	function __construct(){
		parent::__construct();
		
    }

    public function getBandara(){
        $this->db->select('b.id, b.kode, k.nm_kota')
                 ->from('bandara as b')
                 ->join('kota as k', 'b.id_kota=k.id', 'TRUE')
                 ->order_by('k.nm_kota', 'asc');
        $result = $this->db->get()->result();

        $data[0] = " Pilih Bandara ";
        foreach($result as $r){
            $data[$r->id] = $r->nm_kota." (".$r->kode.")";
        }

        return $data;
    }

    public function getTicket($data)
    {
        $this->db->select('t.*, r.*')
                 ->from('tiket as t')
                 ->join('rute as r', 't.id_rute=r.id_rute', 'TRUE')
                 ->where('t.tgl_berangkat', $data['tgl_berangkat'])
                 ->where('r.bandara_asal', $data['asal'])
                 ->where('r.bandara_tujuan', $data['tujuan']);
        
        if($data['tgl_kembali'] != null){
            $this->db->or_where('t.tgl_berangkat', $data['tgl_kembali'])
                     ->where('r.bandara_asal', $data['tujuan'])
                     ->where('r.bandara_tujuan', $data['asal']);
        }

        $result = $this->db->get()->result();
        return $result;
    }
}