






<div class="row">
      <div class="col-xs-1">
        <img src="<?php echo base_url('img/logo.png'); ?>" width="80">
      </div>
      <!-- /.col -->

      <div class="col-xs-7">
        <p style="font-size: 25px;margin: 0;">PT. INTERNAL TEKSTIL GRUP</p>
        <?php
            $return_id = "";

            $max = 6;

            $count = strlen($return_out->id);

            $sisa = $max - $count;

            if ($sisa > 0){
              $nol = "";
              for ($i=1; $i <= $sisa ; $i++ ) { 
                $nol .="0";
              }

              $return_id = $nol.$return_out->id;
            }else{
              $return_id = $return_out->id;
            }

          ?>
        <p style="font-size: 20px;margin: 0;">No. <?php echo $return_id; ?>/<?php echo date("m",strtotime($return->tanggal)); ?><?php echo date("y",strtotime($return->tanggal)); ?></p>
      </div>

      <div class="col-xs-4">
        <div class="pull-right">
          <table>
            <tr>
                <td >Tanggal</td>
                <td >:</td>
                <td class="pull-right"><?php echo date('d M Y',strtotime($return->tanggal)); ?></td>
            </tr>
            <tr>
                <td>Tuan/Toko</td>
                <td>:</td>
                <td class="pull-right">&nbsp;&nbsp;&nbsp;...........................................................</td>
            </tr>
            
          </table>
        </div>
         
      </div>
    </div>

<div class="row">
  <div class="col-xs-8 text-center">
      <p style="font-size: 20px;font-weight: bold;">RETUR</p> 
  </div>

  <div class="col-xs-4 pull-right">
    ________________________________________________
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
            <th>Keterangan</th>

     

          </tr>
          </thead>
          <tbody>
          <?php
				$total = 0;
				foreach ($return_detail as $row) {
					?>
						<tr>
							<td><span style="float:right;"><?php echo $row->qty; ?></span></td>
              <td width="130"></td>
							<td><?php echo $row->nama; ?></td>
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
    Penerima :
    <br>
    <br>
    <br>
    <br>
    (___________________________)
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
    