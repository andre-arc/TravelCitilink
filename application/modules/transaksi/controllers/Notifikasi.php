<?php defined('BASEPATH') or exit('No direct script access allowed');
use google\appengine\api\mail\Message;

class Notifikasi extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$params =  array('server_key' => getenv('MIDTRANS_SERVER_KEY'), 'production' => getenv('MIDTRANS_PRODUCTION'));
		$this->load->library('veritrans');
		$this->veritrans->config($params);
	}

	function index()
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		if($result){
			$notif = $this->veritrans->status($result->order_id);
		}

		error_log(print_r($result,TRUE));

		//notification handler sample

		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
			  echo "Transaction order_id: " . $order_id ." is challenged by FDS";
			  $this->__proses_notifikasi('challenge', $order_id, $type);
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
			  echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
			  $this->__proses_notifikasi('success', $order_id, $type);
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  $this->__proses_notifikasi('success', $order_id, $type);
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  $this->__proses_notifikasi('pending', $order_id, $type);
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		  $this->__proses_notifikasi('denied', $order_id, $type);
		} else if ($transaction == 'expire') {
			// TODO set payment status in merchant's database to 'expire'
			echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
			$this->__proses_notifikasi('expired', $order_id, $type);
		} else if ($transaction == 'cancel') {
			// TODO set payment status in merchant's database to 'Denied'
			echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
			$this->__proses_notifikasi('denied', $order_id, $type);
		}

	}

	function __proses_notifikasi($status, $order_id, $payment_type){
		$data = array(
			"tipe_bayar" => $payment_type,
			"status_bayar" => $status
		);

		// switch($status){
		// 	case "success": 
		// 		$data = array(); break;
		// }

		if($status == 'success' || $status == 'expired'){
			$this->__kirimEmailTiket($order_id, $status);
		}

		$update = $this->db->update('transaksi', $data, array('kode' => $order_id));
	}

	function __kirimEmailTiket($order_id, $status){
		$this->load->library('mjml');
		$this->load->library('email');
		$data = array();

		$select = $this->db->select('t.*, c.*')
						   ->from('transaksi as t')
						   ->join('customer as c', 't.id_customer=c.id_customer')
						   ->where('t.kode', $order_id)->get()->row();

		$data = array(
			'order_id' => $order_id,
			'nama_customer' => $select->nama_customer,
			'email' => $select->email,
			'total_hrg' => $select->total_hrg,
			'tgl_transaksi' => $select->tgl_transaksi
		);

		if($status == 'success' ){
			$data['subject'] = "Transaksi Order ".$order_id." Tiket Kapal Touristix.ID telah Berhasil";
			$mjml = $this->load->view('email_success_order', $data, true);
			$html = $this->mjml->render($mjml);
		}elseif($status == 'expired'){
			$data['subject'] = "Transaksi Order ".$order_id." Tiket Kapal Touristix.ID telah Kadarluasa";
			$html = $this->load->view('email_expired_order', $data, true);
		}
		

		try {
			$message = new Message();
			$message->setSender('touristixid@gmail.com');
			$message->addTo($data['email']);
			$message->setSubject($data['subject']);
			$message->setHtmlBody($html);
			$message->send();
			// echo 'Mail Sent';
			return true;
		} catch (InvalidArgumentException $e) {
			// $error = "Unable to send mail. $e";
			error_log($error);
			return false;
		}

		// $result = $this->email->from('touristixid@gmail.com')   
		// 					 ->to($data['email'])
		// 					 ->subject($data['subject'])
		// 					 ->message($html)
		// 					 ->send();
		// if ($result) {
		// 	return true;
		// } else {
		// 	echo $this->email->print_debugger();
		// }
	}
}