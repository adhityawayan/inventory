<div class="row">
<div class="col-xs-12">
	
<?php
	$user = $this->ion_auth->user()->row();

	echo "<h1>Selamat Datang, ".$user->first_name."</h1>";

?>
</div>
</div><!-- /.row -->


<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Aktivitas Terakhir User</h3>
			</div>
			<div class="box-body">
					<table class="table table-bordered">
						<?php
							foreach ($user_activity as $row => $val) {
								
								echo '
									<tr>
										<td>'.$val['datetime'].'</td>
										<td>'.$val['keterangan'].'</td>
									</tr>
								';
							}
						?>

					</table>
			</div>
		</div>
		
	</div>
</div>

