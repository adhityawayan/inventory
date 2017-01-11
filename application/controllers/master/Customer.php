<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Customer extends Admin_Controller {
		public function index(){


			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master customer');
			$crud->set_table('customer');
			$crud->unset_read();

			$crud->unset_texteditor('alamat');

			$crud->callback_after_insert(array($this,'log_insert_customer'));
			$crud->callback_after_update(array($this,'log_update_customer'));
			$crud->callback_after_delete(array($this,'log_delete_customer'));

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master customer";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		function log_insert_customer($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menambahkan customer ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_update_customer($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah mengedit customer ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_delete_customer($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menghapus customer ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}


	}