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
						<a id="btn-add" class="btn btn-primary btn-sm" href="<?php echo site_url('barang/add/');?>" alt="ADD">
							<i class="fa fa-plus-circle"></i>&nbsp;Add
						</a>
					<?php endif;?>
					<?php if($auth_meta['edit']):?>
						<a id="btn-edit" class="btn btn-info btn-sm" href="<?php echo site_url('barang/edit/');?>" alt="Edit">
							<i class="fa fa-pencil"></i>&nbsp;Edit
						</a>
					<?php endif;?>
					<?php if($auth_meta['del']):?>
						<a id="btn-del" class="btn btn-danger btn-sm" href="<?php echo site_url('barang/del/');?>" alt="Del">
							<i class="fa fa-trash-o"></i>&nbsp;Del
						</a>
					<?php endif;?>
				</div>
				<table
				id="grid_kec"
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
					<input type="hidden" id="nama" name="nama" value="" />
					<div class="row">
						
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Kategori</label>
								<select name="kategori" class="form-control select" style="width:100%;" id="jenis_unit" required>
									<option value="">-- Pilih Kategori --</option>
									<option value="Rumah Tangga">Rumah Tangga</option>
									<option value="Usaha Mikro">Usaha Mikro</option>
									<option value="Lainnya">Lainnya</option>
									
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama pelanggan</label>
								<input type="text" id="nm_pelanggan" name="nm_pelanggan" class="form-control input-sm" value="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No KK</label>
								<input type="text" id="no_kk" name="no_kk" class="form-control input-sm" value="" placeholder="No Kartu Keluarga" />
								<small class="form-text text-muted" id="cek-nama"></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nik</label>
								<input type="text" id="nik" name="nik" class="form-control input-sm" value="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No HP</label>
								<input type="text" id="hp" name="hp" class="form-control input-sm" value="" placeholder="No Hp" />
								<small class="form-text text-muted" id="cek-nama"></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Keterangan</label>
								<input type="text" id="keterangan" name="keterangan" class="form-control input-sm" value="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Alamat pelanggan</label>
								<input type="text" id="alamat_pelanggan" name="alamat_pelanggan" class="form-control input-sm" value="" />
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
		return $.map($('#grid_kec').bootstrapTable('getSelections'), function (row) {
			return row;
		});
	}

	$(document).ready(function(){

		$('select').select2();

		$('#grid_kec').bootstrapTable({
			toolbar:'#toolbar',
			pagination:true,
			search:true,
			pageSize:10,
			url: SITE_URL+'/pembeli/get_json/',
			singleSelect:true,
			columns: [
			{
				field: 'state',
				checkbox: true,
				align: 'center',
				valign: 'middle'
			},
			{
				field: 'id_customer',
				title: 'No Customer',
				halign:'center',
				sortable:true
			},
			{
				field: 'nama_customer',
				title: 'Nama Customer',
				halign:'center',
				sortable:true
			},
			{
				field: 'hp',
				title: 'No HP',
				halign:'center',
				sortable:true
			},
			{
				field: 'email',
				title: 'Email',
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
            $('#id_customer').val('').trigger("change");
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
				//alert(rowSel[0].jenis_unit);
				//load row
				$('#id').val(rowSel[0].id_pelanggan);
				$('#nm_pelanggan').val(rowSel[0].nm_pelanggan);
				$('#nik').val(rowSel[0].nik);
				$('#hp').val(rowSel[0].hp);
				$('#kategori').val(rowSel[0].kategori).trigger('change');
				$('#alamat_pelanggan').val(rowSel[0].alamat_pelanggan);
				$('#keterangan').val(rowSel[0].keterangan);
				$('#no_kk').val(rowSel[0].no_kk);
			
				
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
				var url_form = ($('#act').val()=='edit') ? SITE_URL+"/pembeli/act_edit/" : SITE_URL+"/pembeli/act_add/";
				$.ajax({
					type: "POST",
					url: url_form,
					dataType: "json",
					data: form_data,
					success: function(data){
						if(data.success){
							swal('Selamat', data.msg, 'success');
							$('#myModal').modal('hide');
							$('#grid_kec').bootstrapTable('refresh');
						}else{
							swal('Ada kesalahan.', data.msg, 'error');
							$('#myModal').modal('hide');
						}
					}
				});
				e.preventDefault();
			});

			$('#nm_barang').change(function () {
				var noPlat   = $('#nm_barang').val() || null;
				var tempPlat = $('#nama').val() || null;
				var tempUrl  = SITE_URL+"/barang/cek_nama/"+noPlat;

				if (noPlat != tempPlat) {
					$.ajax({
						type: "POST",
						url: tempUrl,
						dataType: "html",
						data: 'form_data',
						success: function(data){
							$("#cek-nama").html(data);
						}
					});
				}
				else{
					$("#cek-nama").html("");
				}
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
						url: SITE_URL+"/pembeli/act_del/",
						dataType: "json",
						data: {id_pelanggan:rowSel[0].id_pelanggan},
						success: function(data){
							if(data.success){
								swal('Selamat', data.msg, 'success');
								$('#grid_kec').bootstrapTable('refresh');
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