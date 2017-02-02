<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Motif_masuk extends Admin_Controller {
		public function index(){
			

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Motif Masuk');
			$crud->set_table('motif_masuk');
			
			$crud->order_by("tanggal","desc");

			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_read();

			$crud->required_fields('tanggal','supplier_id');

			$crud->add_action("Detail","","motif_masuk/detail");

			$data_motif = $this->_motif_dropdown();
			$data_supplier = $this->_supplier_dropdown();


			$crud->set_field_upload('lampiran_surat_jalan','surat_jalan');

			$crud->display_as("supplier_id","Supplier");
			$crud->display_as("datetime","Tanggal");

			$crud->field_type('supplier_id','dropdown',$data_supplier);

			$crud->field_type('user_id','hidden',$this->ion_auth->user()->row()->id);
			$crud->field_type('tersimpan','hidden',"belum");

			$crud->unset_columns("tersimpan","user_id",'created_on');
			$crud->unset_fields("created_on");

			$crud->callback_after_insert(array($this,'log_add_motif_masuk'));

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
			 
			$this->data['header_title'] = "Motif Masuk";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();


		}

		function log_add_motif_masuk($post_array,$primary_key){
			$this->session->set_userdata('motif_masuk_id',$primary_key);

		}

		public function alihkan(){
			redirect("motif_masuk/detail/".$this->session->userdata('motif_masuk_id'));
		}




		
		public function detail(){

			$data_motif = $this->_motif_dropdown();
			$data_supplier = $this->_supplier_dropdown();

			//status 
			$this->db->where("id",$this->uri->segment(3));
			$r = $this->db->get("motif_masuk")->row();

			if (!$this->uri->segment(4) == "add" and !$this->uri->segment(4) == "edit"){
				
				$supp = $this->db->get_where("supplier",array("id",$r->supplier_id))->row();

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
									<label>supplier</label>
								</div>
								<div class="col-lg-10" id="qty_input_box">
									<p>'.$supp->nama.'</p>
								</div>
							</div>
						</div>
					</div>
				';

			}else{
				$output = "";
			}


			//motif masuk detail
			$motif_masuk_detail = new grocery_CRUD();
 
			$motif_masuk_detail->set_subject('Motif');
			$motif_masuk_detail->set_table('motif_masuk_detail');
			
			$motif_masuk_detail->required_fields('motif_id','barang_id','type_id','qty');
		// 

			$motif_masuk_detail->columns("nama","barang_id","type_id","qty","harga","subtotal","ket");

			$motif_masuk_detail->unset_read();

			if ($r->tersimpan == "sudah"){
				$motif_masuk_detail->unset_add();
				// $motif_masuk_detail->unset_edit();
				$motif_masuk_detail->unset_delete();
			}
			$motif_masuk_detail->display_as("motif_id","Motif");
			$motif_masuk_detail->display_as("nama","Nama Motif");
			$motif_masuk_detail->display_as("barang_id","Barang");
			$motif_masuk_detail->display_as("type_id","Type");
			$motif_masuk_detail->display_as("subtotal","Sub Total");
			$motif_masuk_detail->display_as("ket","Keterangan");


			$data_barang = $this->_barang_dropdown();
			$data_type = $this->_type_dropdown();


			$motif_masuk_detail->field_type("motif_masuk_id","hidden",$this->uri->segment(3));
			$motif_masuk_detail->field_type("motif_id","dropdown",$data_motif);
			$motif_masuk_detail->field_type("barang_id","dropdown",$data_barang);
			$motif_masuk_detail->field_type("type_id","dropdown",$data_type);
			$motif_masuk_detail->field_type("nama","hidden","");
			$motif_masuk_detail->field_type("harga","hidden","");
			$motif_masuk_detail->field_type("subtotal","hidden","");

			$motif_masuk_detail->unset_texteditor("ket");

			$motif_masuk_detail->or_where("motif_masuk_id",$this->uri->segment(3));

			$motif_masuk_detail->callback_column("motif_id",array($this,"callback_motif"));
			$motif_masuk_detail->callback_column("harga",array($this,"callback_currency"));
			$motif_masuk_detail->callback_column("subtotal",array($this,"callback_currency"));


			$motif_masuk_detail->callback_before_insert(array($this,"before_insert_motif_masuk_detail"));

			$output2 = $motif_masuk_detail->render();
			 
			$this->data['header_title'] = "Motif Masuk";
			$this->data['header_description'] = "";

			$this->data['content'] = "admin/motif_masuk_view";

			$this->db->where("id",$this->uri->segment(3));
			$r = $this->db->get("motif_masuk")->row();


			$this->data['tersimpan'] = $r->tersimpan;

			$this->data['motif_masuk'] = $output;
			$this->data['motif_masuk_detail'] = $this->_grocery_view($output2);


			$this->_render_page();
		}

		function callback_motif($value, $row){
			$motif_id = $value;

			$this->db->where("id",$motif_id);
			$motif = $this->db->get("motif",1)->row();
			return $motif->nama;
		}

		function callback_currency($value, $row){
			return "Rp ".number_format($value,0,",",".");
		}
		function before_insert_motif_masuk_detail($post_array){
			$barang_id = $post_array['barang_id'];
			$type_id = $post_array['type_id'];

			// $this->db->where("barang_id",$barang_id);
			// $this->db->where("type_id",$type_id);

			// $motif = $this->db->get("motif")->row();


			// $motif_id = $motif->id;

			// $post_array['motif_id'] = $motif_id;

			$motif_id = $post_array['motif_id'];
			$this->db->where("id",$motif_id);
			$motif = $this->db->get("motif")->row();


			$post_array['nama'] = $motif->nama;
			$post_array['harga'] = $motif->harga;
			$post_array['subtotal'] = $motif->harga * $post_array['qty'];
			return $post_array;
		}

		

		function log_insert_motif_masuk($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."' telah menambahkan motif masuk '".$primary_key."' untuk motif '".$post_array['motif_id']."' jumlah ".$post_array['qty']."";
			$arr = json_encode($post_array);

			$this->activity_log($text,$arr);

			//pengurangan
			$this->db->set('qty', 'qty-'.$post_array['qty'], FALSE);
			$this->db->where('id', $post_array['motif_id']);
			$this->db->update('motif'); 

			return true;
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

		private function _supplier_dropdown(){
			$data = array();

			$this->db->select('id, nama');
	        $this->db->order_by('id','asc');
	        $query = $this->db->get('supplier');
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

			$this->db->where("motif_masuk_id",$this->input->post('motif_masuk_id'));
			$detail = $this->db->get("motif_masuk_detail");

			foreach ($detail->result() as $row) {
				$this->motif_model->tambah_stok($row->motif_id,$row->qty);	
			}

			$this->db->set("tersimpan","sudah");
			$this->db->where("id",$this->input->post('motif_masuk_id'));
			$this->db->update("motif_masuk");
			
			$this->db->where("id",$this->input->post('motif_masuk_id'));
			$d = $this->db->get("motif_masuk")->row();

			$this->db->where("id",$d->supplier_id);
			$d = $this->db->get("supplier")->row();

			
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menambahkan motif masuk dengan supplier ".$d->nama;
			$arr = array(
					'motif_masuk_detail' => $detail,
					'motif_masuk_id'			=> $this->input->post('motif_masuk_id'),
					'supplier_id'				=> $d->id,
				);

			$arr = json_encode($arr);

			$this->activity_log($text,$arr);

				
			

			redirect("motif_masuk/detail/".$this->input->post('motif_masuk_id'));
		}

		public function batal($motif_masuk_id){
			$this->db->where('id',$motif_masuk_id);
			$this->db->delete("motif_masuk");

			$this->db->where('motif_masuk_id',$motif_masuk_id);
			$this->db->delete("motif_masuk_detail");	

			redirect('motif_masuk','refresh');
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