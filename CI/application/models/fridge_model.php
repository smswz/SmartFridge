<?php
	class Fridge_model extends CI_Model {
		
		
		public function get_fridges() {
		
			$query = $this->db->get('fridge');
			
			if($query->num_rows() > 0) {
				
				foreach($query->result() as $row) {
				
					$data[] = $row;
				}
				return $data;
			}
		}
		public function add_new_fridge($data) {
		
			$this->db->insert('fridge', $data); 
			
		}//end add_new_fridge
		
		public function fridge_exists($name) {
			
			$query = $this->db->get_where('fridge', array('name' => $name));
			
			if($query->num_rows() > 0) {
			
				return true;
			}
			
		}//end fridge_exists
				
		public function delete($id) {
			//delete the fridge 
			$this->db->delete('fridge', array('id' => $id)); 
			
		}//end delete
		
		public function get_fridge($name) {
			//get the newest data on the fridge on search value name
			$query = $this->db->get_where('fridge', array('name' => $name));
			
			foreach($query->result() as $row) {
			
				$data[] = $row;
			}
			return $data[0];

		}
	}//end class fridge_model
?>