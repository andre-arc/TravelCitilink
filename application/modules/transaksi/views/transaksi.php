<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading bg-blue clearfix">
					<span class="pull-left">
						<i class="<?php echo $icon; ?>"></i>&nbsp;Data <?php echo $title; ?>
						<span class="badge mybg-white"><span id="total_record"></span>&nbsp;Total Records</span>
					</span>
					<span class="pull-right">
						<?php echo modules::run('acl/widget/group_org_user'); ?>
					</span>
				</div>
				<table id="grid_kec" class="table table-hover" data-show-refresh="true" data-classes="table table-no-bordered" data-pagination="true" data-id-field="id" data-page-list="[10, 25, 50, 100, ALL]" data-side-pagination="server">
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

		</div>
	</div>
</div>

<script>
	var selections = [];

	function getRowSelections() {
		return $.map($('#grid_kec').bootstrapTable('getSelections'), function(row) {
			return row;
		});
	}

	$(document).ready(function() {

		$('select').select2();

		$('#grid_kec').bootstrapTable({
			pagination: true,
			search: true,
			pageSize: 10,
			url: SITE_URL + 'admin/transaksi/get_json/',
			singleSelect: true,
			sortOrder: "desc",
			columns: [{
					field: 'state',
					checkbox: true,
					align: 'center',
					valign: 'middle'
				},
				{
					field: 'kode',
					title: 'Kode Transaksi',
					sortable: true
				},
				{
					field: 'tgl_transaksi',
					title: 'Tanggal Transaksi',
					class: 'col-md-1',
					halign: 'center',
					sortable: true
				},
				{
					field: 'total_hrg',
					title: 'Total Harga',
					halign: 'center',
					sortable: true
				},
				{
					field: 'tipe_bayar',
					title: 'Payment',
					halign: 'center',
					sortable: true
				},
				{
					field: 'status_bayar',
					title: 'Status',
					halign: 'center',
					sortable: true,

					formatter: function(value) {
						switch (value) {
							case 'expired':
								color = 'bg-red';
								break;
							case 'success':
								color = 'bg-yellow';
								break;
							case 'pending':
								color = 'bg-green';
								break;
							default:
								color = 'bg-white';
								break;
						}
						return '<span class="label ' + color + '">' + value.toUpperCase(); + '</span>';
					}

				},
				{
					field: 'id_transaksi',
					title: 'Tools',
					halign: 'center',
					sortable: true,
					formatter: function(value) {
						return "<div class='text-center'><a href='" + SITE_URL + "/transaksi/detail/" + value + "' class='btn btn-primary margin'>Detail</a></div>";
					}
				}
			],
			onLoadSuccess: function(e) {
				$('#total_record').html(e.total);
				$('.fixed-table-pagination').addClass('panel-footer clearfix bg-gray-active');
			}
		});

		<?php if ($auth_meta['add']) : ?>
			$('#btn-add').click(function(e) {
				$('#frm-wil-gp').trigger("reset");
				$('#id_tiket').val('').trigger("change");
				$('.modal-header').removeClass().addClass("modal-header").addClass("mybg-primary");
				$('#title_act').html('<i class="fa fa-plus-circle"></i>&nbsp;Form Add');
				$('#act').val('add');

				$('#myModal').modal('show');
				e.preventDefault();
			});

		<?php endif; ?>

		<?php if ($auth_meta['edit']) : ?>

			$('#btn-edit').click(function(e) {
				var rowSel = getRowSelections();
				if (rowSel.length) {
					$('#frm-wil-gp').trigger("reset");
					$('.modal-header').removeClass().addClass("modal-header").addClass("mybg-info");
					$('#title_act').html('<i class="fa fa-pencil"></i>&nbsp;Form Edit');
					$('#act').val('edit');
					//alert(rowSel[0].jenis_unit);
					//load row
					$('#id').val(rowSel[0].id_tiket);
					$('#kode_pnr').val(rowSel[0].kode_pnr);
					$('#tgl_berangkat').val(rowSel[0].tgl_berangkat);
					$('#waktu').val(rowSel[0].waktu);
					$('#dari').val(rowSel[0].dari).trigger('change');
					$('#tujuan').val(rowSel[0].tujuan).trigger('change');
					$('#maskapai').val(rowSel[0].maskapai).trigger('change');
					$('#jml_seat').val(rowSel[0].jml_seat);
					$('#harga').val(rowSel[0].harga);




					$('#myModal').modal('show');
				} else {
					swal('Silahkan memilih record yang akan diedit terlebih dulu.');
				}
				e.preventDefault();
			});
		<?php endif; ?>

		<?php if (($auth_meta['add']) || ($auth_meta['edit'])) : ?>
			$('#frm-wil-gp').submit(function(e) {
				var form_data = $("#frm-wil-gp").serialize();
				var url_form = ($('#act').val() == 'edit') ? SITE_URL + "/tiket/act_edit/" : SITE_URL + "/tiket/act_add/";
				$.ajax({
					type: "POST",
					url: url_form,
					dataType: "json",
					data: form_data,
					success: function(data) {
						if (data.success) {
							swal('Selamat', data.msg, 'success');
							$('#myModal').modal('hide');
							$('#grid_kec').bootstrapTable('refresh');
						} else {
							swal('Ada kesalahan.', data.msg, 'error');
							$('#myModal').modal('hide');
						}
					}
				});
				e.preventDefault();
			});

			$('#nm_barang').change(function() {
				var noPlat = $('#nm_barang').val() || null;
				var tempPlat = $('#nama').val() || null;
				var tempUrl = SITE_URL + "/barang/cek_nama/" + noPlat;

				if (noPlat != tempPlat) {
					$.ajax({
						type: "POST",
						url: tempUrl,
						dataType: "html",
						data: 'form_data',
						success: function(data) {
							$("#cek-nama").html(data);
						}
					});
				} else {
					$("#cek-nama").html("");
				}
			});
		<?php endif; ?>

		<?php if ($auth_meta['del']) : ?>
			$('#btn-del').click(function(e) {
				var rowSel = getRowSelections();
				if (rowSel.length) {
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
					}).then(function() {
							$.ajax({
								type: "POST",
								url: SITE_URL + "/tiket/act_del/",
								dataType: "json",
								data: {
									id_tiket: rowSel[0].id_tiket
								},
								success: function(data) {
									if (data.success) {
										swal('Selamat', data.msg, 'success');
										$('#grid_kec').bootstrapTable('refresh');
									} else {
										swal('Ada kesalahan.', data.msg, 'error');
									}
								}
							});
						},
						function(dismiss) {})
				} else {
					swal('Silahkan memilih record yang akan dihapus terlebih dulu.');
				}
				e.preventDefault();
			});
		<?php endif; ?>
	});
</script>