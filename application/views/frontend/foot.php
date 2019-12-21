<div id="footer" class="main-footer bg-black" style="border-top:1px solid #000;">

    <div class="container">

        <div class="row">

            <div class="col-md-3">

                <div class="box box-success box-solid">

                    <div class="box-header">

                        <h3 class="box-title"><i class="fa fa-envelope"></i>&nbsp;Contact Us</h3>

                    </div>

                    <div class="box-body bg-white" style="color:#000 !important;">

                        <i class="fa fa-university"></i>&nbsp;

                        <a href="<?php echo $MYCFG['OFFICE']['URL']; ?>" target="_blank"><?php echo $MYCFG['OFFICE']['NAME']; ?></a>

                        <?php echo $MYCFG['OFFICE']['CITY']; ?><br />

                        <?php echo $MYCFG['OFFICE']['ADDRESS']; ?><br />

                        <?php echo $MYCFG['OFFICE']['CITY']; ?><br />

                        <i class="fa fa-phone-square"></i>&nbsp;<?php echo $MYCFG['OFFICE']['PHONE']; ?><br />

                        <i class="fa fa-fax"></i>&nbsp;<?php echo $MYCFG['OFFICE']['FAX']; ?><br />

                        <i class="fa fa-envelope"></i>&nbsp;Email :<br>

                        <?php echo $MYCFG['OFFICE']['MAIL']; ?>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <?php echo modules::run('home/widget/stat_hosting'); ?>

            </div>

            <div class="col-md-3">

                <?php echo modules::run('home/widget/stat_berita'); ?>

            </div>

            <div class="col-md-3">

                <?php echo modules::run('home/widget/link_app'); ?>

            </div>

        </div>

    </div>

</div>
<?php echo (isset($js)) ? $js : ''; ?>