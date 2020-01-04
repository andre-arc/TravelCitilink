<div class="container" style="padding:15px 15px;>
    <section class=" content">
    <div class="row">
        <div class="col-md-12">

            <?php
            if (!empty($result)) {
                echo "<form action='" . base_url('transaksi/checkout') . "' method='GET' id='form-checkout'>";
                echo form_hidden('choose', '');

                foreach ($result as $r) {
            ?>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="page-header">
                                        Banda Aceh - Sabang
                                        <small class="pull-right"> Tanggal Berangkat : <?= $r->tgl_berangkat ?></small>
                                    </h2>
                                    <div class="col-md-3" style="text-align: center;">
                                        <img style="margin-left: 10%;margin-top: -22px;margin-bottom: -18px;" src="<?php echo base_url('/assets/image/expressbahari.png'); ?>" alt="logo">
                                        <h4><?= $r->kapal; ?></h4>
                                        <h5 class="text-center">Executive</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="time">
                                            <?= $r->waktu  ?>
                                            <br>

                                        </span>
                                    </div>
                                    <div class="col-md-4 detail-tiket">
                                        [<?= $r->dari . "-" . $r->tujuan ?>]
                                        <br>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="harga">
                                            <span><?= convertToRupiah($r->hrg_tiket) ?></span>
                                        </div>

                                        <div class="hrgbutton">
                                            <button type="button" class="btn btn-info btn-lg tiket_btn pull-right" btn-id="<?= $r->id_tiket ?>">PILIH</button>
                                        </div>
                                    </div>



                                    </form>
                                </div>
                            </div>
                        </div>




                    <?php
                }
                echo form_close();
            } else {
                    ?>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    Tidak ada Data
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }

                ?>
                    </div>

        </div>
        </section>

    </div>


    <script>
        function check() {
            var data = $('input.checked').map(function() {
                return $(this).val();
            });
            // console.log(data);

            // var form_data=$("#form-checkout").serialize();
            // console.log(form_data);
        }

        $(document).ready(function() {
            $('input.check').on('click', function() {
                $(this).toggleClass('checked')
            });

            $('.tiket_btn').click(function(e) {
                e.preventDefault();
                $('input[name="choose"]').val($(this).attr('btn-id'));
                $('#form-checkout').submit();
            });

        })
    </script>