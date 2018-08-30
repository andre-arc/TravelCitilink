<div class="box box-success box-solid">
	<div class="box-header">
		<h3 class="box-title">BOX TITLE 1</h3>
	</div>
	<ul class="nav nav-pills nav-stacked">
	<?php for($i=1;$i<=5;$i++):?>
		<li class="<?php echo ($i%2) ? "": "active";?>">
			<a href="#">
				<i class="fa fa-square"></i>&nbsp;United States of America
				<span class="badge pull-right">12</span>
			</a>
		</li>
	<?php endfor;?>
	</ul>
	
</div>