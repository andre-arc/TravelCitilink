<?php
 $arr_box = array('box-primary','box-info','box-warning','box-danger','box-default','box-success');
 $current_box = random_element($arr_box)
?>
<div class="box <?php echo $current_box;?> box-solid direct-chat direct-chat-primary">
	<div class="box-header with-border">
		<h3 class="box-title ">
			<i class="fa fa-university"></i>&nbsp;Berita&nbsp;<?php echo $category;?>
		</h3>
		<a href="<?php echo site_url('news/archives/'.strtolower($category).'/');?>" class="btn btn-xs btn-default bg-black pull-right">
			<i class="fa fa-archive"></i>&nbsp;Arsip Berita
		</a>
		
	</div>
	<div class="box-body">
		<div class="direct-chat-messages" style="height:auto !important;">
			<?php for($i=1;$i<=5;$i++):?>
			<div class="direct-chat-msg <?php echo ($i%2) ? "" : "right";?>">
				<div class="direct-chat-info clearfix">
					<span class="direct-chat-name pull-left">Nama Desc/Panjang SKPK</span>
					<span class="direct-chat-timestamp pull-right">23 Jan 2016 12:00</span>
				</div>
				<img class="direct-chat-img" src="<?php echo image_asset_url('logo-pemko-banda-aceh-128px-bg-white.png');?>" />
				<a class="direct-chat-text" href="#" target="_blank">
					This Is title of News. That's unbelievable!
				</a>
			</div>
			<?php endfor;?>
		</div>
	</div>	
</div>