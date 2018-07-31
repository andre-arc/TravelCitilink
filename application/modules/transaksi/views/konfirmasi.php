
<section class="content">
	<div class="panel">
		<div class="panel-heading bg-blue">
			<span class="<?php echo $tbl_icon;?>"></span>&nbsp;<?php echo $tbl_title;?>
			<span class="pull-right"><i class="fa fa-list"></i>&nbsp;Total : <span id="total_record" class="badge bg-black"></span> Records</span>
		</div>
		<div id="toolbar">
			<?php if($auth_meta['act']['add']):?>
			<button id="btn-add" name="btn-add" class="btn btn-primary btn-sm">
				<i class="fa fa-plus-circle"></i>&nbsp;Add New
			</button>
			<?php endif;?>
			<?php if($auth_meta['act']['edit']):?>
			<button id="btn-edit" name="btn-edit" class="btn btn-info btn-sm" disabled><i class="fa fa-pencil"></i> Edit</button>
			<?php endif;?>
			<?php if($auth_meta['act']['del']):?>
			<button id="btn-remove" name="btn-remove" class="btn btn-danger btn-sm" disabled><i class="fa fa-remove"></i> Delete</button>
			<?php endif;?>
			
		</div>
		<table id="grid_org"
					data-show-refresh="true"
          data-show-export="true"
          data-classes="table table-no-bordered table-responsive"
					
          data-pagination="true"
          data-id-field="id"
          data-page-list="[10, 25, 50, 100, ALL]"
          data-side-pagination="server"
					data-response-handler="responseHandler">
		</table>
	</div>
</section>

<div class="modal" id="mdl_org">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><span id="title_act"></span> <?php echo $tbl_title?></h4>
			</div>
			<form role="form" id="frm-org-mdl" name="frm-org-mdl" method="POST">
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
								<option value="bca">BCA</option>
								<option value="">MANDIRI</option>
								
							</select>
						</div>
						<div class="form-group">
							<label>Rekening Atas Nama</label>
							<input type="password" name="atas_nama" id="atas_nama" class="form-control" />
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
								<option value="">ATM</option>
								<option value="">SMS BANKING</option>

								
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
							<label>Pilih Transaksi</label>
							<select name="metode" class="form-control input-sm">
							<option value="0">-- Pilih Bandara --</option>
	                    	<?php foreach($cabang->result() as $row):?>
	                    		<option value="<?php echo $row->id_transaksi;?>">[<?php echo $row->kode_pnr;?>]</option>
	                    	<?php endforeach;?>
	                    </select>
      					</div>
					</div>
					
				</div>	
						
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i>&nbsp;Save Changes</button>
			</div>

			</form>
		</div>
	</div>	
</div>	


