<?php
	class Arduino extends CI_Controller{
		
		/*
		public function __construct() {
			
			parent::__construct();
			private $temp = 0.0;
			private $fridge_id = -1;
			private $egg_id = -1;
			private $egg_set = false;
	        
		}//end constructor*/
	
		public function index() {
			
			$this->load->view('arduino_view');
			
		}//end index
		
		/*
		public function get_arduino_data() {
			
			$data['test'] = $this->input->post('test');
			$data['get_data'] = $this->input->post('query_string');
			
			//echo $data;
			$this->load->view('arduino_view', $data);
		}	
		*/
		public function update_eggs() {
			
			$data['egg'] = TRUE;
			$data['fridge_id'] 	= $this->uri->segment(3);
			$data['egg_id'] 	= $this->uri->segment(4);
			$data['egg_total'] 	= $this->uri->segment(5);
			
			$this->load->view('arduino_view', $data);
		}
		
		public function update_temp() {
			
			$data['fridge_id'] 	= $this->uri->segment(3);
			$data['temp_id'] 	= $this->uri->segment(4);
			$data['temp'] 		= $this->uri->segment(5);
			
			$this->load->view('arduino_view', $data);
		}
	}//end class
?>