
<table class="table table-bordered" id="dtables">
	<thead>
		
	<tr>
		<th width="50">#</th>
		<th width="100">Tanggal</th>
		<th width="100">Customer</th>
		<th width="50">Qty</th>
		<th>Nama motif</th>
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
					<?php
						$motif_keluar_id = $row->id;

						$this->db->where('motif_keluar_id',$motif_keluar_id);
						$detail = $this->db->get("motif_keluar_detail")->row();
					?>
					<td><?php echo $detail->qty; ?></td>
					<td><?php echo $detail->nama; ?></td>
					<td><?php echo ($detail->ket == null)? "-":$detail->ket; ?></td>
				</tr>
			<?php
		}
	?>
	</tbody>
	
</table>