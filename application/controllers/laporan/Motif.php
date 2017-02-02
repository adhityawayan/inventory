<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Motif extends Admin_Controller {
		private $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		public function __construct(){
			parent::__construct();
			$this->load->model("customer_model");
			$this->load->model("surat_jalan_model");

		}
		public function index(){
			$this->data['header_title'] = "Laporan Motif Masuk & Keluar";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_barangmasukkeluar_view";
			$this->data['bulan']	= $this->bulan;
			$this->data['tipe_laporan']	= "";
			$this->data['link']	= "#";
			$this->data['box_title'] = "Laporan";
			$this->data['table'] = "";
			$this->data['barang'] = $this->_barang_dropdown();
			$this->data['type'] = $this->_type_dropdown();

			$this->_render_page();
		}


		public function harian(){
			$this->data['header_title'] = "Laporan Motif Masuk & Keluar";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_barangmasukkeluar_view";
			$this->data['bulan']	= $this->bulan;
			$this->data['tipe_laporan']	= "harian";
			$this->data['table'] = "admin/laporan_barangmasukkeluar_tabel";
			$this->data['barang'] = $this->_barang_dropdown();
			$this->data['type'] = $this->_type_dropdown();

			$barang_id = $this->input->post('barang_id');
			$type_id = $this->input->post('type_id');

			//nama barang dan type
			$nama_barang = "Semua Barang";
			$nama_type = "Semua Type";

			if ($type_id != "semua"){
				$this->db->where("id",$type_id);
				$type = $this->db->get("type");
				$nama_type = $type->row()->nama;
			}

			if ($barang_id != "semua"){
				$this->db->where("id",$barang_id);
				$barang = $this->db->get("barang");
				$nama_barang = $barang->row()->nama;
			}
			//end

			$tgl = $this->input->post('tanggal');
			$split_tgl = explode("/", $tgl);

			$this->data['box_title'] = "Laporan Barang Masuk & Keluar ".$nama_barang." ".$nama_type." Tanggal ".$tgl;

			$this->data['link']	= site_url('laporan/motif/cetak_harian/'.$barang_id.'/'.$type_id.'/'.$split_tgl[0].'/'.$split_tgl[1].'/'.$split_tgl[2]);

			// if ($barang_id != "semua"){
			// 	$this->db->where("id",$barang_id);
			// }

			// if ($type_id != "semua"){
			// 	$this->db->where("type_id",$type_id);
			// }

			
			$motif = $this->db->get("motif");

			$this->data['motif'] = $motif;

			//masuk
			$this->db->select("*, motif_masuk_detail.qty as 'qty_detail'");
			$this->db->join("motif","motif.id = motif_masuk_detail.motif_id");
			$this->db->join("motif_masuk","motif_masuk.id=motif_masuk_detail.motif_masuk_id");
			$this->db->where("motif_masuk.tanggal",$split_tgl[2]."-".$split_tgl[1]."-".$split_tgl[0]);
			



			if ($barang_id != "semua"){
				$this->db->where("motif_masuk_detail.barang_id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("motif_masuk_detail.type_id",$type_id);
			}

			

			$this->db->where("tersimpan","sudah");
			$laporan = $this->db->get("motif_masuk_detail");

			$laporan_semua = array();

			foreach ($laporan->result() as $row) {
				$laporan_semua[] = [
					'tanggal' => $row->tanggal,
					'masuk_keluar'	=> 'Barang Masuk',
					'qty' => $row->qty_detail,
					'nama' => $row->nama,
					'ket' => ($row->ket == null)? "-":$row->ket,
					'surat_jalan'	=> '',
					'nama_cust'		=> '',
				];
				
			}

			// $this->data['laporan'] = $laporan;


			//keluar
			$this->db->select("*, motif_keluar_detail.qty as 'qty_detail', motif_keluar.id as motif_keluar_id");
			$this->db->join("motif_keluar","motif_keluar.id=motif_keluar_detail.motif_keluar_id");
			$this->db->where("motif_keluar.tanggal",$split_tgl[2]."-".$split_tgl[1]."-".$split_tgl[0]);
			
			$this->db->join("motif","motif.id = motif_keluar_detail.motif_id");



			if ($barang_id != "semua"){
				$this->db->where("motif_keluar_detail.barang_id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("motif_keluar_detail.type_id",$type_id);
			}

			

			$this->db->where("tersimpan","sudah");
			$laporan = $this->db->get("motif_keluar_detail");


			foreach ($laporan->result() as $row) {
				//data surat jalan
				$surat_jalan = $this->surat_jalan_model->get_surat($row->motif_keluar_id);
				if ($surat_jalan != null){

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
				      $no_surat_jalan = $no_surat."/".date("my",strtotime($surat_jalan->created_on));
				  }else{
				  		$no_surat_jalan = "Surat Belum Dicetak";
				  }

				$laporan_semua[] = [
					'tanggal' => $row->tanggal,
					'masuk_keluar'	=> 'Barang Keluar',
					'qty' => $row->qty_detail,
					'nama' => $row->nama,
					'ket' => ($row->ket == null)? "-":$row->ket,
					'surat_jalan'	=> $no_surat_jalan,
					'nama_cust'		=> $this->customer_model->get_cust($row->customer_id)->nama,
				];
			}

			
			function cmp($a, $b){
			    $a = strtotime($a['tanggal']);
			    $b = strtotime($b['tanggal']);

			    if ($a == $b) {
			        return 0;
			    }
			    return ($a < $b) ? -1 : 1;
			}

			usort($laporan_semua, "cmp");


			$this->data['laporan'] = $laporan_semua;

			$this->_render_page();
		}


		public function bulanan(){

			$this->data['header_title'] = "Laporan Motif Masuk & Keluar";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_barangmasukkeluar_view";
			$this->data['bulan']	= $this->bulan;
			$this->data['tipe_laporan']	= "bulanan";
			$this->data['table'] = "admin/laporan_barangmasukkeluar_tabel";
			$this->data['barang'] = $this->_barang_dropdown();
			$this->data['type'] = $this->_type_dropdown();

			$barang_id = $this->input->post("barang_id");
			$type_id = $this->input->post("type_id");

			//nama barang dan type
			$nama_barang = "Semua Barang";
			$nama_type = "Semua Type";

			if ($type_id != "semua"){
				$this->db->where("id",$type_id);
				$type = $this->db->get("type");
				$nama_type = $type->row()->nama;
			}

			if ($barang_id != "semua"){
				$this->db->where("id",$barang_id);
				$barang = $this->db->get("barang");
				$nama_barang = $barang->row()->nama;
			}
			//end
			$bln = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");

			$this->data['box_title'] = "Laporan Barang Masuk & Keluar ".$nama_barang." ".$nama_type." Bulan ".$this->bulan[$bln-1]." ".$tahun;
			$this->data['link']	= site_url('laporan/motif/cetak_bulanan/'.$barang_id.'/'.$type_id.'/'.$bln.'/'.$tahun);

			// if ($barang_id != "semua"){
			// 	$this->db->where("id",$barang_id);
			// }

			// if ($type_id != "semua"){
			// 	$this->db->where("type_id",$type_id);
			// }

			
			$motif = $this->db->get("motif");

			$this->data['motif'] = $motif;

			//laporan masuk
			$this->db->select("*, motif_masuk_detail.qty as 'qty_detail'");
			$this->db->join("motif","motif.id = motif_masuk_detail.motif_id");
			$this->db->join("motif_masuk","motif_masuk.id=motif_masuk_detail.motif_masuk_id");

			if ($barang_id != "semua"){
				$this->db->where("motif_masuk_detail.barang_id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("motif_masuk_detail.type_id",$type_id);
			}


			$this->db->where("month(motif_masuk.tanggal)",$bln);
			$this->db->where("year(motif_masuk.tanggal)",$tahun);
			$this->db->where("tersimpan","sudah");
			$laporan = $this->db->get("motif_masuk_detail");

			// $this->data['laporan'] = $laporan;

			$laporan_semua = array();

			foreach ($laporan->result() as $row) {
				$laporan_semua[] = [
					'tanggal' => $row->tanggal,
					'masuk_keluar'	=> 'Barang Masuk',
					'qty' => $row->qty_detail,
					'nama' => $row->nama,
					'ket' => ($row->ket == null)? "-":$row->ket,
					'surat_jalan'	=> '',
					'nama_cust'		=> '',
				];
			}


			// laporan keluar
			


			$this->db->select("*, motif_keluar_detail.qty as 'qty_detail', motif_keluar.id as motif_keluar_id");
			$this->db->join("motif_keluar","motif_keluar.id=motif_keluar_detail.motif_keluar_id");




			$this->db->join("motif","motif.id = motif_keluar_detail.motif_id");



			if ($barang_id != "semua"){
				$this->db->where("motif_keluar_detail.barang_id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("motif_keluar_detail.type_id",$type_id);
			}

			

			$this->db->where("month(motif_keluar.tanggal)",$bln);
			$this->db->where("year(motif_keluar.tanggal)",$tahun);
			$this->db->where("tersimpan","sudah");
			$laporan = $this->db->get("motif_keluar_detail");

			foreach ($laporan->result() as $row) {
				//data surat jalan
				$surat_jalan = $this->surat_jalan_model->get_surat($row->motif_keluar_id);
				if ($surat_jalan != null){

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
				      $no_surat_jalan = $no_surat."/".date("my",strtotime($surat_jalan->created_on));
				  }else{
				  		$no_surat_jalan = "Surat Belum Dicetak";
				  }

				$laporan_semua[] = [
					'tanggal' => $row->tanggal,
					'masuk_keluar'	=> 'Barang Keluar',
					'qty' => $row->qty_detail,
					'nama' => $row->nama,
					'ket' => ($row->ket == null)? "-":$row->ket,
					'surat_jalan'	=> $no_surat_jalan,
					'nama_cust'		=> $this->customer_model->get_cust($row->customer_id)->nama,
				];
			}

			function cmp($a, $b){
			    $a = strtotime($a['tanggal']);
			    $b = strtotime($b['tanggal']);

			    if ($a == $b) {
			        return 0;
			    }
			    return ($a < $b) ? -1 : 1;
			}

			usort($laporan_semua, "cmp");


			$this->data['laporan'] = $laporan_semua;


			$this->_render_page();
		}


		public function cetak_harian($barang_id, $type_id, $tgl, $bulan, $tahun){
			if ($bulan == null or $tahun == null){
				redirect('laporan/motif_masuk','refresh');
				exit;
			}

			//nama barang dan type
			$nama_barang = "Semua Barang";
			$nama_type = "Semua Type";

			if ($type_id != "semua"){
				$this->db->where("id",$type_id);
				$type = $this->db->get("type");
				$nama_type = $type->row()->nama;
			}

			if ($barang_id != "semua"){
				$this->db->where("id",$barang_id);
				$barang = $this->db->get("barang");
				$nama_barang = $barang->row()->nama;
			}
			//end

			// if ($barang_id != "semua"){
			// 	$this->db->where("id",$barang_id);
			// }

			// if ($type_id != "semua"){
			// 	$this->db->where("type_id",$type_id);
			// }

			
			$motif = $this->db->get("motif");

			$this->data['motif'] = $motif;
			

			$this->db->select("*, motif_masuk_detail.qty as 'qty_detail'");
			$this->db->join("motif","motif.id = motif_masuk_detail.motif_id");
			$this->db->join("motif_masuk","motif_masuk.id=motif_masuk_detail.motif_masuk_id");
			$this->db->where("motif_masuk.tanggal",$tahun."-".$bulan."-".$tgl);
			



			if ($barang_id != "semua"){
				$this->db->where("motif_masuk_detail.barang_id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("motif_masuk_detail.type_id",$type_id);
			}

			

			$this->db->where("tersimpan","sudah");
			$laporan = $this->db->get("motif_masuk_detail");

			$laporan_semua = array();

			foreach ($laporan->result() as $row) {
				$laporan_semua[] = [
					'tanggal' => $row->tanggal,
					'masuk_keluar' => 'Barang Masuk',
					'qty' => $row->qty_detail,
					'nama' => $row->nama,
					'ket' => ($row->ket == null)? "-":$row->ket,
					'surat_jalan'	=> '',
					'nama_cust'		=> '',
				];
				
			}

			// $this->data['laporan'] = $laporan;


			//keluar
			$this->db->select("*, motif_keluar_detail.qty as 'qty_detail', motif_keluar.id as motif_keluar_id");
			$this->db->join("motif_keluar","motif_keluar.id=motif_keluar_detail.motif_keluar_id");
			$this->db->where("motif_keluar.tanggal",$tahun."-".$bulan."-".$tgl);
			
			$this->db->join("motif","motif.id = motif_keluar_detail.motif_id");



			if ($barang_id != "semua"){
				$this->db->where("motif_keluar_detail.barang_id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("motif_keluar_detail.type_id",$type_id);
			}

			

			$this->db->where("tersimpan","sudah");
			$laporan = $this->db->get("motif_keluar_detail");


			foreach ($laporan->result() as $row) {
				//data surat jalan
				$surat_jalan = $this->surat_jalan_model->get_surat($row->motif_keluar_id);
				if ($surat_jalan != null){

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
				      $no_surat_jalan = $no_surat."/".date("my",strtotime($surat_jalan->created_on));
				  }else{
				  		$no_surat_jalan = "Surat Belum Dicetak";
				  }

				$laporan_semua[] = [
					'tanggal' => $row->tanggal,
					'masuk_keluar' => 'Barang Keluar',
					'qty' => $row->qty_detail,
					'nama' => $row->nama,
					'ket' => ($row->ket == null)? "-":$row->ket,
					'surat_jalan'	=> $no_surat_jalan,
					'nama_cust'		=> $this->customer_model->get_cust($row->customer_id)->nama,
				];
			}

			function cmp($a, $b){
			    $a = strtotime($a['tanggal']);
			    $b = strtotime($b['tanggal']);

			    if ($a == $b) {
			        return 0;
			    }
			    return ($a < $b) ? -1 : 1;
			}

			usort($laporan_semua, "cmp");



			$this->data['laporan_title'] = "<h3 class='page-header'>Laporan Barang Masuk & Keluar ".$nama_barang." ".$nama_type." Per Tanggal ".$tgl."/".$bulan."/".$tahun."</h3>";
			$this->data['laporan'] = $laporan_semua;
			$this->data['content']					= 'admin/laporan_barangmasukkeluar_tabel';
				
			$this->_render_print();
		}

		public function cetak_bulanan($barang_id, $type_id , $bulan, $tahun){
			if ($bulan == null or $tahun == null){
				redirect('laporan/motif_masuk','refresh');
				exit;
			}

			//nama barang dan type
			$nama_barang = "Semua Barang";
			$nama_type = "Semua Type";

			if ($type_id != "semua"){
				$this->db->where("id",$type_id);
				$type = $this->db->get("type");
				$nama_type = $type->row()->nama;
			}

			if ($barang_id != "semua"){
				$this->db->where("id",$barang_id);
				$barang = $this->db->get("barang");
				$nama_barang = $barang->row()->nama;
			}
			//end



			// if ($barang_id != "semua"){
			// 	$this->db->where("id",$barang_id);
			// }

			// if ($type_id != "semua"){
			// 	$this->db->where("type_id",$type_id);
			// }

			
			$motif = $this->db->get("motif");

			$this->data['motif'] = $motif;


			$this->db->select("*, motif_masuk_detail.qty as 'qty_detail'");
			$this->db->join("motif","motif.id = motif_masuk_detail.motif_id");
			$this->db->join("motif_masuk","motif_masuk.id=motif_masuk_detail.motif_masuk_id");




			if ($barang_id != "semua"){
				$this->db->where("motif_masuk_detail.barang_id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("motif_masuk_detail.type_id",$type_id);
			}

			


			$this->db->where("month(motif_masuk.tanggal)",$bulan);
			$this->db->where("year(motif_masuk.tanggal)",$tahun);
			$this->db->where("tersimpan","sudah");
			$laporan = $this->db->get("motif_masuk_detail");

			$this->data['laporan'] = $laporan;


			$laporan_semua = array();

			foreach ($laporan->result() as $row) {
				$laporan_semua[] = [
					'tanggal' => $row->tanggal,
					'masuk_keluar' => 'Barang Masuk',
					'qty' => $row->qty_detail,
					'nama' => $row->nama,
					'ket' => ($row->ket == null)? "-":$row->ket,
					'surat_jalan'	=> '',
					'nama_cust'		=> '',

				];
			}


			// laporan keluar
			


			$this->db->select("*, motif_keluar_detail.qty as 'qty_detail', motif_keluar.id as motif_keluar_id");
			$this->db->join("motif_keluar","motif_keluar.id=motif_keluar_detail.motif_keluar_id");




			$this->db->join("motif","motif.id = motif_keluar_detail.motif_id");



			if ($barang_id != "semua"){
				$this->db->where("motif_keluar_detail.barang_id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("motif_keluar_detail.type_id",$type_id);
			}

			

			$this->db->where("month(motif_keluar.tanggal)",$bulan);
			$this->db->where("year(motif_keluar.tanggal)",$tahun);
			$this->db->where("tersimpan","sudah");
			$laporan = $this->db->get("motif_keluar_detail");

			foreach ($laporan->result() as $row) {
				//data surat jalan
				$surat_jalan = $this->surat_jalan_model->get_surat($row->motif_keluar_id);
				if ($surat_jalan != null){

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
				      $no_surat_jalan = $no_surat."/".date("my",strtotime($surat_jalan->created_on));
				  }else{
				  		$no_surat_jalan = "Surat Belum Dicetak";
				  }
				//end data

				$laporan_semua[] = [
					'tanggal' => $row->tanggal,
					'masuk_keluar' => 'Barang Keluar',
					'qty' => $row->qty_detail,
					'nama' => $row->nama,
					'ket' => ($row->ket == null)? "-":$row->ket,
					'surat_jalan'	=> $no_surat_jalan,
					'nama_cust'		=> $this->customer_model->get_cust($row->customer_id)->nama,
				];
			}

			function cmp($a, $b){
			    $a = strtotime($a['tanggal']);
			    $b = strtotime($b['tanggal']);

			    if ($a == $b) {
			        return 0;
			    }
			    return ($a < $b) ? -1 : 1;
			}

			usort($laporan_semua, "cmp");



			$this->data['laporan_title'] = "<h3 class='page-header'>Laporan Barang Masuk & Keluar ".$nama_barang." ".$nama_type." Bulan ".$this->bulan[$bulan-1]." ".$tahun."</h3>";
			$this->data['laporan'] = $laporan_semua;
			$this->data['content']					= 'admin/laporan_barangmasukkeluar_tabel';
				
			$this->_render_print();
		}

		private function _barang_dropdown(){
			$data = array();

			$this->db->select('id, nama');
	        $this->db->order_by('nama','asc');
	        $query = $this->db->get('barang');
	        $maxkode = 20;

	        if ($query->num_rows() > 0)
	        {
	            
	            foreach ($query->result_array() as $row)
	            {
	            	$count = strlen($row['id']);
		            $nbsp = "";
	            	if ($maxkode >= $count){
	            		$hit = $maxkode - $count;
		            	for ($i=0; $i < $hit; $i++) { 
		            		$nbsp .= "&nbsp;";
		            	}
	            	}else{
	            		$nbsp = "&nbsp;&nbsp;";
	            	}
	            	

	                $data[$row['id']] = $row['nama']; 
	            }
	        }else{
	        	$data[''] = '';
	        }
	        $query->free_result();
	        return $data; 
		}

		private function _type_dropdown(){
			$this->db->select('id, nama');
	        $this->db->order_by('id','asc');
	        $query = $this->db->get('type');
	        if ($query->num_rows() > 0)
	        {
	            $data = array();
	            foreach ($query->result_array() as $row)
	            {
	                $data[$row['id']] = $row['nama']; 
	            }
	        }else{
	        	$data[''] = '';
	        }
	        $query->free_result();
	        return $data; 
		}

	}