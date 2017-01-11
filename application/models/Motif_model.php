<?php
	Class Motif_model extends CI_Model {

		public function tambah_stok($id, $qty) {
			$this->db->set("qty","qty+".$qty,FALSE);
			$this->db->where("id",$id);
			$this->db->update("motif");
		}

		public function kurangi_stok($id, $qty) {
			$this->db->set("qty","qty-".$qty,FALSE);
			$this->db->where("id",$id);
			$this->db->update("motif");
		}
		

	}