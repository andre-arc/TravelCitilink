<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="desktop-layout">
							<div class="empty-state-background">
								<div class="empty-state-wrapper" style="text-align: -moz-center;">
								<?php
									if($status == 'settlement'){
										?>
										<img src="<?php echo $this->config->item('asset_url') . 'assets/image/success_image.png' ?>
											" alt="" class="img-responsive" width="390px">
											<p class="title">Selamat, transaksi telah berhasil</p>
											<p class="caption noData">Bukti Pembayaran telah dikirim ke email anda.</p>
										</div>
										<?php
									}
								?>
							</div>
						</div>

					</div>
					<!-- /.box-body -->
				</div>
			</div>
			
		</div>
	</div>

</section>

<style>
	.no-data-wrapper {
		height: 100%;
		width: 100%;
		background-color: #fff;

	}

	.empty-state-wrapper {
		padding-left: 100px;
		padding-right: 100px;
	}

	.state-img {
		height: 303px;
		width: 100%;
		margin-bottom: 16px;
	}

	.title {

		color: #35405a;
		font-size: 18px;
		font-weight: 600;
		text-align: center;
	}

	.caption {

		margin-top: 12px;
		margin-bottom: 45px;
		font-size: 16px;
		color: #8a93a7;
		text-align: center;

	}
</style>