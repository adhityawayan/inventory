<?php
  $user = $this->ion_auth->user()->row();
  $access = $this->db->query("select ua.menu_id, mn.nama, mn.segment1, mn.segment2, mn.segment3 from users_access ua right join menus mn on ua.menu_id = mn.id where user_id='2'");


?>
<li class="header">INVENTORY</li>
<li <?php if ($this->uri->segment(1) == "home"){echo " class='active' "; } ?>><a href="<?php echo site_url('home') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

<?php
  $temp = array();
  foreach ($access->result() as $row) {
    if ($row->segment1 == "master"){
      array_push($temp, $row->nama);
    }
  }

  if (count($temp) > 0):
?>
<li <?php if ($this->uri->segment(1) == "master"){echo " class='active' "; } ?> class="treeview">
  <a href="#"><i class="fa fa-hdd-o"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <?php if (in_array("Master Barang", $temp)): ?>
    <li><a href="<?php echo site_url('master/barang'); ?>"><i class="fa fa-circle-o"></i> Master Barang</a></li>
    <?php endif; ?>
    <?php if (in_array("Master Type", $temp)): ?>
    <li><a href="<?php echo site_url('master/type'); ?>"><i class="fa fa-circle-o"></i> Master Type</a></li>
    <?php endif; ?>
    <?php if (in_array("Master Motif", $temp)): ?>
    <li><a href="<?php echo site_url('master/motif'); ?>"><i class="fa fa-circle-o"></i> Master Motif</a></li>
    <?php endif; ?>
    <?php if (in_array("Master Supplier", $temp)): ?>
    <li><a href="<?php echo site_url('master/supplier'); ?>"><i class="fa fa-circle-o"></i> Master Supplier</a></li>
    <?php endif; ?>
    <?php if (in_array("Master Customer", $temp)): ?>
    <li><a href="<?php echo site_url('master/customer'); ?>"><i class="fa fa-circle-o"></i> Master Customer</a></li>
    <?php endif; ?>
    <?php if (in_array("Master Company", $temp)): ?>
    <li><a href="<?php echo site_url('master/company'); ?>"><i class="fa fa-circle-o"></i> Master Company</a></li>
    <?php endif; ?>
    <?php if (in_array("Master Promo", $temp)): ?>
    <li><a href="<?php echo site_url('master/promo'); ?>"><i class="fa fa-circle-o"></i> Master Promo</a></li>
    <?php endif; ?>
  </ul>
</li>
<?php
  endif;

  $temp = array();
  foreach ($access->result() as $row) {
    if ($row->segment1 == "stok_opname"){
      array_push($temp, $row->nama);
    }
  }

  if (count($temp) > 0):

?>
<li <?php if ($this->uri->segment(1) == "stok_opname"){echo " class='active' "; } ?>><a href="<?php echo site_url('stok_opname') ?>"><i class="fa fa-edit"></i> <span>Stok Opname</span></a></li>
<?php
  endif;

  $temp = array();
  foreach ($access->result() as $row) {
    if ($row->segment1 == "barang_masuk" or $row->segment1 == "barang_keluar" or $row->segment1 == "return_barang"){
      array_push($temp, $row->nama);
    }
  }

  if (count($temp) > 0):
?>
<li <?php if ($this->uri->segment(1) == "motif_masuk" or $this->uri->segment(1) == "motif_keluar" or $this->uri->segment(1) == "return_motif"){echo " class='active' "; } ?> class="treeview" >
  <a href="#"><i class="fa fa-list"></i> <span>Transaksi</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">

    <li><a href="<?php echo site_url('motif_masuk'); ?>"><i class="fa fa-circle-o"></i> Motif Masuk</a></li>
    <li><a href="<?php echo site_url('motif_keluar'); ?>"><i class="fa fa-circle-o"></i> Motif Keluar</a></li>
    <li><a href="<?php echo site_url('return_motif'); ?>"><i class="fa fa-circle-o"></i> Retur Motif</a></li>
  </ul>
</li>
<?php
  endif;

  $temp = array();
  foreach ($access->result() as $row) {
    if ($row->segment1 == "histori"){
      array_push($temp, $row->nama);
    }
  }

  if (count($temp) > 0):
?>
<li <?php if ($this->uri->segment(1) == "histori"){echo " class='active' "; } ?>><a href="<?php echo site_url('histori/pesanan_cust') ?>"><i class="fa fa-folder-open"></i> <span>Histori Pesanan Customer</span></a></li>
<?php
  endif;

  $temp = array();
  foreach ($access->result() as $row) {
    if ($row->segment1 == "laporan"){
      array_push($temp, $row->nama);
    }
  }

  if (count($temp) > 0):
?>

<li <?php if ($this->uri->segment(1) == "laporan"){echo " class='active' "; } ?> class="treeview" >
  <a href="#"><i class="fa fa-print"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="<?php echo site_url('laporan/barang_masuk'); ?>"><i class="fa fa-circle-o"></i> Laporan Barang Masuk</a></li>
    <li><a href="<?php echo site_url('laporan/barang_keluar'); ?>"><i class="fa fa-circle-o"></i> Laporan Barang Keluar</a></li>
  </ul>
</li>
        
<?php endif; ?>