<?php if (count($ls_img)) : ?>


  <div id="crs-widget" class="carousel slide" data-ride="carousel" style="width: 100%;">

    <ol class="carousel-indicators">

      <?php foreach ($ls_img as $k => $v) : ?>

        <li data-target="#crs-widget" data-slide-to="<?php echo $k; ?>" class="<?php echo ($k == 0) ? 'active' : ''; ?>"></li>

      <?php endforeach; ?>

    </ol>



    <div class="carousel-inner" role="listbox">

      <?php foreach ($ls_img as $k => $v) : ?>

        <div class="item <?php echo ($k == 0) ? 'active' : ''; ?>">

          <img class="img-fluid" src="<?php echo $this->config->item('asset_url').'assets/image/slider/' ; ?><?php echo $v; ?>" style="width: 100%;" />

        </div>

      <?php endforeach; ?>

    </div>



    <a class="left carousel-control" href="#crs-widget" role="button" data-slide="prev">

      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>

      <span class="sr-only">Previous</span>

    </a>

    <a class="right carousel-control" href="#crs-widget" role="button" data-slide="next">

      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>

      <span class="sr-only">Next</span>

    </a>



  </div>

<?php else : ?>



<?php endif; ?>