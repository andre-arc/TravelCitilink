<div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading bg-blue clearfix">
          <span class="pull-left">
            <i class="fa fa-plus-square"></i>&nbsp;SEARCH TICKET 
          </span>
          <span class="pull-right">
            <?php echo modules::run('acl/widget/group_org_user');?>
          </span>
        </div>

        <div class="panel-body">
            <div class="row">
                        <div class="col-md-12">
                            <form role="form" id="form-search"  method="POST" action="#">
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label>Dari:</label>
                                  <?= form_dropdown('asal', $bandara, '0', 'id="asal" class="form-control"')?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label>Ke:</label>
                                  <?= form_dropdown('tujuan', $bandara, '0', 'id="tujuan" class="form-control"')?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label>Tanggal Berangkat</label>
                                 <input id="tgl_berangkat" class="form-control" type="text" name="tgl_berangkat">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label>Tanggal Kembali</label>
                                <input id="tgl_kembali" class="form-control" type="text" name="tgl_kembali">
                                <input type="checkbox" type="text" name="pp"> Kembali
                                </div>
                            </div>
                           
                           
                            <div class="col-md-12">
                                <div class="form-group">
                                 <button id="checkout" type="button" onclick="check()" class="btn btn-primary pull-right margin">CHECKOUT</button>
                                   <button type="submit" class="btn btn-primary pull-right margin">SEARCH</button> 
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
        </div>
      </div>
    </div>

    <div class="col-md-12" id="list-tiket">

    </div>
  <script>

$('#checkout').hide();

$('#form-search').submit(function(e){
var form_data=$("#form-search").serialize();

$.ajax({
  type: "POST",
  url: "<?php echo base_url()."dashboard/search"; ?>",
  dataType: "json",
  data: form_data,
  success: function(data){
    if(data.status){
      $('#list-tiket').html(data.html);
    }
  }
});

e.preventDefault();
});

  </script>
    
      