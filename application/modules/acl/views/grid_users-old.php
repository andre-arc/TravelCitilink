<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading bg-green clearfix">
				<span class="pull-left">
				<i class="<?php echo $icon;?>"></i>&nbsp;Manage <?php echo $title;?>
				<span class="badge mybg-white"><span id="total_record"></span>&nbsp;Total Records</span>&nbsp;
				</span>
				<span class="pull-right">
					<?php echo modules::run('acl/widget/group_org_user');?>					
				</span>
			</div>
			<div id="toolbar">
			<?php if($auth_meta['add']):?>
				<a id="btn-add" class="btn btn-primary btn-sm" href="<?php echo site_url('acl/users/add/');?>" alt="ADD">
					<i class="fa fa-plus-circle"></i>&nbsp;Add
				</a>
			<?php endif;?>
			<?php if($auth_meta['edit']):?>
				<a id="btn-edit" class="btn btn-info btn-sm" href="<?php echo site_url('acl/users/edit/');?>" alt="Edit">
					<i class="fa fa-pencil"></i>&nbsp;Edit
				</a>
			<?php endif;?>
			<?php if($auth_meta['del']):?>
				<a id="btn-del" class="btn btn-danger btn-sm" href="<?php echo site_url('acl/users/del/');?>" alt="Del">
					<i class="fa fa-trash-o"></i>&nbsp;Del
				</a>
			<?php endif;?>
		</div>
			<table id="grid_users"
					data-show-refresh="true"
          data-show-export="true"
          data-classes="table table-no-bordered"
 					
          data-pagination="true"
          data-id-field="id"
          data-page-list="[10, 25, 50, 100, ALL]"
          data-side-pagination="server" >
			</table>
			
		</div>
	</div>
</div>
</section>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>			
        <h4 class="modal-title"><span id="title_act"></span></h4>
      </div>
			<form role="form" id="frm-adm-users" name="frm-adm-users" method="POST" action="#">
      <div class="modal-body">
				<input type="hidden" name="act" id="act" value="" />
				<input type="hidden" id="id" name="id" value="" />
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="inputUser">User Name</label>
								<input type="text" id="username" name="username" class="form-control input-sm" value="" />
							</div>
							<div class="form-group">
								<label class="control-label" >User Password</label>
								<input type="password" id="password" name="password" class="form-control input-sm" readonly=readonly>
								<label id="chk_passwd" name="chk_passwd">
									<input type="checkbox" name="profile_rst_pass" id="profile_rst_pass"> Change Password
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" >Email</label>
								<input type="text" id="email" name="email" class="form-control input-sm" value="" />
							</div>
							<div class="form-group">
								<label class="control-label" >Phone</label>
								<input type="text" id="phone" name="phone" class="form-control input-sm" value="" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" >First Name</label>
								<input type="text" id="first_name" name="first_name" class="form-control input-sm" value="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" >Last Name</label>
								<input type="text" id="last_name" name="last_name" class="form-control input-sm" value="" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Groups</label>
								<select name="groups" id="groups" class="form-control input-sm">
									<?php foreach($ls_groups as $k=>$v): ?>
									<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
									<?php endforeach; ?>
								</select>
							</div>							
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Orgs</label>
								<select name="org_id" id="org_id" class="form-control input-sm">
									<option value="0">--Choose-Org--</option>
									<?php foreach($ls_org as $k=>$v): ?>
									<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
									<?php endforeach; ?>
								</select>
							</div>							
						</div>						
					</div>
							
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>			
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>&nbsp;Save</button>
      </div>
			</form>
    </div>
  </div>
</div>

<script>
	var selections = [];
  
	function getRowSelections() {
    return $.map($('#grid_users').bootstrapTable('getSelections'), function (row) {
			return row;
		});
  }	

