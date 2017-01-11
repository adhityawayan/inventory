<li class="header">INVENTORY</li>
<li <?php if ($this->uri->segment(1) == "home"){echo " class='active' "; } ?>><a href="<?php echo site_url('home') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
<li <?php if ($this->uri->segment(1) == "master"){echo " class='active' "; } ?> class="treeview">
  <a href="#"><i class="fa fa-hdd-o"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="<?php echo site_url('master/barang'); ?>"><i class="fa fa-circle-o"></i> Master Barang</a></li>
    <li><a href="<?php echo site_url('master/type'); ?>"><i class="fa fa-circle-o"></i> Master Type</a></li>
    <li><a href="<?php echo site_url('master/motif'); ?>"><i class="fa fa-circle-o"></i> Master Motif</a></li>
    <li><a href="<?php echo site_url('master/supplier'); ?>"><i class="fa fa-circle-o"></i> Master Supplier</a></li>
    <li><a href="<?php echo site_url('master/customer'); ?>"><i class="fa fa-circle-o"></i> Master Customer</a></li>
    <li><a href="<?php echo site_url('master/company'); ?>"><i class="fa fa-circle-o"></i> Master Company</a></li>
    <li><a href="<?php echo site_url('master/promo'); ?>"><i class="fa fa-circle-o"></i> Master Promo</a></li>
  </ul>
</li>
<li <?php if ($this->uri->segment(1) == "stok_opname"){echo " class='active' "; } ?>><a href="<?php echo site_url('stok_opname') ?>"><i class="fa fa-edit"></i> <span>Stok Opname</span></a></li>

<li <?php if ($this->uri->segment(1) == "motif_masuk" or $this->uri->segment(1) == "motif_keluar" or $this->uri->segment(1) == "return_motif"){echo " class='active' "; } ?> class="treeview" >
  <a href="#"><i class="fa fa-list"></i> <span>Transaksi</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="<?php echo site_url('motif_masuk'); ?>"><i class="fa fa-circle-o"></i> Motif Masuk</a></li>
    <li><a href="<?php echo site_url('motif_keluar'); ?>"><i class="fa fa-circle-o"></i> Motif Keluar</a></li>
    <li><a href="<?php echo site_url('return_motif'); ?>"><i class="fa fa-circle-o"></i> Retur Motif</a></li>
  </ul>
</li>
<li <?php if ($this->uri->segment(2) == "pesanan_cust"){echo " class='active' "; } ?>><a href="<?php echo site_url('histori/pesanan_cust') ?>"><i class="fa fa-folder-open"></i> <span>Histori Pesanan Customer</span></a></li>
<li <?php if ($this->uri->segment(2) == "retur_cust"){echo " class='active' "; } ?>><a href="<?php echo site_url('histori/retur_cust') ?>"><i class="fa fa-folder-open"></i> <span>Histori Retur Customer</span></a></li>


<li <?php if ($this->uri->segment(2) == "aktivitas_user"){echo " class='active' "; } ?>><a href="<?php echo site_url('histori/aktivitas_user') ?>"><i class="fa fa-newspaper-o"></i> <span>Aktifitas User</span></a></li>

<li <?php if ($this->uri->segment(1) == "laporan"){echo " class='active' "; } ?> class="treeview" >
  <a href="#"><i class="fa fa-print"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="<?php echo site_url('laporan/motif_masuk'); ?>"><i class="fa fa-circle-o"></i> Laporan Motif Masuk</a></li>
    <li><a href="<?php echo site_url('laporan/motif_keluar'); ?>"><i class="fa fa-circle-o"></i> Laporan Motif Keluar</a></li>
    <li><a href="<?php echo site_url('laporan/stok_terakhir'); ?>"><i class="fa fa-circle-o"></i> Laporan Stok Akhir</a></li>
    <li><a href="<?php echo site_url('laporan/penjualan'); ?>"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
  </ul>
</li>
        
<li class="header">ADMINISTRATOR</li>
<li <?php if ($this->uri->segment(1) == "user"){echo " class='active' "; } ?>><a href="<?php echo site_url('user') ?>"><i class="fa fa-user"></i> <span>User Management</span></a></li>