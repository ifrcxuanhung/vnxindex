<?php

require('_/modules/welcome/controllers/block.php');
/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  VNFDB
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  home.php 
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

class Home extends Welcome {
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
        $this->load->Model('home_model', 'mhome');
        $setting = $this->data->setting;
        if ($this->input->is_ajax_request()) {
            if ($this->mhome->addNewsLetter($this->input->post('email')) == 1) {
                $this->output->set_output('ok');
            }
        } else {

            $this->load->Model('midx_model', 'midx');
            $this->load->Model('mtranslates_model', 'mtranslates');
            $this->load->Model('mlanguages_model', 'mlanguages');
            $data['config'] = $this->db->get('config')->row_array();
            $data['mtran'] = $this->mtranslates;
            $data['mlang'] = $this->mlanguages;
            if($setting['PVN'] == 1)
            {
                $provider = " PROVIDER = 'IFRC' OR (PROVIDER = 'PVN' AND CODE<>'PVN05PRVND') ";
            }
            else
            {
                $provider = " PROVIDER = 'IFRC' ";
            }
           
            $data['place'] = remove_emty_array($this->midx->getPlace($provider));
            $data['price'] = remove_emty_array($this->midx->getPrice($provider));
            $data['curr'] = remove_emty_array($this->midx->getCurr($provider));
            $providerGlobal = remove_emty_array($this->midx->getProviderFIX());
            //echo "<pre>";print_r($providerGlobal);exit;
          
            if ($providerGlobal != NULL) {

                $temp = NULL;
                foreach ($providerGlobal as $kprovider => $vprovider) {
                    $temp[$kprovider]['type'] = $vprovider['provider']['provider'];
                    $temp[$kprovider]['sub_type'] = $vprovider['sub_type'];
                }
            }
			// echo '<pre>'; print_r($data);exit;
            $data['boxInternationalIndexes'] = $temp;
            $data['total_global'] = $this->midx->getTotal('global');
            $data['total_index'] = $this->midx->getTotalIndex();
            $data['select_name'] = $this->midx->getNameSelectHome();
            $data['last_update'] = $this->midx->getLastUpdate();
            $data['base_url'] = base_url();


            $this->data->data = $data;
			 
            $block = new Block;
			
            $this->data->detail_intro_copn = $block->detail_intro_copn();
            $this->data->idx_home = $block->showIdxHome();
            $this->data->newsletter = $block->newsletter();
            $this->data->service_product = $block->service_product();
            $this->data->partner = $block->partner();
            $this->data->partner_right = $block->partner_right();
            $this->data->actualites = $block->actualites();
            $this->data->compare_chart = $block->compare_chart();
			
            
            $this->template->write_view('content', 'home', $this->data);
            /* echo '<!--';
              pre($this->data);
              echo '-->'; */
            $this->template->render();
        }
    }


}
