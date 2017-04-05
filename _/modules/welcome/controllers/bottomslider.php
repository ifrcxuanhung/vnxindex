<?php

require('_/modules/welcome/controllers/block.php');

class Bottomslider extends Welcome {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->Model('bottomslider_model', 'bottomslider');
    
		$block = new Block;
		$this->template->write_view('content', 'bottomslider', $this->data);
	
		$this->template->render();
        
    }

}
