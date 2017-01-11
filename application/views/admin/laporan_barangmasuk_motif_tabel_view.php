<?php if (isset($laporan_title)){ echo $laporan_title; } ?>

<table class="table table-bordered">
	<tr>
		<th width="50">#</th>
		<th width="100">Tanggal</th>
		<th width="50">Qty</th>
		<th>Motif</th>
		<th>Keterangan</th>
	</tr>
	<?php
		$no = 0;
		
		$total_qty = 0;
		

	 	foreach ($laporan->result() as $row) {
	 		$total_qty += $row->qty;
	 		?>
	 			<tr>
		 			<td><?php echo ++$no; ?></td>
		 			<td><?php echo date('d/m/Y',strtotime($row->tanggal)); ?></td>
		 			<td><?php echo $row->qty_detail; ?></td>
		 			<td><?php echo $row->nama; ?></td>
		 			<td><?php echo ($row->ket == null)? "-":$row->ket; ?></td>
		 		</tr>
	 		<?php
	 	}

		
	?>
	<tr>
		<th colspan="2">Total</th>
		<th><?php echo $total_qty; ?></th>
		<th></th>
		<th></th>
	</tr>
</table>