<?php if (isset($laporan_title)){ echo $laporan_title; } ?>
<table class="table table-bordered">
	<thead>	
		<tr>
			<th>No</th>
			<th>motif</th>
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
							//mendapatkan motif masuk dan motif keluar bulan ini
							$this->db->where("year(tanggal)",$tahun);
							$this->db->where("month(tanggal)",$i);
							$this->db->where("tersimpan","sudah");
							$this->db->order_by("tanggal","asc");
							$motif_keluar = $this->db->get("motif_keluar");

							$total_motif_keluar = 0;
							if ($motif_keluar->num_rows() > 0){

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
										foreach ($motif_keluar_detail->result() as $mkd) {
											$jml_detail += $mkd->qty;
										}

										$total_motif_keluar += $jml_detail;
									}

								}

							}
							

							$this->db->where("year(tanggal)",$tahun);
							$this->db->where("month(tanggal)",$i);
							$this->db->where("tersimpan","sudah");
							$this->db->order_by("tanggal","asc");
							$motif_masuk = $this->db->get("motif_masuk");
							
							$total_motif_masuk = 0;
							if ($motif_masuk->num_rows() > 0){

								foreach ($motif_masuk->result() as $bk) {
									
									$this->db->where("motif_masuk_id",$bk->id);

									$this->db->where_in("motif_id",$m->id);

									if ($barang_id != "semua"){
										$this->db->where("barang_id",$barang_id);
									}

									if ($type_id != "semua"){
										$this->db->where("type_id",$type_id);
									}

									$motif_keluar_detail = $this->db->get("motif_masuk_detail");

									if ($motif_keluar_detail->num_rows() > 0){
										$jml_detail = 0;
										foreach ($motif_keluar_detail->result() as $mkd) {
											$jml_detail += $mkd->qty;
										}

										$total_motif_masuk += $jml_detail;
									}

								}

							}



							$stok_bulan_ini = $total_motif_masuk - $total_motif_keluar;

							
							//mendapatkan motif masuk dan motif keluar sebelumnya
							// $this->db->where("year(tanggal) <=",$tahun,TRUE);
							// $this->db->where("month(tanggal) <",$i,TRUE);
							// $this->db->where("tersimpan","sudah");
							// $this->db->order_by("tanggal","asc");
							// $motif_keluar_before = $this->db->get("motif_keluar");

							if ($i < 10){
								$bln = "0".$i;
							}else{
								$bln = $i;
							}

							$tahun_bulan = $tahun."-".$bln;
							$motif_keluar_before = $this->db->query('
									SELECT *
									FROM motif_keluar 
									WHERE DATE_FORMAT(tanggal,"%Y-%m") < "'.$tahun_bulan.'" and tersimpan = "sudah"
									order by tanggal asc
								');

							$total_motif_keluar_before = 0;
							if ($motif_keluar_before->num_rows() > 0){

								foreach ($motif_keluar_before->result() as $bk) {
									
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
										foreach ($motif_keluar_detail->result() as $mkd) {
											$jml_detail += $mkd->qty;
										}

										$total_motif_keluar_before += $jml_detail;
									}

								}

							}

							//echo " motif keluar seblmnya ".$total_motif_keluar_before;

							// $this->db->where("year(tanggal) <=",$tahun,TRUE);
							// $this->db->where("month(tanggal) <",$i,TRUE);
							// $this->db->where("tersimpan","sudah");
							// $this->db->order_by("tanggal","asc");
							// $motif_masuk_before = $this->db->get("motif_masuk");

							$motif_masuk_before = $this->db->query('
									SELECT *
									FROM motif_masuk 
									WHERE DATE_FORMAT(tanggal,"%Y-%m") < "'.$tahun_bulan.'" and tersimpan = "sudah"
									order by tanggal asc
								');

							$total_motif_masuk_before = 0;
							if ($motif_masuk_before->num_rows() > 0){
								foreach ($motif_masuk_before->result() as $bk) {
									
									$this->db->where("motif_masuk_id",$bk->id);

									$this->db->where_in("motif_id",$m->id);

									if ($barang_id != "semua"){
										$this->db->where("barang_id",$barang_id);
									}

									if ($type_id != "semua"){
										$this->db->where("type_id",$type_id);
									}
									$motif_masuk_detail = $this->db->get("motif_masuk_detail");

									if ($motif_masuk_detail->num_rows() > 0){
										$jml_detail = 0;
										foreach ($motif_masuk_detail->result() as $mkd) {
											$jml_detail += $mkd->qty;
										}

										$total_motif_masuk_before += $jml_detail;
									}

								}

							}


							//echo " motif masuk seblmnya ".$total_motif_masuk_before."<br>";
							

							$sisa_stok = $total_motif_masuk_before - $total_motif_keluar_before;


							$hasil = $stok_bulan_ini + $sisa_stok;


							$total_bulan[$i-1] += $hasil;

							echo "<td>$hasil</td>";

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