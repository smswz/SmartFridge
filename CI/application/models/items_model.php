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
}
/* End of file items_model.php */
/* Location: ./application/models/items_model.php */
?>