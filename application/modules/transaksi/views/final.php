<div class="container" style="padding:15px 15px;">
    <section class="content">
        <div class="row">
            <!--  <?php //include_once('count.php'); 
                    ?> -->
        </div>
        <!-- /.row -->
        <div class="row">
            <form role="form" id="form-detail" name="frm-wil-gp" method="POST" action="<?= base_url('transaksi/proses') ?>">

                <input type="hidden" name="act" id="act" value="" />
                <input type="hidden" name="detail_tiket" value='<?= json_encode($detail_tiket) ?>'>
                <input type="hidden" name="data_penumpang" value='<?= json_encode($data_penumpang) ?>'>
                <input type="hidden" name="pemesan" value='<?= json_encode($pemesan) ?>'>

                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading clearfix">
                            <span class="pull-left labelkonsumen">
                                &nbsp;Review Pesanan
                            </span>
                        </div>
                        <div class="panel-body">
                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">

                                    <address>
                                        <strong><?= $pemesan->nama_pemesan ?>.</strong><br>
                                        Phone: <?= $pemesan->no_hp ?><br>
                                        Email: <?= $pemesan->email ?>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col" style="text-align: end;">
                                    <br>
                                    <b>Payment Due:</b> 2/22/2014<br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <br>
                            <hr>
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Penumpang #</th>
                                            <th>Subtotal</th>
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
                                                <td><?= $p->deskripsi_penumpang ?> (x1)</td>
                                                <td><?= $p->harga ?></td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-center">


                            <?php
                            $total_hrg = 0;
                            foreach ($data_penumpang as $p) {
                                $total_hrg += $p->harga;
                            }
                            foreach ($detail_tiket as $t) {
                            ?>
                                <img src="<?= base_url("/assets/image/".$t->logo_kapal); ?>" alt="logo" height="100">
                                <br>

                                <strong><?= $t->dari . " - " . $t->tujuan ?> </strong><br>
                                Waktu : <?= $t->tgl_berangkat . ' ' . $t->waktu  ?> <br>
                                <hr>
                            <?php
                            }
                            ?>





                            <!-- <div class="box-body">
                                <strong>Harga</strong>

                                <p class="text-muted">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Dewasa (x1)
                                        </div>
                                        <div class="col-md-6">
                                            IDR 200000
                                        </div>
                                    </div>

                                </p>

                            </div> -->
                            <div class="name">
                                <span class="nametext pull-left">
                                    Total Pembayaran
                                </span>

                                <span class="harga">IDR <?= convertToRupiah($total_hrg) ?></span> <span class="satuan"></span>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="text-notice">Dengan menekan tombol, kamu menyetujui <span>Syarat &amp; Ketentuan</span> dari PT. KAI.</div>
                    <button type="submit" class="btn btn-warning margin pull-right">Lanjutkan Ke Pembayaran</button>
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-default margin pull-right">Edit</a>
                </div>
            </form>
        </div>

    </section>
</div>
<script>
    // $("select").select2();

    var no = 0;



    $(document).on('click', '.add-row', function() {

        ++no;

        var $table = $('#tabel-penumpang');

        var $lastTr = $table.find('tr:last');

        $table.find("select").select2("destroy");



        var $clone = $lastTr.clone(true);

        // $clone.find('input').not("input:disabled,input[type=hidden]").val("");



        $table.find('tbody').append($clone);

        $table.find("select").select2();



    });

    $(document).on('click', '.delete-row', function() {

        if (no > 0) {

            console.log(--no);

            $(this).closest('tr').remove();

        }

    });
</script>