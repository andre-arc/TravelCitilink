<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <h4>Cari Tiket Kapal Express Penyeberangan Banda Aceh - Sabang</h4>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form role="form" id="form-search" method="GET" action="<?php echo base_url() . "home/search"; ?>">
              <div class="row">
                <div class="col-md-3">

                  <div class="form-group">
                    <label>Dari:</label>
                    <?= form_dropdown('asal', $pelabuhan, '0', ' class="form-control search"') ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Ke:</label>
                    <?= form_dropdown('tujuan', $pelabuhan, '0', ' class="form-control search"') ?>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Tanggal Berangkat</label>
                    <input id="tgl_berangkat" class="form-control search" type="text" name="tgl_berangkat" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input id="tgl_kembali" class="form-control search" type="text" name="tgl_kembali" autocomplete="off">
                    <input type="checkbox" type="text" name="pp" id="pp"> Kembali
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group" style="padding-top: 4px;">
                    <label></label>
                    <div class="box box-default collapsed-box  penumpang ">
                      <div class="box-header with-border">
                        <h4 class="box-title" data-widget="collapse" style="font-size: 15px;">Penumpang</h4>

                        <div class="box-tools pull-right">
                          <button data-widget="collapse" type="button" class="btn btn-box-tool"><i class="fa fa-chevron-down"></i>
                          </button>
                        </div>
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-5">
                              <label class="nmpnmg">Dewasa</label>
                            </div>
                            <div class="col-md-7">
                              <div class="input-group">
                                <input class="form-control" type="number" value="1" type="text" name="adult" min="0">
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr style="margin: 10px 0px 10px 0px;">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-5">
                              <label class="nmpnmg">Anak</label>
                            </div>
                            <div class="col-md-7">
                              <div class="input-group">
                                <input class="form-control" type="number" value="0" type="text" name="child" min="0">
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr style="margin: 10px 0px 10px 0px;">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-5">
                              <label class="nmpnmg">Bayi</label>
                            </div>
                            <div class="col-md-7">
                              <div class="input-group">
                                <input class="form-control" type="number" value="0" type="text" name="infant" min="0">
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <!-- /.box-body -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <button type="submit" class="btn btn-info pull-right margin search-b">Cari Tiket</button>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    var tomorrow = new Date().getDate() + 1;
    var options = {
      format: 'yyyy-mm-dd',
      todayHighlight: false,
      autoclose: true,
      daysOfWeekDisabled: '0',
      daysOfWeekHighlighted: '0',
      language: 'id',
      locale: 'id',
      startDate: "+1d"
    };

    $(document).ready(function() {
      $("#tgl_kembali").attr('readonly', true);
      $('#asal').select2();
      $('#tujuan').select2();
      $('#tgl_berangkat').datepicker(options);
    });

    $('#checkout').hide();

    $('#pp').change(function() {
      if ($(this).is(":checked")) {
        $("#tgl_kembali").attr('readonly', false);
        $('#tgl_kembali').datepicker(options);
      } else {
        $("#tgl_kembali").attr('readonly', true);
        $('#tgl_kembali').datepicker('update', '');
        $('#tgl_kembali').datepicker('destroy');
      }
    });

    // $('#form-search').submit(function(e) {
    //   var form_data = $("#form-search").serialize();

    //   $.ajax({
    //     type: "POST",
    //     url: "",
    //     dataType: "json",
    //     data: form_data,
    //     success: function(data) {
    //       if (data.status) {
    //         $('#list-tiket').html(data.html);
    //       }
    //     }
    //   });


    //   e.preventDefault();
    // });
  </script>