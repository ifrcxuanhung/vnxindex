<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_test extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        $this->load->model('Home_model');
    }

    function index() {
            $this->data->info = $this->Home_model->get_info();

            $this->template->write_view('content', 'group_indexes/index', $this->data);
            $this->template->write('title', 'home');
            $this->template->render();
        
    }
}
