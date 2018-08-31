
<section class="content">
<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><span id="title_act"></span> <?php echo $tbl_title?></h4>
			</div>
			<form role="form" id="frm-confirm" name="frm-org-mdl" method="POST">
			<div class="modal-body">
				<input type="hidden" name="id" id="id" value="" />
				<input type="hidden" name="act" id="act" value="" />
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Bank Tujuan</label>
							<select name="bank_tujuan" class="form-control input-sm">
								<option value="123322131231">BCA - a/n PT.Ubudiyah Travel</option>
								<option value="332434333432">MANDIRI - a/n PT.Ubudiyah Travel</option>
								
								
							</select>
						</div>
						<div class="form-group">
							<label>Bank Anda</label>
							<select name="bank_anda" class="form-control input-sm">
								<option value="BCA">BCA</option>
								<option value="MANDIRI">MANDIRI</option>
								
							</select>
						</div>
						<div class="form-group">
							<label>Rekening Atas Nama</label>
							<input type="text" name="atas_nama" id="atas_nama" class="form-control" />
						</div>
					</div>
					<div class="col-md-6" >
						<div class="form-group">
							<label>Tanggal Tranfers</label>
							<input type="date" name="tgl_tranfers" id="tgl_tranfers" class="form-control" />
						</div>

						
						<div class="form-group">
							<label>Metode</label>
							<select name="metode" class="form-control input-sm">
								<option value="ATM">ATM</option>
								<option value="SMS BANKING">SMS BANKING</option>

								
							</select>
						</div>
						<div class="form-group">
							<label>Nominal</label>
							<input type="text" name="nominal" id="nominal" class="form-control" />
						</div>
      					
					</div>
				</div>
				
				<hr>
				
				<div class="row">
					<div class="col-md-12">
					<div class="form-group" id="cgroups">
							<label>Kode Transaksi</label>
							<input type="text" class="form-control" name="kode_transaksi" placeholder="Masukkan Kode Transaksi">
      					</div>
					</div>
					
				</div>	
						
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;Save Changes</button>
			</div>

			</form>
		</div>
</section>


<script>
	
  function responseHandler(res) {
		$.each(res.rows, function (i, row) {
			row.state = $.inArray(row.id, selections) !== -1;
		});
		return res;
  };
	
	
		$('#frm-confirm').submit(function(e){
			var form_data=$("#frm-confirm").serialize();
			var url_form = SITE_URL+"/home/konfirmasi/add/";
			
			$.ajax({
					type: "POST",
					url: url_form,
					dataType: "json",
					data: form_data,
					success: function(data){
						// alert(data);
						if(data.success){
							alert("Selamat,\n\r"+data.msg);
							$('#mdl_org').modal('hide');
							//location.reload();
							
						}else{
							alert("Ada kesalahan.\n\r"+data.msg);
							// $('#mdl_org').modal('hide');
						}
					}
			});
			e.preventDefault();			

	});
</script>
