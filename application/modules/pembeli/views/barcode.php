<style>
	.input-lg {
	    height: 46px;
	    padding: 10px 16px;
	    font-size: 18px;
	    line-height: 1.33;
	    border-radius: 6px;
	}
	.select2-container--default .select2-selection--single {
	    height: 46px;
	    padding: 10px 16px;
	    font-size: 18px;
	    line-height: 1.33;
	    border-radius: 6px;
	}
	.select2-container--default .select2-selection--single .select2-selection__arrow b {
	    top: 85%;
	}
	.select2-container--default .select2-selection--single .select2-selection__rendered {
	    line-height: 22px;
	}
	.select2-container--default .select2-selection--single {
	    border: 1px solid #CCC;
	box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
	transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	}
</style>
<br>

<section>
	
		<div class="col-md-12">
			<div class="panel">
				<div class="row">
					<div class="col-xs-8">
						<?php

							$select_pembeli[] = '-- Pilih No KK ---';

							foreach ($kk as $v){
								$select_pembeli[$v->no_kk] = $v->no_kk;
							}

							echo form_dropdown('nomor_kk[]',$select_pembeli,null, 'class="form-control select2-container input-lg step2-select" id="inputlg" style="width:100%;" required');

						?>
					</div>
					<div class="col-xs-4">
						<button type="submit" id='btn-cari' class="btn btn-lg btn-info btn-block"> Cari</button>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div id="result">
						
					</div>
				</div>
			</div>
		</div>
		</div>
		
		
		
</section>

<script>
	$('select').select2();

	function cari(){
		var no_kk = $('#inputlg').val() || null;

		var url_form = SITE_URL+"/pembeli/barcode/act_search/";
		$.ajax({
			type:"POST",
			url: url_form,
			dataType: "html",
			data:{kode:no_kk},
			success: function(data){
				$("#result").html(data);
			}
		});
	}


	$("#btn-cari").click(function(){
		cari();
	});


	$("#input-lg").keydown(function (e){
		if(e.keyCode === 13){
			cari();
		}
	});

	$("#inputlg").change(function(e){
		cari();
	});
</script>