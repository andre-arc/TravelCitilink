<section class="content">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading bg-blue clearfix">
				<span class="pull-left">
					<i class="<?php echo $icon;?>"></i>&nbsp;Manage <?php echo $title;?>
				</span>
				<span class="pull-right">
					<?php echo modules::run('acl/widget/group_org_user');?>				
				</span>
			</div>
			<div class="panel-body">
				<form name="frm" id="frm" method="POST" action="<?php echo site_url('acl/config/save/');?>">
				<?php foreach($MYCFG as $k):?>
					<!--fieldset-->
						<?php foreach($k as $key=>$val):?>
						<div class="form-group">
							<label><?php echo $key;?></label>
							<?php if(strlen(utf8_decode($val))<100):?>
								<input class="form-control" type="text" name="<?php echo $key;?>" id="<?php echo $key;?>" value="<?php echo $val;?>"/>
							<?php else:?>
								<textarea class="textarea" rows="4" cols="120" name="<?php echo $key;?>" id="<?php echo $key;?>" >
									<?php echo $val;?>
								</textarea>
							<?php endif;?>
						</div>
						<?php endforeach;?>
					<!--/fieldset-->
				<?php endforeach;?>
			</div>
			<div class="panel-footer clearfix">
				<button class="pull-right btn btn-sm btn-success" type="submit" name="submit">
					<i class="fa fa-save"></i>&nbsp;Save
				</button>
			</div>
			</form>
		</div>			
	</div>			
</section>
<script>
$(document).ready(function(){
	$('.textarea').wysihtml5({
			"image": false,
	});
	$('#frm').submit(function(e){
		var post_data=serialize($this);
		
		e.preventDefault();
	});
	
	
})
</script>