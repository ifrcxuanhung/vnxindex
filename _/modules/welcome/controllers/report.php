<?php
require('_/modules/welcome/controllers/block.php');
class Report extends Welcome {

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

    public function index($month =NULL, $codeid='codeid') {
        $this->load->Model('report_model', 'report');
       // $codeid =  $this->input->get('codeid');
//        $month =  $this->input->get('month');
       // echo "<pre>";print_r($month);exit;
        if($month=='all'){
			$arr_month = $this->report->getmonth();
			$month_curr = $arr_month['month'][0]->yyyymm;
		}

        //$this->router->fetch_method();
        
         $indcur=$this->uri->segment('3');
         $this->data->indcur=substr($indcur,0,6);
		//echo $this->data->vnx;
        
        $months = $month =='all' ? $month_curr:$month;
		$this->data->month_rp = $months;
		//echo "<pre>";print_r($this->data->month_rp);exit; 
        $report = remove_emty_array($this->report->getReport($codeid,$this->data->month_rp));
		
        $this->data->report = $report;

        //$getmonth = remove_emty_array($this->report->getmonth());
        //$this->data->getmonth = $getmonth;
        
        $block = new Block;
        $this->data->detail_intro_copn = $block->detail_intro_copn();
        $this->data->idx_home = $block->showIdxHome();
        $this->data->newsletter = $block->newsletter();
        $this->data->service_product = $block->service_product();
        $this->data->partner = $block->partner();
        $this->data->partner_right = $block->partner_right();
        $this->data->actualites = $block->actualites();
        $this->data->compare_chart = $block->compare_chart($codeid);
        
        $this->template->write_view('content', 'report', $this->data);
        $this->template->render();
        
    }

   

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */