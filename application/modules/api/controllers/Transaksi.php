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
        $tiket = $this->db->get('transaksi')->result();

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $tiket )
            {
                // Set the response and exit
                $this->response( [
                    'status' => true,
                    'data' => $tiket
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
            if ( array_key_exists( $id, $tiket ) )
            {
                $this->response( [
                    'status' => true,
                    'data' => $tiket[$id]
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
    public function detail_get()
    {
        $id_transaksi = $this->get('id');
        
        $data = [];
        $data['detail_tiket'] = $this->transaksi->getDetailTiket($tiket);
        // $data['detail_tiket'] = $this->transaksi->getDetailTiket($tiket);

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $tiket )
            {
                // Set the response and exit
                $this->response( [
                    'status' => true,
                    'data' => $tiket
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