<script type="text/javascript">
	$(document).ready(function(){
		$("#ship_to").hide();
		$("#ship_to_text").val("");


		$("#status_kirim").change(function(){
			if ($(this).val() == "ship_to"){
				$("#ship_to").show();
			}else{
				$("#ship_to").hide();
			}
		});
		$("#status_kirim").keyup(function(){
			if ($(this).val() == "ship_to"){
				$("#ship_to").show();
			}else{
				$("#ship_to").hide();
			}
		});

		var trigger = '<?php echo $this->uri->segment('4'); ?>';

		if (trigger == "cetak_surat_jalan"){
			$("#btn_cetak_surat_jalan").trigger('click');
		}


		$("#ket_keluar").keyup(function(){
			var value = $(this).val();
			$.post("<?php echo site_url('motif_keluar/set_keterangan'); ?>",{
				'ket' : value,
				'motif_keluar_id' : <?php echo $this->uri->segment(3); ?>
			},function(data){

			});
		});

	});
</script>