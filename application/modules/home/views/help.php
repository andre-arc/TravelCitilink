<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="box box-solid">
                    <div class="box-header" style="text-align: center;padding-top: 30px;padding-bottom: 30px;">
                        <h3>Pertanyaan Umum</h3><br>
                        <p>Berikut ini pertanyaan umum yang sering ditanyakan kepada kami, <br> mungkin salah satunya adalah pertanyaan yang ingin kamu tanyakan.</p>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding-left: 20px;padding-right: 20px;">
                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel">
                                <div class="box-header box box-warning box-solid">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Apakah touristix.id menerima pembayaran dengan mata uang asing?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        Ya. Untuk pembayaran secara online atau kartu kredit, kami menerima pembayaran dari semua mata uang asing. Untuk setiap pembayaran yang menggunakan mata uang asing akan terkonversi ke dalam mata uang rupiah.
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="box-header box box-warning box-solid ">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Apakah metode pembayaran dapat diganti ?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="box-body">
                                        Kamu dapat mengubah metode bayar sebelum melakukan pembayaran
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="box-header box box-warning box-solid">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Apakah saya perlu melakukan konfirmasi ke touristix.id apabila telah melakukan pembayaran?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="box-body">
                                        Tidak perlu. Jika e-ticket/voucher sudah kamu terima dengan baik, kamu tidak perlu menghubungi kami kembali. Kecuali, jika ada kendala terkait e-ticket/voucher yang belum kamu diterima, atau ada kendala lainnya yang membutuhkan bantuan kami.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="text-center space--sm bg--dark">
                        <div class="container">
                            <h3>Apakah kamu masih punya pertanyaan lain?</h3>
                            <a href="https://api.whatsapp.com/send?phone=6285292789158&text=Hallo%20TourisTix.id" target="_blank"><img alt="Tombol WhatsApp" src="<?php echo $this->config->item('asset_url') . 'assets/image/button-wa.png' ?>"></a>
                        </div>
                        <br><br>
                    </section>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>

</section>

<style>
    .no-data-wrapper {
        height: 100%;
        width: 100%;
        background-color: #fff;

    }

    .empty-state-wrapper {
        padding-left: 100px;
        padding-right: 100px;
    }

    .state-img {
        height: 303px;
        width: 100%;
        margin-bottom: 16px;
    }

    .title {

        color: #35405a;
        font-size: 18px;
        font-weight: 600;
        text-align: center;
    }

    .caption {

        margin-top: 12px;
        margin-bottom: 45px;
        font-size: 16px;
        color: #8a93a7;
        text-align: center;

    }
</style>