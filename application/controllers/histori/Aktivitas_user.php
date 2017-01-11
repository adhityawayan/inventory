<?php defined('BASEPATH') OR exit('No direct script access allowed');
	Class Aktivitas_user extends Admin_Controller {
		private $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		public function index(){
			$crud = new grocery_CRUD();
 
			$crud->set_subject('Aktivitas User');
			$crud->set_table('users_logs');
			$crud->unset_read();
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();

			$crud->order_by("datetime","desc");

			$crud->unset_columns("url","post_array");

			$crud->display_as("datetime","Waktu");
			$crud->display_as("user_id","User");

			$crud->callback_column('user_id',array($this,'_callback_user'));
			$crud->callback_column('datetime',array($this,'_callback_tanggal'));
			$crud->callback_column('keterangan',array($this,'_callback_ket'));

			$output = $crud->render();
			 
			$this->data['header_title'] = "Aktivitas User";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/aktivitas_user_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->data['data_user'] = $this->_user_dropdown();


			$this->_render_page();

		}

		public function pilih_user(){
			$crud = new grocery_CRUD();
 
			$crud->set_subject('Aktivitas User');
			$crud->set_table('users_logs');
			$crud->unset_read();
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();

			$crud->order_by("datetime","desc");

			$crud->unset_columns("url","post_array");

			$user = $this->input->post("user");
			$bulan = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");

			if ($user == "semua"){

			}else{
				$crud->where("customer_id",$user);
			}
			$crud->where("bulan",$user);
			$crud->where("customer_id",$user);

			$crud->display_as("datetime","Waktu");
			$crud->display_as("user_id","User");

			$crud->callback_column('user_id',array($this,'_callback_user'));
			$crud->callback_column('datetime',array($this,'_callback_tanggal'));
			$crud->callback_column('keterangan',array($this,'_callback_ket'));

			$output = $crud->render();
			 
			$this->data['header_title'] = "Aktivitas User";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/aktivitas_user_view";
			$this->data['output'] = $this->_grocery_view($output);


			$this->data['data_user'] = $this->_user_dropdown();


			$this->_render_page();

		}

		private function _user_dropdown(){
			$data = array();

	        $this->db->order_by('first_name','asc');
	        $query = $this->db->get('users');
	       return $query->result();
		}

		public function _callback_user($value, $row)
		{
			$this->db->where("id",$value);
			$r = $this->db->get("users")->row();
			return $r->first_name." ".$r->last_name;
		}

		public function _callback_tanggal($value, $row)
		{
			return date("d/m/Y H:i",strtotime($value));
		}

		public function _callback_ket($value, $row)
		{
			return $value;
		}

	}