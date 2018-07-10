<?php include_once('head.php');?>
<body class="skin-blue sidebar-mini wysihtml5-supported">
	<div class="wrapper">
		<?php include_once('nav.php');?>
		<div class="content-wrapper" style="min-height: 916px;">
			<div class="container">
				<div class="row box box-primary">
					<div class="col-md-6">
						<?php print_r($_SESSION);?>
					</div>
					<div class="col-md-6">
						<?php print_r($menus);?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						R2.C1
						&nbsp;
					</div>
					<div class="col-md-6">
						R2.C2
						&nbsp;
					</div>					
				</div>
				
			</div>
		</div>
	<?php include_once('foot.php');?>
	</div>
</div>
</html>