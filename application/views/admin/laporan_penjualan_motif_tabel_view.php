<?php if (isset($laporan_title)){ echo $laporan_title; } ?>
<table class="table table-bordered">
	<thead>	
		<tr>
			<th>No</th>
			<th>Motif</th>
			<th>Jan</th>
			<th>Feb</th>
			<th>Mar</th>
			<th>Apr</th>
			<th>Mei</th>
			<th>Jun</th>
			<th>Jul</th>
			<th>Ags</th>
			<th>Sep</th>
			<th>Okt</th>
			<th>Nov</th>
			<th>Des</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;

		
		$total_bulan = array();
		for($i = 0; $i < 12; $i++){
			$total_bulan[$i] = 0;
		}

		foreach ($motif->result() as $m) {
			


		 	?>
		 		<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $m->nama; ?></td>
					<?php
						//berdasarkan bulan 

						for($i = 1; $i <= 12; $i++){
							$this->db->where("year(tanggal)",$tahun);
							$this->db->where("month(tanggal)",$i);
							$this->db->where("tersimpan","sudah");
							$this->db->order_by("tanggal","asc");
							$motif_keluar = $this->db->get("motif_keluar");

							if ($motif_keluar->num_rows() > 0){
								$total = 0;

								foreach ($motif_keluar->result() as $bk) {
									
									$this->db->where("motif_keluar_id",$bk->id);

									$this->db->where_in("motif_id",$m->id);

									if ($barang_id != "semua"){
										$this->db->where("barang_id",$barang_id);
									}

									if ($type_id != "semua"){
										$this->db->where("type_id",$type_id);
									}
									
									$motif_keluar_detail = $this->db->get("motif_keluar_detail");

									if ($motif_keluar_detail->num_rows() > 0){
										$jml_detail = 0;
										foreach ($motif_keluar_detail->result() as $bkd) {
											$jml_detail += $bkd->qty;
										}

										$total += $jml_detail;
									}

								}
								$total_bulan[$i-1] += $total;

								echo "<td>$total</td>";
							}else{
								echo "<td>0</td>";
							}
							

						}
						



					?>
				</tr>
		 	<?php
		 } 

	?>
		<tr>
			<th>Total</th>
			<th></th>
			<?php
				for($i = 0; $i < 12; $i++){
					echo "
						<th>
						".$total_bulan[$i]."
						</th>
					";
				}
			?>
		</tr>
	</tbody>
</table>