<?php

/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  VNFDB
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  block.php 
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

class Block extends MY_Controller {
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

    public function __construct() {
        parent::__construct();
    }

    /*     * ***********************************************************************************************************
     * Name         ： detail_intro_copn
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

    public function detail_intro_copn() {
        $this->load->model('article_model', 'marticle');
        $data = new stdClass();
        $data->template_url = template_url();
        $data->list = $this->marticle->list_article_cate('ifrc', 2);
        $data->info = $this->marticle->get_cate('ifrc');
        return $this->load->view('block/detail_intro_copn', $data, true);
    }

    /*     * ***********************************************************************************************************
     * Name         ： newsletter
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

    public function newsletter() {
        $data = '';
        $setting = $this->db->query('SELECT value FROM `setting` WHERE `key` = "newsletter" AND `group` = "modules"')->row_array();
        if($setting['value'] == '1'){
            return $this->load->view('block/newsletter', $data, true);
        }else{
            return $data;
        }
        
    }

    /*     * ***********************************************************************************************************
     * Name         ： service_product
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

    public function service_product() {
        $this->load->model('article_model', 'marticle');
        $data = new stdClass();
        $data->template_url = template_url();
        //$data->list = $this->marticle->list_article_two_cate('service', 'product');
        $data->list = $this->marticle->getArticleByGroup('services_product');
        return $this->load->view('block/service_product', $data, true);
    }

    /*     * ***********************************************************************************************************
     * Name         ： actualites
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

    public function actualites() {
        $this->load->model('article_model', 'marticle');
        $data = new stdClass();
        $data->template_url = template_url();
        //$data->list = $this->marticle->list_article_cate('actualites', 3);
        //$data->info = $this->marticle->get_cate('actualites');
        $data->list = $this->marticle->getArticleByGroup('news');
        return $this->load->view('block/actualites', $data, true);
    }

    /*     * ***********************************************************************************************************
     * Name         ： compare_chart
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

    public function compare_chart($code = 'VNX25PRVND') {
        $this->load->model('home_model', 'mhome');
        if ($this->input->is_ajax_request()) {
            $response = $this->mhome->getClose($code);
            $this->output->set_output(json_encode($response));
        }
        $data = new stdClass();
        $data->template_url = template_url();
        $where = array(
            'PLACE' => 'Vietnam',
            //'CURR' => 'VND',
            'PRICE' => 'PR',
            'VNXI'  => '1'
        );
        $data->icode = $code;
        $data->hnx = $this->mhome->getClose('IFRCHNX');
        $data->vni = $this->mhome->getClose('IFRCVNI');
        $data->sample = $this->mhome->getSampleCode($where);
		$data->date_last = $this->mhome->getCloseEnd();
		//echo "<pre>";print_r($data->date_last);exit; 
        return $this->load->view('block/compare_chart', $data, true);
    }
    public function compare_chart3($code = '') {
        $this->load->model('home_model', 'mhome');

        if ($this->input->is_ajax_request()) {
            $response = $this->mhome->getClose($code);
            $this->output->set_output(json_encode($response));
        }
        $data = new stdClass();
        $data->template_url = template_url();
        $where = array(
            'PLACE' => 'Vietnam',
            'CURR' => 'VND',
            'PRICE' => 'PR',
            'VNXI'  => '1'
        );
        $data->icode = $code;
        $data->hnx = $this->mhome->getClose('IFRCHNX');
        $data->vni = $this->mhome->getClose('IFRCVNI');
        //echo "<pre>";print_r($data->hnx);exit;
        $data->sample = $this->mhome->getSampleCode($where);
        return $this->load->view('block/compare_chart_company', $data, true);
    }

    /*     * ***********************************************************************************************************
     * Name         ： compare_chart_2
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
     * M001         ： New  2013.12.31 (Minh Đẹp Trai)  
     * *************************************************************************************************************** */

    public function compare_chart_2() {
        $this->load->model('home_model', 'mhome');
        if ($this->input->is_ajax_request()) {
            $frequency = $this->input->post('frequency');
            $dataCode = array();
            foreach($_POST as $key => $value){
                if (strpos($key,'code') !== false) {
                    $getName = $this->db->query('SELECT shortname FROM idx_sample WHERE code = "'.$value.'"')->row_array();
                    $dataCode[$getName['shortname']] = $this->mhome->getClose2($value,$frequency);
                }
            }
            $response['data'] = $dataCode;
            echo json_encode($response);
        }
    }

