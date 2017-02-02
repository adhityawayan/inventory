<?php
	Class Surat_jalan_model extends CI_Model {
		public function get_surat($motif_keluar_id) {
			$this->db->where("motif_keluar_id",$motif_keluar_id);
			
			$result =  $this->db->get("surat_jalan");
			if ($result->num_rows() > 0){
				return $result->row();
			}else{
				return null;
			}
		}
	}