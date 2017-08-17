<?php

class Report_model extends CI_Model {
	
	
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getReport($codeid,$month) {

		$lang = $this->session->userdata('curent_language');
        $where = '';
        if ($month != NULL){
            $where .=" AND month='$month'";
    	}
		$sql_description = 'SELECT * FROM  _description WHERE code = "'.$codeid.'" AND langcode = "'.$lang['code'].'"';
		$sql_facts = 'SELECT * FROM  mr_idx_facts WHERE code = "'.$codeid.'" AND lang ="'.$lang['code'].'"';
		$sql_performance = 'SELECT * FROM  _performance WHERE code = "'.$codeid.'"'.$where;
        $sql_performance_cur = 'SELECT * FROM  _performance_cur_idx WHERE code = "'.$codeid.'"'.$where.' order by f2 desc';
        //$sql_figures = 'SELECT * FROM  _figures WHERE code = "'.$codeid.'"'.$where;
        $sql_figures = 'SELECT idx_code,month,(idx_cap/1000000000) idx_cap ,(idx_div/1000000000) idx_div,(min_cap/1000000000) min_cap, (max_cap/1000000000) max_cap,
(mean_cap/1000000000) mean_cap,vola,beta,trk_error,div_yld,low_lv,high_lv FROM  mr_idx_figures WHERE  idx_code = "'.$codeid.'"'.$where;
		/*$sql_composition = 'select * from(SELECT code,f1,f2,(f3/1000000000) as f3,f4,`order` FROM  _composition WHERE code = "'.$codeid.'"'.$where.' LIMIT 10) as tempa
                            LEFT JOIN
(select                     stk_code,100*mtd as perf,idx_code from rpt_stk_competitor group by stk_code) as tempb on tempa.f1=tempb.stk_code
and left(tempa.`code`,3)=left(tempb.`idx_code`,3)';*/
		$sql_composition = 'select (a.stk_mcap/1000000000) as stk_mcap,a.stk_code, a.stk_name, (a.stk_wgt*100) as stk_wgt, (b.var*100) as perf from efrc_ind_composition a left join report_market_last b ON(a.stk_code = b.code) where idx_code ="'.$codeid.'" LIMIT 0,10;';
        //echo "<pre>";print_r($sql_composition);exit;
        //$sql_count='SELECT COUNT(isin) count FROM idx_compo  WHERE  code = "'.$codeid.'"group by code; ';
        $sql_count='SELECT nb as count FROM mr_idx_figures  WHERE  idx_code = "'.$codeid.'"'.$where.' group by idx_code; ';
        $sql_month='select DISTINCT month as yyyymm, concat(left(month,4),"-",right(month,2)) month from _composition order by month desc';
      // print_r ($sql_month);
        $sql_nameindex='select f1,f2 from _facts where f1 like "%Full name%" and code="'.$codeid.'"';
        $sql_namemonth='select DATE_FORMAT (a.date, "%M %Y") as `month` from (select max(f2) date from _performance where code="'.$codeid.'"'.$where.') as a';
        //$sql_getname="SELECT DISTINCT SHORTNAME, CODE from idx_sample WHERE 1 AND CODE IN (SELECT idx_code FROM idx_ref WHERE idx_code = idx_mother)
			//	AND PROVIDER in ('HOSE','HNX','PVN','IFRC','IFRCGWC','PROVINCIAL','IFRCLAB','IFRCRESEARCH') AND provider<>'' ORDER BY NAME ASC";
        
		$data['description'] = $this->db->query($sql_description)->result_object();
		$data['facts'] = $this->db->query($sql_facts)->result_object();
		$data['performance'] = $this->db->query($sql_performance)->result_object();
		$data['figures'] = $this->db->query($sql_figures)->result_object();
		$data['composition'] = $this->db->query($sql_composition)->result_object();
		//echo "<pre>";print_r($data['composition']);exit; 
        $data['nameindex']=$this->db->query($sql_nameindex)->result_object();
        $data['namemonth']=$this->db->query($sql_namemonth)->result_object();
        $data['count']=$this->db->query($sql_count)->result_object();
        $data['month']=$this->db->query($sql_month)->result_object();
        $data['performance_cur']=$this->db->query($sql_performance_cur)->result_object();
       // $data['getname']=$this->db->query($sql_getname)->result_object();
		//print_r($sql_performance);
		return $data;
	}
      public function getmonth() {
        $sql_list = 'select DISTINCT month as yyyymm, concat(left(month,4),"-",right(month,2)) month from _composition order by month desc;';
        $data['month'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
}