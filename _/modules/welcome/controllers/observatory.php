<?php

/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  VNXINDEX
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  observatory.php 
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
 * Version V001 ：  2013.12.13 (Nguyen Tuan Anh)        New Create 
 * ******************************************************************************************************************* */

class Observatory extends Welcome {
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
     * M001         ： New  2012.12.13 (Nguyen Tuan Anh)  
     * *************************************************************************************************************** */

    function __construct() {
        parent::__construct();
        $this->load->Model('midx_model');
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
     * M001         ： New  2012.12.13 (Nguyen Tuan Anh)  
     * *************************************************************************************************************** */

    public function index() {
        $data['config'] = $this->db->get('config')->row_array();
        $data['base_url'] = base_url();
        $data['total'] = $this->midx_model->getTotal();

        foreach ($this->midx_model->getType() as $v) {
            $type[] = $v['type']['TYPE'];
        }
        $data['Type'] = remove_emty_array($type);
        $data['Price'] = remove_emty_array($this->midx_model->getPrice());
        $data['Code'] = remove_emty_array($this->midx_model->getCode());
        $data['subtype'] = remove_emty_array($this->midx_model->getSubtype());
        $data['Currency'] = remove_emty_array($this->midx_model->getCurr());
        $data['Provider'] = remove_emty_array($this->midx_model->getProvider());
        $data['Coverage'] = remove_emty_array($this->midx_model->getPlace());
        $data['SHORTNAME'] = remove_emty_array($this->midx_model->getSName());
        $data['meta'] = $data['config'];
        $data['Name'] = remove_emty_array($this->midx_model->getName2());

        $this->data->data = $data;
        $this->data->total = $data['total']['TOTAL'];
        $this->data->code = $this->uri->segment(3);
        $this->template->write_view('content', 'observatory/index', $this->data);
        $this->template->render();
    }

}