<?php
	function setClassActive($url){
		$current = current_url();

		if ($current == $url){
			return "class='active'";
		}
	}


	function getSettingValue($name) {
		$cari = array(
				'name' => $name,
			);
		$q = $this->db->get_where('settings',$cari);
		return $q->row();
	}