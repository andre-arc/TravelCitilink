<div class="container" style="padding:15px 15px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-text" style="text-transform: unset;font-size: 12px;color:gray;">Asal</span>
                                    <h5 class="description-header"><?= $this->input->get('asal'); ?> </h5>

                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-text" style="text-transform: unset;font-size: 12px;color:gray; ">Tujuan</span>
                                    <h5 class="description-header"><?= $this->input->get('tujuan'); ?></h5>

                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right" style="font-size: 20px;padding-top: 6px;">
                                    <h5 class="description-header"><?= $this->input->get('tgl_berangkat'); ?> <?= $this->input->get('tgl_kembali'); ?></h5>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block">
                                    <a href="<?= base_url(); ?>" type="button" class="btn btn-block btn-warning">Ubah Pencarian</a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>

            <div class="col-md-12">
                <?php
                if (!empty($result)) {
                    echo "<form action='" . base_url('transaksi/checkout') . "' method='GET' id='form-checkout'>";
                    echo form_hidden('choose', '');

                    foreach ($result as $r) {
                ?>
                        <div class="panel" style="margin-bottom: 7px;">
                            <div class="modal-header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4 class="list-title">
                                            <span id="title_act"></span> Jenis Kapal <i class="fa fa-angle-down"></i></h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h4 class="list-title">
                                            <span id="title_act"></span> Waktu Berangkat <i class="fa fa-angle-down"></i></h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="list-title">
                                            <span id="title_act"></span> Rute Keberangkatan <i class="fa fa-angle-down"></i></h4>
                                    </div>
                                    <div class="col-md-3">
                                        <h4 class="list-title" style="text-align: left">
                                            <span id="title_act"></span> Harga <i class="fa fa-angle-down"></i></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3" style="text-align: center;">
                                            <img style="margin-left: 10%;margin-top: -22px;margin-bottom: -18px;" src="<?php echo base_url('/assets/image/' . $r->logo_kapal); ?>" alt="<?= $r->nama_kapal; ?>">
                                            <h4><?= $r->nama_kapal; ?></h4>
                                            <h5 class="text-center">Executive</h5>
                                        </div>
                                        <div class="col-md-2 time">
                                            <span>
                                                <?= $r->waktu  ?>
                                                <br>

                                            </span>
                                        </div>
                                        <div class="col-md-4 detail-tiket">

                                            <?= $r->dari . " <i class='fa  fa-angle-right'></i> " . $r->tujuan ?>
                                            <br>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="row" style="padding-top: 45px;">
                                                <div class="col-sm-6 col-xs-6">
                                                    <div class="harga">
                                                        <span><?= convertToRupiah($r->hrg_tiket) ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-6">
                                                    <div class="hrgbutton">
                                                        <button type="button" class="btn btn-info tiket_btn pull-right" btn-id="<?= $r->id_tiket ?>">Pilih</button>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>



                                        </form>
                                    </div>
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