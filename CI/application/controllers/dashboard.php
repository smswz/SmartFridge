<?php

class Dashboard extends CI_Controller {


	public function index() {

		//$this->load->model('fridge_model');
		$this->load->library('table');
		$data['fridges'] = $this->fridge_model->get_fridges();
		$this->load->view('dashboard', $data);
		
		//$this->table->generate($this->fridge_model->
	}
	
	public function add_fridge() {
	
    	$name = $this->input->post('name');
 
    	if($this->fridge_model->fridge_exists($name)) {
    		echo 'Fridge already exists';
    	}else{
    		echo 'Fridge added';
    	}
  	}//end add_fridge

	public function remove_fridge() {
		
		$id = $this->input->post('id');

		$this->fridge_model->delete($id);
		echo 'Fridge removed';
	}

}

/* End of file index.php */
/* Location: ./application/controllers/dashboard.php */

?>