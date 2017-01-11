<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Master extends Admin_Controller {
		public function barang(){

			$data_type = $this->_type_dropdown();

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master Barang');
			$crud->set_table('barang');

			$crud->display_as("type_id","Type");

			$crud->field_type('type_id','dropdown',$data_type);

			$crud->callback_after_insert(array($this,'log_insert_barang'));
			$crud->callback_after_update(array($this,'log_update_barang'));
			$crud->callback_after_delete(array($this,'log_delete_barang'));

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master Barang";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		function log_insert_barang($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."' telah menambahkan barang '".$primary_key."'";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_update_barang($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."'' telah mengedit barang '".$primary_key."'";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_delete_barang($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."'' telah menghapus barang '".$primary_key."'";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
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
	        }
	        $query->free_result();
	        return $data; 
		}

		public function type(){
			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master Type');
			$crud->set_table('type');
			
			$crud->callback_after_insert(array($this,'log_insert_barang'));
			$crud->callback_after_update(array($this,'log_update_barang'));
			$crud->callback_after_delete(array($this,'log_delete_barang'));

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master Type";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		function log_insert_type($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."' telah menambahkan type '".$primary_key."'";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_update_type($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."'' telah mengedit type '".$primary_key."'";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_delete_type($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."'' telah menghapus type '".$primary_key."'";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		public function motif(){
			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master Motif');
			$crud->set_table('motif');

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master Motif";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		public function supplier(){
			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master Supplier');
			$crud->set_table('supplier');

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master Supplier";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		public function customer(){
			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master Customer');
			$crud->set_table('customer');

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master Customer";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		public function company(){
			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master Company');
			$crud->set_table('company');

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master Company";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}
	}