
<style>
	h3{
		
		text-align: center;
	}

	h5{
		text-align: center;
	}
	
	.biodata-pangkalan{
		position: absolute;

	}
	.kategori-pembeli{

		left: 1120px;
		padding: 8px;
		position: absolute;
		border: 1px solid black;
	}
	.reg{
		padding-left: 10px;
		font-size: 12px;
		font-style: bold;
	}

	.kartu{
		 font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	}

	

	#lookbook {
		position: relative;
		top: 170px;
   	 font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    
   
}
	#lookbook table{
		border-collapse: collapse;
	}

#lookbook td, #lookbook th {
  border: 1px solid #ddd;
    padding: 5px;
}

#lookbook tr:nth-child(even){background-color: #f2f2f2;}



#lookbook th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
	
</style>

<?php
if($filter == 'all'){
                        $org_id = $this->session->userdata('user_org');
						$pangkalan =  $this->db->query("select * from orgs where parent_id = $org_id");
						$row = $pangkalan->result();
						
						foreach ($row as $r) {
						$id_pangkalan = $r->id;
						?>

						<div class="kartu" style="padding: 10px;border: 2px solid gray;margin-bottom: 10px; height:599px; ">
	<div class="kop">	
		<h3><b>LOOKBOOK PENYALURAN PANGKALAN LPG 3KG</b></h3>
	</div>

	<div class="biodata-pangkalan">
		<table >
			<tr>
				<td>Nama Pangkalan</td><td>:</td><td><?php echo $r->name;?></td>
			</tr>
			<tr>
				<td>No Reg. Pangkalan</td><td>:</td><td><?php echo $r->no_reg;?></td>
			</tr>
			<tr>
				<td>Alamat</td><td>:</td><td><?php echo $r->alamat_pkl;?></td>
			</tr>
			<tr>
				<td>Agen Penyuplai</td><td>:</td><td><?php echo $r->parent_name;?></td>
			</tr>
			<tr>
				<td>Bulan</td><td>:</td><td><?php echo ucwords($nm_bulan);?></td>
			</tr>
		</table>	
	</div>

	<div class="kategori-pembeli">
		<table >
			<tr>
				<td>Rumah Tangga</td><td>:</td><td>12</td><td>Tbg</td>
			</tr>
			<tr>
				<td>Usaha Mikro</td><td>:</td><td>11</td><td>Tbg</td>
			</tr>
			<tr>
				<td>Lainnya</td><td>:</td><td>33</td><td>Tbg</td>
			</tr>
			
		</table>	
	</div>

	<div id="lookbook" >
		<table>
			<tr>
				<td colspan="7">Tanggal</td><td></td>
				<?php
					for ($i=1; $i <= $lastDate; $i++) { 
						echo "<td>$i</td>";
					}
				?>
					
			</tr>
			<tr>
				<td colspan="7">Stock Awal</td><td>Tbg</td>
				  <?php

				  	$date = $tahun."-".$bulan."-1";
				  	$query = $this->db->query("call get_laporan('$date', $id_pangkalan)");
					$result = $query->row();
					$query->next_result(); 
	                $query->free_result();

					$stok_awal = $result->stok_awal;

			        
					for ($i=1; $i <= $lastDate ; $i++) {
						$date = $tahun."-".$bulan."-".$i;
						echo "<td>$stok_awal</td>";

						$query = $this->db->query("call getPenerimaan('$date', $id_pangkalan);");
						$result = $query->row();


						$query->next_result(); 
	                    $query->free_result();
					    if(count($result) > 0){
					        $terima = $result->jml_terima;
					    }else{
					        $terima = 0;
					    }


						$query = $this->db->query("call get_jual_tbg('$date', $id_pangkalan, 'all')");
						$result = $query->row();
						$query->next_result(); 
	                    $query->free_result();
						$jual = $result->jml_tabung;

						$stok_awal = ($stok_awal+$terima) - $jual;
					}

			    ?>
			</tr>
			<tr>
				<td colspan="7">Penerimaan</td><td>Tbg</td>
				<?php
				for ($i=1; $i <= $lastDate ; $i++) {
						$date = $tahun."-".$bulan."-".$i;

						$query = $this->db->query("call getPenerimaan('$date', $id_pangkalan)");
						$result = $query->row();
						$query->next_result(); 
	                    $query->free_result();
	                    
						 if(count($result) > 0){
					        $terima = $result->jml_terima;
					    }else{
					        $terima = 0;
					    }
						
						echo "<td>$terima</td>";
					}
				?>
			</tr>
			<tr>
				<td colspan="7">Paraf Supir</td><td>Paraf</td>
				<?php
				for ($i=1; $i <= $lastDate ; $i++) {
						echo "<td></td>";
					}
				?>
			</tr>



			<tr>
				<td rowspan="2">No</td>
				<td rowspan="2">Nama Penjual</td>
				<td colspan="3">Kategori</td>
				<td rowspan="2">Alamat Pembeli</td>
				<td rowspan="2">Keterangan *)</td>
				<td colspan="<?php echo $lastDate+1;?>" rowspan="2"></td>
			</tr>
			<tr>
				<td>RT</td>
				<td>UM</td>
				<td>Lainnya</td>
			</tr>
 
            <?php 
            $query = $this->db->query("select * from tbl_pelanggan where id_pangkalan='$id_pangkalan' order by nm_pelanggan ASC");
            $result = $query->result();
            
             $no = 1;
            foreach($result as $r){
           
            ?>

			 <tr>
    			<td rowspan="2"><?php echo $no; ?></td>
    			<td rowspan="2"><?php echo $r->nm_pelanggan; ?></td>
    			<td rowspan="2">RT</td>
    			<td rowspan="2"></td>
    			<td rowspan="2"></td>
    			<td rowspan="2"><?php echo $r->alamat_pelanggan; ?></td>
    			<td rowspan="2"><?php echo $r->keterangan; ?></td>
    			
    			<td>Tbg</td>
    			<?php
				for ($i=1; $i <= $lastDate ; $i++) {
						$date = $tahun."-".$bulan."-".$i;

						$query = $this->db->query("call get_jual_tbg('$date', $r->id_pelanggan, 'single')");
						$result = $query->row();
						$query->next_result(); 
	                    $query->free_result();
						$jual = $result->jml_tabung;
						
						echo "<td>$jual</td>";
					}
				?>
  			</tr>
  			<tr>
    			<td>Paraf</td>
    			<?php
				for ($i=1; $i <= $lastDate ; $i++) {
						echo "<td></td>";
					}
				?>
     			
  			</tr>
  			
  			<?php
  			$no++;
            }
  			?>

			
			
			
		</table>	
	</div>



</div>
						<?php

						}
}
else{
	$id_pangkalan = $filter;
}
?>

