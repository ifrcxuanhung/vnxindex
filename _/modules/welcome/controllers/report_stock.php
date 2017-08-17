<?php
require('_/modules/welcome/controllers/block.php');
class Report_stock extends Welcome {

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

    public function index($code='') {

        $this->load->Model('Report_stock_model', 'report');
        
        $report = remove_emty_array($this->report->getReport($code));
		//echo "<pre>";print_r();exit; 
        $this->data->report = $report;
		$this->data->last_get_report = $this->report->lastgetReport($code);
        $block = new Block;
        $this->data->detail_intro_copn = $block->detail_intro_copn();
        $this->data->idx_home = $block->showIdxHome();
        $this->data->newsletter = $block->newsletter();
        $this->data->service_product = $block->service_product();
        $this->data->partner = $block->partner();
        $this->data->partner_right = $block->partner_right();
        $this->data->actualites = $block->actualites();
        $this->data->compare_chart3 = $block->compare_chart3("");

		$this->data->stock_code = $code;
		
		$month_hung = $this->report->getOneMonth();
		//$time = strtotime(date('Y-m')."-01")-24*60*60;
		//$this->data->newformat = date('Ym',$time);
		$this->data->newformat = $month_hung['yyyymm'];
		
		
		$date_current = date("Y-m-d",strtotime("-4 days"));
		 
        $this->template->write_view('content', 'report_stock', $this->data);
        $this->template->render();
        
        /*$block = new Block;
        $this->data->compare_chart_company = $block->compare_chart_company($codeid);
        $this->template->write_view('content', 'report_stock', $this->data);
        $this->template->render();*/
        
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */