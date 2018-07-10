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
                            <form role="form" id="form-export" method="POST" action="<?php echo base_url();?>/lookbook/report/proses_export">
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label>Keberangkatan</label>
                                  <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label>Jenis Penerbangan</label>
                                  <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label>Rute Berangkat</label>
                                  <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label>Rute Kembali</label>
                                  <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                  </select>
                                </div>
                            </div>
                           
                           
                            <div class="col-md-12">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-primary pull-right">Search</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
        </div>
      </div>
    </div>
  </div>