<div class="container" style="padding:15px 15px; background-color:#FFF !important;">
      <section class="content">
            <div class="row">
                  <div class="col-md-12">
                  <?php
                        if(!empty($result)){
                            echo "<form action='".base_url('transaksi/checkout')."' method='GET' id='form-checkout'>";
                            echo form_hidden('choose', '');

                            foreach ($result as $r) {
                                ?>
                                <div class="panel">
                            <div class="panel-body">
                                <div class="row">
                                            <div class="col-md-12">
                                            <div class="col-md-4">
                                                <img style="margin-left: 10%;" src="https://2.bp.blogspot.com/-kcAFN1pdt2g/VgjjMoip7wI/AAAAAAAAItU/XOkXvNtFe1c/s1600/logo%2Bmaskapai%2Bpenerbangan%2Bcitilink%2Bindonesia.JPG" alt="logo" height="100">
                                            </div>
                                            <div class="col-md-4 detail-tiket" >
                                                [<?= $r->dari."-".$r->tujuan ?>]
                                                <br>
                                                <span class="waktu">
                                                Keberangkatan : <?= $r->dari."-".$r->tujuan ?>
                                                <br>
                                                Tanggal Berangkat : <?= $r->tgl_berangkat ?>
                                                </span>
                                            </div>
                                            <div class="col-md-2">
                                                <span class="harga">IDR <?= convertToRupiah($r->hrg_tiket) ?></span>
                                            </div>

                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-success btn-lg tiket_btn" btn-id="<?= $r->id_tiket ?>">PILIH</button>
                                            </div>
                                                
                                                </form>
                                            </div>
                                        </div>
                            </div>

                        


                        <?php
                            }
                            echo form_close();
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
                  </div>

            </div>
      </section>

</div>


<script>

    function check(){
        var data = $('input.checked').map(function(){
             return $(this).val();
        });
        // console.log(data);
        
        // var form_data=$("#form-checkout").serialize();
        // console.log(form_data);
    }

    $(document).ready(function(){
        $('input.check').on('click', function(){
            $(this).toggleClass('checked')
        });
        
        $('.tiket_btn').click(function(e){
            e.preventDefault();
            $('input[name="choose"]').val($(this).attr('btn-id'));
            $('#form-checkout').submit();
        });

    })

    

</script>
