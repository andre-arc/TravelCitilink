<?php include_once('head.php'); ?>

<body class="skin-green layout-top-nav">

	<div class="wrapper">
		<?php //include_once('logo.php');
		?>
		<?php include_once('nav.php'); ?>
		<div class="content-wrapper bg-batik">
			<div class="container-fluid" style="padding:15px 15px; background-color:#FFF !important;">
				<?php echo modules::run('home/widget/slider'); ?>


				<div class="row" style="margin-bottom:15px;">
					<?php include_once('btn-group-example.php'); ?>
				</div>

				<div class="row">
					<style>
						.direct-chat-msg {
							border-bottom: 1px dashed #CCC !important;
							padding-bottom: 10px;
						}

						a:hover {
							color: #000 !important;
						}
					</style>

					<?php
					$arr_cat = array('Kesekretariatan', 'Badan', 'Dinas');
					foreach ($arr_cat as $category) : ?>
						<div class="col-md-4">
							<?php //include('direct-chat-panel.php');
							?>
							<?php echo modules::run('home/widget/feed_org', $category); ?>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="row">
					<style>
						.direct-chat-msg {
							border-bottom: 1px dashed #CCC !important;
							padding-bottom: 10px;
						}

						a:hover {
							color: #000 !important;
						}
					</style>

					<?php
					$arr_cat = array('Kantor', 'Kecamatan', 'Unit_Kerja');
					foreach ($arr_cat as $category) : ?>
						<div class="col-md-4">
							<?php //include('direct-chat-panel.php');
							?>
							<?php echo modules::run('home/widget/feed_org', $category); ?>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</div>
		<?php include_once('foot.php'); ?>
	</div>
	</div>

	</html>