<script>
	var selections = [];
	var org_allowed = <?php echo json_encode($tree_org);?>;
	
  function responseHandler(res) {
		$.each(res.rows, function (i, row) {
			row.state = $.inArray(row.id, selections) !== -1;
		});
		return res;
  };
	
	function getRowSelections() {
    	return $.map($('#grid_org').bootstrapTable('getSelections'), function (row) {
			return row
		});
  	};
	
	function enable_btn(){
   		// $('#btn-add').prop("disabled",false);
   		$('#btn-edit').prop("disabled",false);
   		$('#btn-remove').prop("disabled",false);
	};
	
	function disable_btn(){
   		// $('#btn-add').prop("disabled",true);
   		$('#btn-edit').prop("disabled",true);
   		$('#btn-remove').prop("disabled",true);
	}
	
	$(document).ready(function(){		
	
		$('#grid_org').bootstrapTable({
				toolbar:'#toolbar',
				search:true,
				url: SITE_URL+'/acl/users/get_json/',
				singleSelect:false,
				pageSize: 10,
				pageList:"[5, 10, 20, 50, 100, 200]" ,
				columns: [
				{
					field: 'state',
					checkbox: true,
          			align: 'center',
          			valign: 'middle'
        		}, {
						field: 'id',
						valign:'center',
						title: 'ID'
				}, {
						field: 'username',
						title: 'USERNAME',
						valign:'center',
						sortable:true

				}, {
						field: 'email',
						valign:'center',
						title: 'EMAIL',
						sortable:true
				}, {
						field: 'first_name',
						title: 'FIRST NAME',
						valign:'center'
				}, {
						field: 'last_name',
						title: 'LAST NAME',
						valign:'center'
				}, {
						field: 'groups',
						title: 'GROUPS',
						valign:'center'
				}, {
						field: 'orgs',
						title: 'ORGS',
						valign:'center'
				}
				, {
						field: 'orgs_id',
						title: 'ORGS_ID',
						valign:'center',
						visible: false
				}, {
						field: 'groups_id',
						title: 'GROUPS_id',
						valign:'center',
						visible: false
				}, {
						field: 'company',
						title: 'company',
						valign:'center',
						visible: false
				}, {
						field: 'phone',
						title: 'phone',
						valign:'center',
						visible: false
				}

				],
				onLoadSuccess:function(e){
					$('#total_record').html(e.total);
					$('.fixed-table-pagination').addClass('panel-footer clearfix bg-gray-active');
				},
				onCheck:function(row){
					enable_btn();					
				},
				onUncheck:function(row){
					disable_btn();
				}
		});
	
		$('#btn-add').click(function(e){
			$('#frm-org-mdl').trigger("reset");

			$('.modal-header').removeClass('bg-teal');
			$('.modal-header').addClass('bg-blue');
			$('#title_act').html('<i class="fa fa-plus-circle"></i>&nbsp;Add');
			$('#act').val('add');

			$('#mdl_org').modal('show');
		});
	
		$('#btn-edit').click(function(e){
			$('.modal-header').removeClass('bg-blue');
			$('.modal-header').addClass('bg-teal');
			$('#title_act').html('<i class="fa fa-pencil"></i>&nbsp;Edit');
			$('#act').val('edit');

			//populate data
			var all_orgs='';
			var row=getRowSelections();
			$('#id').val(row[0].id);
			$('#username').val(row[0].username);
			$('#password').val('');
			$('#email').val(row[0].email);
			$('#first_name').val(row[0].first_name);
			$('#last_name').val(row[0].last_name);
			$('#company').val(row[0].company);
			$('#phone').val(row[0].phone);
			$('#groups').val(row[0].groups_id);
			$('#orgs').val(row[0].orgs_id);


		
			// var arr = row[0].groups_id.split(',');
			// $("#cgroups div.checkbox label input").each(function () {
   //      		clas = $(this).attr('id');
   //      		// a+= ($.trim(clas));
   //      		for(i=0; i<arr.length; i++){
   //      			if (($.trim(clas)) == ($.trim(arr[i]))) {
   //      				$(this).prop('checked','checked');
   //      			}
   //      		}
   //  		});
			// var a='';
   //  		var arr2 = row[0].orgs_id.split(',');
			// $("#corgs div.checkbox label input").each(function () {
   //      		clas = $(this).attr('id');
        		
   //      		for(i=0; i<arr2.length; i++){
   //      			a+=(clas+"=="+($.trim(arr2[i]))+",");
   //      			if (clas == ($.trim(arr2[i]))) {
   //      				$(this).prop('checked','checked');
   //      			}
   //      		}
   //  		});
    		// alert(a);
		
			$('#mdl_org').modal('show');
		});
		
		$('#btn-remove').click(function(){
				var r = confirm("Apakah anda yakin akan menghapus data tersebut !");
				if (r == true) {
					selections = getRowSelections();
					var mydata='id='+selections[0].id;
					
					$.ajax({
						type: "POST",
						url: SITE_URL+'/acl/users/del/',
						dataType: "json",
						data: mydata,
						success: function(data){
							if(data.resp){
								alert("Selamat,\n\r"+data.message);
								//location.reload();						
								$('#grid_org').bootstrapTable('refresh');
							}else{
								alert("Ada kesalahan.\n\r"+data.message);
							}
						}
					});
				} else {
				
				}			
		});
	
		$('#frm-org-mdl').submit(function(e){
			var form_data=$("#frm-org-mdl").serialize();
			var url_form = ($('#act').val()=='edit') ? SITE_URL+"/acl/users/edit/" : SITE_URL+"/acl/users/add/";
			
			$.ajax({
					type: "POST",
					url: url_form,
					dataType: "json",
					data: form_data,
					success: function(data){
						// alert(data);
						if(data.resp){
							alert("Selamat,\n\r"+data.message);
							$('#mdl_org').modal('hide');
							//location.reload();
							$('#grid_org').bootstrapTable('refresh');
							
						}else{
							alert("Ada kesalahan.\n\r"+data.message);
							// $('#mdl_org').modal('hide');
						}
					}
			});
			e.preventDefault();			
		});
	

	});
</script>
