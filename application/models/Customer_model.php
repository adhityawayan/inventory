<?php
	Class Customer_model extends CI_Model {
		public function get_cust($customer_id) {
			$this->db->where("id",$customer_id);
			return $this->db->get("customer")->row();
		}
	}