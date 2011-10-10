<?php
	Class Update_items extends CI_Controller {
		
		function index() {
			$data = $this->get();
		}
		
		function update_items() {
			
			$item['name'] = $this->input->post('name');
			$item['quantity'] = $this->input->post('quantity');
			$item['fridge_id'] = $this->input->post('fridge_id');
			
			
			
			$this->item_model->update();
		}
	}

?>