<?php
	Class Home extends Admin_Controller{
		function index(){
			$this->data['header_title']  		= 'Inventory';
			$this->data['header_description']  	= '';
			$this->data['content']  			= 'admin/dashboard/dashboard_admin';
			$this->data['css_plugins']  		= array('assets/plugins/morris/morris.css');
			//$this->data['js_plugins']  			= array('assets/dist/js/pages/dashboard2.js');
			
			$this->data['user_activity']		= $this->last_activity();
			$this->data['motif_masuk']		= $this->motif_masuk_this_month();
			$this->data['motif_keluar']		= $this->motif_keluar_this_month();

			$this->_render_page();
		}


		private function last_activity(){

	        $this->db->order_by('id','desc');
	        $query = $this->db->get('users_logs',0,6);
	        $data = array();

	        if ($query->num_rows() > 0)
	        {
	            foreach ($query->result_array() as $row)
	            {
	                array_push($data, $row);
	            }

	            
	        }
	        $query->free_result();
	        return $data; 
		}

		private function motif_masuk_this_month(){
			$this->db->order_by('id','desc');
	        $query = $this->db->get('motif_masuk');

	        return $query->num_rows(); 
		}

		private function motif_keluar_this_month(){
			$this->db->order_by('id','desc');
	        $query = $this->db->get('motif_keluar');

	        return $query->num_rows(); 
		}
	}
?>