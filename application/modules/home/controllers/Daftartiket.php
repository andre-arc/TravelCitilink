<?php defined('BASEPATH') or exit('No direct script access allowed');

class Daftartiket extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        //$this->__init();
        $this->data['tpl'] = 'single';
        $this->data['icon'] = 'fa fa-cogs';
        $this->data['subicon'] = 'fa fa-university';
        $this->data['title'] = 'Konfirmasi Pembayaran';
        $this->data['table_name'] = 'users';
        $this->data['content'] = '';
        $this->data['css'] = css_asset('bootstrap-table.min.css', 'bootstrap-table');
        $this->data['css'] = css_asset('style.css', '');
        $this->data['css'] .= css_asset('bootstrap3-wysihtml5.min.css', 'bootstrap-wysihtml5');
        $this->data['js'] = js_asset('bootstrap-table.min.js', 'bootstrap-table');
        $this->data['js'] .= js_asset('bootstrap3-wysihtml5.all.min.js', 'bootstrap-wysihtml5');
        $this->load->model('KonfirmasiModel');
    }


    function index()
    {
        $this->load->library('form_validation');
        $mydata['tbl_icon'] = $this->data['subicon'];
        $mydata['tbl_title'] = $this->data['title'];
        $mydata['tbl'] = 'mytabel';
        $this->data['content'] = $this->load->view('daftartiket', $mydata, true);
        $this->display();
    }
}
