<div class="row">
      <div class="col-xs-1">
        <img src="<?php echo base_url("img/logo.png"); ?>" width="40">
      </div>
      <div class="col-xs-11">
        <h2 class="page-header">

          <i class="fa fa-globe"></i> Invoice
          <small class="pull-right">
          <?php
            $no_invoice = "";

            $max = 6;

            $count = strlen($invoice->id);

            $sisa = $max - $count;

            if ($sisa > 0){
              $nol = "";
              for ($i=1; $i <= $sisa ; $i++ ) { 
                $nol .="0";
              }

              $no_invoice = $nol.$invoice->id;
            }else{
              $no_invoice = $invoice->id;
            }

          ?>

          	No. Invoice : <?php echo $no_invoice; ?>/<?php echo date("m",strtotime($motif_keluar->tanggal)); ?><?php echo date("y",strtotime($motif_keluar->tanggal)); ?> | Tanggal Cetak : <?php echo date('d/m/Y',strtotime($invoice->created_on)); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>


    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Nama motif</th>
            <th>Keterangan</th>
            <th>Harga</th>
            <th>Subtotal</th>

     

          </tr>
          </thead>
          <tbody>
          <?php
				$total = 0;
				foreach ($motif_keluar_detail as $row) {
					$total += $row->subtotal;
					?>
						<tr>
							<td><span style="float:right;"><?php echo $row->qty; ?></span></td>
							<td><?php echo $row->nama; ?></td>
							<td><?php if ($row->ket == null) {echo "-";}else{echo $row->ket;} ?></td>
							<td>Rp <span style="float:right;"><?php echo number_format($row->harga,0,",","."); ?></span></td>
							<td>Rp <span style="float:right;"><?php echo number_format($row->subtotal,0,",","."); ?></span></td>
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
      <!-- accepted payments column -->
      <div class="col-xs-7">
        

       
      </div>
      <!-- /.col -->
      <div class="col-xs-5">
        <p class="lead"></p>

        <div class="table-responsive">
          <table class="table">
            
            <tr>
              <th>Total:</th>
              <td><span style="float:left;">Rp</span> <span style="float:right;"><?php echo number_format($total,0,",","."); ?></span></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->