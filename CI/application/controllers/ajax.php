<?php

	class Ajax extends Controller {

  		public function Ajax() {
  
    	parent::Controller(); 
  	}
  	
  	public function index() {
  	
  		$this->load->model('fridge_model');
  	}//end index

  	public function add_fridge()
  	{

    	$name = $this->input->post('name');
    
    	// if the fridge exists return a 1 indicating true
    	if ($this->fridge_model->fridge_exists($name)) {
    		return '1';
    	}else{
    		$this->fridge_model->add_new_fridge($name);
    		return '0';
    	}
  	}//end add_fridge
}//end class

/* End of file ajax.php */
/* Location: ./system/application/controllers/ajax.php */