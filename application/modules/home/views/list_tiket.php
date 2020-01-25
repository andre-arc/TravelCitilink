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
                                <div class="description-block border-right" style="font-size: 20px;">
                                    <span class="description-text" style="text-transform: unset;font-size: 12px;color:gray; ">Tanggal Keberangkatan</span>
                                    <h5 class="description-header">
                                        <?= longdate_indo($this->input->get('tgl_berangkat')); ?>
                                        <?= $this->input->get('tgl_kembali') ? longdate_indo($this->input->get('tgl_kembali')) : ''; ?></h5>
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

            <div class="col-md-12" id="list-tiket">

            </div>
    </section>

</div>


<script>
    var asal = getUrlParameter('asal').replace("+", " ");
    var tujuan = getUrlParameter('tujuan').replace("+", " ");
    var tgl_berangkat = getUrlParameter('tgl_berangkat');
    var tgl_kembali = getUrlParameter('pp') ? getUrlParameter('tgl_kembali') : "";
    var jmlTiket = 0;

    var adult = getUrlParameter('adult');
    var child = getUrlParameter('child');
    var infant = getUrlParameter('infant');

    function check() {
        var data = $('input.checked').map(function() {
            return $(this).val();
        });
        // console.log(data);

        // var form_data=$("#form-checkout").serialize();
        // console.log(form_data);
    }

    $(document).ready(function() {

        getDataTiket(asal, tujuan, tgl_berangkat);

        $('input.check').on('click', function() {
            $(this).toggleClass('checked')
        });

    })

    function getUrlParameter(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);

        if (results) {
            return results[1]
        } else {
            return 0;
        }
    };

    function getDataTiket(asal, tujuan, berangkat) {
        $.ajax({
            type: "POST",
            url: '<?= base_url('home/getJsonTiket') ?>',
            dataType: "html",
            data: {
                asal: asal,
                tujuan: tujuan,
                tgl_berangkat: berangkat,
                adult: adult,
                child: child,
                infant: infant,
            },
            success: function(data) {
                $("#list-tiket").html(data)

                $('.tiket_btn').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).attr('btn-id');

                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('home/selectTiket') ?>',
                        dataType: "json",
                        data: {
                            id_tiket: id,
                        },
                        success: function(data) {
                            if (getUrlParameter('pp')) {
                                if (jmlTiket >= 1) {
                                    $('#form-checkout').submit();
                                } else {
                                    jmlTiket++;
                                    getDataTiket(tujuan, asal, tgl_kembali);
                                }
                            } else {
                                if (jmlTiket == 0) {
                                    $('#form-checkout').submit();
                                }
                            }
                        }
                    });
                });
            }
        });
    }
</script>