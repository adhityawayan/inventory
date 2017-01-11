<?php
	Class Notfound extends Admin_Controller {
		public function index(){

			$this->data['header_title'] = "404 Not Found";
			$this->data['header_description'] = "";
			$this->data['content'] = "admin/_templates/notfound_view";


			$this->_render_page();
		}
	}