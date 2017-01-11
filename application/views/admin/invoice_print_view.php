<!--<style type="text/css">
	#table td,#table th{
		border:1px solid #000;
		padding:3px;

	}
	#table{
		margin-top:8px;
	}
	h3{
		margin-bottom: 2px;
	}
</style>
<center>
	
<h3>INVOICE<br>No. <?php echo $invoice->id; ?></h3>
</center>

<table id="table" width="100%" style="border:1px solid #000;" >
	<tr style="background: #eee;">
		<th>Nama Barang</th>
		<th>Qty</th>
		<th>Harga</th>
		<th>Keterangan</th>
		<th>Total</th>
	</tr>
	<?php
		$total = 0;
		foreach ($barang_keluar_detail as $row) {
			$total += $row->subtotal;
			?>
				<tr>
					<td><?php echo $row->nama; ?></td>
					<td><span style="float:right;"><?php echo $row->qty; ?></span></td>
					<td>Rp <span style="float:right;"><?php echo number_format($row->harga,0,",","."); ?></span></td>
					<td><?php echo $row->ket; ?></td>
					<td>Rp <span style="float:right;"><?php echo number_format($row->subtotal,0,",","."); ?></span></td>
				</tr>
			<?php
		}
	?>
	<tr>
		<th colspan="4"><span style="float:right;">Total</span></th>
		<th><span style="float:left;">Rp</span> <span style="float:right;"><?php echo number_format($total,0,",","."); ?></span></th>
	</tr>
</table>
<br>

<table width="100%">
	<tr>
		<td valign="top">
			Tanda Terima,
			<br>	
			<br>	
			<br>	
			<br>
			<br>
			( _____________________ )	
		</td>
		<td valign="top">
			<div style="border:1px solid #000;width: 150px;padding:7px;">
				Barang yang sudah<br>
				diterima tidak dapat<br>
				ditukar / dikembalikan
			</div>
		</td>
		<td valign="top">
			Hormat Kami,
			<br>	
			<br>	
			<br>	
			<br>	
			<br>
			( _____________________ )
		</td>
	</tr>
</table>

<script type="text/javascript">
	window.print();
</script>-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Inventory
          <small class="pull-right">
          	No. Invoice : <?php echo $invoice->id; ?> | Tanggal : <?php echo $invoice->datetime; ?></small>
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
            <th>Nama Barang</th>
            <th>Keterangan</th>
            <th>Harga</th>
            <th>Subtotal</th>

     

          </tr>
          </thead>
          <tbody>
          <?php
				$total = 0;
				foreach ($barang_keluar_detail as $row) {
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
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
