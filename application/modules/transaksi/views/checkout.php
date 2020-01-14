<div class="container" style="padding:15px 15px;">
    <section class="content">
        <div class="row">
            <!--  <?php //include_once('count.php'); 
                    ?> -->
        </div>
        <!-- /.row -->
        <div class="row">
            <form role="form" id="form-detail" name="frm-wil-gp" method="POST" action="<?= base_url('transaksi/finalisasi') ?>">
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading clearfix">
                            <span class="pull-left labelkonsumen">&nbsp;Detail Pemesan
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
                                        <div class="info-list-autocomplete">Seperti di KTP/Paspor/SIM (tanpa tanda baca dan gelar).</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input class="form-control" type="email" name="email" required>
                                        <p class="info-list-autocomplete">Detail pemesanan akan kami kirim ke email ini.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Nomor Ponsel</label>
                                        <input class="form-control" type="text" name="no_hp" required>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading clearfix">
                            <span class="pull-left labelkonsumen">
                                &nbsp;Detail Penumpang
                            </span>
                        </div>
                        <div class="panel-body">
                        <?php
                            $count_penumpang = 0;

                            foreach($jenis_penumpang as $jp){
                                for ($i=0; $i < $jml_penumpang[$jp->nama] ; $i++) { 
                                    $count_penumpang++;

                                    ?>
                                    <h4>Penumpang <?= $count_penumpang ?> : <?= $jp->nama?></h4>
                                        <input type="hidden" class="harga-tiket" name="hrg_tiket[]" value="">
                                        <input type="hidden" class="harga-tiket" name="penumpang[]" value="<?= $jp->id ?>">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Nama Lengkap</label>
                                                <input placeholder="Nama Penumpang" name="nm_penumpang[]" class="form-control" type="text" require>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            
                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-center">
                            <?php
                            $total_hrg = 0;
                            foreach ($detail_tiket as $t) {
                                $total_hrg += $t->hrg_tiket;
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

                            <span class="harga">IDR <?= convertToRupiah($total_hrg) ?></span> <span class="satuan">/pax</span>
                            <hr>
                            <button type="submit" class="btn btn-block btn-lg btn-info">LANJUTKAN</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script>
    // $("select").select2();

    var no = 0;
    $(document).on('click', '.add-row', function(e) {

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

    $(document).on('click', '.delete-row', function() {

        if (no > 0) {

            console.log(--no);

            $(this).closest('tr').remove();

        }

    });

    $(document).ready(function() {
        var $table = $('#tabel-penumpang');

        $table.find("select").on('change', function(e) {
            var id_tiket = <?= $detail_tiket[0]->id_tiket ?>;
            var jenis_penumpang = e.target.value;
            var select = $(this);
            $.ajax({
                type: "POST",
                url: '<?= base_url('transaksi/getHarga') ?>',
                dataType: "json",
                data: {
                    id: id_tiket,
                    jenis: jenis_penumpang
                },
                success: function(data) {
                    select.closest('tr').find(".harga-tiket").val(data)
                    $("span.harga").text(getTotalHrg())
                }
            });
        });
    })

    function getTotalHrg() {
        var total = 0;
        $(".harga-tiket").map(function() {
            total += parseInt($(this).val());
        });

        return formatRupiah(total.toString(), 'Rp. ');
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>