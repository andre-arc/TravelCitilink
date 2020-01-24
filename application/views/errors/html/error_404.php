<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
	<title>404 Page Not Found</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php $CI =& get_instance(); echo $CI->config->item('asset_url').'assets/css/error.css'; ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- <script src="https://inong.bandaacehkota.go.id/assets/js/jquery-migrate-1.2.1.min.js"></script> -->
</head>



<body>
	<div class="container">
		<div class="col-md-6 col-sm-6 imgSec">
			<div class="icon">
				<div class="victor"></div>
				<!-- <div class="animation"></div> -->
			</div>
		</div>
		<div class="col-md-6 col-sm-6 content">
			<h2 class="heading">
				Touristix.id
			</h2>
			<p>Oops terjadi kesalahan...</p>
			<p><small>Sepertinya Anda tersesat. Halaman yang Anda cari tidak ditemukan.</small></p><a href="<?php echo base_url(); ?>" class="button"> Kembali ke Awal</a>
		</div>
	</div>
</body>

</html>