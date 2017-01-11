
<table class="table table-bordered" id="dtables">
	<thead>
		
	<tr>
		<th width="50">#</th>
		<th width="100">Tanggal</th>
		<th width="100">Customer</th>
		<th width="50">Qty</th>
		<th>Nama Motif</th>
		<th>Keterangan</th>
	</tr>
	</thead>
	<tbody>
		
	<?php
		$no = 0;
		foreach ($histori->result() as $row) {
			?>
				<tr>
					<td><?php echo ++$no; ?></td>
					<td><?php echo date('d/m/Y',strtotime($row->tanggal)); ?></td>
					<td>
						<?php
							$this->db->where("id",$row->customer_id);
							$cust = $this->db->get("customer")->row();

							echo $cust->nama;
						?>
					</td>

					<td><?php echo $row->qty; ?></td>
					<td><?php echo $row->nama; ?></td>
					<td><?php echo ($row->ket == null)? "-":$row->ket; ?></td>
				</tr>
			<?php
		}
	?>
	</tbody>
	
</table>