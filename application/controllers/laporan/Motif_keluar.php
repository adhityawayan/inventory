<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Motif_keluar extends Admin_Controller {
		private $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		public function index(){
			$this->data['header_title'] = "Laporan Motif keluar";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_barangkeluar_view";
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
			$this->data['header_title'] = "Laporan Motif keluar";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_barangkeluar_view";
			$this->data['bulan']	= $this->bulan;
			$this->data['tipe_laporan']	= "harian";
			$this->data['table'] = "admin/laporan_barangkeluar_motif_tabel_view";
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

			$this->data['box_title'] = "Laporan Barang Keluar ".$nama_barang." ".$nama_type." Tanggal ".$tgl;

			$this->data['link']	= site_url('laporan/motif_keluar/cetak_harian/'.$barang_id.'/'.$type_id.'/'.$split_tgl[0].'/'.$split_tgl[1].'/'.$split_tgl[2]);

			if ($barang_id != "semua"){
				$this->db->where("id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("type_id",$type_id);
			}

			
			$motif = $this->db->get("motif");

			$this->data['motif'] = $motif;

			
			$this->db->select("*, motif_keluar_detail.qty as 'qty_detail'");
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

			$this->data['laporan'] = $laporan;

			$this->_render_page();
		}


		public function bulanan(){

			$this->data['header_title'] = "Laporan Motif keluar";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_barangkeluar_view";
			$this->data['bulan']	= $this->bulan;
			$this->data['tipe_laporan']	= "bulanan";
			$this->data['table'] = "admin/laporan_barangkeluar_motif_tabel_view";
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

			$this->data['box_title'] = "Laporan Barang Keluar ".$nama_barang." ".$nama_type." Bulan ".$this->bulan[$bln-1]." ".$tahun;
			$this->data['link']	= site_url('laporan/motif_keluar/cetak_bulanan/'.$barang_id.'/'.$type_id.'/'.$bln.'/'.$tahun);

			if ($barang_id != "semua"){
				$this->db->where("id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("type_id",$type_id);
			}

			
			$motif = $this->db->get("motif");

			$this->data['motif'] = $motif;

			$this->db->select("*, motif_keluar_detail.qty as 'qty_detail'");
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

			$this->data['laporan'] = $laporan;

			$this->_render_page();
		}


		public function cetak_harian($barang_id, $type_id, $tgl, $bulan, $tahun){
			if ($bulan == null or $tahun == null){
				redirect('laporan/motif_keluar','refresh');
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

			if ($barang_id != "semua"){
				$this->db->where("id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("type_id",$type_id);
			}

			
			$motif = $this->db->get("motif");

			$this->data['motif'] = $motif;

			$this->db->select("*, motif_keluar_detail.qty as 'qty_detail'");
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


			$this->data['laporan_title'] = "<h3 class='page-header'>Laporan Barang Keluar ".$nama_barang." ".$nama_type." Per Tanggal ".$tgl."/".$bulan."/".$tahun."</h3>";
			$this->data['laporan'] = $laporan;
			$this->data['content']					= 'admin/laporan_barangkeluar_motif_tabel_view';
				
			$this->_render_print();
		}

		public function cetak_bulanan($barang_id, $type_id , $bulan, $tahun){
			if ($bulan == null or $tahun == null){
				redirect('laporan/motif_keluar','refresh');
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



			if ($barang_id != "semua"){
				$this->db->where("id",$barang_id);
			}

			if ($type_id != "semua"){
				$this->db->where("type_id",$type_id);
			}

			
			$motif = $this->db->get("motif");

			$this->data['motif'] = $motif;

			$this->db->select("*, motif_keluar_detail.qty as 'qty_detail'");
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

			$this->data['laporan'] = $laporan;

			$this->data['laporan_title'] = "<h3 class='page-header'>Laporan Barang Keluar ".$nama_barang." ".$nama_type." Bulan ".$this->bulan[$bulan-1]." ".$tahun."</h3>";
			$this->data['laporan'] = $laporan;
			$this->data['content']					= 'admin/laporan_barangkeluar_motif_tabel_view';
				
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