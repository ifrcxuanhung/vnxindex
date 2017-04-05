<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  IMS v3.0
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  admin.php 
 * ---------------------------------------------------------------------------------------------------------------------
 * Entry Server ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Called By    ：  System
 * ---------------------------------------------------------------------------------------------------------------------
 * Notice       ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Copyright    ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Comment      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * History      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Version V001 ：  2012.08.14 (LongNguyen)        New Create 
 * ******************************************************************************************************************* */

class Admin extends MY_Controller {

    protected $data;

    function __construct() {

        parent::__construct();
        $this->load->library('user_agent');
        $this->load->library('ion_auth');
        $this->load->library('session');
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_userdata('url_login', current_url());
            $this->session->set_userdata('module_login', 'admin');
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            //redirect($this->config->item('base_url'), 'refresh');
        }
        // fix loi su dung callback trong from validation khi xai modular extension
        //$this->form_validation->CI =& $this;

        $this->load->model('Language_model', 'language_model');

        $where = array('status' => 1);
        $langList = $this->language_model->find(NULL, $where);
        if (is_array($langList) == TRUE && count($langList) > 0) {
            foreach ($langList as $value) {
                $this->data->list_language[$value['code']] = $value;
            }
            $this->data->default_language = $langList[0];
        }
        unset($langList);
        $this->session->set_userdata('default_language', $this->data->default_language);
        if (!$this->session->userdata('curent_language')) {
            $this->session->set_userdata('curent_language', $this->data->default_language);
        }
        $this->data->listServicesUser=FALSE;
        $user_id = $this->session->userdata('user_id');

        if ($user_id != FALSE) {
            $this->load->model('Group_model', 'group_model');
            $this->load->model('Services_model', 'services_model');
            $group_id = $this->group_model->get_user_group($user_id);
            if($group_id->name !== 'admin') {
                redirect($this->config->item('base_url'), 'refresh');
            }
            $this->data->listServicesUser = $this->services_model->get_service_info('user', $user_id);
            if (!is_array($this->data->listServicesUser) || count($this->data->listServicesUser) == 0) {
                $this->data->listServicesUser = $this->services_model->get_service_info('group', $group_id->group_id);
            }
        }
        $this->data->curent_language = $this->session->userdata('curent_language');
        $this->data->user_service = $this->session->userdata('services');
        $this->data->setting = $this->registry->setting;
        $this->template->set_template('admin');
        // $this->output->enable_profiler(TRUE);
        $this->write_log();
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    public function index() {
        $this->zend->load('Zend_Acl');
        $this->template->write_view('content', 'dashboard');
        $this->template->write('title', 'Admin Panel ');
        $this->template->render();
    }

    /*     * ***********************************************************************************************************
     * Name         ： _thumb
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    public function _thumb(&$image = NULL) {
        $thumb = 'assets/images/no-image.jpg';
        $config = array();
        if ($image == NULL) {
            $image = $thumb;
            return $thumb;
        }
        if (isset($image) == TRUE && $image != '') {
            image_thumb($image, 100, 75);
        }
        return $image;
    }

    /*     * ***********************************************************************************************************
     * Name         ： access_denied
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    public function access_denied() {
        $data->message = $this->session->userdata('access');
        $this->template->write_view('content', 'access_denied', $data);
        $this->template->write('title', 'Admin Panel ');
        $this->template->render();
        return;
    }

    public function write_log() {
        $filename = 'assets/log/user_log.txt';

        if (!file_exists($filename)) {
            $content = 'TIME' . chr(9) . 'USERNAME' . chr(9) . 'URL';
            $fp = fopen($filename, "wb");
            fwrite($fp, $content);
            fclose($fp);
        }

        if(isset($this->session->userdata['username'])){

            $user = $this->session->userdata['username'];

        }elseif(isset($this->session->userdata['email'])){

            $user = $this->session->userdata['email'];

        }else{

            $user = $this->session->userdata['user_id'];

        }

        $date_current = date('Y-m-d H:i:s');

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $content = PHP_EOL;
        $content .= $date_current . chr(9) . $user . chr(9) . $url;

        $fp = fopen($filename, "a");
        fwrite($fp, $content);
        fclose($fp);
    }

}