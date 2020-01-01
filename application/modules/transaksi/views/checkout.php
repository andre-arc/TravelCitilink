
<section class="content">
      <div class="row">
       <!--  <?php //include_once('count.php'); ?> -->
      </div>
      <!-- /.row -->
	<div class="row">
    <form role="form" id="form-detail" name="frm-wil-gp" method="POST" action="<?= base_url('transaksi/final') ?>">
		<div class="col-md-8">
            <div class="panel">
                <div class="panel-heading bg-blue clearfix">
                    <span class="pull-left">
                        <i class="fa fa-plus-square"></i>&nbsp;DATA PEMESAN 
                    </span>
                    <span class="pull-right">
                        <?php echo modules::run('acl/widget/group_org_user');?>
                    </span>
                 </div>
                <div class="panel-body">
                
					<input type="hidden" name="act" id="act" value="" />
                    <input type="hidden" name="detail_tiket" value='<?= json_encode($detail_tiket) ?>'>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Nama Pemesan</label>
								<input class="form-control" type="text" name="nm_pemesan" required>
							</div>
						</div>
					</div>
			
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">No Telp</label>
								<input class="form-control" type="text" name="no_hp" required>
							</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Email</label>
								<input class="form-control" type="email" name="email" required>
							</div>
						</div>
					</div>
			
					
                </div>
            </div>

             <div class="panel">
                <div class="panel-heading bg-blue clearfix">
                    <span class="pull-left">
                        <i class="fa fa-plus-square"></i>&nbsp;DATA PENUMPANG 
                    </span>
                    <span class="pull-right">
                        <?php echo modules::run('acl/widget/group_org_user');?>
                    </span>
                 </div>
                <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                    <button class="btn btn-primary pull-right add-row">Tambah Penumpang</button>
                    </div>
                </div>
                <br>


                    <table class="table table-hover" id="tabel-penumpang">
                        <tbody>
                            <tr>
                                <input type="hidden" class="harga-tiket" name="hrg_tiket[]" value="">
                                <td>
                                <div class="form-group">
                                    <input placeholder="Nama Penumpang" name="nm_penumpang[]" class="form-control" type="text" require>
                                </div>
                                </td>
                                <td>
                                <div class="form-group">
                                    <?= form_dropdown('penumpang[]', $jenis_penumpang, '0', 'class="form-control kewarganegaraan penumpang" require')?>
                                </div>
                                </td>
                                <td><button type='button' class='btn btn-primary delete-row'><i class='fa fa-times'></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading bg-blue clearfix">
                    <span class="pull-left">
                        <i class="fa fa-plus-square"></i>&nbsp;DETAIL TICKET 
                    </span>
                    <span class="pull-right">
                        <?php echo modules::run('acl/widget/group_org_user');?>
                    </span>
                 </div>
                <div class="panel-body text-center">
                <img style="" src="https://2.bp.blogspot.com/-kcAFN1pdt2g/VgjjMoip7wI/AAAAAAAAItU/XOkXvNtFe1c/s1600/logo%2Bmaskapai%2Bpenerbangan%2Bcitilink%2Bindonesia.JPG" alt="logo" height="100">
                <br>
                <?php
                $total_hrg = 0;
                foreach ($detail_tiket as $t) {
                $total_hrg += $t->hrg_tiket;
                ?>
                    Keberangkatan : <?= $t->kota_asal."(".$t->dari.")"." -> ".$t->kota_tujuan."(".$t->tujuan.")" ?> <br>
                    Waktu         : <?= $t->tgl_berangkat.' '.$t->waktu  ?> <br>
                    <hr>
                <?php
                }
                ?>
                <br>

               <span class="harga">IDR <?= convertToRupiah($total_hrg) ?></span> <span class="satuan">/pax</span>
               <hr>
               <button type="submit" class="btn btn-block btn-lg btn-primary">LANJUTKAN</button>
                </div>
            </div>
		</div>
        </form>
	</div>
</section>
<script>
// $("select").select2();

    var no=0;
$(document).on('click', '.add-row', function (e) {

     ++no;           

    var $table = $('#tabel-penumpang');

    var $lastTr = $table.find('tr:last');    

    $table.find("select").select2("destroy");



    var $clone = $lastTr.clone(true);


     $clone.find('input').not("input:disabled,input[type=hidden]").val("");

    

    $table.find('tbody').append($clone);

    $table.find("select").select2();

    
    e.preventDefault();

});

$(document).on('click', '.delete-row', function () {

if (no>0){

    console.log(--no);

    $(this).closest('tr').remove();

} 

});

$(document).ready(function(){
    var $table = $('#tabel-penumpang');

    $table.find("select").on('change', function (e) {
        var id_tiket = <?= $detail_tiket[0]->id_tiket ?>;
        var jenis_penumpang = e.target.value;
        $.ajax({
            type: "POST",
            url: '<?= base_url('transaksi/getHarga') ?>',
            dataType: "json",
            data: {id:id_tiket, jenis:jenis_penumpang},
            success: function(data){
               console.log($(e).closest('tr'));
            }
        });
    });
})
</script>