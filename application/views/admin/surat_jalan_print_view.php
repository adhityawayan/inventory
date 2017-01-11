<style type="text/css">
	#table td,#table th{
		border:1px solid #000;
		padding:3px;

	}
	#table{
		margin-top:8px;
	}
	h3{
		margin-bottom: 2px;
	}
</style>
<h3>SURAT JALAN No. <?php echo $surat_jalan->id; ?></h3>
Bersama ini kendaraan ............ No. ................<br>
kami kirimkan barang-barang, tersebut dibawah ini<br>
Harap diterima dengan baik.

<table id="table" width="100%" style="border:1px solid #000;" >
	<tr style="background: #eee;">
		<th width="80">Banyaknya</th>
		<th>Nama Barang</th>
		<th>Keterangan</th>
	</tr>
	<?php
		foreach ($barang_keluar_detail as $row) {
			?>
				<tr>
					<td><?php echo $row->qty; ?></td>
					<td><?php echo $row->nama; ?></td>
					<td><?php echo $row->ket; ?></td>
				</tr>
			<?php
		}
	?>
</table>
<br>

<table width="100%">
	<tr>
		<td valign="top">
			Tanda Terima,
			<br>	
			<br>	
			<br>	
			<br>
			<br>
			( _____________________ )	
		</td>
		<td valign="top">
			<div style="border:1px solid #000;width: 150px;padding:7px;">
				Barang yang sudah<br>
				diterima tidak dapat<br>
				ditukar / dikembalikan
			</div>
		</td>
		<td valign="top">
			Hormat Kami,
			<br>	
			<br>	
			<br>	
			<br>	
			<br>
			( _____________________ )
		</td>
	</tr>
</table>

<script type="text/javascript">
	window.print();
</script>