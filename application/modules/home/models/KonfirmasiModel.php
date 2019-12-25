<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class KonfirmasiModel extends CI_model {


     function get_transaksi(){
        $hasil=$this->db->query("SELECT
                                        detail_transaksi.id,
                                        detail_transaksi.id_tiket,
                                        detail_transaksi.id_transaksi,
                                        tiket.id_tiket,
                                        tiket.tgl_berangkat,
                                        tiket.waktu,
                                        tiket.dari,
                                        tiket.tujuan,
                                        tiket.kapal,
                                        transaksi.id_transaksi,
                                        customer.id_customer,
                                        customer.nama_customer,
                                        transaksi.id_customer,
                                        transaksi.id_mitra
                                        FROM
                                        tiket ,
                                        transaksi ,
                                        detail_transaksi ,
                                        customer
                                        WHERE
                                        transaksi.id_transaksi = detail_transaksi.id_transaksi AND
                                        detail_transaksi.id_tiket = tiket.id_tiket AND
                                        transaksi.id_customer = customer.id_customer AND
                                        transaksi.id_mitra = '777'");
        return $hasil;
    }

    
   
}