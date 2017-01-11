
<div class='row'>
	<div class='col-xs-12' id="motif_keluar">
		<?php 
			
				echo $return_motif; 
			
		
		?>
	</div>
</div>
<div class='row'>
	<div class='col-xs-12'>
		<?php echo $return_motif_detail; ?>
	</div>
</div>

<?php
	if (!$this->uri->segment(4) == "add" and !$this->uri->segment(4) == "edit"){
?>

<div class='row'>
	<div class='col-xs-12'>
		<div class="box">
			<div class="box-body">
				<a href="<?php echo site_url('return_motif'); ?>" class="btn btn-warning">Kembali</a>
				
				<div class="pull-right">
						<?php if (strtolower($tersimpan) == "sudah"): ?>
							<a href="<?php echo site_url('return_motif/cetak/'.$this->uri->segment(3)); ?>" target="_blank" class="btn btn-primary">Cetak Retur motif</a>
						<?php endif; ?>

						
						<?php if (strtolower($tersimpan) == "belum"): ?>
							<form class="form-inline" action="<?php echo site_url('return_motif/simpan'); ?>" method="post">
								<input type="hidden" name="return_id" value="<?php echo $this->uri->segment(3); ?>">
								
								<button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-save"></i> Simpan</button>
								<a href="<?php echo site_url('return_motif/batal/'.$this->uri->segment(3)) ?>" class="btn btn-default">Batal</a>
							</form>
						<?php endif; ?>
				</div>
			</div>
		</div>
		
	</div>
</div>
<?php } ?>