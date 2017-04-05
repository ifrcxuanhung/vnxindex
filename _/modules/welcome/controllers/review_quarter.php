<?php
require('_/modules/welcome/controllers/block.php');
class Review_quarter extends Welcome {

    /**
     * Ho�i Phuong
     */
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->Model('Report_monthly_model', 'report_monthly');
        $date = isset($_REQUEST["date"]) ? $_REQUEST["date"] : '';
       // $months = $month =='all' ? NULL:$month;
        $report_monthly = remove_emty_array($this->report_monthly->getReport($date));
        $this->data->report_monthly = $report_monthly;
        
        $getdate = $this->db->query("select reference from index_review_quarter group by reference order by reference desc")->result_array();
        $this->data->getdates = $getdate;
       // echo "<pre>";print_r($this->data->getdates);exit; 
        $getprovider = remove_emty_array($this->report_monthly->getprovider_idx_day());
        $this->data->getprovider = $getprovider;
        
        $getname = remove_emty_array($this->report_monthly->getSName());
        $this->data->getname = $getname;
        
        $gettype = remove_emty_array($this->report_monthly->gettype());
        $this->data->gettype = $gettype;
        
        $getcurrency = remove_emty_array($this->report_monthly->getcurrency());
        $this->data->getcurrency = $getcurrency;
        
        $getPRTR = remove_emty_array($this->report_monthly->getPRTR());
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
		$sql_list = "select count(stk_code) as count
        from index_review_quarter group by idx_code";
        //print_r($sql_list);
        $this->data->counts = $this->db->query($sql_list)->row_array();
       // echo "<pre>";print_r($this->data->counts);exit;
        $this->template->write_view('content', 'review_quarter', $this->data);
        $this->template->render();
    }
}
