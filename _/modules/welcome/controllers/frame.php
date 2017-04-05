<?php

class Frame extends Welcome {
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

    public function chart($code = '') {
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
            'PRICE' => 'PR'
        );
        $data->icode = $code;
        $data->hnx = $this->mhome->getClose('IFRCHNX');
        $data->vni = $this->mhome->getClose('IFRCVNI');
        $data->sample = $this->mhome->getSampleCode($where);
        $this->load->view('frame/chart', $this->data);
    }

    public function testChart(){
        $this->load->view('frame/test');
    }

}

/* End of file search.php */
    /* Location: ./application/controllers/search.php */