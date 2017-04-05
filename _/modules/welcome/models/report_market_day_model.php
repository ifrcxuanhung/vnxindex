<?php

class Report_market_day_model extends CI_Model {
	
	
	
	public function __construct() {
		parent::__construct();
	}
    public function getReport($date = '', $exchange ='', $page = 1, $rp = 20) {
        
        $lang = $this->session->userdata('curent_language');
        $start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        $where1 = '';
        if ($date != '' && $date != '0') {
            $where.=" AND a.date='$date' ";
           // $where1.=" AND a.date='$date' ";
        }
        if ($exchange != '' && $exchange != '0') {
            $exchange = str_replace('\\', '', $exchange);
            $where.=" AND a.exchange='$exchange' ";
            
        }
       /* $search ='';  
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (b.idx_name like '%".$q_search."%' OR b.idx_code LIKE '%".$q_search."%') ";    
        }  */
               
        if(($date == '' || $date == '0') && ($exchange ==''||$exchange == '0')) $where =' AND a.date=(select max(date) from report_market_day)';
            $sql_list="select id,date,code,name,exchange,FORMAT(shares,0) shares,FORMAT(close,0) close,FORMAT(capi/1000000000,0) capi,FORMAT(volume,0) volume,FORMAT(turnover/1000,0) turnover,FORMAT(100*var,2) var,FORMAT(100*mtd,2) mtd,
FORMAT(100*ytd,2) ytd from report_market_day as a where 1".$where."LIMIT ".$start.", ".$rp;
       //print_r($sql_list);
       
        $data['listindexes'] = $this->db->query($sql_list)->result_object();
		return $data;
    }
    
    public function getReport_new($date = '', $exchange ='', $page = 1, $rp = 20) {
        $lang = $this->session->userdata('curent_language');
        $start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        if ($date != '' && $date != '0') {
            $where.=" AND a.date='$date' ";
        }
        if ($exchange != '' && $exchange != '0') {
            $exchange = str_replace('\\', '', $exchange);
            $where.=" AND a.exchange='$exchange' ";
            
        }
       /* $search ='';  
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (b.idx_name like '%".$q_search."%' OR b.idx_code LIKE '%".$q_search."%') ";    
        }  */
               
        if(($date == '' || $date == '0') && ($exchange ==''||$exchange == '0')) $where =' AND a.date=(select max(date) from report_market_day)';
            $sql_list="select id,date,code,name,exchange,nbdays,FORMAT(100*perf,2) perf,FORMAT(volat,2) volat,FORMAT(beta,2) beta,
FORMAT(velocity,2) velocity,FORMAT(trading,2) trading,FORMAT(turn,0) turn from report_market_day as a where 1".$where."LIMIT ".$start.", ".$rp;
        //print_r($sql_list);
        $data['listindexes'] = $this->db->query($sql_list)->result_object();
		return $data;
    }
    
    public function countGetreport($date = '', $exchange ='') {
        $lang = $this->session->userdata('curent_language');
        //$start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        if ($date != '' && $date != '0') {
            $where.=" AND a.date='$date' ";
        }
        if ($exchange != '' && $exchange != '0') {
            $exchange = str_replace('\\', '', $exchange);
            $where.="  AND a.exchange='$exchange' ";   
        } 
        /* $search ='';  
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (b.idx_name like '%".$q_search."%' OR b.idx_code LIKE '%".$q_search."%') ";    
        }    */     
        if(($date == '' || $date == '0') && ($exchange ==''||$exchange == '0')) $where =' AND a.date=(select max(date) from report_market_day)';
        $sql_list = "select count(a.code) as count from report_market_day as a where 1".$where;
        $data= $this->db->query($sql_list)->result_object();
		return $data;
    }
        
    public function getdate() {
        $sql_list = "SELECT DISTINCT date  from report_market_day order by date desc limit 5;";
        $data['date'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getexchange() {
        $sql_list = "SELECT DISTINCT exchange from report_market_day; ";
        $data['exchange'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    
    /*public function getSName($vnx = false) {
        $where = "";
        if ($vnx == true) {
            $where .= "AND CODE IN (SELECT idx_code FROM idx_ref WHERE idx_code = idx_mother)";
        }
        $sql_list = "SELECT DISTINCT SHORTNAME
				from idx_sample
				WHERE 1
				{$where} AND PROVIDER in ('HOSE','HNX','PVN','IFRC','IFRCGWC','PROVINCIAL','IFRCLAB','IFRCRESEARCH') AND provider<>''
				ORDER BY NAME ASC";
        $data['shortname'] = $this->db->query($sql_list)->result_object();
        return $data;
        
    }*/
  
}