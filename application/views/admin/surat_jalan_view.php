






<div class="row">
      <div class="col-xs-1">
        <img src="<?php echo base_url('img/logo.png'); ?>" width="50">
      </div>
      <!-- /.col -->

      

      <div class="col-xs-11">
        <div class="pull-right">
          <table >
            <tr>
                <td>Tuan/Toko</td>
                <td>:</td>
                <td>&nbsp;&nbsp;&nbsp<?php echo $surat_jalan->nama_penerima; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="pull-right">&nbsp;&nbsp;&nbsp;..............................................................................</td>
            </tr>
            
            
          </table>
        </div>
         
      </div>
    </div>

<div class="row">
  
  <div class="col-xs-6">
    <?php
      $no_surat = "";

      $max = 6;

      $count = strlen($surat_jalan->id);

      $sisa = $max - $count;

      if ($sisa > 0){
        $nol = "";
        for ($i=1; $i <= $sisa ; $i++ ) { 
          $nol .="0";
        }

        $no_surat = $nol.$surat_jalan->id;
      }else{
        $no_surat = $surat_jalan->id;
      }

    ?>
    <h3>SURAT JALAN No. <?php echo $no_surat; ?>/<?php echo date("my",strtotime($surat_jalan->created_on)); ?></h3>
  Bersama ini kendaraan ............ No. ................<br>
  kami kirimkan barang-barang, tersebut dibawah ini<br>
  Harap diterima dengan baik.
  </div>
  
  <div class="col-xs-6 pull-right">
    <div class="pull-right">
      ________________________________________________
    </div>
    
  </div>
  <div class="col-xs-12 text-center">
    <?php
      if ($surat_jalan->status_kirim == "ship_to") {
        echo $surat_jalan->ship_to;
      }else{
        //echo $surat_jalan->nama_customer;
      }
      
    ?>
  </div>
</div>


  
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
          <tr>
            <th width="100">Banyaknya</th>
            <th colspan="2">Nama Barang</th>
            <th>Motif</th>
            <th>Keterangan</th>

     

          </tr>
          </thead>
          <tbody>
          <?php
				$total = 0;
				foreach ($motif_keluar_detail as $row) {
					?>
						<tr>
							<td><span style="float:right;"><?php echo $row->qty; ?></span></td>
              <td width="130">
                <?php 
                  $this->db->where("id",$row->type_id);
                  $type = $this->db->get("type");
                  if ($type->num_rows() > 0){
                    echo $type->row()->nama; 
                  }
                ?>
                  
              </td>
              <td><?php echo $row->nama; ?></td>
							<td><?php echo $row->motif; ?></td>
							<td><?php if ($row->ket == null) {echo "-";}else{echo $row->ket;} ?></td>
						</tr>
					<?php
				}
			?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
<div class="row">
  <div class="col-xs-4 text-center">
    Mengetahui :
    <br>
    <br>
    <br>
    <br>
    (___________________________)
  </div>
  <div class="col-xs-4 text-center">
    <div style="border:1px solid #000;width: 150px;padding:7px;">
        Barang yang sudah<br>
        diterima tidak dapat<br>
        ditukar / dikembalikan
      </div>
  </div>
  <div class="col-xs-4 text-center">
    Toko :
    <br>
    <br>
    <br>
    <br>
    (___________________________)
  </div>
</div>
    