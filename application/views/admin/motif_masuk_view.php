
<div class='row'>
	<div class='col-xs-12' >
		<?php 
			
				echo $motif_masuk; 
			
		
		?>
	</div>
</div>
<div class='row'>
	<div class='col-xs-12'>
		<?php echo $motif_masuk_detail; ?>
	</div>
</div>

<?php
	if (!$this->uri->segment(4) == "add" and !$this->uri->segment(4) == "edit"){
?>

<div class='row'>
	<div class='col-xs-12'>
		<div class="box">
			<div class="box-body">
				<a href="<?php echo site_url('motif_masuk'); ?>" class="btn btn-warning">Kembali</a>
				
				<div class="pull-right">
						

						
						<?php if (strtolower($tersimpan) == "belum"): ?>
							<form class="form-inline" action="<?php echo site_url('motif_masuk/simpan'); ?>" method="post">
								<input type="hidden" name="motif_masuk_id" value="<?php echo $this->uri->segment(3); ?>">
								
								<button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-save"></i> Simpan</button>
								<a href="<?php echo site_url('motif_masuk/batal/'.$this->uri->segment(3)) ?>" class="btn btn-default">Batal</a>
							</form>
						<?php endif; ?>
				</div>
			</div>
		</div>
		
	</div>
</div>
<?php } ?>