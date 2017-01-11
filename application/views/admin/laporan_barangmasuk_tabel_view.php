<?php if (isset($laporan_title)){ echo $laporan_title; } ?>
<table class="table table-bordered">
	<tr>
		<th width="50">#</th>
		<th width="100">Tanggal</th>
		<th width="50">Qty</th>
		<th>Nama Barang</th>
		<th>Keterangan</th>
	</tr>
	<?php
		$no = 0;
		foreach ($laporan->result() as $row) {
			?>
				<tr>
					<td><?php echo ++$no; ?></td>
					<td><?php echo date('d/m/Y',strtotime($row->tanggal)); ?></td>
					<?php
						// $barang_masuk_id = $row->id;

						// $this->db->where('barang_masuk_id',$barang_masuk_id);
						// $detail = $this->db->get("barang_masuk_detail")->row();
					?>
					<td><?php echo $row->qty; ?></td>
					<td><?php echo $row->nama; ?></td>
					<td><?php echo ($row->ket == null)? "-":$row->ket; ?></td>
				</tr>
			<?php
		}
	?>
	
</table>