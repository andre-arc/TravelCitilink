<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4><?= $mobil['0']->jmlMobil ?> Unit</h4>

              <p>Total Mobil</p>
            </div>
            <div class="icon">
              <i class="ion-android-car"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <?php
        if($this->session->userdata('user_group_name') == 'operator cabang'){
            ?>
         <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4><?= empty($kas['0']->jml_kas) ? 'Rp. 0' : 'Rp. '. number_format($kas['0']->jml_kas, 0, ',', '.') ?></h4>

              <p><?= $kas['0']->name ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
            <?php
        }
        else{
            ?>
         <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4><?= empty($kas['0']->jml_kas) ? 'Rp. 0' : 'Rp. '. number_format($kas['0']->jml_kas, 0, ',', '.') ?></h4>

              <p><?= $kas['0']->name ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h4><?= empty($kas['1']->jml_kas) ? 'Rp. 0' : 'Rp. '. number_format($kas['1']->jml_kas, 0, ',', '.') ?></h4>

              <p><?= $kas['1']->name ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h4><?= empty($kas['2']->jml_kas) ? 'Rp. 0' : 'Rp. '. number_format($kas['2']->jml_kas, 0, ',', '.') ?></h4>

              <p><?= $kas['2']->name ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
            <?php
        }
        ?>
       