    /*     * ***********************************************************************************************************
     * Name         ： partner
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

    public function partner() {
       
            $this->load->model('article_model', 'marticle');
            $data = new stdClass();
            $data->template_url = template_url();
            $data->list = $this->marticle->list_article_cate('partner_sponsors');
            return $this->load->view('block/partner', $data, true);
        
    }

    /*     * ***********************************************************************************************************
     * Name         ： partner_right
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
     * M001         ： New  2012.08.16 (Nguyen Tuan Anh)  
     * *************************************************************************************************************** */

    public function partner_right() {
        $setting = $this->db->query('SELECT value FROM `setting` WHERE `key` = "partners" AND `group` = "modules"')->row_array();
        $data = '';
        if($setting['value'] == '1'){
            $this->load->model('article_model', 'marticle');
            $data = new stdClass();
            $data->template_url = base_url();
            $data->list = $this->marticle->list_article_cate('partner_sponsors');
    //        pre($data); die();
            return $this->load->view('block/partner_right', $data, true);
        }else{
            return $data;
        }
    }

    /*     * ***********************************************************************************************************
     * Name         ： showIdx
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
     * M001         ： New  2012.08.16 (Vu KHai)  
     * *************************************************************************************************************** */

    public function showIdxHome() {
        $this->load->model('vnfdb_home_model', 'midxhome');
        $data = new stdClass();
        $data->template_url = template_url();
        $data->list = $this->midxhome->getIdxHome();
        return $this->load->view('block/idx_home', $data, true);
    }

    public function showProduct(){
        $this->load->model('article_model', 'marticle');
        $data = new stdClass();
        $data->template_url = template_url();
        $data->list = $this->marticle->list_article_cate('product');
        $data->info = $this->marticle->get_cate('product');
        return $this->load->view('block/product', $data, true);
    }

    public function showContact(){
        $this->load->model('article_model', 'marticle');
        $data = new stdClass();
        $data->template_url = template_url();
        $data->list = $this->marticle->list_article_cate('contact',2);
        $data->info = $this->marticle->get_cate('contact');
        return $this->load->view('block/contact', $data, true);
    }
	public function bottomslider()
    {
		$this->load->model('bottomslider_model', 'bottomslider');
        return $this->load->view('block/bottomslider',true);

    }
    
    /*public function compare_stockchart($code = '') {
        
        $this->load->model('home_model', 'mhome');
        if ($this->input->is_ajax_request()) {
            $response = $this->mhome->getCloseStock($code);
            $this->output->set_output(json_encode($response));
            echo json_encode($response);
        }
        $data = new stdClass();
        $data->template_url = template_url();
        $where = array(
            'PLACE' => 'Vietnam',
            'CURR' => 'VND',
            'PRICE' => 'PR',
            'VNXI'  => '1'
        );
        $data->icode = $code;
        $data->hnx = $this->mhome->getClose('IFRCHNX');
        $data->vni = $this->mhome->getClose('IFRCVNI');
        $data->sample = $this->mhome->getSampleCode($where);
        return $this->load->view('block/compare_chart_company', $data, true);
    }*/
    public function compare_chart_company($code = '')
    {
		$data = new stdClass();
        $data->icode = $code;
        return $this->load->view('block/compare_chart_company', $data, true);

    }
	
	
    public function compare_chart_company_2($code='')
    {
		$this->load->model('chart_model', 'chart_model');
        $ticker = $code;
        $dataCode = array();
        $market = $this->chart_model->getMarketCompany($ticker);


        if (isset($market))
        {

            $date = $this->chart_model->getDateCompareChartCompany($ticker, $market);

            /* company chart */
            $dataCode[$ticker] = $this->chart_model->getAdjClose($ticker, $date);

            $dataName = $this->chart_model->getDetailCompany($ticker);
            $response['name'][$ticker] = $dataName[0]['stk_name'];

            /* market chart */
            switch (strtolower($market))
            {
                case 'vnxhn':
                    $dataCode['IFRCHNX'] = $this->chart_model->getClose('IFRCHNX', $date);
                    $response['name']['IFRCHNX'] = $this->chart_model->getIndexName('IFRCHNX');
                    break;
                case 'vnxhm':
                    $dataCode['IFRCVNI'] = $this->chart_model->getClose('IFRCVNI', $date);
                    $response['name']['IFRCVNI'] = $this->chart_model->getIndexName('IFRCVNI');
                    break;
            }
            /* index sector chart */

            $indexSector = $this->chart_model->getIndexSectorCompany($ticker);
            $dataCode[$indexSector] = $this->chart_model->getClose($indexSector, $date);

            $response['name'][$indexSector] = $this->chart_model->getIndexName($indexSector);

            $response['data'] = $dataCode;

        }
        else
        {
            $response['name'] = '';
            $response['data'] = array();
        }


        echo json_encode($response);
    }


}