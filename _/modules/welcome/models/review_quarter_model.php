<?php

class Review_quarter_model extends CI_Model {
	
	
	
	public function __construct() {
		parent::__construct();
	}
    public function getReport($date = '', $page = 1, $rp = 20) {
        $lang = $this->session->userdata('curent_language');
        $start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '1=1 ';
        //$where1 = '';
        if ($date != '' && $date != '0') {
            $where.=" AND reference ='$date' ";
            //$where1.=" AND a.date='$date' ";
        }
       
      
               
       // if(($date == '' || $date == '0')) $where1 =' AND a.date=(select max(date) from idx_day)';
            $sql_list="SELECT stk_code,stk_name,stk_float,stk_capp,idx_code,reference,id, FORMAT(stk_shares,2) stk_shares FROM index_review_quarter WHERE ".$where." ORDER BY stk_code asc LIMIT ".$start.", ".$rp.";";
       //print_r($sql_list); 
        $data['listindexes'] = $this->db->query($sql_list)->result_object();
		return $data;
    }
    
    public function countGetreport($date = '') {
        $lang = $this->session->userdata('curent_language');
        //$start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
         $where = '1=1 ';
        if ($date != '' && $date != '0') {
           $where.=" AND reference ='$date' ";
        }
       
       
        $sql_list = "select count(stk_code) as count from index_review_quarter WHERE ".$where;
        //print_r($sql_list);
        $data= $this->db->query($sql_list)->result_object();
		return $data;
    }
        
    public function getdate_limit5() {
        $sql_list = "SELECT max(DISTINCT date) date ,DATE_FORMAT(date, '%Y-%m') as yyyymm  from idx_month where provider='IFRC' group by yyyymm order by yyyymm desc limit 1,5;";
        $data['date'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getprovider_idx_day() {
        $sql_list = "SELECT DISTINCT provider as provider from idx_month 
where provider in ('PVN','IFRC','IFRCGWC','PROVINCIAL','IFRCLAB','IFRCRESEARCH') AND provider<>'' order by provider asc;";
        $data['provider'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    
    public function getSName($vnx = false) {
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
        
    }
    public function gettype() {
        $sql_list = "SELECT DISTINCT idx_bbs as type  from idx_ref where idx_bbs<>'' order by type asc;";
        $data['type'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
     public function getcurrency() {
        $sql_list = "select DISTINCT idx_curr as curr from idx_ref;";
        $data['curr'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getPRTR() {
        $sql_list = "select  DISTINCT if(idx_type='P','PR',if(idx_type='R','TR',idx_type)) as PRTR,idx_type from idx_ref where idx_type <>'';";
        $data['PRTR'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
  
}