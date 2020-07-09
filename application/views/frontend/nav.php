<header class="main-header">
	<nav class="navbar navbar-static-top" style="background-color: #fff;">
		<div class="container" style="margin-bottom: 10px;margin-top: 10px;">
			<div class="navbar-header">
				<a href="<?php echo site_url(); ?>" class="navbar-brand" data-html="true">
					<img src="<?php echo $this->config->item('asset_url') . 'assets/image/logo.png' ?>" width="130px" style="margin-top: -6px;" alt="">
				</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>

			<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<ul class="nav navbar-nav">

					<li class="menu-label">
						<a href="https://touristix.id/" class="dropdown-toggle" data-toggle="dropdown">
							TOUR TRAVEL
						</a>
					</li>
					<li>
						<a class="menu-label" href="<?php echo site_url('#'); ?>">
							TIKET KAPAL
						</a>
					</li>
					<li>
						<a class="menu-label" href="#">
							RENTAL MOBIL
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							LAINNYA
						</a>

					</li>


				</ul>

			</div>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li>
						<div class="btn-group" style="padding:7px;">
							<a href="<?php echo site_url('home/konfirmasi/'); ?>" class="btn btn-warning active"> CEK ORDER
							</a>
						</div>
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