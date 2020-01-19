<header class="main-header">
	<nav class="navbar navbar-static-top" style="background-color: #fff;">
		<div class="container" style="margin-bottom: 10px;margin-top: 10px;">
			<div class="navbar-header">
				<a href="<?php echo site_url(); ?>" class="navbar-brand" data-html="true">
					<img src="<?php echo $this->config->item('asset_url').'assets/image/logo.png' ?>" width="120px" style="margin-top: -6px;" alt="">
				</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>

			<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li>
						<a class="menu-label" href="<?php echo site_url('#'); ?>">
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
						<a href="<?php echo site_url('home/konfirmasi/'); ?>">&nbsp;CEK ORDER</a>
					</li>
					<li>
						<?php if ($this->ion_auth->logged_in()) : ?>
							<a href="<?php echo site_url('dashboard/'); ?>"><i class="fa fa-cogs"></i>&nbsp;Dashboard</a>
							<?php // else : 
							?>
							<!-- <a href="<?php // echo site_url('acl/login/'); 
											?>">&nbsp;Login</a> -->
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>