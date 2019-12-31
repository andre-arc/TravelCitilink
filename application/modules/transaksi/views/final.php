
<section class="content">
      <div class="row">
       <!--  <?php //include_once('count.php'); ?> -->
      </div>
      <!-- /.row -->
	<div class="row">
    <form role="form" id="form-detail" name="frm-wil-gp" method="POST" action="<?= base_url('transaksi/proses') ?>">

        <input type="hidden" name="act" id="act" value="" />
        <input type="hidden" name="detail_tiket" value='<?= json_encode($detail_tiket) ?>'>
        <input type="hidden" name="data_penumpang" value='<?= json_encode($data_penumpang) ?>'>
        <input type="hidden" name="pemesan" value='<?= json_encode($pemesan) ?>'>

		<div class="col-md-12">
            <div class="panel">
                <div class="panel-heading bg-blue clearfix">
                    <span class="pull-left">
                        <i class="fa fa-plus-square"></i>&nbsp;FINALISASI TRANSAKSI 
                    </span>
                    <span class="pull-right">
                        <?php echo modules::run('acl/widget/group_org_user');?>
                    </span>
                 </div>
                <div class="panel-body">
                
					
                    Nama : <?= $pemesan->nama_pemesan ?>

                    <hr>
                    <?php
                         $total_hrg = 0;
                foreach ($detail_tiket as $t) {
                $total_hrg += $t->harga;
                ?>
                    Keberangkatan : <?= $t->kota_asal."(".$t->dari.")"." -> ".$t->kota_tujuan."(".$t->tujuan.")" ?> <br>
                    Waktu         : <?= $t->tgl_berangkat.' '.$t->waktu  ?> <br>
                    <hr>
                <?php
                }
                ?>

                    <br>
                    <div class="col-md-4">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penumpang</th>
                                <th>Jenis</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_penumpang as $p) {
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $p->nm_penumpang ?></td>
                                <td><?= $p->deskripsi_penumpang ?></td>
                            </tr>
                            <?php
                            $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="col-md-12">
                    <hr>
                    <span class="harga pull-right">IDR <?= convertToRupiah($total_hrg*count($data_penumpang)) ?></span>
                    </div>
                    
                </div>
                <div class="modal-footer"> 
                <button type="submit" class="btn btn-primary margin pull-right">Booking</button>
                <a href="<?= base_url('dashboard')?>" class="btn btn-primary margin pull-right">Batal</a>
               
                </div>
                	
            </div>
        
            </form>
        </div>

</section>
<script>
// $("select").select2();

    var no=0;



$(document).on('click', '.add-row', function () {

     ++no;           

    var $table = $('#tabel-penumpang');

    var $lastTr = $table.find('tr:last');    

    $table.find("select").select2("destroy");



    var $clone = $lastTr.clone(true);

    // $clone.find('input').not("input:disabled,input[type=hidden]").val("");

    

    $table.find('tbody').append($clone);

    $table.find("select").select2();

    

});

$(document).on('click', '.delete-row', function () {

if (no>0){

    console.log(--no);

    $(this).closest('tr').remove();

} 

});
</script>