<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('dashboard/');?>" class="logo">
      <span class="logo-mini">
				<b><?php echo substr($MYCFG['GENERAL']['APP_NAME'],0,1);?></b><?php echo $MYCFG['GENERAL']['VERSION'];?>
			</span>
      <span class="logo-lg"><b><?php echo $MYCFG['GENERAL']['APP_NAME'];?></b><?php echo $MYCFG['GENERAL']['VERSION'];?></span>
    </a>

    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle Nav</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
								
					<li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="user-image"><i class="fa fa-user-circle-o"></i></span>
              <span class="hidden-xs"><?php echo $_SESSION['username'];?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
								<i class="fa fa-user-circle-o" style="font-size:60px;color:#FFF;"></i>
                <p>
                  <?php echo $_SESSION['username']?><br/>
									(<?php echo $_SESSION['email'];?>)
                  <small><i class="fa fa-tag"></i>&nbsp;<?php echo $_SESSION['user_group_name']?>- <i class="fa fa-university"></i>&nbsp;<?php echo $_SESSION['user_org_name'];?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-info btn-flat"><i class="fa fa-power-off"></i>&nbsp;Profile Akun</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('acl/login/logout/');?>" class="btn btn-danger btn-flat"><i class="fa fa-power-off"></i>&nbsp;Log Out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
      <!-- Sidebar user panel -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
					<i class="fa fa-user-circle-o" style="font-size:30px;color:#FFF;"></i>
        </div>
        <div class="pull-left info">
          <p>
						<?php //echo $_SESSION['username']?><br/>
						<small><i class="fa fa-tag"></i>&nbsp;<?php// echo $_SESSION['user_group_name']?>- <i class="fa fa-university"></i>&nbsp;<?php //echo $_SESSION['user_org_name'];?></small>						
					</p>
        </div>
      </div> -->

      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
				<?php foreach($menus as $k=>$v):?>
							<?php if(isset($v['children'])) : ?>
								<li class="treeview">
									<a href="#">
										<i class="<?php echo $v['iconCls'];?>"></i>
										<span><?php echo $v['text'];?></span>&nbsp;<i class="fa fa-angle-left pull-right"></i>
									</a>
                  <ul class="treeview-menu">
										<?php foreach($v['children'] as $key=>$val):?>
										<li>
											<a href="<?php echo site_url($val['url']);?>" data-html="true" data-toggle="tooltip" data-placement="right" title="<?php echo $val['remark'];?>">
												<i class="<?php echo $val['iconCls'];?>"></i>&nbsp;<?php echo $val['text'];?>
											</a>
										</li>
										<?php endforeach;?>										
									</ul>
								</li>
							<?php else:?>
								<li>
									<a href="<?php echo ($v['url']=='#')? '#': site_url($v['url']);?>" data-html="true" data-toggle="tooltip" data-placement="right" title="<?php echo $v['remark'];?>">
										<i class="<?php echo $v['iconCls'];?>"></i>&nbsp;<span><?php echo $v['text'];?></span>
									</a>						
								</li>
							<?php endif; ?>
				
				<?php endforeach;?>
				<li class="header">DOCUMENTATION</li>
        <li><a href="<?php echo base_url('manual.pdf');?>" target="_blank"><i class="fa fa-circle-o text-aqua"></i> <span>Manual Book</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>