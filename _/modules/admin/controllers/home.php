<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        $this->load->model('Home_model');
    }

    function index() {
        $lang_code = $this->session->userdata('curent_language');
        $this->data->articles = $this->Home_model->showArticles($lang_code['code']);
        $this->data->users = $this->Home_model->showUsers();
        $this->template->write_view('content', 'home/index', $this->data);
        $this->template->write('title', 'Home ');
        $this->template->render();
    }
}