<div class="login-box" style="box-shadow: 0 10px 20px 0 rgba(53,64,90,.2);padding-top: 10px;">
  <div class="login-logo">
    <a href="<?php echo site_url(); ?>">
      <h3>
        <font color="#798687"><b>TourisTIX - Access</b></font>
      </h3>
    </a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan Login</p>
    <form name="flogin" id="flogin" action="<?php echo site_url('usr/login/'); ?>" method="POST">
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Username" type="text" name="user_name" id="user_name" tabindex="1" />
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Password" type="password" name="user_password" id="user_password" tabindex="2" />
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

        </div>
        <div class="col-xs-4">

          <button type="submit" class="btn btn-success btn-block btn-flat" tabindex="3">
            &nbsp;Login
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#flogin').submit(function(e) {
      var form_data = $(this).serialize();

      console.log(form_data);
      $.ajax({
        type: "POST",
        url: SITE_URL + '/usr/login/json_login/',
        data: form_data,
        dataType: 'JSON',
        success: function(data) {
          if (data.result) {
            window.location.replace(SITE_URL + "dashboard/");
          } else {
            alert(data.msg);
          }
        }
      });


      e.preventDefault();
    });
  })
</script>