<?php
if($bulan >= date('n')){
?>
<strong>Tabel Formulir Input Penerimaan Tabung Periode <?php echo ucwords($nm_bulan).' '.$tahun;?></strong>
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<tr>
			<th rowspan="2" class="text-center">Nama Pangkalan</th>
			<th colspan="<?php echo $lastDate;?>" class="text-center">Tanggal Penerimaan</th>
		</tr>
		<tr>
			<?php for($i=1; $i <= $lastDate; $i++) :  ?>
			<th><?php echo $i; ?></th>
			<?php endfor; ?>
		</tr>

		<?php foreach($pangkalan as $p):
			$this->db->where('id_pangkalan', $p->id);
			$this->db->where('tanggal', "$date");
			$select = $this->db->get('tbl_penerimaan');
			
				if($select->num_rows() == 0){
					 for($i=1; $i <= $lastDate; $i++){
					 	$tanggal = $tahun."-".$bulan."-".$i;
					 	$query = $this->db->query("call insertPenerimaan('$tanggal', 0, $p->id);");
					 // 	$query->next_result(); 
						// $query->free_result(); 
					 }

				}
		?>
		<tr>
			<td><?php echo $p->name;?></td>
			<?php for($i=1; $i <= $lastDate; $i++) :
				$tanggal = $tahun."-".$bulan."-".$i; 
				$query = $this->db->query("call getPenerimaan('$tanggal', $p->id);");
				$result = $query->row();

				$query->next_result(); 
				$query->free_result();
				echo "<td><a href='#' class='tbg_terima' data-type='text' data-pk='$result->id_penerimaan' data-name='jml_tabung' data-url='".base_url('penerimaan/act_edit')."' data-title='Enter username'>$result->jml_terima</a></td>"; 
			?>
		<?php endfor; ?>
		</tr>
	<?php endforeach;?>
		
	</table>
</div>
<?php
}
else{
	echo "<script>alert('Tidak bisa menginput untuk periode ini');</script>";
}
?>
<script>
	$(document).ready(function(){
		$('.tbg_terima').editable();
	})
</script>