<?php include_once('head.php'); ?>

<body class="skin-green layout-top-nav">

	<div class="wrapper">
		<?php //include_once('logo.php');
		?>
		<?php include_once('nav.php'); ?>
		<div class="content-wrapper bg-batik">
			<div class="container" style="padding:15px 15px; background-color:#FFF !important;">
				<div class="row">
					<div class="col-md-4">
						<?php echo modules::run('home/widget/slider'); ?>
					</div>
					<div class="col-md-4">
						<?php echo modules::run('home/widget/tengah_skpk_tweet');/*include_once('widget_stat.php');*/ ?>
					</div>
					<div class="col-md-4">
						<div class="box box-success box-solid">
							<div class="box-header bg-green-active">
								<i class="fa fa-info-circle"></i>&nbsp;Info
								<a class="btn btn-xs btn-danger pull-right" href="<?php echo site_url('home/rss/'); ?>" target="_blank">
									<i class="fa fa-rss-square"></i>&nbsp;RSS INONG
								</a>
							</div>
							<div class="box-body">
								<?php echo $MYCFG['GENERAL']['DISCLAIMER']; ?>
							</div>
						</div>

					</div>
				</div>
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