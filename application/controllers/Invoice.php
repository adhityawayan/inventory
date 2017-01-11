<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Invoice extends Admin_Controller {
		public function index(){
			redirect('notfound','refresh');
		}

		public function cetak($motif_keluar_id){
			$this->db->where("id",$motif_keluar_id);
			$motif_keluar = $this->db->get("motif_keluar")->row();

			$this->db->where("motif_keluar_id",$motif_keluar_id);
			$motif_keluar_detail = $this->db->get("motif_keluar_detail")->result();

			$this->db->where("motif_keluar_id",$motif_keluar_id);
			$num_row = $this->db->get("invoice")->num_rows();

			if ($num_row == 0){
				$insert = array(
						'motif_keluar_id'	=> $motif_keluar_id,
						'user_id'			=> $this->ion_auth->user()->row()->id,
					);
				$this->db->insert("invoice",$insert);
			}
				$this->db->where("motif_keluar_id",$motif_keluar_id);
				$invoice = $this->db->get("invoice")->row();
			
			$this->data['motif_keluar'] 			= $motif_keluar;
			$this->data['motif_keluar_detail'] 	= $motif_keluar_detail;
			$this->data['invoice']					= $invoice;
			$this->data['content']					= 'admin/invoice_view';
				

			$this->_render_print();
		}
	}