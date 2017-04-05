<?php
require('_/modules/welcome/controllers/block.php');
class Report_IFRC_PSI extends Welcome {

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
        $this->load->Model('Report_IFRC_PSI_model', 'report_monthly');
        $date = isset($_REQUEST["date"]) ? $_REQUEST["date"] : '';
       // $months = $month =='all' ? NULL:$month;
        $report_monthly = remove_emty_array($this->report_monthly->getReport($date));
        $this->data->report_monthly = $report_monthly;
        
        $getdate = remove_emty_array($this->report_monthly->getdate_limit5());
        $this->data->getdate = $getdate;
        
        $highlights = remove_emty_array($this->report_monthly->getHighlights());
        $this->data->highlights = $highlights;

        $this->template->write_view('content', 'report_IFRC_PSI', $this->data);
        $this->template->render();
    }
}