$(document).ready(function(){		

	$('#grid_users').bootstrapTable({
		toolbar:'#toolbar',
		pagination:true,
		search:true,
		pageSize:10,
		url: SITE_URL+'/acl/users/get_json/',
		pageSize:10,
		singleSelect:true,
		columns: [
				{
					field: 'state',
					checkbox: true,
          align: 'center',
          valign: 'middle'
        },
				{
						field: 'username',
						title: 'User Name',
						halign:'center',
						sortable:true
				},
				{
						field: 'first_name',
						title: 'First Name',
						halign:'center',
						sortable:true
				},{
						field: 'last_name',
						title: 'Last Name',
						halign:'center',
						sortable:true
				},{
						field: 'phone',
						title: 'Phone',
						halign:'center',
						sortable:true
				},{
						field: 'email',
						title: 'E-Mail',
						halign:'center',
						sortable:true
				},{
						field: 'grp_name',
						title: 'Group',
						halign:'center',
						sortable:true
				},{
						field: 'org_name',
						title: 'Org',
						halign:'center',
						sortable:true
				}
				],
				onLoadSuccess:function(e){
					$('#total_record').html(e.total);
					$('.fixed-table-pagination').addClass('panel-footer clearfix bg-gray-active');					
				}
	});

	<?php if($auth_meta['add']):?>
		$('#btn-add').click(function(e){
			$('#frm-adm-users').trigger("reset");
    	$('.modal-header').removeClass().addClass("modal-header").addClass("mybg-primary");
			$('#title_act').html('<i class="fa fa-plus-circle"></i>&nbsp;Form Add User');
			$('#act').val('add');
				
			$("#chk_passwd").hide();
			$("#password").removeAttr("readonly");	
			
			$('#myModal').modal('show');
			e.preventDefault();
		});
	<?php endif;?>
	
	<?php if($auth_meta['edit']):?>
		$("#profile_rst_pass").change(function() {
			$("#password").prop("readonly", !$(this).is(":checked"));
		});
	
		$('#btn-edit').click(function(e){
			var rowSel=getRowSelections();
			console.log(rowSel);
			if(rowSel.length){
				$('#frm-adm-users').trigger("reset");
				$('.modal-header').removeClass().addClass("modal-header").addClass("mybg-info");
				$('#title_act').html('<i class="fa fa-pencil"></i>&nbsp;Form Edit User');
				$('#act').val('edit');
				$("#chk_passwd").show();
				$("#password").prop('readonly', true);	
				
				//load row
				$('#id').val(rowSel[0].id);
				$('#username').val(rowSel[0].username);
				$('#email').val(rowSel[0].email);
				$('#phone').val(rowSel[0].phone);
				$('#first_name').val(rowSel[0].first_name);
				$('#last_name').val(rowSel[0].last_name);
				$('#org_id').val(rowSel[0].org_id);
				$('#groups').val(rowSel[0].grp_id);
				
				$('#myModal').modal('show');
			}else{
				alert('Silahkan memilih record yang akan diedit terlebih dulu.');
			}
			e.preventDefault();
		});
	<?php endif;?>
	
	<?php if(($auth_meta['add'])||($auth_meta['edit'])):?>
			$('#frm-adm-users').submit(function(e){
			var form_data=$("#frm-adm-users").serialize();
			var url_form = ($('#act').val()=='edit') ? SITE_URL+"/acl/users/act_edit/" : SITE_URL+"/acl/users/act_add/";
			
			$.ajax({
					type: "POST",
					url: url_form,
					dataType: "json",
					data: form_data,
					success: function(data){
						if(data.success){
							alert("Selamat,\n\r"+data.msg);
							$('#myModal').modal('hide');
							$('#grid_users').bootstrapTable('refresh');
						}else{
							alert("Ada kesalahan.\n\r"+data.msg);
							$('#myModal').modal('hide');
						}
					}
			});
			e.preventDefault();			
		});
	<?php endif;?>
	
	<?php if($auth_meta['del']):?>
		$('#btn-del').click(function(e){
			var rowSel=getRowSelections();
			if(rowSel.length){
				var r = confirm("Apakah anda yakin akan menghapus data tersebut !");
				if (r == true) {
					$.ajax({
						type: "POST",
						url: SITE_URL+"/acl/users/act_del/",
						dataType: "json",
						data: {id:rowSel[0].id},
						success: function(data){
							if(data.success){
								alert("Selamat,\n\r"+data.msg);
								$('#grid_users').bootstrapTable('refresh');
							}else{
								alert("Ada kesalahan.\n\r"+data.msg);
							}
						}
					});
				}				
			}else{
				alert('Silahkan memilih record yang akan dihapus terlebih dulu.');			
			}
			e.preventDefault();
		});
		<?php endif;?>
	
	
});
</script>