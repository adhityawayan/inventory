<?php if (isset($laporan_title)){ echo $laporan_title; } ?>
<table class="table table-bordered">
	<thead>	
		<tr>
			<th>No</th>
			<th>Type</th>
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

		$this->db->order_by("nama","asc");
		$type = $this->db->get("type");
		
		foreach ($type->result() as $ty) {
			$this->db->where("type_id",$ty->id);
			$brg = $this->db->get("barang");
			$barang_id = array();
			foreach ($brg->result() as $bt) {
				array_push($barang_id, $bt->id);
			}


		 	?>
		 		<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $ty->nama; ?></td>
					<?php
						//berdasarkan bulan 

						for($i = 1; $i <= 12; $i++){
							$this->db->where("year(tanggal)",$tahun);
							$this->db->where("month(tanggal)",$i);
							$this->db->where("tersimpan","sudah");
							$this->db->order_by("tanggal","asc");
							$barang_keluar = $this->db->get("barang_keluar");

							if ($barang_keluar->num_rows() > 0){
								$total = 0;

								foreach ($barang_keluar->result() as $bk) {
									
									$this->db->where("barang_keluar_id",$bk->id);

									$this->db->where_in("barang_id",$barang_id);
									$barang_keluar_detail = $this->db->get("barang_keluar_detail");

									if ($barang_keluar_detail->num_rows() > 0){
										$jml_detail = 0;
										foreach ($barang_keluar_detail->result() as $bkd) {
											$jml_detail += $bkd->qty;
										}

										$total += $jml_detail;
									}

								}

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
		
	</tbody>
</table>