<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        $this->load->helper(array('my_array_helper', 'form'));
        $this->load->model('news_model', 'mnews');
    }

    function index() {
        $this->data->data_type = $this->mnews->get_data_type();
        if ($this->input->is_ajax_request()) {
            $this->output->set_output(json_encode($this->data->data_type));
        } else {
            $this->template->write_view('content', 'news/news_list', $this->data);
            $this->template->write('title', 'Help');
            $this->template->render();
        }
    }

    function get_data_by_filter() {
        if ($this->input->is_ajax_request()) {
            $data_value = $this->input->post('value_type');
            $output = $this->mnews->listNewsByFilter($data_value);
            $this->output->set_output(json_encode($output));
        }
    }

    // function index($time = '') {
    //     if($this->input->is_ajax_request()){
    //         $this->load->model('news_model', 'mnews');
    //         if(!in_array($time, array('history', 'today', ''))){
    //             $output = $this->mnews->listNewsByMoment('', $time);
    //         }else{
    //             $output = $this->mnews->listNewsByMoment($time);
    //         }
    //         $this->output->set_output(json_encode($output));
    //     }else{
    //         $this->template->write_view('content', 'news/news_list', $this->data);
    //         $this->template->write('title', 'Events ');
    //         $this->template->render();
    //     }
    // }
}
