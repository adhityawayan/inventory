<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Return_motif extends Admin_Controller {
		public function index(){
			

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Retur motif');
			$crud->set_table('return');
			
			$crud->order_by("tanggal","desc");

			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_read();

			$crud->required_fields('tanggal','customer_id');

			$crud->add_action("Detail","","return_motif/detail");

			$data_motif = $this->_motif_dropdown();
			$data_customer = $this->_customer_dropdown();

			$crud->display_as("customer_id","Customer");

			$crud->field_type('customer_id','dropdown',$data_customer);
			$crud->field_type('user_id','hidden',$this->ion_auth->user()->row()->id);
			$crud->field_type('tersimpan','hidden',"belum");

			$crud->unset_columns("tersimpan","user_id","created_on");
			$crud->unset_fields("created_on");

			$crud->callback_after_insert(array($this,'log_add_return_motif'));

			$crud->or_where("tersimpan","sudah");
			
			$crud->set_lang_string('insert_success_message',
					 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
					 <script type="text/javascript">
					  window.location = "'.site_url(strtolower(__CLASS__).'/alihkan').'";
					 </script>
					 <div style="display:none">
					 '
			   );

			$crud->set_lang_string('form_update_changes',"Lanjutkan");


			$output = $crud->render();
			 
			$this->data['header_title'] = "Retur motif";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();


		}

		function log_add_return_motif($post_array,$primary_key){
			$this->session->set_userdata('return_id',$primary_key);

		}

		public function alihkan(){
			redirect("return_motif/detail/".$this->session->userdata('return_id'));
		}




		
		public function detail(){

			$data_motif = $this->_motif_dropdown();

			//status 
			$this->db->where("id",$this->uri->segment(3));
			$r = $this->db->get("return")->row();

			if (!$this->uri->segment(4) == "add" and !$this->uri->segment(4) == "edit"){
				

				$cust = $this->db->get_where("customer",array("id",$r->customer_id))->row();

				$output = '
					<div class="box">
						<div class="box-body">
							<div class="row" id="qty_field_box">
								<div class="form-display-as-box col-lg-2 control-label" id="qty_display_as_box">
									<label>Tanggal</label>
								</div>
								<div class="col-lg-10" id="qty_input_box">
									<p >'.date('d/m/Y',strtotime($r->tanggal)).'</p>
								</div>
							</div>
							<div class="row" id="qty_field_box">
								<div class="form-display-as-box col-lg-2 control-label" id="qty_display_as_box">
									<label>Customer</label>
								</div>
								<div class="col-lg-10" id="qty_input_box">
									<p>'.$cust->nama.'</p>
								</div>
							</div>
						</div>
					</div>
				';

			}else{
				$output = "";
			}


			//motif keluar detail
			$return_motif_detail = new grocery_CRUD();
 
			$return_motif_detail->set_subject('Motif');
			$return_motif_detail->set_table('return_detail');
			
			$return_motif_detail->required_fields('motif_id','barang_id','type_id','qty');


			$return_motif_detail->unset_columns("return_id","nama");
			$return_motif_detail->unset_read();

			if ($r->tersimpan == "sudah"){
				$return_motif_detail->unset_add();
				$return_motif_detail->unset_edit();
				$return_motif_detail->unset_delete();
			}

			$data_barang = $this->_barang_dropdown();
			$data_type = $this->_type_dropdown();

			$return_motif_detail->display_as("motif_id","Motif");
			$return_motif_detail->display_as("barang_id","Barang");
			$return_motif_detail->display_as("type_id","Type");

			$return_motif_detail->field_type("nama","hidden","");

			$return_motif_detail->field_type("return_id","hidden",$this->uri->segment(3));
			$return_motif_detail->field_type("motif_id","dropdown",$data_motif);
			$return_motif_detail->field_type("barang_id","dropdown",$data_barang);
			$return_motif_detail->field_type("type_id","dropdown",$data_type);

			$return_motif_detail->unset_texteditor("ket");

			$return_motif_detail->or_where("return_id",$this->uri->segment(3));


			$return_motif_detail->callback_before_insert(array($this,"before_insert_return_motif_detail"));

			$output2 = $return_motif_detail->render();
			 
			$this->data['header_title'] = "Retur Motif";
			$this->data['header_description'] = "";

			$this->data['content'] = "admin/return_view";


			$this->data['tersimpan'] = $r->tersimpan;

			$this->data['return_motif'] = $output;
			$this->data['return_motif_detail'] = $this->_grocery_view($output2);


			$this->_render_page();
		}

		function callback_currency($value, $row){
			return "Rp ".number_format($value,0,",",".");
		}
		function before_insert_return_motif_detail($post_array){
			$motif_id = $post_array['motif_id'];

			$this->db->where("id",$motif_id);
			$motif = $this->db->get("motif")->row();

			$post_array['nama'] = $motif->nama;
			return $post_array;
		}


		private function _motif_dropdown(){
			$data = array();

			$this->db->select('id, nama');
	        $this->db->order_by('nama','asc');
	        $query = $this->db->get('motif');
	        $maxkode = 20;

	        if ($query->num_rows() > 0)
	        {
	            
	            foreach ($query->result_array() as $row)
	            {
	            	$count = strlen($row['id']);
		            $nbsp = "";
	            	if ($maxkode >= $count){
	            		$hit = $maxkode - $count;
		            	for ($i=0; $i < $hit; $i++) { 
		            		$nbsp .= "&nbsp;";
		            	}
	            	}else{
	            		$nbsp = "&nbsp;&nbsp;";
	            	}
	            	

	                $data[$row['id']] = $row['nama']; 
	            }
	        }else{
	        	$data[''] = '';
	        }
	        $query->free_result();
	        return $data; 
		}

		private function _customer_dropdown(){
			$data = array();

			$this->db->select('id, nama');
	        $this->db->order_by('id','asc');
	        $query = $this->db->get('customer');
	        if ($query->num_rows() > 0)
	        {
	            
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

		


		public function simpan(){
			$this->load->model("motif_model");

			$this->db->where("return_id",$this->input->post('return_id'));
			$detail = $this->db->get("return_detail");

			foreach ($detail->result() as $row) {
				//$this->motif_model->tambah_stok($row->motif_id,$row->qty);
			}

				$this->db->set("tersimpan","sudah");
				$this->db->where("id",$this->input->post('return_id'));
				$this->db->update("return");
			

			$this->db->where("id",$this->input->post('return_id'));
			$d = $this->db->get("return")->row();

			$this->db->where("id",$d->customer_id);
			$d = $this->db->get("customer")->row();

			
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menambahkan motif keluar dengan customer ".$d->nama;
			$arr = array(
					'return_detail' => $detail,
					'return_id'			=> $this->input->post('return_id'),
				);

			$arr = json_encode($arr);

			$this->activity_log($text,$arr);


			redirect("return_motif/detail/".$this->input->post('return_id'));
		}

		public function batal($return_id){
			$this->db->where('id',$return_id);
			$this->db->delete("return");

			$this->db->where('return_id',$return_id);
			$this->db->delete("return_detail");	

			redirect('return_motif','refresh');
		}

		public function cetak($return_id){
			$this->db->where("id",$return_id);
			$return = $this->db->get("return")->row();

			$this->db->where("return_id",$return_id);
			$return_detail = $this->db->get("return_detail")->result();

			$this->db->where("return_id",$return_id);
			$num_row = $this->db->get("return_out")->num_rows();


			if ($num_row == 0){
				$insert = array(
						'return_id'	=> $return_id,
						'user_id'			=> $this->ion_auth->user()->row()->id,
					);
				$this->db->insert("return_out",$insert);
			}
				$this->db->where("return_id",$return_id);
				$return_out = $this->db->get("return_out")->row();
			
			$this->data['return'] 			= $return;
			$this->data['return_detail'] 	= $return_detail;
			$this->data['return_out'] 			= $return_out;
			$this->data['content']					= 'admin/return_print_view';
				

			$this->_render_print();
		}

		private function _barang_dropdown(){
			$data = array();

			$this->db->select('id, nama');
	        $this->db->order_by('nama','asc');
	        $query = $this->db->get('barang');
	        $maxkode = 20;

	        if ($query->num_rows() > 0)
	        {
	            
	            foreach ($query->result_array() as $row)
	            {
	            	$count = strlen($row['id']);
		            $nbsp = "";
	            	if ($maxkode >= $count){
	            		$hit = $maxkode - $count;
		            	for ($i=0; $i < $hit; $i++) { 
		            		$nbsp .= "&nbsp;";
		            	}
	            	}else{
	            		$nbsp = "&nbsp;&nbsp;";
	            	}
	            	

	                $data[$row['id']] = $row['nama']; 
	            }
	        }else{
	        	$data[''] = '';
	        }
	        $query->free_result();
	        return $data; 
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
		

	}