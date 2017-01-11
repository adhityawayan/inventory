<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Stok_opname extends Admin_Controller {

		public function index(){
			$data_type = $this->_type_dropdown();
			$data_motif = $this->_motif_dropdown();

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Stok Opname');
			$crud->set_table('motif');

			$crud->unset_read();
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();

			$crud->field_type('type_id','dropdown',$data_type);
			$crud->field_type('motif_id','dropdown',$data_motif);

			$crud->display_as("type_id","Type");
			$crud->display_as("motif_id","Motif");

			$crud->columns('nama','qty','type_id','ket');

			$crud->add_action("Edit Stok","","stok_opname/stok/edit");

			$output = $crud->render();


			$this->data['header_title'] = "Stok Opname";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();
		}


		public function stok(){
			$data_type = $this->_type_dropdown();
			$data_motif = $this->_motif_dropdown();


			$crud = new grocery_CRUD();
 
			$crud->set_subject('Stok Opname');
			$crud->set_table('motif');

			$crud->unset_read();
			$crud->unset_add();
			$crud->unset_delete();

			$crud->display_as("qty","Stok");
			$crud->display_as("type_id","Type");
			$crud->unset_fields('ket','type_id');


			$crud->field_type('nama','readonly');
			$crud->field_type('harga','readonly');

			$crud->fields('nama','harga','qty');



			$crud->callback_before_update(array($this,'before_update_stok'));
			$crud->callback_after_update(array($this,'log_after_update_stok'));

			$crud->set_lang_string('update_success_message',
					 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
					 <script type="text/javascript">
					  window.location = "'.site_url(strtolower(__CLASS__).'/index').'";
					 </script>
					 <div style="display:none">
					 '
			   );


			$output = $crud->render();


			$this->data['header_title'] = "Stok Opname";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);

			$this->_render_page();
		}


		

		function before_update_stok($post_array,$primary_key) {

			$this->db->where("id",$primary_key);
			$r = $this->db->get("barang")->row();

			
			$stok_before	= $r->qty;
			$stok_after		= $post_array['qty'];
			$nama 			= $r->nama;

			$this->session->set_userdata("stok_before",$stok_before);
			$this->session->set_userdata("stok_after",$stok_after);
			$this->session->set_userdata("nama",$nama);

		}
		function log_after_update_stok($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." mengubah stok barang ".$this->session->userdata("nama")." (".$primary_key.") dari ".$this->session->userdata("stok_before")." menjadi ".$this->session->userdata("stok_after");
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);

			$this->session->unset_userdata('nama');
			$this->session->unset_userdata('stok_before');
			$this->session->unset_userdata('stok_after');
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
	        }else{
	        	$data[''] = '';
	        }
	        $query->free_result();
	        return $data; 
		}

		private function _motif_dropdown(){
			$this->db->select('id, nama');
	        $this->db->order_by('id','asc');
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