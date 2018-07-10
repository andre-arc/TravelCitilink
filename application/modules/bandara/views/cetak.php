
<style>
	h4{
		text-decoration: underline;
		text-align: center;
	}

	h5{
		text-align: center;
	}
	.kop{
		letter-spacing: 3px;
		line-height: 0.1;
		
 background:orange;

	}

	.biodata{
		letter-spacing: 3px;
		padding-left: 130px;
		margin-top: -135px;
	}
	.reg{
		padding-left: 10px;
		font-size: 15px;
		font-style: bold;
	}

	.logo{
	top:30px;
		
	}
</style>

<div class="kartu" style="width: 400;padding: 10px;border: 2px solid gray;margin: 0;height: 230;">
	
	<div class="kop">
		
	<h4>KARTU MEMBER</h4>
	<h5>PENYALURAN GAS SUBSIDI 3KG</h5>
</div>
		
<div class="barcode">
	<img src='<?php echo site_url($data[0]->qrcode);?>' width='122' height='125'>
</div>

<div class="reg">
	NO REG : <?php echo $data[0]->no_kk; ?>
</div>

<div class="biodata" >
	<table>
		

	<tr>
		<td>Nama </td><td>:</td><td> <?php echo $data[0]->nm_pelanggan; ?></td>
	</tr>
	<tr>	
		<td>Nik </td><td>:</td><td> <?php echo $data[0]->nik; ?></td>
	</tr>
	<tr>
		<td>No HP </td><td>:</td> <td><?php echo $data[0]->hp; ?></td>
	</tr>
	<tr>
		<td>Alamat </td><td>:</td> <td><?php echo $data[0]->alamat_pelanggan; ?></td>
	</tr>
	<tr>
		<td>Kategori </td><td>:</td> <td><?php echo $data[0]->kategori; ?></td>
	</tr>
		</table>
</div>
	
</div>
