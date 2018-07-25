<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading bg-blue clearfix">
					<span class="pull-left">
						<i class="<?php echo $icon;?>"></i>&nbsp;Data <?php echo $title;?>
						<span class="badge mybg-white"><span id="total_record"></span>&nbsp;Total Records</span>
					</span>
					<span class="pull-right">
						<?php echo modules::run('acl/widget/group_org_user');?>
					</span>
				</div>
				<div id="toolbar">
					<?php if($auth_meta['add']):?>
						<a id="btn-add" class="btn btn-primary btn-sm" href="<?php echo site_url('kas/add/');?>" alt="ADD">
							<i class="fa fa-plus-circle"></i>&nbsp;Add
						</a>
					<?php endif;?>
					<?php if($auth_meta['edit']):?>
						<a id="btn-edit" class="btn btn-info btn-sm" href="<?php echo site_url('kas/edit/');?>" alt="Edit">
							<i class="fa fa-pencil"></i>&nbsp;Edit
						</a>
					<?php endif;?>
					<?php if($auth_meta['del']):?>
						<a id="btn-del" class="btn btn-danger btn-sm" href="<?php echo site_url('kas/del/');?>" alt="Del">
							<i class="fa fa-trash-o"></i>&nbsp;Del
						</a>
					<?php endif;?>
				</div>
				<table
				id="grid_kas"
				class="table table-hover"
				data-show-refresh="true"
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
			<form role="form" id="frm-wil-gp" name="frm-wil-gp" method="POST" action="#">
				<div class="modal-body">
					<input type="hidden" name="act" id="act" value="" />
					<input type="hidden" id="id" name="id" value="" />
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">No Faktur</label>
								<input type="text" id="no_faktur" name="no_faktur" class="form-control input-sm" value="" />
								<small class="form-text text-muted" id="cek-kode"></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<input type="text" id="tgl_transaksi" name="tgl_transaksi" class="form-control input-sm" value="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Mitra</label>
								<?= form_dropdown('org_id', $cabang, null, 'id="org_id" style="width:100%;"'); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Jumlah Dana</label>
								<input type="text" id="jumlah" name="jumlah" class="form-control input-sm" value="" />
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
		return $.map($('#grid_kas').bootstrapTable('getSelections'), function (row) {
			return row;
		});
	}

	$(document).ready(function(){
		$('#tgl_transaksi').datepicker({
			format: 'dd-mm-yyyy',
			language: 'id'
		});
		
		$('select').select2();

		$('#grid_kas').bootstrapTable({
			toolbar:'#toolbar',
			pagination:true,
			search:true,
			pageSize:10,
			url: SITE_URL+'/kas/get_json/',
			singleSelect:true,
			columns: [
			{
				field: 'state',
				checkbox: true,
				align: 'center',
				valign: 'middle'
			},
			{
				field: 'id_kas',
				title: 'ID',
				halign:'center',
				sortable:true
			},
{
				field: 'no_faktur',
				title: 'No Faktur',
				halign:'center',
				sortable:true
			},
			{
				field: 'tgl_transaksi',
				title: 'Tanggal',
				halign:'center',
				sortable:true
			},
			{
				field: 'name',
				title: 'Keterangan',
				halign:'center',
				sortable:true,
                formatter:function(value){
                  <?php
                      $group_name= $this->session->userdata('user_group_name');
                        if($group_name == 'operator cabang'){
                            echo 'return "Menerima Dana dari Pusat";';
                        }else{
                            echo 'return "Mengirim Dana ke Mitra <b>"+value+"</b>";';
                        }
                    ?>
                }
			},
			{
				field: 'jumlah',
				title: 'Jumlah Dana',
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
			$('#frm-wil-gp').trigger("reset");
			$('.modal-header').removeClass().addClass("modal-header").addClass("mybg-primary");
			$('#title_act').html('<i class="fa fa-plus-circle"></i>&nbsp;Form Add');
			$('#act').val('add');
			
			$('#myModal').modal('show');
			e.preventDefault();
		});

		<?php endif;?>

		<?php if($auth_meta['edit']):?>

		$('#btn-edit').click(function(e){
			var rowSel=getRowSelections();
			if(rowSel.length){
				$('#frm-wil-gp').trigger("reset");
				$('.modal-header').removeClass().addClass("modal-header").addClass("mybg-info");
				$('#title_act').html('<i class="fa fa-pencil"></i>&nbsp;Form Edit');
				$('#act').val('edit');

				//document.getElementById('org_id').value = rowSel[0].org_id;
				
				//load row
				$('#id').val(rowSel[0].id);
				$('#no_faktur').val(rowSel[0].no_faktur);
				$('#tgl_transaksi').val(rowSel[0].tgl_transaksi);
				$('#jumlah').val(rowSel[0].jumlah);
				$('#org_id').val(rowSel[0].org_id).trigger("change");
				
				$('#myModal').modal('show');
			}else{
				swal('Silahkan memilih record yang akan diedit terlebih dulu.');
			}
			e.preventDefault();
		});
		<?php endif;?>

		<?php if(($auth_meta['add'])||($auth_meta['edit'])):?>
			$('#frm-wil-gp').submit(function(e){
				var form_data=$("#frm-wil-gp").serialize();
				var url_form = ($('#act').val()=='edit') ? SITE_URL+"/kas/act_edit/" : SITE_URL+"/kas/act_add/";
				$.ajax({
					type: "POST",
					url: url_form,
					dataType: "json",
					data: form_data,
					success: function(data){
						if(data.success){
							swal('Selamat', data.msg, 'success');
							$('#myModal').modal('hide');
							$('#grid_kas').bootstrapTable('refresh');
						}else{
							swal('Ada kesalahan.', data.msg, 'error');
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
				swal({
					title: 'Anda yakin?',
					text: "Data yang dihapus tidak dapat dikembalikan!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Hapus',
					cancelButtonText: 'Batal',
					confirmButtonClass: 'pull-right',
					cancelButtonClass: 'pull-left',
				}).then(function () {
					$.ajax({
						type: "POST",
						url: SITE_URL+"/kas/act_del/",
						dataType: "json",
						data: {id:rowSel[0].id},
						success: function(data){
							if(data.success){
								swal('Selamat', data.msg, 'success');
								$('#grid_kas').bootstrapTable('refresh');
							}else{
								swal('Ada kesalahan.', data.msg, 'error');
							}
						}
					});
				},
				function (dismiss) {})
			}else{
				swal('Silahkan memilih record yang akan dihapus terlebih dulu.');
			}
			e.preventDefault();
		});
		<?php endif;?>
	});
</script>