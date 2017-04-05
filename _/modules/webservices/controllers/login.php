<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        $this->data = new stdClass();
        $this->load->library('session');
        $this->template->set_template('login');
    }

    function index() {
        $this->data->base_url = base_url();
        $this->template->write('title', 'Webservices');
        $this->template->write_view('content', 'login', $this->data);
        $this->template->render();
    }
    
    function checklogin() {
        $output = array('value' => 'no', 'href' => '#');
        $check = array();
        $user = real_escape_string($_POST['user']);
        $pwd = real_escape_string($_POST['pwd']);
        $sql = "select user from ims_webservices where user = '{$user}' and pass = '{$pwd}' limit 1;";
        $check = $this->db->query($sql)->result_array();
		//echo "<pre>";print_r($check);exit;
        if(count($check) == 1) {
            $this->session->set_userdata('webservices', $user);
            $output['value'] = 'yes';
            $output['href'] = base_url() . 'webservices/table/' . $this->session->userdata('table').'';
        }
        echo json_encode($output);
    }

}
