<?php

class Report_market_month_model extends CI_Model {
	
	
	
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
            $where.=" AND a.market='$exchange' ";
            
        }
       /* $search ='';  
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (b.idx_name like '%".$q_search."%' OR b.idx_code LIKE '%".$q_search."%') ";    
        }  */
               
        if(($date == '' || $date == '0') && ($exchange ==''||$exchange == '0')) $where =' AND a.date=(select max(date) from ifrc_report)';
            $sql_list="select id,date,ticker,market as exchange,FORMAT(svolume,0) svolume,FORMAT(sturnover,0) sturnover,
FORMAT(svelo,0) svelo,FORMAT(nb,0) nb,FORMAT(shares_lis,0) shares_lis,FORMAT(pr_cls,0) pr_cls,FORMAT(ssnb,0) ssnb,FORMAT(ssnbt,0) ssnbt,
FORMAT(ssturnover,0) ssturnover,FORMAT(ssvolume,0) ssvolume,FORMAT(ssvelo,0) ssvelo from ifrc_report as a where 1".$where."LIMIT ".$start.", ".$rp;
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
            $where.=" AND a.market='$exchange' ";
            
        }
       /* $search ='';  
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (b.idx_name like '%".$q_search."%' OR b.idx_code LIKE '%".$q_search."%') ";    
        }  */
               
        if(($date == '' || $date == '0') && ($exchange ==''||$exchange == '0')) $where =' AND a.date=(select max(date) from ifrc_report)';
            $sql_list="select id,date,ticker,market as exchange,FORMAT(svolume,0) svolume,FORMAT(sturnover,0) sturnover,
FORMAT(svelo,0) svelo,FORMAT(nb,0) nb,FORMAT(shares_lis,0) shares_lis,FORMAT(pr_cls,0) pr_cls,FORMAT(ssnb,0) ssnb,FORMAT(ssnbt,0) ssnbt,
FORMAT(ssturnover,0) ssturnover,FORMAT(ssvolume,0) ssvolume,FORMAT(ssvelo,0) ssvelo from ifrc_report as a where 1".$where."LIMIT ".$start.", ".$rp;
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
            $where.="  AND a.market='$exchange' ";   
        } 
        /* $search ='';  
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (b.idx_name like '%".$q_search."%' OR b.idx_code LIKE '%".$q_search."%') ";    
        }    */     
        if(($date == '' || $date == '0') && ($exchange ==''||$exchange == '0')) $where =' AND a.date=(select max(date) from ifrc_report)';
        $sql_list = "select count(a.code) as count from ifrc_report as a where 1".$where;
        $data= $this->db->query($sql_list)->result_object();
		return $data;
    }
        
    public function getdate() {
        $sql_list = "SELECT DISTINCT date  from ifrc_report order by date desc limit 5;";
        $data['date'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getexchange() {
        $sql_list = "SELECT DISTINCT market as exchange from ifrc_report; ";
        $data['exchange'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    
  
}