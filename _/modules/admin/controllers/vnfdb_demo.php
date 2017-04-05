<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ******************************************************************************************************************* *
 *   Author: Minh Đẹp Trai                                                                                               *
 * * ******************************************************************************************************************* */

class Vnfdb_demo extends Admin {

    public function __construct() {
        parent::__construct();
        $this->load->model('Vnfdb_demo_model', 'vnfdb_model');
    }

    public function index(){
        $this->template->write_view('content', 'vnfdb_demo/index', $this->data);
        $this->template->write('title', 'VNFDB DEMO');
        $this->template->render();
    }

    public function step_by_step(){
            $this->template->write_view('content', 'vnfdb_demo/step_by_step', $this->data);
            $this->template->write('title', 'VNFDB DEMO STEP BY STEP');
            $this->template->render();
    }

    public function process_document(){
        if($this->input->is_ajax_request()){
            $output = $this->vnfdb_model->listDocument();
            $this->output->set_output(json_encode($output));
        }
    }

    public function process_test(){
        if($this->input->is_ajax_request()){
            $output = $this->vnfdb_model->listTest();
            $this->output->set_output(json_encode($output));
        }
    }

    public function autocomplete(){
        if($this->input->is_ajax_request()){
            $step = $this->input->post('step');
            $data = $this->vnfdb_model->autocomplete($step);
            echo json_encode($data);
        }
    }
}