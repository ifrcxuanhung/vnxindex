<?php
require('_/modules/welcome/controllers/block.php');
class Report_market_day extends Welcome {

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
        
        $this->load->Model('report_market_day_model', 'report_daily');
        $date = isset($_REQUEST["date"]) ? $_REQUEST["date"] : '';
        
        $report_daily = remove_emty_array($this->report_daily->getReport($date));
        $this->data->report_daily = $report_daily;
        
        $report_daily_new = remove_emty_array($this->report_daily->getReport_new($date));
        $this->data->report_daily_new = $report_daily_new;
        
        $getdate = remove_emty_array($this->report_daily->getdate());
        $this->data->getdate = $getdate;
        
        $getexchange = remove_emty_array($this->report_daily->getexchange());
        $this->data->getexchange = $getexchange;
        
        /*$getname = remove_emty_array($this->report_daily->getSName());
        $this->data->getname = $getname;*/
        
        $this->template->write_view('content', 'report_market_day', $this->data);
        $this->template->render();
    }
}

