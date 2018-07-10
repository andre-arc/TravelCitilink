<section class="content">
<?php
    $filter['0'] = '-- Pilih Filter';
    $filter['all'] = 'Semua';
    foreach ($cabangs as $cabang) {
        $filter[$cabang->id] = "$cabang->name";
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
                            <form role="form" id="form-export" method="POST" action="<?php echo base_url();?>/lookbook/report/proses_export">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Filter By</label>
                                    <?= form_dropdown('filter', $filter, null, 'id="filter" style="width:100%;" class="form-control"'); ?>
                                </div>
                            </div>
                            <div id="tglSection">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Periode</label>
                                        <input type="text" name="periode" id="periode" class='form-control'>
                                    </div>
                                </div>
                               
                            </div>
                           
                            <div class="col-md-12">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-primary pull-right">Export Data</button>
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
    
			$('#periode').datepicker({
			format: "MM yyyy",
		    viewMode: "months", 
		    minViewMode: "months",
			language: 'id'
		});
		// $('#periode').change(function(){
		// 	alert($('#periode').data("datepicker").getDate());
		// });

        $('#tgl_akhir').datepicker({
			format: 'dd/mm/yyyy',
			language: 'id'
		});
    
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