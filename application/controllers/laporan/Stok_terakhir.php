<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Stok_terakhir extends Admin_Controller {
		public function index(){
			$barang_id = "semua";
			$type_id = "semua";

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

			$motif = $this->db->get("motif");

			$this->data['header_title'] = "Laporan Stok Akhir";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_stok_terakhir_view";
			$this->data['tahun']	= date('Y');
			$this->data['link']	= site_url('laporan/stok_terakhir/cetak_tahun/'.$barang_id.'/'.$type_id.'/'.date('Y'));
			$this->data['box_title'] = "Laporan Stok Akhir Tahun ".$this->input->post("tahun");
			$this->data['table'] = "admin/laporan_stok_terakhir_tabel_view";

			$this->data['barang'] = $this->_barang_dropdown();
			$this->data['type'] = $this->_type_dropdown();

			
			

			$this->data['motif'] = $motif;
			$this->data['barang_id'] = $barang_id;
			$this->data['type_id'] = $barang_id;


			$this->_render_page();
		}
		
		public function tahun(){

			
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

			// if ($barang_id != "semua"){
			// 	$this->db->where("id",$barang_id);
			// }

			// if ($type_id != "semua"){
			// 	$this->db->where("type_id",$type_id);
			// }

			
			$motif = $this->db->get("motif");

			$this->data['barang_id'] = $barang_id;
			$this->data['type_id'] = $barang_id;
			$this->data['motif'] = $motif;


			$this->data['header_title'] = "Laporan Stok Akhir";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_stok_terakhir_view";
			$this->data['tahun']	= $this->input->post("tahun");
			$this->data['link']	= site_url('laporan/stok_terakhir/cetak_tahun/'.$barang_id.'/'.$type_id.'/'.$this->input->post("tahun"));
			$this->data['box_title'] = "Laporan Stok Akhir Tahun ".$this->input->post("tahun");
			$this->data['table'] = "admin/laporan_stok_terakhir_tabel_view";
			$this->data['barang'] = $this->_barang_dropdown();
			$this->data['type'] = $this->_type_dropdown();
			

			$this->_render_page();
		}

		public function cetak_tahun($barang_id, $type_id, $tahun) {

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
			


			$this->data['laporan_title'] = "<h3 class='page-header'>Laporan Stok Akhir $nama_barang $nama_type Tahun ".$tahun."</h3>";
			$this->data['tahun']	= $tahun;
			$this->data['content'] = "admin/laporan_stok_terakhir_tabel_view";
			$this->data['barang'] = $this->_barang_dropdown();
			$this->data['type'] = $this->_type_dropdown();
				
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


		/*
		public function index(){

			$data_type = $this->_type_dropdown();
			$data_motif = $this->_motif_dropdown();

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Stok Terakhir');
			$crud->set_table('barang');
			$crud->unset_read();

			$crud->unset_columns("kode");
			
			$crud->display_as("type_id","Type");
			$crud->display_as("motif_id","Motif");
			$crud->display_as("qty","Jml Stok");

			$crud->field_type('type_id','dropdown',$data_type);
			$crud->field_type('motif_id','dropdown',$data_motif);
			$crud->field_type('qty','hidden','0');
			$crud->field_type('kode','hidden',null);

			$crud->required_fields('nama','harga','type_id','motif_id');

			$crud->unset_edit();
			$crud->unset_add();
			$crud->unset_delete();

			$output = $crud->render();
			 
			$this->data['header_title'] = "Stok Terakhir";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/laporan_stok_terakhir_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		public function cetak(){
			$data_type = $this->_type_dropdown();
			$data_motif = $this->_motif_dropdown();

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Stok Terakhir');
			$crud->set_table('barang');
			$crud->unset_read();

			$crud->unset_columns("kode");
			
			$crud->display_as("type_id","Type");
			$crud->display_as("motif_id","Motif");
			$crud->display_as("qty","Jml Stok");

			$crud->field_type('type_id','dropdown',$data_type);
			$crud->field_type('motif_id','dropdown',$data_motif);
			$crud->field_type('qty','hidden','0');
			$crud->field_type('kode','hidden',null);

			$crud->required_fields('nama','harga','type_id','motif_id');

			$crud->unset_edit();
			$crud->unset_add();
			$crud->unset_delete();

			$output = $crud->render();
			 
			$this->data['laporan_title'] = "<h3 class='page-header'>Laporan Stok Terkhir</h3>";
			$this->data['laporan'] = $this->_grocery_view($output);
			$this->data['content']					= 'admin/laporan_stok_terakhir_tabel_view';
				
			$this->_render_print();
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

		private function _motif_dropdown(){
			$this->db->select('id, nama');
	        $this->db->order_by('id','asc');
	        $query = $this->db->get('motif');
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

		*/

	}