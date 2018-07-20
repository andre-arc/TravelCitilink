<?php if (! defined ('BASEPATH')) exit ('No direct script access allowed');

class Barcode extends MY_Admin{
	public function __construct(){
		parent::__construct();
		$this->load->model('pembeliModel');
		$this->load->helper('form');
	}

	public function index(){
		$this->data['css']  = css_asset('bootstrap-table.min.css','bootstrap-table');
		$this->data['css'] .= css_asset('sweetalert2.min.css','limonte-sweetalert2');
		$this->data['css'] .= css_asset('select2.min.css','select2');
		$this->data['css'] .= css_asset('bootstrap-datepicker.min.css','bootstrap-datepicker');
		
		$this->data['js']   = js_asset('bootstrap-table.min.js','bootstrap-table');
		$this->data['js']  .= js_asset('sweetalert2.min.js','limonte-sweetalert2');
		$this->data['js']  .= js_asset('select2.full.min.js','select2');
		$this->data['js']  .= js_asset('bootstrap-datepicker.min.js','bootstrap-datepicker');
		$this->data['js']  .= js_asset('bootstrap-datepicker.id.min.js','bootstrap-datepicker');

		$meta= $this->meta('pembeli/barcode',true);
		$this->data['auth_meta']	= $meta['act'];
		$this->data['icon']			= $meta['icon'];
		$this->data['title']		= $meta['title'];


		$this->data['kk']= $this->pembeliModel->get()->result_object();
		$this->data['content'] = $this->load->view('barcode', $this->data,true);
		$this->display($this->data);

	}



	public function act_search(){
		$kode = $_POST['kode'];

		$sql='SELECT * from tbl_pelanggan where no_kk=\''.$kode.'\'
		';
	
		$data=$this->db->query($sql)->result();

		echo '
			<div class="col-xs-12">	
	<div class="panel">
		<div class="panel-heading bg-blue clearfix">Data Pembeli
		</div>
			<div class="row">
				<div class="col-xs-12">
				<div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src='.site_url($data[0]->qrcode).'
           alt="User profile picture">

              <h3 class="profile-username text-center">Nama: '.$data[0]->nm_pelanggan.'</h3>

              <p class="text-muted text-center">No Kartu Keluarga : '.$data[0]->no_kk.'</p>

              <ul class="list-group list-group-unbordered">
             	 <li class="list-group-item">
                  <b>No Induk Kependudukan</b> <a class="pull-right">'.$data[0]->nik.'</a>
                </li>
                <li class="list-group-item">
                  <b>No HP</b> <a class="pull-right">'.$data[0]->hp.'</a>
                </li>
                <li class="list-group-item">
                  <b>Kategori Pembeli</b> <a class="pull-right">'.$data[0]->kategori.'</a>
                </li>
                <li class="list-group-item">
                  <b>Alamat </b> <a class="pull-right">'.$data[0]->alamat_pelanggan.'</a>
                </li>
                <li class="list-group-item">
                  <b>Keterangan</b> <a class="pull-right">'.$data[0]->keterangan.'</a>
                </li>
              </ul>

              <a href='.site_url('pembeli/barcode/cetak/').$data[0]->no_kk.' target="_blank" class="btn btn-primary btn-block"><b>CETAK KARTU</b></a>
            </div>
            

		</div>

						
						</div>
					</div>
				</div>

		';
	}


	public function cetak(){


		//load mPDF library
		$this->load->library('m_pdf');

		//now pass the data//
		$kode = $this->uri->segment('4');
		$sql='SELECT * from tbl_pelanggan where no_kk=\''.$kode.'\'';	
		$this->data['data']=$this->db->query($sql)->result();
		 //now pass the data //
		 //
		 

		$html=$this->load->view('pembeli/cetak', $this->data,true);

		//this the the PDF filename that user will get to download
		$pdfFilePath ='Kartu.pdf';
 
		
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");


       
       
    }

	

	

}