<section class="content">
<?php
    $filter['0'] = '-- Pilih Kode PNR';
    //$filter['all'] = 'Semua';
    foreach ($pnr as $p) {
        $filter[$p->id_tiket] = "$p->kode_pnr [$p->dari ke $p->tujuan] - $p->waktu & $p->tgl_berangkat";
    }

/*$filter = array(
            0 => '-- Pilih Filter --',
            'all' => 'Semua',
            'sparepart' => 'Sparepart',
            'mobil' => 'Mobil'
            );*/
    
?>
<div class="row">
		<div class="col-md-6">
			<div class="panel">
				<div class="panel-heading bg-blue clearfix">
					<span class="pull-left">
						<i class="fa fa-plus-square"></i>&nbsp;Export <?php echo $title;?>
					</span>
					<span class="pull-right">
						<?php echo modules::run('acl/widget/group_org_user');?>
					</span>
				</div>
				<div class="panel-body">
				    <div class="row">
                        <div class="col-md-12">
                            <form role="form" id="form-export" method="POST" action="<?php echo base_url();?>/lookbook/laporanmaskapai/proses_export">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Filter By</label>
                                    <?= form_dropdown('filter', $filter, null, 'id="filter" style="width:100%;" class="form-control"'); ?>
                                </div>
                            </div>
                          <!--  <div id="tglSection">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Mulai</label>
                                        <input type="text" name="tgl_mulai" id="tgl_mulai" class='form-control'>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Akhir</label>
                                        <input type="text" name="tgl_akhir" id="tgl_akhir" class='form-control'>
                                    </div>
                                </div>
                            </div> -->
                           
                            <div class="col-md-12">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-primary pull-right">Generate</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
function resetAll(){
    $('#tglSection').hide();
    $('#mobilSection').hide();
}    
    
$(document).ready(function(){
        resetAll();
        $('#filter').select2();
    
			$('#tgl_mulai').datepicker({
            format: 'dd/mm/yyyy',
            language: 'id'
        });
        $('#tgl_akhir').datepicker({
            format: 'dd/mm/yyyy',
            language: 'id'
        });
    
		// $('#periode').change(function(){
		// 	alert($('#periode').data("datepicker").getDate());
		// });

        
    
        $('#filter').change(function(){
            resetAll();
            $('#tglSection').show();
            if( $('#filter').val() == 'mobil'){
                $('#mobilSection').show();
                $('#mobil').select2();
            }
        });    
    
		$('#form-export').submit(function(e){
            filter = $('#filter').val();
                if(filter == 0){
                    alert('Filter harus di pilih');
                    e.preventDefault();
                }
				
			});
	});
</script>