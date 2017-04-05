<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Synchronization extends Admin {

    public $table;
    public $pages;

    public function __construct() {
        parent::__construct();
        $this->load->Model('synchronization_model', 'msynch');
    }

    public function index() {
		$this->template->write_view('content', 'synchronization/index', $this->data);
		$this->template->write('title', 'Synchronization');
		$this->template->render();
    }
	
	public function process_synchronization(){
		if ($this->input->is_ajax_request()) {
			$from = microtime(true);
			$result_data = file(APPPATH.'../../assets/data_upload_indexes/synchronization_data.txt');
			unset($result_data[0]);
			foreach($result_data as $item){
				$data = explode("\t",$item);
				if($data[4] == 1){
					// duplicateTables(source_database, destination_database, source_table, destination_table);
					$this->msynch->duplicateTables($data[0],$data[2],$data[1],$data[3]);
				}
			}
		}
		$total = microtime(true) - $from;
		$result[0]['time'] = round($total, 2);
		$result[0]['task'] = 'Synchronization';
		echo json_encode($result);
	}

}