<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Api_model extends CI_Model {



	function _get_userdata($username){

		$query = $this->db->query("select 
									users.id as user_id,
									users.first_name,
									users.last_name,
									users.username,
									orgs.name,
									orgs.id as org_id
								   from users, users_orgs, orgs where users.id=users_orgs.user_id and orgs.id=users_orgs.org_id and users.username='$username'");

		if($query){

			return $query->result_object();

		}



		return false;

	}


	function _getPangkalan($id){
		$query = $this->db->query("select * from orgs where id='$id'");

		if($query){
			return $query->row();
		}
		return false;
	}


	function _cekPelanggan($id){
		$tanggal = date('Y-m-d');
		$query = $this->db->query("select * from tbl_penjualan where id_pembeli='$id' and waktu_input='$tanggal'");

		if($query->num_rows() > 0){
			return false;
		}else{
			return true;
		}
	}



	function _getPelanggan($id){
		$query = $this->db->query("select id_pelanggan, no_kk, nm_pelanggan, nik from tbl_pelanggan where no_kk='$id'");

		if($query){
			return $query->row();
		}
		return false;
	}

	function _getKatPelanggan(){
		$query = $this->db->get('kategori_pelanggan');

		if($query){
			foreach ($query->result() as $r) {
				$result[$r->id] = $r->nama;
			}
			return $result ;
		}
		return false;
	}

	function _getTabungMonthly($id){
		$bulan = date('n');
		$tahun = date('Y');

		$query = $this->db->query("select COALESCE(sum(jml_tabung),0) as total from tbl_penjualan where id_pembeli='$id' and month(waktu_input) = $bulan AND year(waktu_input) = $tahun");

		if($query){
			return $query->row();
		}
		return false;
	}
}