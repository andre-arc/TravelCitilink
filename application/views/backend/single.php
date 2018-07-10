<?php include_once('head.php');?>
<body class="skin-blue sidebar-mini wysihtml5-supported">
	<div class="wrapper">
		<?php include_once('nav.php');?>
		<div class="content-wrapper" style="min-height: 916px;">
			<?php echo (isset($content)) ? $content : '';?>
		</div>
	<?php include_once('foot.php');?>
	</div>
</div>
</html>