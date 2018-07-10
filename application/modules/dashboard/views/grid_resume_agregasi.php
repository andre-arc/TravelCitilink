<div class="box box-success box-solid direct-chat direct-chat-primary">
	<div class="box-header with-border">
		<h3 class="box-title ">
			<i class="fa fa-university"></i>&nbsp;<?php echo $jml;?>&nbsp;Berita Terkini
		</h3>
	</div>
	<div class="box-body">
		<div class="direct-chat-messages" style="height:auto !important;">
			<?php $i=1;foreach($arr_berita as $k=>$v): ?>
			<div class="direct-chat-msg <?php echo ($i%2) ? "" : "right";?>">
				<div class="direct-chat-info clearfix">
					<span class="direct-chat-name pull-left">
						<i class="fa fa-university"></i>&nbsp;<?php echo $v['skpk'];?>
					</span>
					<span class="direct-chat-timestamp pull-right">
						<i class="fa fa-calendar"></i>&nbsp;
						<?php 
							$myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $v['tgl_publish']);
							echo $myDateTime->format('Y-M-d H:i');
						?>
					</span>
				</div>
				<img class="direct-chat-img" src="<?php echo image_asset_url('logo-pemko-banda-aceh-128px-bg-white.png');?>" />
				<a class="direct-chat-text <?php echo ($i%2) ? "" : "bg-green";?>" href="<?php echo $v['path'];?>" target="_blank">
					<?php echo word_limiter($v['judul'],8);?>
				</a>
			</div>
			<?php $i++; endforeach;?>
		</div>
	</div>	
</div>