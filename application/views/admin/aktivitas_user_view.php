<!--
<div class='row'>
	<div class='col-xs-4' id="">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Pilih Customer</h3>

			</div>
			<form action="<?php echo site_url("histori/aktivitas_user/pilih_user"); ?>" method="post">
			<div class="box-body">
				

				<div class='row' id=">_field_box">
					<div class='form-display-as-box col-lg-3 control-label' id="_display_as_box">
						<label>
							User*
						</label>
					</div>
					<div class='col-lg-9' id="_input_box">
						<select name="user" required="" class="form-control select2">
							<option value="semua">Semua</option>
							<?php
								foreach ($data_user as $row) {
									?>
										<option value="<?php echo $row->id; ?>"><?php echo $row->first_name." ".$row->last_name; ?></option>
									<?php
								}

							?>
						</select>
					</div>
				</div>
				<br>
				<div class='row' id=">_field_box">
					<div class='form-display-as-box col-lg-3 control-label' id="_display_as_box">
						<label>
							Bulan*
						</label>
					</div>
					<div class='col-lg-9' id="_input_box">
						<select name="bulan" required="" class="form-control select2">
							<?php
								$bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

								for ($i=0; $i < count($bulan); $i++) { 
										if (count($bulan) == 1){
											$angkabulan = "0".$i+1;
										}else{
											$angkabulan = $i+1;
										}
									?>
										<option <?php if (date("m") == $angkabulan){ echo "selected"; } ?> value="<?php echo $i+1; ?>"><?php echo $bulan[$i]; ?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
				<br>
				<div class='row' id=">_field_box">
					<div class='form-display-as-box col-lg-3 control-label' id="_display_as_box">
						<label>
							Tahun*
						</label>
					</div>
					<div class='col-lg-9' id="_input_box">
						<input type="text" required="" value="<?php echo date("Y"); ?>" class="form-control" name="tahun">
					</div>
				</div>
			</div>
			<div class="box-footer">
				<div class='row' id=">_field_box">
					<div class='form-display-as-box col-lg-3 control-label' id="_display_as_box">
						
					</div>
					<div class='col-lg-9' id="_input_box">
						<input type="submit" name="tampilkan_harian" value="Tampilkan" class="btn btn-primary">
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>

	
</div>

-->
<?php
	$this->load->view("admin/_templates/output_view");
?>