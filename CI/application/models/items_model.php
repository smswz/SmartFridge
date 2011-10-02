<?php
	class Items_model extends CI_Model {
		
		
		public function get_items($id) {
		
			$query = $this->db->get_where('items', array('fridge_id' => $id));
			
			if($query->num_rows() > 0) {
				
				foreach($query->result() as $row) {
				
					$data[] = $row;
				}
				return $data;
			}
		}
		
		public function delete($item) {
			
			$this->db->delete('items', array('id' => $item['item_id']));
			
			$query = $this->db->get_where('items', array('fridge_id' => $item['fridge_id']));
			
			if($query->num_rows() > 0) {
				
				foreach($query->result() as $row) {
				
					$data[] = $row;
				}
				return $data;
			}
		}
		
		public function add($item) {
			
			$search_criteria = array('name' => $item['name'], 'fridge_id' => $item['fridge_id']);
			$query = $this->db->get_where('items', $search_criteria);
			
			if($query->num_rows() == 0) {
				
				//new item so set the total and current amount to the quantity being added on creation
				$item['current_amount'] = $item['quantity'];
				$item['total'] = $item['quantity'];
				
				$this->db->insert('items', $item);
				//return false if no item was found already
				echo false;
			}else{
				//return true if an item with the same name was already found
				echo true;
			}
		}
}
/* End of file items_model.php */
/* Location: ./application/models/items_model.php */
?>