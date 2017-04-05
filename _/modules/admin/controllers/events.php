<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        $this->load->helper(array('my_array_helper', 'form'));
        $this->load->model('events_model', 'mevents');
    }

    function index() {
        $this->data->data_type = $this->mevents->get_data_type();
        $this->template->write_view('content', 'events/events_list', $this->data);
        $this->template->write('title', 'Help');
        $this->template->render();
    }

    function get_data_by_filter(){
        if($this->input->is_ajax_request()){
            $data_value = $this->input->post('value_type');
            $output = $this->mevents->listEventsByFilter($data_value);
            $this->output->set_output(json_encode($output));
        }
    }

    // function index($time = '') {
    //     if($this->input->is_ajax_request()){
    //         $this->load->model('events_model', 'mevents');
    //         if(!in_array($time, array('history', 'today', ''))){
    //             $output = $this->mevents->listEventsByMoment('', $time);
    //         }else{
    //             $output = $this->mevents->listEventsByMoment($time);
    //         }
    //         $this->output->set_output(json_encode($output));
    //     }else{
    //         $this->template->write_view('content', 'events/events_list', $this->data);
    //         $this->template->write('title', 'Events ');
    //         $this->template->render();
    //     }
    // }
}
