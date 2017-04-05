<?php

/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  VNFDB
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  welcome.php 
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
 * Version V001 ：  2013.07.8 (LongNguyen)        New Create 
 * ******************************************************************************************************************* */
class Welcome extends MY_Controller {


    /*     * ***********************************************************************************************************
     * Name         ： __construct
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

    function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->library('vfdb_ion_auth');
        $this->load->library('ion_auth');
        if (!$this->vfdb_ion_auth->logged_in()) {
            $this->session->set_userdata('url_login', current_url());
            $this->session->set_userdata('module_login', 'vfdb');
        }
        $this->data = new stdClass();
        $this->data->config = $this->db->get('config')->row_array();
        $this->load->model('admin/language_model', 'language_model');
        $this->load->model('menu_model', 'mmenu');
        $this->load->model('slide_model', 'mslide');
        $this->load->model('article_model', 'marticle');
        $this->load->model('tickers_model', 'mtickers');
		$this->load->model('bottomslider_model', 'bottomslider');
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
        $this->data->curent_language = $this->session->userdata('curent_language') ;
        // load top menu
        $top_menu = $this->mmenu->show_menu_treeview($this->mmenu->list_menu(7));
        $this->data->menutop = $top_menu;
        // load banner
        $this->data->bannertop = $this->mslide->media('banner-top');
        // load bottom menu
        $this->data->botmenu = $this->mmenu->load_top_menu(7);
        // load bottom actualites
        $this->data->list = $this->marticle->list_article_cate('bottom_actualites', 3);
        // load user in vfdb_users table
        $account = $this->vfdb_ion_auth->user()->row();
        // load user in users table if not exist in vfdb_users table
        if (empty($account)) {
            $account = $this->ion_auth->user()->row();
        }
        // load scroll tickers
        $this->data->tickers = $this->mtickers->getTickers();
        $this->data->tickers1 = $this->mtickers->getTickers2();
        $module = $this->session->userdata('module_login');
		
        // if($module != 'welcome'){
        //     $account = '';
        // }
        $this->data->template_url = template_url();
        $this->data->account = $account;
        $this->data->setting = $this->registry->setting;
		
		$this->data->article_bottomslider = $this->bottomslider->article_by_category('boxmenu');
		$this->template->write_view('bottomslider', 'block/bottomslider', $this->data);
       //$this->template->set_template('default');
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
        redirect(base_url() . 'home');
    }

    /*     * ***********************************************************************************************************
     * Name         ： active
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

    public function active($langCode = '') {
        $ls = $this->language_model->find();
        foreach ($ls as $key => $value) {
            $this->data->list_language[$value['code']] = $value;
        }
        if (isset($this->data->list_language[$langCode]) == TRUE) {
            $this->session->set_userdata('curent_language', $this->data->list_language[$langCode]);
            $this->output->set_output(json_encode(array('result' => 1)));
        }
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */