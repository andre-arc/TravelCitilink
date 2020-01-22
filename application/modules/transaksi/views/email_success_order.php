<mjml>
<mj-body background-color="#ccd3e0" font-size="13px">
<mj-section background-color="#fff" padding-bottom="20px" padding-top="20px">
<mj-column width="100%">
<mj-image src="https://storage.googleapis.com/touristix.appspot.com/assets/image/logo.png" alt="" align="center" border="none" width="180px" padding-left="0px" padding-right="0px" padding-bottom="1px" padding-top="10px"></mj-image>
<mj-text align="center" color="#000" font-size="13px" font-family="Helvetica" padding-left="25px" padding-right="25px" padding-bottom="30px" padding-top="0px">
<br/>
<span style="font-size:15px">www.touristix.id</span></mj-text>
</mj-column>
</mj-section>
<mj-section background-color="#356cc7" padding-bottom="0px" padding-top="0">
<mj-column width="100%">
<mj-text align="center" font-size="13px" color="#ABCDEA" font-family="Ubuntu, Helvetica, Arial, sans-serif" padding-left="25px" padding-right="25px" padding-bottom="18px" padding-top="28px">HELLO
<p style="font-size:16px; color:white"><?= $nama_customer ?></p>
</mj-text>
</mj-column>
</mj-section>
<mj-section background-color="#356cc7" padding-bottom="5px" padding-top="0">
<mj-column width="100%">
<mj-divider border-color="#ffffff" border-width="2px" border-style="solid" padding-left="20px" padding-right="20px" padding-bottom="0px" padding-top="0"></mj-divider>
<mj-text align="center" color="#FFF" font-size="13px" font-family="Helvetica" padding-left="25px" padding-right="25px" padding-bottom="28px" padding-top="28px"><span style="font-size:20px; font-weight:bold">Mohon segera selesaikan
pembayaran Anda.</span>
<br/>
<span style="font-size:15px" padding-top="18px">Checkout berhasil pada tanggal <?= $tgl_transaksi ?> </span></mj-text>
</mj-column>
</mj-section>
<mj-section background-color="#568feb" padding-bottom="15px">
<mj-column>
<mj-text align="center" color="#FFF" font-size="15px" font-family="Ubuntu, Helvetica, Arial, sans-serif" padding-left="25px" padding-right="25px" padding-bottom="0px"><strong>Order Number</strong></mj-text>
<mj-text align="center" color="#FFF" font-size="13px" font-family="Helvetica" padding-left="25px" padding-right="25px" padding-bottom="20px" padding-top="10px"><?= $order_id ?></mj-text>
</mj-column>
<mj-column>
<mj-text align="center" color="#FFF" font-size="15px" font-family="Ubuntu, Helvetica, Arial, sans-serif" padding-left="25px" padding-right="25px" padding-bottom="0px"><strong>Order Date</strong></mj-text>
<mj-text align="center" color="#FFF" font-size="13px" font-family="Helvetica" padding-left="25px" padding-right="25px" padding-bottom="20px" padding-top="10px"><?= $tgl_transaksi ?></mj-text>
</mj-column>
<mj-column>
<mj-text align="center" color="#FFF" font-size="15px" font-family="Ubuntu, Helvetica, Arial, sans-serif" padding-left="25px" padding-right="25px" padding-bottom="0px"><strong>Total Price</strong></mj-text>
<mj-text align="center" color="#FFF" font-size="13px" font-family="Helvetica" padding-left="25px" padding-right="25px" padding-bottom="20px" padding-top="10px"><?= convertToRupiah($total_hrg) ?></mj-text>
</mj-column>
</mj-section>
<mj-section background-color="#356CC7" padding-bottom="20px" padding-top="20px">
<mj-column width="50%">
<mj-button background-color="#ffae00" color="#FFF" font-size="14px" align="center" font-weight="bold" border="none" padding="15px 30px" border-radius="10px" href="<?= base_url('transaksi/cetakTiket/?orderId='.$order_id) ?>" font-family="Helvetica" padding-left="25px" padding-right="25px" padding-bottom="10px">Unduh Bukti Pembayaran</mj-button>
</mj-column>
<mj-column width="50%">
<mj-button background-color="#ffae00" color="#FFF" font-size="14px" align="center" font-weight="bold" border="none" padding="15px 30px" border-radius="10px" href="<?= base_url('transaksi/detail/?orderId='.$order_id) ?>" font-family="Helvetica" padding-left="25px" padding-right="25px" padding-bottom="12px">Cek Pesanan</mj-button>
</mj-column>
</mj-section>
<mj-section background-color="#356cc7" padding-bottom="5px" padding-top="0">
<mj-column width="100%">
<mj-divider border-color="#ffffff" border-width="2px" border-style="solid" padding-left="20px" padding-right="20px" padding-bottom="0px" padding-top="0"></mj-divider>
<mj-text align="center" color="#FFF" font-size="15px" font-family="Helvetica" padding-left="25px" padding-right="25px" padding-bottom="20px" padding-top="20px">Best,
<br/>
<span style="font-size:15px">Touristix Team</span></mj-text>
</mj-column>
</mj-section>
</mj-body>
</mjml>