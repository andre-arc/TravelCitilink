<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><span id="title_act"></span> Check Tiket</h4>
					</div>
					<form role="form" id="frm-confirm" name="frm-org-mdl" action="" method="GET">
						<div class="modal-body">


							<div class="form-group">
								<input type="text" placeholder="Alamat Email" name="email" id="email" class="form-control" />
							</div>
							<div class="form-group">
								<input type="text" placeholder="Order ID" name="orderId" id="orderid" class="form-control" />
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
								<?php
									if(empty($detail_transaksi)){
										?>
										<img src="<?php echo $this->config->item('asset_url') . 'assets/image/checktiket.jpg' ?>
											" alt="" class="img-responsive" width="390px" style="display:block;margin:auto;">
											<p class="title">Cek pesanan dengan mudah</p>
											<p class="caption noData">Masukkan alamat email dan order ID di form cek pesanan.</p>
										</div>
										<?php
									}else{
										?>
										  <div class="row invoice-info">
										  <div class="col-sm-6 invoice-col">
												Customer:
												<address>
													<strong><?= $pemesan->nama_customer ?></strong><br>
													Phone: <?= $pemesan->hp ?><br>
													Email: <?= $pemesan->email ?>
												</address>
										   </div>
										   <div class="col-sm-6 invoice-col">
												<b>Order ID:</b> <?= $detail_transaksi->kode ?><br>
												<b>Tanggal Pemesanan:</b> <?= $detail_transaksi->tgl_transaksi ?><br>
												<b>Status:</b> <?= $detail_transaksi->status_bayar ?>
											</div>
										</div>
										<hr>
										<div class="col-xs-12 table-responsive">
											<span class="pull-left labelkonsumen">
												&nbsp;Detail Keberangkatan
											</span>
											<table class="table table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Tiket </th>
														<th>Rute </th>
														<th>Tanggal </th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													foreach ($detail_tiket as $t) {
													?>
														<tr>
															<td><?= $no ?></td>
															<td><?= 'Tiket Kapal '.$t->nama_kapal.' '.$t->jenis_tiket ?></td>
															<td><?= $t->dari.' <i class="fa fa-fw fa-arrow-right"></i> '.$t->tujuan ?></td>
															<td><?= date_indo($t->tgl_berangkat).' '.$t->waktu ?></td>
														</tr>
													<?php
														$no++;
													}
													?>
												</tbody>
											</table>
											<span class="pull-left labelkonsumen">
												&nbsp;Detail Penumpang
											</span>
											<table class="table table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama</th>
														<th>Penumpang </th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													foreach ($data_penumpang as $p) {
													?>
														<tr>
															<td><?= $no ?></td>
															<td><?= $p->nama_penumpang ?></td>
															<td><?= $p->jenis_penumpang ?></td>
														</tr>
													<?php
														$no++;
													}
													?>
												</tbody>
											</table>

											<span class="pull-left labelkonsumen">
												&nbsp;Detail Harga Tiket
											</span>
											<table class="table table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Tiket</th>
														<th>Harga </th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													foreach ($detail_harga as $d) {
													?>
														<tr>
															<td><?= $no ?></td>
															<td><?= ucwords($d->jenis_penumpang)." (".$d->jml_penumpang."x)" ?></td>
															<td><?= convertToRupiah($d->total_hrg) ?></td>
														</tr>
													<?php
														$no++;
													}
													?>
												</tbody>
											</table>
										</div>
										
										<div class="col-sm-12 invoice-col">
										<hr>
											<strong class="pull-right">Total Pembayaran : <?= convertToRupiah($total_harga) ?></strong>
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