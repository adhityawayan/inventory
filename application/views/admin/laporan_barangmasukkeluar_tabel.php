<?php if (isset($laporan_title)){ echo $laporan_title; } ?>
<table class="table table-bordered">
	<tr>
		<th width="50">#</th>
		<th width="100">Tanggal</th>
		<th width="100">Masuk/Keluar</th>
		<th width="50">Qty</th>
		<th>Nama Barang</th>
		<th>Surat Jalan</th>
		<th>Nama Customer</th>
		<th>Keterangan</th>
	</tr>
	<?php
		$no = 0;
		foreach ($laporan as $row) {
			?>
				<tr>
					<td><?php echo ++$no; ?></td>
					<td><?php echo date('d/m/Y',strtotime($row['tanggal'])) ?></td>
					<td><?php echo $row['masuk_keluar']; ?></td>
					<?php
						// $barang_keluar_id = $row->id;

						// $this->db->where('barang_keluar_id',$barang_keluar_id);
						// $detail = $this->db->get("barang_keluar_detail")->row();
					?>
					<td><?php echo $row['qty']; ?></td>
					<td><?php echo $row['nama']; ?></td>
					<td><?php echo $row['surat_jalan']; ?></td>
					<td><?php echo $row['nama_cust']; ?></td>
					<td><?php echo ($row['ket'] == null)? "-":$row['ket']; ?></td>
				</tr>
			<?php
		}
	?>
	
</table>

