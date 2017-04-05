<?php

class Annual_performance_statistics extends Welcome {
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
     * M001         ： New  2013.12.31 (Minh Đẹp Trai)  
     * *************************************************************************************************************** */

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->Model('midx_model', 'midx');
        $this->load->Model('mtranslates_model', 'mtranslates');
        $this->load->Model('mlanguages_model', 'mlanguages');
        $data['config'] = $this->db->get('config')->row_array();
        $data['mtran'] = $this->mtranslates;
        $data['mlang'] = $this->mlanguages;
        $this->data->count = $this->midx->loadAllAnnualCount();
        
        $this->template->write_view('content', 'annual_performance_statistics',  $this->data);
        $this->template->render();
    }

}

/* End of file search.php */
    /* Location: ./application/controllers/search.php */