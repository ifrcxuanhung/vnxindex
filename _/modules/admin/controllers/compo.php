<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ******************************************************************************************************************* *
 * 	 Author: Minh																										 *
 * * ******************************************************************************************************************* */

class Compo extends Admin {
    public function __construct() {
        parent::__construct();
    }
	public function update_indexes(){
		if($this->input->is_ajax_request()){
			$from = microtime(true);

			
			
			$total = microtime(true) - $from;
            $result[0]['time'] = round($total, 2);
            $result[0]['task'] = 'Finish';
            echo json_encode($result);
        }
	}
}