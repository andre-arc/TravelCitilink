<div id="content" class="bs-header bg-batik">
	<div class="container" style="background-color:#FFF !important;">
		<div class="media">
			<div class="media-left">
				<a href="index.php">
				<?php 
					$attr_img = array( 'width'=>'55px');
					echo image_asset($MYCFG['GENERAL']['APP_NAME_LOGO'],'',$attr_img);
					?>
				</a>
			</div>
			<div class="media-body">
				<h3 class="media-heading">
					<?php echo $MYCFG['GENERAL']['APP_NAME'].'&nbsp;'.$MYCFG['GENERAL']['VERSION'];?>
				</h3>
				<p>
					<strong><?php echo $MYCFG['GENERAL']['APP_NAME_LONG'];?></strong>
				</p>
			</div>
		</div>
	</div>
</div>