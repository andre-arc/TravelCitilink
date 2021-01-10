<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Transaksi extends RestController {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('transaksi/M_transaksi', 'transaksi');
    }

    public function index_get()
    {
        // Users from a data store e.g. database
        $this->db->order_by('tgl_transaksi', 'desc');
        $transaksi = $this->db->get('transaksi')->result();

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $transaksi )
            {
                // Set the response and exit
                $this->response( [
                    'status' => true,
                    'data' => $transaksi
                ], 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $transaksi ) )
            {
                $this->response( [
                    'status' => true,
                    'data' => $transaksi[$id]
                ], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404 );
            }
        }
    }

    public function index_put($id){
        $data = $this->put();
        
        $transaksi = $this->db->where('id_transaksi', $id)->get('transaksi')->row();
        if(!empty($transaksi)){

            $this->db->where('id_transaksi', $id);
            $update = $this->db->update('transaksi', $data);
            if ($update) {
                $this->response([
                    'status' => true,
                    'message' => 'Transaksi berhasil di edit'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'error edit transaksi'
                ], 400);
            }

        }else{
            // Set the response and exit
            $this->response( [
                'status' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404 );
        }
    }

    public function detail_get($id)
    {
        $id_transaksi = $id;
        
        $select_tiket = $this->db->where('id_transaksi', $id_transaksi)->get('detail_transaksi')->result();
        foreach($select_tiket as $row){
            $transaksi_tiket[] = $row->id_tiket;
        }
        // var_dump($transaksi_tiket);
        $detail_transaksi = $this->db->where('id_transaksi', $id)->get('transaksi')->row();
        $detail_tiket = $this->transaksi->getDetailTiket($transaksi_tiket);
        $pemesan = $this->transaksi->getCustomer($id_transaksi);
        $data_penumpang = $this->transaksi->getDetailPenumpang($id_transaksi);

        $jenis_penumpang = $this->transaksi->getJenisPenumpang();
        $detail_harga = array();
        $total_harga = 0;

        foreach ($jenis_penumpang as $j) {
            $count = 0;
            foreach ($data_penumpang as $dp) {
                if($dp->jenis_penumpang == $j->nama)
                    $count++;
            }

            if($count > 0){
                $total = 0;
                foreach ($detail_tiket as $t){
                    
                    $select_harga = $this->db->select('dt.hrg_tiket')
                                            ->join('jenis_penumpang as jp', 'jp.id=dt.jenis_penumpang')
                                            ->where('dt.id_tiket', $t->id_tiket)
                                            ->where('jp.nama', $j->nama)
                                            ->get('detail_tiket as dt')->row();
                    $total += $select_harga->hrg_tiket;
                }

                $detail_harga[] = (object) array(
                        'jenis_penumpang' => $j->nama,
                        'jml_penumpang' => $count,
                        'total_hrg' => $total
                );
                $total_harga += $total * $count;
            }
        }
        

        $data = [
            'detail_transaksi' => $detail_transaksi,
            'detail_customer' => $pemesan,
            'detail_tiket' => $detail_tiket,
            'data_penumpang' => $data_penumpang,
            'detail_harga' =>  $detail_harga,
            'total_harga' => $total_harga,
        ];

        if ( !empty($data) )
        {
            // Check if the users data store contains users
            if ( $data )
            {
                // Set the response and exit
                $this->response( [
                    'status' => true,
                    'data' => $data
                ], 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404 );
            }
        }
        else
        {
            $this->response( [
                'status' => false,
                'message' => 'id transaksi harus ada'
            ], 400 );
        }
    }
}