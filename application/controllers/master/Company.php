<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Company extends Admin_Controller {
		public function index(){

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master company');
			$crud->set_table('company');
			$crud->unset_read();

			$crud->callback_after_insert(array($this,'log_insert_company'));
			$crud->callback_after_update(array($this,'log_update_company'));
			$crud->callback_after_delete(array($this,'log_delete_company'));

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master company";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		function log_insert_company($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menambahkan company ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_update_company($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah mengedit company ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_delete_company($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menghapus company ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}


		
	}