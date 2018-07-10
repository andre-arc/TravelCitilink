<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo site_url();?>"><i class="fa fa-newspaper-o"></i>&nbsp;<b>INONG</b>&nbsp;2.0</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Reset/Forgot Password</p>
    <form name="f_forgot" id="f_forgot" action="<?php echo site_url('acl/forgot/');?>" method="POST">
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Email" type="text" name="email_address" id="email_address" tabindex="1" />
        <span class="fa fa-envelope-open-o form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
					<a href="<?php echo site_url('acl/login/');?>" class="btn btn-danger btn-flat" tabindex="4">
						<i class="fa fa-question-circle"></i>&nbsp;Back to Login Form
					</a>
        </div>
        <div class="col-xs-6">
          <button type="submit" class="btn btn-success btn-block btn-flat" tabindex="3">
						<i class="fa fa-power-off"></i>&nbsp;Reset Password
					</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
$(document).ready(function(){
})
</script>