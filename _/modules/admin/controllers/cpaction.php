<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cpaction extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();

        $this->load->model('Cpaction_model', 'mcpaction');
        $this->load->helper(array('my_array_helper', 'form'));
    }

    function index($time = '') {
        if($this->input->is_ajax_request()){
            if(!in_array($time, array('history', 'today', 'future', ''))){
                $output = $this->mcpaction->listCPAction('', $time);
            }else{
                $output = $this->mcpaction->listCPAction($time);
            }
            $this->output->set_output(json_encode($output));
        }else{
            $this->template->write_view('content', 'cpaction/cpaction_list', $this->data);
            $this->template->write('title', 'Cpaction ');
            $this->template->render();
        }
    }

    public function delete(){
        if($this->input->is_ajax_request()){
            $id = $this->input->post('id');
            if($this->mcpaction->deleteFinal($id)){
                $this->output->set_output('1');
            }
        }
    }
}
