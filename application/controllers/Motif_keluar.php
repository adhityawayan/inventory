<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Motif_keluar extends Admin_Controller {
		public function index(){
			

			$crud = new grocery_CRUD();
 
			$crud->set_subject('Motif Keluar');
			$crud->set_table('motif_keluar');
			
			$crud->order_by("tanggal","desc");

			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_read();

			$crud->required_fields('tanggal','customer_id');

			$crud->add_action("Detail","","motif_keluar/detail");
			$crud->add_action("Cetak Invoice","","invoice/cetak","custom_add_action");
			$crud->add_action("Cetak Surat Jalan","","motif_keluar/detail");

			$data_motif = $this->_motif_dropdown();
			$data_customer = $this->_customer_dropdown();

			$crud->display_as("customer_id","Customer");
			$crud->display_as("datetime","Tanggal");

			$crud->field_type('customer_id','dropdown',$data_customer);

			$crud->field_type('user_id','hidden',$this->ion_auth->user()->row()->id);
			$crud->field_type('tersimpan','hidden',"belum");

			$crud->unset_columns("tersimpan","user_id",'created_on');
			$crud->unset_fields("created_on");

			$crud->callback_after_insert(array($this,'log_add_motif_keluar'));

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
			 
			$this->data['header_title'] = "Motif Keluar";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/output_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->_render_page();


		}

		function log_add_motif_keluar($post_array,$primary_key){
			$this->session->set_userdata('motif_keluar_id',$primary_key);

		}

		public function alihkan(){
			redirect("motif_keluar/detail/".$this->session->userdata('motif_keluar_id'));
		}




		
		public function detail(){

			$data_motif = $this->_motif_dropdown();
			$data_customer = $this->_customer_dropdown();

			//status 
			$this->db->where("id",$this->uri->segment(3));
			$r = $this->db->get("motif_keluar")->row();

			if (!$this->uri->segment(4) == "add" and !$this->uri->segment(4) == "edit" or $this->uri->segment(4) == "cetak_surat_jalan"){
				
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
			$motif_keluar_detail = new grocery_CRUD();
 
			$motif_keluar_detail->set_subject('Motif');
			$motif_keluar_detail->set_table('motif_keluar_detail');
			
			$motif_keluar_detail->required_fields('motif_id','barang_id','type_id','qty');

			$motif_keluar_detail->columns("nama","barang_id","type_id","qty","harga","subtotal","ket");

			$motif_keluar_detail->unset_read();

			if ($r->tersimpan == "sudah"){
				$motif_keluar_detail->unset_add();
				$motif_keluar_detail->unset_edit();
				$motif_keluar_detail->unset_delete();
			}
			$motif_keluar_detail->display_as("motif_id","Motif");
			$motif_keluar_detail->display_as("barang_id","Barang");
			$motif_keluar_detail->display_as("type_id","Type");
			$motif_keluar_detail->display_as("subtotal","Sub Total");
			$motif_keluar_detail->display_as("ket","Keterangan");

			$data_barang = $this->_barang_dropdown();
			$data_type = $this->_type_dropdown();

			$motif_keluar_detail->field_type("motif_keluar_id","hidden",$this->uri->segment(3));


			$motif_keluar_detail->field_type("barang_id","dropdown",$data_barang);
			$motif_keluar_detail->field_type("type_id","dropdown",$data_type);
			$motif_keluar_detail->field_type("motif_id","dropdown",$data_motif);
			$motif_keluar_detail->field_type("nama","hidden","");
			$motif_keluar_detail->field_type("motif","hidden","");
			$motif_keluar_detail->field_type("harga","hidden","");
			$motif_keluar_detail->field_type("subtotal","hidden","");

			$motif_keluar_detail->unset_fields("promo");
			$motif_keluar_detail->unset_texteditor("ket");

			$motif_keluar_detail->or_where("motif_keluar_id",$this->uri->segment(3));

			$motif_keluar_detail->callback_column("motif_id",array($this,"callback_motif"));
			$motif_keluar_detail->callback_column("harga",array($this,"callback_currency"));
			$motif_keluar_detail->callback_column("subtotal",array($this,"callback_currency"));


			$motif_keluar_detail->callback_before_insert(array($this,"before_insert_motif_keluar_detail"));
			$motif_keluar_detail->callback_after_insert(array($this,"after_insert_motif_keluar_detail"));

			$motif_keluar_detail->set_lang_string('insert_error', 'Qty Melebihi Stok');

			$output2 = $motif_keluar_detail->render();
			 
			$this->data['header_title'] = "Motif Keluar";
			$this->data['header_description'] = "";

			$this->data['content'] = "admin/motif_keluar_view";

			$this->db->where("id",$this->uri->segment(3));
			$r = $this->db->get("motif_keluar")->row();


			$this->data['tersimpan'] = $r->tersimpan;

			$this->db->where("motif_keluar_id",$r->id);
			$surat_jalan = $this->db->get("surat_jalan");
			if ($surat_jalan->num_rows() > 0){
				$surat_jalan = $surat_jalan->row();
			}else{
				$surat_jalan = null;
			}
			$this->data['surat_jalan'] = $surat_jalan;
			$this->data['motif_keluar'] = $output;
			$this->data['motif_keluar_detail'] = $this->_grocery_view($output2);


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
		function before_insert_motif_keluar_detail($post_array){
			// $barang_id = $post_array['barang_id'];
			// $type_id = $post_array['type_id'];

			// $this->db->where("barang_id",$barang_id);
			// $this->db->where("type_id",$type_id);

			// $motif = $this->db->get("motif")->row();


			// $motif_id = $motif->id;

			// $post_array['motif_id'] = $motif_id;


			$motif_id = $post_array['motif_id'];

			$this->db->where("id",$motif_id);
			$motif = $this->db->get("motif")->row();

			if ($post_array['qty'] > $motif->qty){
				$this->session->set_userdata('sisa',$motif->qty);
				return false;
				exit;
			}
			$post_array['nama'] = $motif->nama;
			$post_array['harga'] = $motif->harga;
			$post_array['motif'] = $motif->nama;
			$post_array['subtotal'] = $motif->harga * $post_array['qty'];
			return $post_array;
		}

		

		

		function log_insert_motif_keluar($post_array, $primary_key) {
			$text = "ID User '".$this->ion_auth->user()->row()->id."' telah menambahkan motif keluar '".$primary_key."' untuk motif '".$post_array['motif_id']."' jumlah ".$post_array['qty']."";
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
			//promo
			$motif_keluar_id = $this->input->post('motif_keluar_id');

			$this->db->where("motif_keluar_id",$motif_keluar_id);
			$this->db->where("promo",'tidak');
			$data = $this->db->get("motif_keluar_detail");

			foreach ($data->result() as $row) {
				//cek promo
				$this->db->where("motif_id",$row->motif_id);
				$promo = $this->db->get("promo")->row();

				$bagi = $row->qty / $promo->beli;
				$bagi = floor($bagi);
				if ($bagi > 0){
					$dapat = $bagi*$promo->gratis;
					
					$arr = array(
							'motif_keluar_id' => $motif_keluar_id,
							'motif_id'			=> $row->motif_id,
							'nama'				=> $row->nama,
							'qty'				=> $dapat,
							'harga'				=> 0,
							'subtotal'			=> 0,
							'ket'				=> "PROMO",
							'promo'				=> "ya",
						);
					$this->db->insert("motif_keluar_detail",$arr);
				}
			}

			$this->db->where("motif_keluar_id",$this->input->post('motif_keluar_id'));
			$detail = $this->db->get("motif_keluar_detail");

			foreach ($detail->result() as $row) {
				$this->motif_model->kurangi_stok($row->motif_id,$row->qty);
			}

			$this->db->set("tersimpan","sudah");
			$this->db->where("id",$this->input->post('motif_keluar_id'));
			$this->db->update("motif_keluar");
			
			$this->db->where("id",$this->input->post('motif_keluar_id'));
			$d = $this->db->get("motif_keluar")->row();

			$this->db->where("id",$d->customer_id);
			$d = $this->db->get("customer")->row();

			
			$text = $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." telah menambahkan motif keluar dengan customer ".$d->nama;
			$arr = array(
					'motif_keluar_detail' => $detail,
					'motif_keluar_id'			=> $this->input->post('motif_keluar_id'),
					'customer_id'				=> $d->id,
				);

			$arr = json_encode($arr);

			$this->activity_log($text,$arr);


					

			redirect("motif_keluar/detail/".$this->input->post('motif_keluar_id'));


		}

		public function batal($motif_keluar_id){
			$this->db->where('id',$motif_keluar_id);
			$this->db->delete("motif_keluar");

			$this->db->where('motif_keluar_id',$motif_keluar_id);
			$this->db->delete("motif_keluar_detail");	

			redirect('motif_keluar','refresh');
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