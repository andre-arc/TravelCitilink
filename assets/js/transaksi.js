var no=0;

$(document).on('click', '.add-row', function () {
     ++no;           
    var $table = $('#tabel');
    var $lastTr = $table.find('tr:last');    
    $table.find("select").select2("destroy");

    var $clone = $lastTr.clone(true);
    $clone.find('input').not("input:disabled,input[type=hidden]").val("");
    
    $table.find('tbody').append($clone);
    $table.find("select").select2();
    
});

$(document).on('click', '.delete-row', function () {
    if (no>0){
        console.log(--no);
        $(this).closest('tr').remove();
    } 
});

$(document).on('change', 'select.kd-brg', function () {
    var $select  = $(this);
    var kdBrg  = $select.val();
    var url  = SITE_URL+"/barang/get_json";
     $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                success: function(result){
                    $rows = result['rows'];
                    $.each($rows, function(){
                       if(this['id_barang'] == kdBrg){
                           $select.closest('tr').find('input.merk').val(this['merk']);
                           $select.closest('tr').find('input.satuan').val(this['satuan_barang']);
                           return false;
                    }
                    });                    
                   
                }
            });
});

$(document).on('change', 'select.pakai-stok', function () {
    var $select  = $(this);
    var pakai  = $select.val();
    sumber = $select.closest('tr').find('input.sumber');
    if(pakai == '1'){
        sumber.val('gudang').prop('disabled', true);
        sumber.after($("<input/>", {type: 'hidden',name: 'sumber[]',value: 'gudang'}));
    }else{
        sumber.val('').prop('disabled', false);
        sumber.next().remove();
    }
});


function resetAll(){
   // $('select').select2('val', '0');
    $('#detail-kat').remove();
    $("#detail-form").html('');
};

function getForm(){
     var url  = SITE_URL+"/transaksi/get_form/detail_form";
     var kat_transaksi   = $('#kat_transaksi').val() || null;
     var kat_detail      = $('#kat-detail').val() || null;
     var data = {kat:kat_transaksi,kat_detail:kat_detail};
     $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: data,
                success: function(result){
                   if(result.status == true){
                        var html = '<table id="tabel" class="table table-striped table-condensed table-hover"><thead style="background-color: #dadada;"<tr>'+ result.head +'</tr></thead><tbody>'+ result.body +'</tbody></table><button type="button" class="btn btn-primary btn-md add-row">Tambah Data <i class="fa fa-plus"></i></button>';
                        $("#detail-form").html(html);
                        $('#tabel').find("select").select2();
                   }
                }
            });
};