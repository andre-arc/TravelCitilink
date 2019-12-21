<?php include_once('head.php'); ?>

<body class="skin-green layout-top-nav">

	<div class="wrapper">
		<?php include_once('nav.php'); ?>
		<div class="content-wrapper bg-batik">
			<div class="container" style="padding:15px 15px; background-color:#FFF !important;">
				<?php echo (isset($content)) ? $content : ""; ?>
			</div>
		</div>
		<?php include_once('foot.php'); ?>

	</div>
	</div>

	</html>