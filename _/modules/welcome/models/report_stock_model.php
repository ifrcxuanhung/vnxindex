<?php

class Report_stock_model extends CI_Model {
	
	
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getOneMonth(){
		
		$data = $this->db->query("select DISTINCT month as yyyymm from _composition order by month desc limit 1")->row_array();
		return $data;
	}
	
	public function getReport($codeid) {
		$lang = $this->session->userdata('curent_language');
        
		$sql_facts = 'SELECT * FROM  rpt_stk_fact WHERE stk_code = "'.$codeid.'"';
        $data['facts'] = $this->db->query($sql_facts)->result_object();

        //$sql_figures = 'SELECT * FROM  rpt_stk_figures WHERE stk_code = "'.$codeid.'"';
		//$data['figures'] = $this->db->query($sql_figures)->result_object();
		
        $sql_performance = 'SELECT * FROM  rpt_stk_per WHERE stk_code ="'.$codeid.'" order by year asc;' ;
		$data['performance'] = $this->db->query($sql_performance)->result_object();
        $sql_last_update_performance = 'SELECT * FROM  rpt_stk_per WHERE stk_code ="'.$codeid.'" order by year DESC LIMIT 1;' ;
        $data['last_update_performance'] = $this->db->query($sql_last_update_performance)->row_object();
        //$sql_membership = 'SELECT id,idx_code,REPLACE(idx_name,"(VND)","") idx_name, date,stk_code,wgt FROM  rpt_stk_membership WHERE stk_code ="'.$codeid.'" order by wgt desc limit 0,10;' ;
		$this->db->query("drop table if exists efrc_insvn_ref;");
	  $this->db->query("create table efrc_insvn_ref select *, space(24) as sub_type from efrc_ins_ref where country = 'VIETNAM';");
	   $this->db->query("CREATE INDEX codeifrc ON efrc_insvn_ref (codeifrc);");
	   $this->db->query("CREATE INDEX code ON efrc_insvn_ref (code);");
	   $this->db->query("update efrc_insvn_ref as a,  idx_sample as b set a.sub_type = b.sub_type where a.`code` = b.`codeint`;");

		$sql_membership = 'SELECT a.id,a.idx_code, b.`name` as stk_name, a.date,a.stk_code,a.stk_wgt FROM efrc_ind_composition a inner join efrc_insvn_ref b
 ON(a.indcodeint = b.`code`) where stk_code ="'.$codeid.'" AND UPPER(b.sub_type) = "BENCHMARK" AND left(name,14) !="VNX PROVINCIAL"
AND left(name,12) !="VNX REGIONAL" AND b.`code` = b.`mother` order by a.stk_wgt desc limit 0,10;' ;
		//echo "<pre>";print_r($sql_membership);exit; 
		$data['membership'] = $this->db->query($sql_membership)->result_object();
        $sect = $this->db->query('select codesect from report_market_last where code ="'.$codeid.'";')->row_array();
		$codesect = $sect['codesect'];
        // $sql_competitor = 'select * from rpt_stk_competitor where idx_code= (select DISTINCT idx_code from rpt_stk_competitor where stk_code="'.$codeid.'" limit 1) order by capi desc limit 0,10;' ;
		 $sql_competitor = 'select * from report_market_last where codesect ="'.$codesect.'" order by capi desc limit 0,10;' ;
		  $sql_figures = 'select * from report_market_last where codesect ="'.$codesect.'" AND code ="'.$codeid.'" order by capi desc limit 0,1;' ;
		 
		$data['competitor'] = $this->db->query($sql_competitor)->result_object();
		
		$data['figures'] = $this->db->query($sql_figures)->result_object();
        
        $sql_sector = 'select DISTINCT left(idx_name,length(idx_name)-5) as idx_name from rpt_stk_membership
         where idx_code=( select idx_code from rpt_stk_competitor where stk_code="'.$codeid.' limit 1")';
		$data['sector'] = $this->db->query($sql_sector)->result_object();
       
		return $data;
	}
	public function lastgetReport($codeid){
		 $sql_membership = 'SELECT date FROM  efrc_ind_composition WHERE stk_code ="'.$codeid.'" order by date desc limit 0,1;' ;
		 $result = $this->db->query($sql_membership)->row_array();
		 return $result;
	}
      public function getmonth() {
        $sql_list = "select DISTINCT month as yyyymm, concat(left(month,4),"-",right(month,2)) month from _composition order by month desc;";
        $data['month'] = $this->db->query($sql_list)->result_object();
        //print_r($sql_list);
        return $data;
    }
}