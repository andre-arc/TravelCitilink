<?php

if(!empty($result)){
    $html;
    foreach ($result as $r) {
        ?>
        <div class="panel">
    <div class="panel-body">
        <div class="row">
                    <div class="col-md-12">
                       <div class="col-md-4">
                         <img src="https://2.bp.blogspot.com/-kcAFN1pdt2g/VgjjMoip7wI/AAAAAAAAItU/XOkXvNtFe1c/s1600/logo%2Bmaskapai%2Bpenerbangan%2Bcitilink%2Bindonesia.JPG" alt="logo" height="100">
                       </div>
                       <div class="col-md-4">
                         contoh penerbagan
                       </div>
                       <div class="col-md-4">
                        <span class="harga">IDR. '<?= convertToRupiah($r->harga) ?></span> /pax
                       </div>
                   

                        <div class="col-md-12">
                            <div class="form-group">
                               <button type="submit" class="btn btn-primary pull-right">DETAIL</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
    </div>
  </div>


<?php
    }
}else{
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
