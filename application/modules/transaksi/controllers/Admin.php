<?php defined('BASEPATH') or exit('No direct script access allowed');

use google\appengine\api\mail\Message;

class Admin extends MY_Admin
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("M_transaksi");
		$this->load->helper("tanggal_indo_helper");
	}

	function index()
	{
		$this->data['css'] =  css_asset('bootstrap-table.min.css', 'bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css', 'limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css', 'select2');

		$this->data['js']  =  js_asset('bootstrap-table.min.js', 'bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js', 'limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js', 'select2');

		$meta = $this->meta('transaksi/', true);
		$this->data['auth_meta'] = $meta['act'];
		$this->data['icon']      = $meta['icon'];
		$this->data['title']     = $meta['title'];
		$this->data['content'] = $this->load->view('transaksi', $this->data, true);
		$this->display($this->data);
	}

	public function get_json($id_transaksi = null)
	{
		$ret = array(
			'total' => 0,
			'rows' => array()
		);
		header('Content-Type: application/json');

		$limit  = isset($_GET['limit']) ? $_GET['limit'] : 10;
		$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
		$search = (isset($_GET['search'])) ? $_GET['search'] : '';
		$sort   = (isset($_GET['sort'])) ? $_GET['sort'] : 't.tgl_transaksi';
		$order  = (isset($_GET['order'])) ? $_GET['order'] : 'desc';

		$SQL_BASE = '
			select * from transaksi as t join orgs as o on o.id=t.id_mitra 
		';

		if ($search <> '') {
			//get where
			$SQL_BASE .= 'WHERE ';
			$SQL_BASE .= 't.id_transaksi like "%' . $search . '%" OR ';
			$SQL_BASE .= 't.id_tiket like "%' . $search . '%" OR ';
			$SQL_BASE .= 't.tgl_transaksi like "%' . $search . '%" OR ';
			$SQL_BASE .= 't.total_hrg like "%' . $search . '%" OR ';

			$ls_data = $this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);

			//get where with limit
			$SQL = ($sort) ? $SQL_BASE . ' ORDER BY ' . $sort . ' ' . $order : $SQL_BASE;
			$SQL .= ' LIMIT ' . $offset . ',' . $limit;
			$ls_data_limit = $this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;
		} else {

			if ($id_transaksi != null) {
				$SQL_BASE .= 'WHERE id_transaksi="' . $id_transaksi . '"';
			}
			//get all
			$ls_data = $this->db->query($SQL_BASE)->result_array();
			$ret['total'] = count($ls_data);
			//get limit
			$SQL = ($sort) ? $SQL_BASE . ' ORDER BY ' . $sort . ' ' . $order : $SQL_BASE;
			$SQL .= ' LIMIT ' . $offset . ',' . $limit;
			$ls_data_limit = $this->db->query($SQL)->result_array();
			$ret['rows'] = $ls_data_limit;
		}

		echo json_encode($ret);
	}
}
