<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fundamental extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();

        $this->load->model('Fundamental_model', 'mfundamental');
        $this->load->helper(array('my_array_helper', 'form'));
    }

    function index($time = '') {
        if($this->input->is_ajax_request()){
            $output = $this->mfundamental->listFAction();
            $this->output->set_output(json_encode($output));
        }else{
            $this->template->write_view('content', 'fundamental/fundamental_list', $this->data);
            $this->template->write('title', 'Fundamental ');
            $this->template->render();
        }
    }

    public function edit(){
        $id = $this->uri->segment(5);
        $this->data->input = $this->mfundamental->get_data($id);
        if($this->input->post()){
            $this->data->input = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ticker', 'ticker', 'required');
            $this->form_validation->set_rules('date', 'date', 'required');
            if($this->form_validation->run()){
                $this->mfundamental->edit($this->data->input,$id);
                redirect(admin_url() . 'fundamental');
            }
        }
        $this->template->write_view('content', 'fundamental/fundamental_edit', $this->data);
        $this->template->write('title', 'Edit Fundamental ');
        $this->template->render();
    }
    
    public function delete(){
        if($this->input->is_ajax_request()){
            $id = $this->input->post('id');
            if($this->mfundamental->deleteFinal($id)){
                $this->output->set_output('1');
            }
        }
    }
}
