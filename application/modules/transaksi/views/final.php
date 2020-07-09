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
                <input type="hidden" name="detail_harga" value='<?= json_encode($detail_harga) ?>'>
                <input type="hidden" name="data_penumpang" value='<?= json_encode($data_penumpang) ?>'>
                <input type="hidden" name="pemesan" value='<?= json_encode($pemesan) ?>'>
                <input type="hidden" name="tipe_transaksi" value='<?= $tipe_transaksi ?>'>

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


                                    <blockquote>
                                        <strong style="letter-spacing: 3px;line-height: -2px;"><?= $pemesan->nama_pemesan ?></strong><br>
                                        <p style="font-size: 14px;color: grey;letter-spacing: 1px;"> Phone: <?= $pemesan->no_hp ?><br>
                                        </p>
                                    </blockquote>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col" style="text-align: end;">
                                    <br>
                                    <small> Email: <cite style="letter-spacing: 2px;" title="<?= $pemesan->email ?>"> <?= $pemesan->email ?></cite></small>

                                </div>
                                <!-- /.col -->
                            </div>
                            <br>
                            <hr>
                            <div class="col-xs-12 table-responsive">
                                <span class="pull-left labelkonsumen">
                                    &nbsp;Detail Penumpang
                                </span>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Penumpang </th>
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

                                <span class="pull-left labelkonsumen">
                                    &nbsp;Detail Harga Tiket
                                </span>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tiket</th>
                                            <th>Harga </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($detail_harga as $d) {
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= ucwords($d->jenis_penumpang)." (".$d->jml_penumpang."x)" ?></td>
                                                <td><?= convertToRupiah($d->harga) ?></td>
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
                            foreach ($detail_harga as $d) {
                                $total_hrg += $d->harga;
                            }
                            foreach ($detail_tiket as $t) {
                            ?>
                                <img src="<?= $this->config->item('asset_url')."assets/image/" . $t->logo_kapal; ?>" alt="logo" height="100">
                                <br>
                                <strong><?= $t->jenis_tiket ?></strong><br>
                                <strong><?= $t->dari . " - " . $t->tujuan ?> </strong><br>
                                Waktu : <?= $t->tgl_berangkat . ' ' . $t->waktu  ?> <br>

                            <?php
                            }

                            //biaya admin
                            $total_hrg += 8000;
                            ?>





                            <div class="tax-section">
                                <div class="tax-title">Biaya lainnya</div>
                                <div class="row text-tax">
                                    <div class="pull-left">Pajak</div>
                                    <div class="pull-right">Termasuk</div>
                                </div>
                                <div class="row text-tax">
                                    <div class="pull-left"> Biaya layanan penumpang</div>
                                    <div class="pull-right text-uppercase"> <?= convertToRupiah(8000) ?></div>
                                </div>
                            </div>
                            <hr>
                            <div class="name">
                                <span class="tax-title pull-left">
                                    Total
                                </span>

                                <span class="harga pull-right"><?= convertToRupiah($total_hrg) ?></span> <span class="satuan"></span>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="text-notice">Dengan menekan tombol, kamu menyetujui <span><a style="color:#4141ac;font-weight: bold;" type="button" data-toggle="modal" data-target="#myModal">
                                Syarat & Ketentuan
                            </a></span> dari TourisTix.id</div>
                    <button type="submit" class="btn btn-warning btn-lg margin pull-right ">Lanjutkan Ke Pembayaran</button>
                </div>
            </form>
        </div>

    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Syarat & Ketentuan</h4>
            </div>
            <div class="modal-body" style="color: grey;">
                <!-- wp:list {"ordered":true} -->
                <ol>
                    <li>Permohonan pembatalan
                        dapat dilakukan di laman touristix.id atau loket pelabuhan
                        selambat-lambatnya 24 Jam sebelum jadwal keberangkatan Kapal sebagaimana
                        tercantum dalam tiket yang telah dibeli dengan dikenakan bea pembatalan
                        sebesar 25%.</li>
                    <li>Permohonan pembatalan
                        kurang dari 24 jam sebelum jadwal keberangkatan kapal maka tiket hangus,
                        tidak ada pengembalian bea</li>
                    <li>Pengembalian bea tiket
                        yang dibatalkan dilakukan secara tunai di pelabuhan yang ditunjuk atau
                        ditransfer ke rekening pemohon pembatalan dengan biaya transfer ditanggung
                        TourisTix.id pada hari ke-30 sampai dengan hari ke-60 setelah permohonan
                        pembatalan.</li>
                    <li>Pembatalan yang
                        diakibatkan tidak terselenggaranya angkutan karena alasan operasional,
                        maka bea tiket di luar bea pesan dikembalikan penuh secara tunai.</li>
                    <li>Permohonan perubahan
                        jadwal dapat dilakukan di pelabuhan, selambat-lambatnya 24 jam sebelum
                        jadwal keberangkatan kapal sebagaimana tercantum dalam tiket yang telah
                        dibeli dengan dikenakan bea perubahan jadwal sebesar 25%.</li>
                    <li>Perubahan jadwal dapat
                        dilakukan terhadap kapal dengan tingkat tarif yang sama atau lebih tinggi,
                        jika dilakukan terhadap kapal dengan tingkat tarif lebih rendah, maka
                        tidak ada pengembalian bea.</li>
                    <li>Larangan pengangkutan
                        diperuntukkan bagi orang dalam keadaan mabuk dan orang yang dapat
                        mengganggu atau membahayakan penumpang lain, orang yang dihinggapi
                        penyakit menular, atau orang yang menurut undang-undang dapat dikenakan
                        peraturan pengasingan untuk kesehatannya</li>
                </ol>
                <!-- /wp:list -->

            </div>

        </div>
    </div>
</div>

<script>
    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').focus()
    })
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