<?php

class Dashboard extends CI_Controller {


	public function index() {

		$this->load->library('table');
		$data['fridges'] = $this->fridge_model->get_fridges();
		$this->load->view('dashboard', $data);
		
	}
	
	public function add_fridge() {
	
    	$name = $this->input->post('name');


    	if($this->fridge_model->fridge_exists($name)) {
			echo true;
    	}else{
		
			//fridge doesnt already exist so add it 
			$this->fridge_model->add_new_fridge(array('name' => $name));
			//get the latest data on the new fridge and send that back to the view to update
			$data = $this->fridge_model->get_fridge($name);
			
    		echo '<tr><td>' . $data->id . '</td><td>'. anchor('items/get_items_list/'. $data->id .'/'. $data->name, $data->name) .
				 '</td><td><a class="delete" href="#" id="'. $data->id . ',' . $data->name .'" ><img src="' . base_url( 'images/delete.png' ) . 	
				 '"</a></td><</td></tr>'; 

    	}
		/*
		$this->fridge_model->add_new_fridge(array('name' => $name));
		$data['fridges'] = $this->fridge_model->get_fridges();
		$this->load->view('dashboard', $data);*/
  	}//end add_fridge

	public function remove_fridge() {
		
		$id = $this->input->post('id');
		$name = $this->input->post('name');

		$this->fridge_model->delete($id);
		//echo $id;
	}
}

/* End of file index.php */
/* Location: ./application/controllers/dashboard.php */

?>