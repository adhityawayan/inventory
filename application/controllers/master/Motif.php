<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Motif extends Admin_Controller {
		public function index(){

			$data_type = $this->_type_dropdown();
			$data_barang = $this->_barang_dropdown();


			$crud = new grocery_CRUD();
 
			$crud->set_subject('Motif');
			$crud->set_table('motif');

			$crud->columns('nama','qty','harga','type_id','barang_id','ket');
			$crud->fields('nama','harga','type_id','barang_id','ket');

			$crud->unset_read();

			$crud->unset_fields('qty');
			$crud->required_fields("nama",'harga','type_id','barang_id');
			$crud->unset_texteditor('ket');

			$crud->display_as('type_id','Type');
			$crud->display_as('barang_id','Barang');
			$crud->field_type('type_id','dropdown',$data_type);
			$crud->field_type('barang_id','dropdown',$data_barang);

			// $crud->add_action('Detail','','master/motif/detail/');

			$crud->callback_after_insert(array($this,'log_insert_motif'));
			$crud->callback_after_update(array($this,'log_update_motif'));
			$crud->callback_after_delete(array($this,'log_delete_motif'));

			// $crud->set_lang_string('insert_success_message',
			// 		 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
			// 		 <script type="text/javascript">
			// 		  window.location = "'.site_url('master/barang/alihkan').'";
			// 		 </script>
			// 		 <div style="display:none">
			// 		 '
			//    );
			// $crud->set_lang_string('update_success_message',
			// 		 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
			// 		 <script type="text/javascript">
			// 		  window.location = "'.site_url('master/barang/detail/'.$this->uri->segment(5)).'";
			// 		 </script>
			// 		 <div style="display:none">
			// 		 '
			//    );

			// $crud->set_lang_string('form_update_changes',"Lanjutkan");


			$output = $crud->render();
			 
			$this->data['header_title'] = "Master Motif";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();

		}

		public function detail($motif_id) {

			$this->db->where("id",$motif_id);
			$r = $this->db->get("motif")->row();

			if (!$this->uri->segment(5) == "add" and !$this->uri->segment(5) == "edit"){
				
				$type = $this->db->get_where("type",array("id",$r->type_id))->row();

				$motif = '
					<div class="box">
						<div class="box-body">
							<div class="row" id="qty_field_box">
								<div class="form-display-as-box col-lg-2 control-label" id="qty_display_as_box">
									<label>Nama Barang</label>
								</div>
								<div class="col-lg-10" id="qty_input_box">
									<p >'.$r->nama.'</p>
								</div>
							</div>

							<div class="row" id="qty_field_box">
								<div class="form-display-as-box col-lg-2 control-label" id="qty_display_as_box">
									<label>Harga</label>
								</div>
								<div class="col-lg-10" id="qty_input_box">
									<p >'.$r->harga.'</p>
								</div>
							</div>

							<div class="row" id="qty_field_box">
								<div class="form-display-as-box col-lg-2 control-label" id="qty_display_as_box">
									<label>Type</label>
								</div>
								<div class="col-lg-10" id="qty_input_box">
									<p>'.$type->nama.'</p>
								</div>
							</div>
							<div class="row" id="qty_field_box">
								<div class="form-display-as-box col-lg-2 control-label" id="qty_display_as_box">
									<label></label>
								</div>
								<div class="col-lg-10" id="qty_input_box">
									<a href="'.site_url('master/motif/index/edit/'.$motif_id).'" class="btn btn-warning"><i class="fa fa-edit"></i> Edit Barang</a>
								</div>
							</div>

						</div>
					</div>
				';

			}else{
				$motif = "";
			}

			$data_barang = $this->_barang_dropdown();

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Barang');
			$crud->set_table('motif_barang');
			$crud->where("motif_id",$motif_id);

			$crud->required_fields("motif_id","barang_id");

			$crud->field_type("barang_id","dropdown",$data_barang);
			$crud->field_type("motif_id","hidden",$motif_id);

			$crud->display_as("barang_id","Barang");
			$crud->columns('barang_id');

			$crud->unset_read();
			$crud->unset_edit();


			$output = $crud->render();
			 
			$this->data['header_title'] = "Master Motif";
			$this->data['header_description'] = "Tambah Barang ke Motif";
			$this->data['content'] = "admin/motif_detail_view";
			$this->data['motif'] = $motif;
			$this->data['barang'] = $this->_grocery_view($output);


			$this->_render_page();
		}

		public function alihkan(){
			redirect("master/motif/detail/".$this->session->userdata('motif_id'));
		}

		function log_insert_motif($post_array, $primary_key) {
			$this->session->set_userdata('motif_id',$primary_key);

			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menambahkan motif ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_update_motif($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah mengedit motif ".$post_array['nama']." (".$primary_key.")";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);
			return true;
		}

		function log_delete_motif($post_array, $primary_key) {
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menghapus motif ".$post_array['nama']." (".$primary_key.")";
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
	        }else{
	        	$data[''] = '';
	        }
	        $query->free_result();
	        return $data; 
		}

		private function _barang_dropdown(){
			$this->db->select('id, nama');
	        $this->db->order_by('id','asc');
	        $query = $this->db->get('barang');
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