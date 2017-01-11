<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Promo extends Admin_Controller {
		public function index(){

			$data_motif = $this->_motif_dropdown();

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Promo');
			$crud->set_table('promo');
			$crud->unset_read();
			
			$crud->display_as("motif_id","Motif");
			$crud->display_as("beli","Jumlah Beli");
			$crud->display_as("gratis","Jumlah Gratis");

			$crud->field_type('motif_id','dropdown',$data_motif);



			$crud->callback_after_insert(array($this,'log_insert_promo'));
			$crud->callback_after_update(array($this,'log_update_promo'));
			$crud->callback_after_delete(array($this,'log_delete_promo'));

			$output = $crud->render();
			 
			$this->data['header_title'] = "Master Promo";
			$this->data['header_description'] = "Promo Gratis Motif Bila Membeli Motif Dalam Jumlah Tertentu";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		function log_insert_promo($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."' telah menambahkan promo '".$primary_key."'";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_update_promo($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."'' telah mengedit promo '".$primary_key."'";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_delete_promo($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."'' telah menghapus promo '".$primary_key."'";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}


		private function _motif_dropdown(){
			$this->db->select('id, nama');
	        $this->db->order_by('nama','asc');
	        $query = $this->db->get('motif');
	        if ($query->num_rows() > 0)
	        {
	            $data = array();
	            foreach ($query->result_array() as $row)
	            {
	                $data[$row['id']] = $row['nama']; 
	            }
	        }else{
	        	$data[''] = '';
	        }
	        $query->free_result();
	        return $data; 
		}

	}