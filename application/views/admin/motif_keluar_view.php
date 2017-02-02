
<div class='row'>
	<div class='col-xs-12' id="motif_keluar">
		<?php 
			
				echo $motif_keluar; 
			
		
		?>
	</div>
</div>
<div class='row'>
	<div class='col-xs-12'>
		<?php echo $motif_keluar_detail; ?>
	</div>
</div>

<?php
	if (!$this->uri->segment(4) == "add" and !$this->uri->segment(4) == "edit" or $this->uri->segment(4) == "cetak_surat_jalan"){
?>
<?php if (strtolower($tersimpan) == "belum"): ?>
<div class='row'>
	<div class='col-xs-12'>
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Promo</h3>
			</div>
			<div class="box-body">
				<table class="table table-borderd">
					<tr>
						<th>Nama Barang</th>
						<th>Nama Type</th>
						<th>Gratis</th>
					</tr>
					<?php
						$motif_keluar_id = $this->uri->segment(3);

						$this->db->where("motif_keluar_id",$motif_keluar_id);
						$this->db->where("promo","tidak");
						$data = $this->db->get("motif_keluar_detail");

						foreach ($data->result() as $row) {
							//cek promo
							//$this->db->where("motif_id",$row->motif_id);
							$this->db->select("*, barang.nama as barang_nama, type.nama as type_nama");
							$this->db->from("promo");
							$this->db->where("barang_id",$row->barang_id);
							$this->db->where("type_id",$row->type_id);
							$this->db->join("barang","barang.id = promo.barang_id");
							$this->db->join("type","type.id = promo.type_id");
							$promo = $this->db->get();

							if ($promo->num_rows() > 0){
								$promo = $promo->row();
								$bagi = $row->qty / $promo->beli;
								$bagi = floor($bagi);
								if ($bagi > 0){

									?>
										<tr>
											<td><?php echo $promo->barang_nama; ?></td>
											<td><?php echo $promo->type_nama; ?></td>
											<td><?php echo $bagi*$promo->gratis; ?></td>
										</tr>
									<?php
								}
							}
						}
					?>
					
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<div class='row'>
	<div class='col-xs-12'>
		<div class="box">
			<div class="box-body">
				<a href="<?php echo site_url('motif_keluar'); ?>" class="btn btn-warning">Kembali</a>
				
				<div class="pull-right">
						<?php if (strtolower($tersimpan) == "sudah"): ?>
							<a href="<?php echo site_url('invoice/cetak/'.$this->uri->segment(3)); ?>" target="_blank" class="btn btn-primary">Cetak Invoice</a>
							<!--<a href="<?php echo site_url('surat_jalan/cetak/'.$this->uri->segment(3)); ?>" target="_blank" class="btn btn-success">Cetak Surat Jalan</a>-->
							<button class="btn btn-success" id="btn_cetak_surat_jalan"  data-toggle="modal" data-target=".bs-modal-suratjalan">Cetak Surat Jalan</button>
							<div id="my-modal-pay" class="modal fade bs-modal bs-modal-suratjalan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		                        <div class="modal-dialog modal-sm">
		                            <div class="modal-content">
		                                <form target="_blank" action="<?php echo site_url('surat_jalan/proses_cetak'); ?>" method="post">
		                                    
		                                    <div class="modal-header">
		                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                        <h4 class="modal-title">Cetak Surat Jalan</h4>
		                                    </div>
		                                    <div class="modal-body">
		                                   	 <input type="hidden" name="motif_keluar_id" value="<?php echo $this->uri->segment(3); ?>"/>
		                                        	<label>Status Kirim</label><br>
		                                        	<select class="form-control" id="status_kirim" name="status_kirim">
		                                        		<option value="kirim_langsung">Kirim Langsung</option>
		                                        		<option value="ship_to">Ship to</option>
		                                        	</select>
		                                        	<div id="ship_to">
			                                        	<label>
			                                        		Ship To
			                                        	</label>
			                                        	<input value="<?php if($surat_jalan != null) {echo $surat_jalan->ship_to; } ?>" type="text" class="form-control" id="ship_to_text" name="ship_to">
		                                        	</div>

		                                        	<label>
			                                        	Nama Penerima
		                                        	</label>
		                                        	<input required="" type="text" class="form-control" name="nama_penerima" value="<?php if($surat_jalan != null) {echo $surat_jalan->nama_penerima; } ?>">
		                                    </div>
		                                    <div id="list-hidden"></div>
		                                    <div class="modal-footer">
		                                        <button type="submit" class="btn btn-primary btn-ok">OK</button>
		                                    </div>
		                                </form>
		                            </div>
		                        </div>
		                    </div>
		                    
						<?php endif; ?>

						
						<?php if (strtolower($tersimpan) == "belum"): ?>
							<form class="form-inline" action="<?php echo site_url('motif_keluar/simpan'); ?>" method="post">
								<input type="hidden" name="motif_keluar_id" value="<?php echo $this->uri->segment(3); ?>">
								
								<button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-save"></i> Simpan</button>
								<a href="<?php echo site_url('motif_keluar/batal/'.$this->uri->segment(3)) ?>" class="btn btn-default">Batal</a>
							</form>
						<?php endif; ?>
				</div>
			</div>
		</div>
		
	</div>
</div>
<?php } ?>


