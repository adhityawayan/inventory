<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Supplier extends Admin_Controller {
		public function index(){

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Master supplier');
			$crud->set_table('supplier');
			$crud->unset_read();

			$crud->callback_after_insert(array($this,'log_insert_supplier'));
			$crud->callback_after_update(array($this,'log_update_supplier'));
			$crud->callback_after_delete(array($this,'log_delete_supplier'));

			$crud->unset_texteditor("alamat");

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master supplier";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		function log_insert_supplier($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menambahkan supplier ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_update_supplier($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah mengedit supplier ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_delete_supplier($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menghapus supplier ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}


		
	}