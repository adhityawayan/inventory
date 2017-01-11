<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Type extends Admin_Controller {
		public function index(){


			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master type');
			$crud->set_table('type');
			$crud->unset_read();

			$crud->callback_after_insert(array($this,'log_insert_type'));
			$crud->callback_after_update(array($this,'log_update_type'));
			$crud->callback_after_delete(array($this,'log_delete_type'));

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master type";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		function log_insert_type($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menambahkan type ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_update_type($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah mengedit type ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_delete_type($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menghapus type ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}


	}