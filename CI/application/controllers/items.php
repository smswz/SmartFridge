<?php
	class Items extends CI_Controller {
		
		public function index() {

		}
		
		public function get_items_list() {
			
			$fridge_id = $this->uri->segment(3);

			$fridge_name = str_replace(array('%', '20'),' ', $this->uri->segment(4));

			$data['items'] = $this->items_model->get_items($fridge_id);

			$data['fridge_name'] = $fridge_name;
			$data['fridge_id'] = $fridge_id;
			$this->load->view('items_view', $data);
		}
		
		public function delete_item() {
			
			$item['item_id'] = $this->uri->segment(3);

			$item['fridge_id'] = $this->uri->segment(4);

			$this->items_model->delete($item);

			$data['items'] = $this->items_model->get_items($item['fridge_id']);
			
			$fridge_name = str_replace(array('%', '20'),' ', $this->uri->segment(5));
			
			$data['fridge_name'] = $fridge_name;
			$data['fridge_id'] = $this->uri->segment(4);
			$this->load->view('items_view', $data);
		}
		
		public function add_item() {
			
			$item['name'] = $this->input->post('name');
			$item['quantity'] = $this->input->post('quantity');
			$item['fridge_id'] = $this->input->post('fridge_id');
			
			$query = $this->items_model->add($item);
			
			print_r($query);
		}
	}
	
	
	/* End of file items.php */
	/* Location: ./application/controllers/items.php */
?>