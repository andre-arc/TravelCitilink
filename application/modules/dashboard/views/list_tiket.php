<?php
if(!empty($result)){
    echo form_open('transaksi/checkout', 'id="form-checkout"');

    foreach ($result as $r) {
        ?>
        <div class="panel">
    <div class="panel-body">
        <div class="row">
                    <div class="col-md-12">
                       <div class="col-md-4">
                       <input style="margin-top: 18%;float:left;" class="check" type="checkbox" name='id_tiket[]' value="<?= $r->id_tiket ?>">
                        <br>
                         <img style="margin-left: 10%;" src="https://2.bp.blogspot.com/-kcAFN1pdt2g/VgjjMoip7wI/AAAAAAAAItU/XOkXvNtFe1c/s1600/logo%2Bmaskapai%2Bpenerbangan%2Bcitilink%2Bindonesia.JPG" alt="logo" height="100">
                       </div>
                       <div class="col-md-4 detail-tiket" >
                         [<?= $r->dari."-".$r->tujuan ?>]
                        <br>
                         <span class="waktu">
                         Keberangkatan : <?= $r->dari."-".$r->tujuan ?>
                         <br>
                         Waktu : <?= $r->waktu ?>
                         <br>
                         Tanggal Berangkat : <?= $r->tgl_berangkat ?>
                         </span>
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
<script>

    function countCheckbox(){
        var countCheckedCheckboxes = $('input.checked').length
        // alert(countCheckedCheckboxes);
            if(countCheckedCheckboxes > 0){
                $('#checkout').show();
            }else{
                $('#checkout').hide()
            }
    }

    function check(){
        var data = $('input.checked').map(function(){
             return $(this).val();
        });
        // console.log(data);
        $('#form-checkout').submit();
        // var form_data=$("#form-checkout").serialize();
        // console.log(form_data);
    }

    $(document).ready(function(){
        $('input.check').on('click', function(){
            $(this).toggleClass('checked')
           countCheckbox();
        });

    })

    

</script>
