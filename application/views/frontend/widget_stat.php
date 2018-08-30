<div class="box box-widget widget-user">
	<div class="widget-user-header bg-green-active" style="padding:10px !important;">
		<h3 class="widget-user-username text-center">
			<strong>
			<?php echo $MYCFG['GENERAL']['APP_NAME'].' ver.'.$MYCFG['GENERAL']['VERSION'];?>
			</strong>
		</h3>
		<h5 class="widget-user-desc text-center">
			<em>
			<?php echo $MYCFG['GENERAL']['APP_NAME_LONG'];?>
			</em>
		</h5>
	</div>
	<div class="widget-user-image">
		<img class="img-circle" src="<?php echo base_url('assets/image/logo-pemko-banda-aceh-128px-bg-white.png');?>" alt="Banda Aceh">
	</div>
	<div class="box-footer">
		<div class="row">
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><?php echo $jml_skpk; ?></h5>
					<span class="description-text"><i class="fa fa-university"></i>&nbsp;SKPK</span>
				</div>
			</div>

			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><?php echo $stat_berita; ?></h5>
					<span class="description-text"><i class="fa fa-newspaper-o"></i>&nbsp;BERITA</span>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="description-block">
					<h5 class="description-header"><?php echo $jml_tweet; ?></h5>
					<span class="description-text" style="color: #00c0ef;"><a href="https://twitter.com/info_nanggroe" target="_blank" style="color: #00c0ef;"><i class="fa fa-twitter-square fa-lg"></i>&nbsp;TWEET</a></span>
				</div>
			</div>
		</div>
	</div>
</div>
