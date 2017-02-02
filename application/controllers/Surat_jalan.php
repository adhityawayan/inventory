<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Surat_jalan extends Admin_Controller {
		public function index(){
			redirect('notfound','refresh');
		}

		public function cetak($motif_keluar_id){
			$this->db->where("id",$motif_keluar_id);
			$motif_keluar = $this->db->get("motif_keluar")->row();

			$this->db->where("motif_keluar_id",$motif_keluar_id);
			$motif_keluar_detail = $this->db->get("motif_keluar_detail")->result();

			$this->db->where("id",$motif_keluar->customer_id);
			$customer = $this->db->get("customer")->row();

			
				$this->db->where("motif_keluar_id",$motif_keluar_id);
				$surat_jalan = $this->db->get("surat_jalan")->row();
			
			$this->data['motif_keluar']			= $motif_keluar;
			$this->data['motif_keluar_detail'] 	= $motif_keluar_detail;
			$this->data['surat_jalan']				= $surat_jalan;
			$this->data['content']					= "admin/surat_jalan_view";
				
	


			$this->_render_print();
		}

		public function proses_cetak(){
			$motif_keluar_id = $this->input->post("motif_keluar_id");
			$status_kirim		= $this->input->post("status_kirim");
			$ship_to			= $this->input->post("ship_to");
			$nama_penerima		= $this->input->post("nama_penerima");

			

			$this->db->where("motif_keluar_id",$motif_keluar_id);
			$sujalan = $this->db->get("surat_jalan");


			$this->db->where("id",$motif_keluar_id);
			$motif_keluar = $this->db->get('motif_keluar');

			$this->db->where('id',$motif_keluar->row()->customer_id);
			$customer = $this->db->get('customer')->row();


			if ($sujalan->num_rows() == 0){
				$insert = array(
						'motif_keluar_id'	=> $motif_keluar_id,
						'user_id'			=> $this->ion_auth->user()->row()->id,
						'status_kirim'		=> $status_kirim,
						'ship_to'			=> $ship_to,
						'nama_penerima'		=> $nama_penerima,
						'nama_customer'		=> $customer->nama,
					);
				$this->db->insert("surat_jalan",$insert);
			}else{
				$this->db->set("status_kirim",$status_kirim);
				if ($status_kirim == "ship_to"){
					$this->db->set("ship_to",$ship_to);
				}else{
					$this->db->set("ship_to","");
					
				}
			
				$this->db->set("nama_penerima",$nama_penerima);
				$this->db->where("motif_keluar_id",$motif_keluar_id);
				$this->db->update("surat_jalan");
			}

			
			redirect('surat_jalan/cetak/'.$motif_keluar_id);
		}
	}