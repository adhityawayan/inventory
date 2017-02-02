<?php if (isset($laporan_title)){ echo $laporan_title; } ?>
<div class='row'>
	<?php if (!isset($laporan_title)): ?>
	<div class='col-xs-12'>
		<div class="box">
			<div class="box-body">
				<div class="pull-right">
					<a target="_blank" href="<?php echo site_url('stok_opname/cetak'); ?>" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
				</div>
			</div>
		</div>
	</div>	
<?php endif; ?>
	<div class='col-xs-12'>
		<?php echo $output; ?>
	</div>
</div>