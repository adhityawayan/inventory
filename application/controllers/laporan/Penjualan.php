<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Penjualan extends Admin_Controller {
		private $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		public function index(){
			$nama_barang = "Semua Barang";
			$nama_type = "Semua Type";
			$motif = $this->db->get("motif");

			$this->data['header_title'] = "Laporan Penjualan";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_penjualan_view";
			$this->data['tahun']	= date("Y");
			$this->data['link']	= site_url('laporan/penjualan/cetak_tahun/'.date("Y")."/semua/semua");
			$this->data['box_title'] = "Laporan Penjualan $nama_barang $nama_type Tahun ".$this->input->post("tahun");
			$this->data['table'] = "admin/laporan_penjualan_motif_tabel_view";
			$this->data['barang'] = $this->_barang_dropdown();
			$this->data['type'] = $this->_type_dropdown();

			

			

			$this->data['barang_id'] = "semua";
			$this->data['type_id'] = "semua";
			$this->data['motif'] = $motif;

			$this->_render_page();
		}

		public function tahun(){

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


			// if ($barang_id != "semua"){
			// 	$this->db->where("id",$barang_id);
			// }

			// if ($type_id != "semua"){
			// 	$this->db->where("type_id",$type_id);
			// }

			
			$motif = $this->db->get("motif");

			$this->data['barang_id'] = $barang_id;
			$this->data['type_id'] = $type_id;
			
			$this->data['motif'] = $motif;

			$this->data['header_title'] = "Laporan Penjualan";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_penjualan_view";
			$this->data['tahun']	= $this->input->post("tahun");
			$this->data['link']	= site_url('laporan/penjualan/cetak_tahun/'.$this->input->post("tahun")."/".$barang_id."/".$type_id);
			$this->data['box_title'] = "Laporan Penjualan $nama_barang $nama_type Tahun ".$this->input->post("tahun");
			$this->data['table'] = "admin/laporan_penjualan_motif_tabel_view";
			$this->data['barang'] = $this->_barang_dropdown();
			$this->data['type'] = $this->_type_dropdown();

			$this->_render_page();
		}

		public function cetak_tahun($tahun,$barang_id, $type_id) {

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

			$this->data['barang_id'] = $barang_id;
			$this->data['type_id'] = $type_id;

			$this->data['motif'] = $motif;


			$this->data['laporan_title'] = "<h3 class='page-header'>Laporan Penjualan $nama_barang $nama_type Tahun ".$tahun."</h3>";
			$this->data['tahun']	= $tahun;
			$this->data['content']					="admin/laporan_penjualan_motif_tabel_view";
				
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