<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getPelabuhan()
    {
        $this->db->select('b.id, b.kode, k.nm_kota')
            ->from('pelabuhan as b')
            ->join('kota as k', 'b.id_kota=k.id', 'TRUE')
            ->order_by('k.nm_kota', 'asc');
        $result = $this->db->get()->result();

        $data[0] = " Pilih Pelabuhan ";
        foreach ($result as $r) {
            $data[$r->kode] = $r->nm_kota . " (" . $r->kode . ")";
        }

        return $data;
    }

    public function getTicket($data)
    {
        $this->db->select('t.*, k.nama as nama_kapal, k.logo as logo_kapal, dtiket.hrg_tiket as hrg_dewasa, jt.deskripsi as jenis_tiket')
            ->from('tiket as t')
            ->join('kapal as k', 't.id_kapal=k.id')
            ->join('detail_tiket as dtiket', 't.id_tiket=dtiket.id_tiket')
            ->join('jenis_penumpang as jp', 'dtiket.jenis_penumpang=jp.id')
            ->join('jenis_tiket as jt', 't.id_jenis=jt.id')
            ->group_start()
            ->where('t.tgl_berangkat', $data['tgl_berangkat'])
            ->where('t.dari', $data['asal'])
            ->where('t.tujuan', $data['tujuan'])
            ->group_end()
            ->where('jp.nama', 'Dewasa');

        $result = $this->db->get()->result();
        return $result;
    }
}
