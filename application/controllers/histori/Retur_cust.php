<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Retur_cust extends Admin_Controller {
		private $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		public function index(){
			$this->data['header_title'] = "Histori Retur Customer";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/histori_retur_cust_view";
			$this->data['bulan']	= $this->bulan;
			$this->data['link']	= "#";
			$this->data['box_title'] = "Histori Retur Customer Bulan ".$this->bulan[date("m") - 1]." ".date("Y");
			$this->data['table'] = "admin/histori_retur_cust_tabel_view";
			$this->data['customer'] = $this->_customer_dropdown();

			$this->db->where("month(tanggal)",date("m"));
			$this->db->where("year(tanggal)",date("Y"));
			$this->db->order_by("tanggal","desc");
			$this->db->join("return","return.id = return_detail.return_id");
			$histori = $this->db->get("return_detail");

			$this->data['histori'] = $histori;

			$this->_render_page();
		}

		public function pilih_cust(){
			$customer = $this->input->post("customer");
			$bulan = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");

			if ($customer == "semua"){

			}else{
				$this->db->where("customer_id",$customer);
			}
			$this->db->where("month(tanggal)",$bulan);
			$this->db->where("year(tanggal)", $tahun);
			$this->db->order_by("tanggal","desc");
			$this->db->join("return","return.id = return_detail.return_id");
			$histori = $this->db->get("return_detail");


			$this->data['header_title'] = "Histori Pesanan Customer";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/histori_pesanan_cust_view";
			$this->data['bulan']	= $this->bulan;
			$this->data['link']	= "#";
			$this->data['box_title'] = "Histori Pesanan Customer Bulan ".$this->bulan[$bulan - 1]." ".$tahun;
			$this->data['table'] = "admin/histori_pesanan_cust_tabel_view";
			$this->data['customer'] = $this->_customer_dropdown();

			

			$this->data['histori'] = $histori;

			$this->_render_page();
		}
		private function _customer_dropdown(){
			$data = array();

			$this->db->select('id, nama');
	        $this->db->order_by('id','asc');
	        $query = $this->db->get('customer');
	        return $query->result();
		}

	}