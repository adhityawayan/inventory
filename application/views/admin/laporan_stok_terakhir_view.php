
<div class='row'>
	<div class='col-xs-5' id="">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Laporan Stok</h3>

			</div>
			<form action="<?php echo site_url("laporan/stok_terakhir/tahun"); ?>" method="post">
				
			<div class="box-body">
				
				<div class='row' id=">_field_box">
					<div class='form-display-as-box col-lg-3 control-label' id="_display_as_box">
						<label>
							Nama Brg*
						</label>
					</div>
					<div class='col-lg-9' id="_input_box">
						<select name="barang_id" class="form-control select2">
							<option value="semua">Semua</option>
							<?php
								foreach ($barang as $option_value => $option_label) {
									?>
										<option value="<?php echo $option_value; ?>"><?php echo $option_label; ?></option>
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
							Type*
						</label>
					</div>
					<div class='col-lg-9' id="_input_box">
						<select name="type_id" class="form-control select2">
							<option value="semua">Semua</option>
							<?php
								foreach ($type as $option_value => $option_label) {
									?>
										<option value="<?php echo $option_value; ?>"><?php echo $option_label; ?></option>
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
						<input type="text" required="" value="<?php echo date("Y"); ?>" name="tahun" class="form-control">
					</div>
				</div>
			</div>
			<div class="box-footer">
				<div class='row' id=">_field_box">
					<div class='form-display-as-box col-lg-3 control-label' id="_display_as_box">
						
					</div>
					<div class='col-lg-9' id="_input_box">
						<input type="submit" name="tampilkan_bulanan" value="Tampilkan" class="btn btn-primary">
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $box_title; ?></h3>
				<div class="box-tools pull-right">
	                <a href="<?php echo $link; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
	                <a href="<?php echo site_url('laporan/stok_terakhir'); ?>"  class="btn btn-default"><i class="fa fa-cancel"></i> Batal</a>
	              </div>
			</div>
			<div class="box-body">
				<?php $this->load->view($table); ?>
			</div>
		</div>
	</div>
</div>
