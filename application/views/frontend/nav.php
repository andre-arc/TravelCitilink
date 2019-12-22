<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a href="<?php echo site_url(); ?>" class="navbar-brand" data-html="true" data-toggle="tooltip" data-placement="bottom" title="<?php echo $MYCFG['GENERAL']['APP_NAME_LONG'] . '<br />Ver.' . $MYCFG['GENERAL']['VERSION']; ?>">
					<b>
						<i class="fa fa-newspaper-o"></i>&nbsp;<?php echo $MYCFG['GENERAL']['APP_NAME']; ?>
					</b>
					<?php echo $MYCFG['GENERAL']['VERSION']; ?>
				</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>

			<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="<?php echo site_url('#'); ?>">
							<i class="fa fa-university"></i>&nbsp;KAPAL
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bar-chart"></i>&nbsp; Hotel
						</a>

					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bar-chart"></i>&nbsp; Tour
						</a>

					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bar-chart"></i>&nbsp; Event
						</a>

					</li>


				</ul>
				<!--form class="navbar-form navbar-left" role="search" method="POST" action="<?php //echo site_url('news/search/');
																								?>">
					<div class="form-group">
						<input type="text" class="form-control" name="keywords" id="keywords" placeholder="Keywords Search">
					</div>
					<button type="submit" class="btn btn-default" style="background-color:#000;color:#FFF;"><i class="fa fa-search"></i>&nbsp;Search</button>
				</form-->
			</div>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li>
						<?php if ($this->ion_auth->logged_in()) : ?>
							<a href="<?php echo site_url('dashboard/'); ?>"><i class="fa fa-cogs"></i>&nbsp;Dashboard</a>
						<?php else : ?>
							<a href="<?php echo site_url('acl/login/'); ?>"><i class="fa fa-power-off"></i>&nbsp;Login</a>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>