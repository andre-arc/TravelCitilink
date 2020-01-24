<mjml>
<mj-head>
<mj-attributes>
<mj-all padding="0px"></mj-all>
<mj-class name="preheader" color="#000000" font-size="11px" font-family="Ubuntu, Helvetica, Arial, sans-serif" padding="0px"></mj-class>
</mj-attributes>
<mj-style inline="inline">a { text-decoration: none; color: inherit; }</mj-style>
</mj-head>
<mj-body background-color="#e0f2ff">
<mj-section background-color="#ffffff" padding-top="20px">
  <mj-column width="100%">
    <mj-image src="https://storage.googleapis.com/touristix.appspot.com/assets/image/logo.png" alt="tickets" width="192px" padding="10px 25px"></mj-image>
    <mj-text align="center" color="#FAB701" font-size="25px" font-family="Lato, Helvetica, Arial, sans-serif" padding="10px 25px"><strong>Hei, <?= $nama_customer ?>
        <br />
        <br />
        Mohon segera selesaikan pembayaran Anda
</strong></mj-text>
<mj-text align="center" color="#EC652D" font-size="14px" font-family="Lato, Helvetica, Arial, sans-serif" padding="40px 20px"><strong>Checkout berhasil pada <?= $tgl_transaksi ?>.</strong></mj-text>
</mj-column>
</mj-section>
<mj-section background-color="#568feb" padding-bottom="15px" padding-top="30px">
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
<mj-button background-color="#ffae00" color="#FFF" font-size="14px" align="center" font-weight="bold" border="none" padding="15px 30px" border-radius="10px" href="<?= $url_bayar ?>" font-family="Helvetica" padding-left="25px" padding-right="25px" padding-bottom="10px">Bayar Sekarang</mj-button>
</mj-column>
</mj-section>
<mj-section background-color="#FAB700" padding="10px">
<mj-column vertical-align="top" width="100%">
<mj-text align="center" color="#EC652D" font-size="20px" font-family="Lato, Helvetica, Arial, sans-serif" padding="10px 25px">Best, <br /><br /> The Touristix Team</mj-text>
</mj-column>
</mj-section>
</mj-body>
</mjml>