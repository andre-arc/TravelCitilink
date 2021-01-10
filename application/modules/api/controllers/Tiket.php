<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Tiket extends RestController {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {
        // Users from a data store e.g. database
        $tiket = $this->db->query('select * from tiket ')->result();

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $tiket )
            {
                // Set the response and exit
                $this->response( $tiket, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $tiket ) )
            {
                $this->response( $tiket[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }

    public function index_post(){
        $tgl_awal = $this->post('tgl_awal');
        $tgl_akhir = $this->post('tgl_akhir');
        $jam_berangkat = $this->post('jam_berangkat');

        // cek id jenis
        $id_jenis = $this->post('id_jenis');
        $jenis_tiket = $this->db->where('id', $id_jenis)->get('jenis_tiket')->row();
        if(empty($jenis_tiket)){
            $this->response( [
                'status' => false,
                'message' => 'jenis tiket tidak ditemukan'
            ], 404 );
            exit();
        }

        // cek id kapal
        $id_kapal = $this->post('id_kapal');
        $kapal = $this->db->where('id', $id_kapal)->get('kapal')->row();
        if(empty($kapal)){
            $this->response( [
                'status' => false,
                'message' => 'kapal tidak ditemukan'
            ], 404 );
            exit();
        }

        //cek harga per jenis penumpang
        $jenis_penumpang = $this->db->get('jenis_penumpang')->result();
        $daftarHarga = [];

        foreach($jenis_penumpang as $r){
            $daftarHarga[$r->id] = $this->post(strtolower('hrg_'.$r->nama)) ? $this->post(strtolower('hrg_'.$r->nama)) : 0 ;
        }

        $asal = $this->db->where('id', $this->post('asal'))->get('pelabuhan')->row();
        $tujuan = $this->db->where('id', $this->post('tujuan'))->get('pelabuhan')->row();

        //cek asal keberangkatan
        if(empty($asal)){
            $this->response( [
                'status' => false,
                'message' => 'asal keberangkatan tidak ditemukan'
            ], 404 );
            exit();
        }

        //cek asal keberangkatan
        if(empty($tujuan)){
            $this->response( [
                'status' => false,
                'message' => 'tujuan keberangkatan tidak ditemukan'
            ], 404 );
            exit();
        }

        $dates = $this->__getDatesFromRange($tgl_awal, $tgl_akhir);
        $status = true;
        foreach($dates as $date){
            foreach($jam_berangkat as $jam){
                $data = [
                    'tgl_berangkat' => $date->format('Y-m-d'),
                    'jam_berangkat' => $jam,
                    'asal' => $asal->kode,
                    'tujuan' => $tujuan->kode,
                    'id_kapal' => $kapal->id,
                    'id_jenis' => $jenis_tiket->id,
                    'daftar_harga' => $daftarHarga
                ];
                $status &= $this->__generateTickets($data);
            }
        }

        if($status){
            $this->response( [
                'status' => true,
                'message' => 'tiket berhasil di generate'
            ], 200 );
            exit();
        }
    }

    public function index_put($id){
        $data = [];

        //cek harga per jenis penumpang
        $jenis_penumpang = $this->db->get('jenis_penumpang')->result();
        $daftarHarga = [];

        foreach($jenis_penumpang as $r){
            $daftarHarga[$r->id] = $this->post(strtolower('hrg_'.$r->nama)) ? $this->post(strtolower('hrg_'.$r->nama)) : 0 ;
        }

        if($this->put('tgl_berangkat')){
            $data['tgl_berangkat'] = $this->put('tgl_berangkat');
        }

        if($this->put('jam_berangkat')){
            $data['waktu'] = $this->put('jam_berangkat');
        }

        // cek id jenis
        if($this->put('id_jenis')){
            $id_jenis = $this->put('id_jenis');
            $jenis_tiket = $this->db->where('id', $id_jenis)->get('jenis_tiket')->row();
            if(empty($jenis_tiket)){
                $this->response( [
                    'status' => false,
                    'message' => 'jenis tiket tidak ditemukan'
                ], 404 );
                exit();
            }

            $data['id_jenis'] = $jenis_tiket->id;
        }

        // cek id kapal
        if($this->put('id_kapal')){
            
            $id_kapal = $this->post('id_kapal');
            $kapal = $this->db->where('id', $id_kapal)->get('kapal')->row();
            if(empty($kapal)){
                $this->response( [
                    'status' => false,
                    'message' => 'kapal tidak ditemukan'
                ], 404 );
                exit();
            }

            $data['id_jenis'] = $jenis_tiket->id;
        }

        //cek asal keberangkatan       
        if($this->put('asal')){
            $asal = $this->db->where('id', $this->post('asal'))->get('pelabuhan')->row();
            
            if(empty($asal)){
                $this->response( [
                    'status' => false,
                    'message' => 'asal keberangkatan tidak ditemukan'
                ], 404 );
                exit();
            }
            $data['asal'] = $asal->kode;
        }

        //cek tujuan keberangkatan        
        if($this->put('tujuan')){
            $tujuan = $this->db->where('id', $this->put('tujuan'))->get('pelabuhan')->row();

            if(empty($tujuan)){
                $this->response( [
                    'status' => false,
                    'message' => 'tujuan keberangkatan tidak ditemukan'
                ], 404 );
                exit();
            }
            $data['tujuan'] = $tujuan->kode;
        }

        $this->db->where('id', $id);
        $status = $this->db->update('tiket', $data);

        if($status){
            $this->response( [
                'status' => true,
                'message' => 'tiket berhasil di generate'
            ], 200 );
            exit();
        }
    }

    private function __generateKode(){
        $kode = getToken(4, 'TIX');

        $tiket = $this->db->where('kode', $kode)->get('tiket')->result();

        if(count($tiket) > 0){
            $this->__generateKode();
        }

        return $kode;
    }

    private function __generateTickets($data){
        if(is_array($data)){
            
            $this->db->insert('tiket', [
                'kode' => $this->__generateKode(),
                'tgl_berangkat' => $data['tgl_berangkat'],
                'waktu' => $data['jam_berangkat'],
                'dari' => $data['asal'],
                'tujuan' => $data['tujuan'],
                'id_kapal' => $data['id_kapal'],
                'id_jenis' => $data['id_jenis']
            ]);

            $id_tiket = $this->db->insert_id();
            
            foreach($data['daftar_harga'] as $key => $value){
                $this->db->insert('detail_tiket', [
                    'id_tiket' => $id_tiket,
                    'jenis_penumpang' => $key,
                    'hrg_tiket' => $value
                ]);
            }

            return true;

        }else{
            return false;
        }
    }

    private function __getDatesFromRange($start, $end){
        $start = new DateTime( $start );
        $end = new DateTime( $end );
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');

        return new DatePeriod($start, $interval, $end);
    }
}