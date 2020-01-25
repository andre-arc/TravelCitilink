<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $MYCFG['GENERAL']['APP_NAME']; ?> - <?php echo $MYCFG['GENERAL']['APP_NAME_LONG']; ?></title>
	<link rel="icon" href="<?php echo image_asset_url($MYCFG['GENERAL']['APP_NAME_LOGO']); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="<?php echo $this->config->item('asset_url'); ?>assets/modules/adminlte/css/AdminLTE.min.css" />
	<link rel="stylesheet" href="<?php echo $this->config->item('asset_url'); ?>assets/modules/adminlte/css/skins/_all-skins.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>



	<script type="text/javascript">
		var BASE_URL = '<?php echo base_url() ?>';
		var ASSET_URL = '<?php echo $this->config->item('asset_url') ?>';
		var SITE_URL = '<?php echo site_url() ?>';
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();

			$('.treeview').each(function(e) {
				var current_loc = window.location.href;
				var current_pmenu = $(this);
				$(this).find('li').each(function(li_item) {
					var current_cmenu = $(this);
					var ch = $(this).find('a').attr('href');
					if (current_loc == ch) {
						current_pmenu.addClass('active');
						current_cmenu.addClass('active');
					}
				});
			});

		});
	</script>
	<script type="text/javascript" src="<?php echo $this->config->item('asset_url') ?>assets/js/myloader.js"></script>
	<style>
		.bb {
			padding-bottom: 5px;
			border-bottom: 1px dashed #333;
		}

		.fixed-table-toolbar {
			margin: 0 10px !important;
		}

		.fixed-table-pagination {
			padding: 0px 10px !important;
		}
	</style>
	<?php echo (isset($css)) ? $css : ''; ?>

</head>