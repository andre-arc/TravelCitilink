<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><span id="title_act"></span> Check Tiket</h4>
					</div>
					<form role="form" id="frm-confirm" name="frm-org-mdl" method="POST">
						<div class="modal-body">


							<div class="form-group">
								<input type="text" placeholder="Alamat Email" name="email" id="email" class="form-control" />
							</div>
							<div class="form-group">
								<input type="text" placeholder="Order ID" name="atas_nama" id="orderid" class="form-control" />
							</div>

						</div>
						<div class="modal-footer">
							<button class="btn btn-info" type="submit">Cek Pesanan</button>
						</div>

					</form>
				</div>

			</div>
			<div class="col-md-8">
				<div class="box">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="desktop-layout">
							<div class="empty-state-background">
								<div class="empty-state-wrapper" style="text-align: -moz-center;">
									<img src="<?php echo $this->config->item('asset_url') . 'assets/image/checktiket.jpg' ?>
									" alt="" class="img-responsive" width="390px">
									<p class="title">Cek pesanan dengan mudah</p>
									<p class="caption noData">Masukkan alamat email dan order ID di form cek pesanan.</p>
								</div>
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