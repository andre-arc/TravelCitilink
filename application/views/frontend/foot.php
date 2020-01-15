<div id="footer" class="main-footer bg-white" style="border-top:1px solid #fff;">
    <div class="container-fluid">
        <div class="container footer-commons">
            <div class="row py-5">
                <div class="col-sm-6 col-md-3 order-sm-0 order-md-0"> <img src="<?php echo base_url('/assets/image/logo.png'); ?>" width="196px" data-original="" class="lazy " alt="" style="display: inline;">
                    <noscript>
                        <img src='<?php echo base_url('/assets/image/logo.png'); ?>' class='noscript noscript-img ' alt='' />
                    </noscript> </div>
                <div class="col-sm-12 col-md-6 order-sm-2 order-md-1">
                    <div class="row" style="padding-top: 19px;">
                        <div class="col-sm-4 col-xs-12">
                            <dl>
                                <dt class="text-muted">PERUSAHAAN</dt>
                                <dd><a href="#">Tentang Kami</a></dd>
                                <dd><a href="https://medium.com/@touristixid">Blog</a></dd>

                            </dl>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <dl>
                                <dt class="text-muted">PROGRAM</dt>
                                <dd><a href="http://touristix.id/#">Event</a></dd>
                                <dd><a href="http://touristix.id/#">Job</a></dd>
                                <dd><a href="http://touristix.id/#">Rewards</a></dd>
                            </dl>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <dl>
                                <dt class="text-muted">SUPPORT</dt>
                                <dd><a href="#">Bantuan</a></dd>
                                <dd><a href="<?= base_url('/help-center'); ?>">FAQ</a></dd>
                                <dd><a href="<?= base_url('/consultation'); ?>">Hubungi Kami</a></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<footer>
    <div class="container-fluid gray-bg border-top">
        <div class="container">
            <div class="row py-3">
                <div class="col-sm-6"><small>copyright © <?php echo date("Y"); ?> - TourisTIX Group. All rights reserved.</small></div>
                <div class="col-sm-6 text-right"><a style="margin-right: 1.5rem !important;" href="#" class="mr-4">Terms</a> <a href="#">Privacy</a></div>
            </div>
        </div>
    </div>
</footer>
<?php echo (isset($js)) ? $js : ''; ?>
<style>
    .py-5 {
        padding-bottom: 3rem !important;
        padding-top: 25px;
    }

    dt {
        font-weight: 700;
        margin-bottom: 0.8rem !important;
        padding-bottom: 10px;
    }

    dl {
        margin-top: 0;
        margin-bottom: 1rem;
        padding-bottom: 10px;
    }

    dd a {
        color: #3d3d3d !important;
        font-size: 0.9em !important;
    }

    dd {
        padding-bottom: 10px;
    }
</style>