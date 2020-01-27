<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Touristix: Situs Tiket Online Kapal Cepat Sabang-Banda Aceh</title>
	<meta name="description" content="Touristix.id memberikan layanan pemesanan tiket Kapal express penyeberangan Banda Aceh Sabang dan paket travelling lainnya, Jelajahi dan pesan pengalaman travel yang menyenangkan bersama Touristix!">

	<!-- <link rel="icon" href="<?php // echo image_asset_url($MYCFG['GENERAL']['APP_NAME_LOGO']); 
								?>"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="<?php echo $this->config->item('asset_url'); ?>assets/modules/adminlte/css/AdminLTE.min.css" />
	<link rel="stylesheet" href="<?php echo $this->config->item('asset_url'); ?>assets/modules/adminlte/css/skins/_all-skins.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>


	<script type="text/javascript" src="<?php echo $this->config->item('asset_url') . 'assets/js/myloader.js'; ?>"></script>
	<script type="text/javascript">
		var BASE_URL = '<?php echo base_url() ?>';
		var ASSET_URL = '<?php echo $this->config->item('asset_url') ?>';
		var SITE_URL = '<?php echo site_url() ?>';
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>

	<?php echo (isset($css)) ? $css : ''; ?>

	<!-- Google Analytics -->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156000942-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-156000942-1');
	</script>

</head>