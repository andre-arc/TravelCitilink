<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a href="<?php echo site_url(); ?>" class="navbar-brand" data-html="true">
					<b>TourisTIX</b>
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
							KAPAL
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							TOUR
						</a>

					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							EVENT
						</a>

					</li>


				</ul>

			</div>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li>
						<a href="<?php echo site_url('home/konfirmasi/'); ?>">&nbsp;Cek Order</a>
					</li>
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