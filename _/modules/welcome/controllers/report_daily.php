<?php
require('_/modules/welcome/controllers/block.php');
class Report_daily extends Welcome {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->Model('report_daily_model', 'report_daily');
        $date = isset($_REQUEST["date"]) ? $_REQUEST["date"] : '';
       // $months = $month =='all' ? NULL:$month;
        $report_daily = remove_emty_array($this->report_daily->getReport($date));
        $this->data->report_daily = $report_daily;
        
        $getdate = remove_emty_array($this->report_daily->getdate_limit5());
        $this->data->getdate = $getdate;
        
        $getprovider = remove_emty_array($this->report_daily->getprovider_idx_day());
        $this->data->getprovider = $getprovider;
        
        $getname = remove_emty_array($this->report_daily->getSName());
        $this->data->getname = $getname;
        
        $getcurrency = remove_emty_array($this->report_daily->getcurrency());
        $this->data->getcurrency = $getcurrency;
        
        $getPRTR = remove_emty_array($this->report_daily->getPRTR());
        $this->data->getPRTR = $getPRTR;
        /*$block = new Block;
        $this->data->detail_intro_copn = $block->detail_intro_copn();
        $this->data->idx_home = $block->showIdxHome();
        $this->data->newsletter = $block->newsletter();
        $this->data->service_product = $block->service_product();
        $this->data->partner = $block->partner();
        $this->data->partner_right = $block->partner_right();
        $this->data->actualites = $block->actualites();
        $this->data->compare_chart = $block->compare_chart();*/
        
        $this->template->write_view('content', 'report_daily', $this->data);
        $this->template->render();
    }
}

