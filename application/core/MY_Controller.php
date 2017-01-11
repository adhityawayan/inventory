<?php
	Class MY_Controller extends CI_Controller{

		public function _generate_breadcrumb(){
			$b = $this->uri->segment_array();
			$arr_bc = array();
			/*
			$group = $this->ion_auth->get_users_groups($this->ion_auth->user()->row()->id)->result();
            //print_r($group);
            foreach ($group as $row) {
              $group_name = $row->name;
            }

			$bc = ucfirst($group_name);

			array_push($arr_bc, $bc);*/

			foreach ($b as $bc) {
				$bc = str_replace("_", " ", $bc);
			
				$bc = ucfirst($bc);
				
				array_push($arr_bc, $bc);
			}

			return $arr_bc;
		}
		
	}


	Class Admin_Controller extends MY_Controller{

		private $template 		= "admin/_templates/admin_view";
		private $print_template = "admin/_templates/print_view";


		public $data = array();
		public function __construct(){
			parent::__construct();
			if (!$this->ion_auth->logged_in()){
				redirect('login','refresh');
				exit;
			}

			$this->data = array(
					'content' 				=> 'admin/_templates/blank_view',
					'header_title'			=> 'Example ($header_title)',
					'header_description' 	=> 'Example Description ($header_description)',
					'breadcrumb' 			=> $this->_generate_breadcrumb(),
					'user_log' 				=> '',
					'custom_js'				=> array(),
				);

			
		}

		public function activity_log($activity,$post_array){
			$insert = array(
			        'user_id' => $this->ion_auth->user()->row()->id,
			        'url' => current_url(),
			        'keterangan' => $activity,
			        'post_array' => $post_array,
			);

			$this->db->insert('users_logs', $insert);
			return true;
		}

		public function _render_page()//I think this makes more sense
		{
			

			$this->viewdata = $this->data;

			$view_html = $this->load->view($this->template, $this->viewdata);

		}

		public function _render_print()//I think this makes more sense
		{
			

			$this->viewdata = $this->data;

			$view_html = $this->load->view($this->print_template, $this->viewdata);

		}

		public function _render_error($error_message)//I think this makes more sense
		{
			$this->data['header_title'] 		= 'Warning!';
			$this->data['header_description']	= '';
			$this->data['content']				= 'admin/_templates/error_view';
			$this->data['error_message']		= $error_message;

			$this->viewdata = $this->data;


			$view_html = $this->load->view($this->template, $this->viewdata);

		}

		public function _grocery_view($output) {
			return $this->load->view('admin/_templates/grocery_view',$output,true);
		}



	}