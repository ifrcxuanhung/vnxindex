<?php

class Report_IFRC_PSI_model extends CI_Model {
	
	
	
	public function __construct() {
		parent::__construct();
	}
    public function getReport($date = '', $page = 1, $rp = 20) {
        $lang = $this->session->userdata('curent_language');
        $start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        if ($date != '' && $date != '0') {
            $where.=" AND a.date='$date' ";
        }     
        if(($date == '' || $date == '0')) $where =' AND a.date=(select max(date) as date from idx_month GROUP BY YEAR(date), month(date) order by date desc limit 1,1)';
            $sql_list="select temp.id,DATE_FORMAT(temp.date, '%Y-%m') as date,temp.provider,temp.code,temp.name,FORMAT(temp.close,2) close,FORMAT(temp.var,2) var,
            ytd_temp.last_ytd,  FORMAT(100*((close/last_ytd)-1),2) ytd,temp.type, yyyymm_temp.yyyymm,temp.idx_mother
             from (select a.id,a.date,a.provider,a.code as code,UPPER(b.idx_name_sn) as name,a.close as close, perform as var, b.idx_bbs as type,b.idx_mother
            from idx_month as a,idx_ref as b where a.code=b.idx_code  and a.provider='IFRCRESEARCH' and b.idx_bbs='SECTOR' and b.idx_type='P'
			and b.idx_curr='VND' and b.calcul_types<>'EW' ".$where." ) temp
            LEFT JOIN
            (select code, date ytd_date, close last_ytd from idx_month
            where date = (select date from idx_month where (year(date) = year('".$date."') - 1)order by date desc limit 1)) ytd_temp
			on temp.code = ytd_temp.code 
			LEFT JOIN
			(select code, max(month) as yyyymm from _performance group by code) as yyyymm_temp on  temp.idx_mother =yyyymm_temp.code
             order by temp.var desc ;";
   //print_r($sql_list);
        $data['listindexes'] = $this->db->query($sql_list)->result_object();
		return $data;
    }
    
    public function countGetreport($date = '') {
        $lang = $this->session->userdata('curent_language');
        //$start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        if ($date != '' && $date != '0') {
            $where.=" AND a.date='$date' ";
        }
          
        if(($date == '' || $date == '0')) $where =' AND a.date=(select max(date) from idx_month)';
        $sql_list = "select count(a.code) as count
        from idx_month as a,idx_ref as b where a.code=b.idx_code and a.provider='IFRCRESEARCH' and b.idx_bbs='SECTOR' and b.idx_type='P'
			and b.idx_curr='VND' and b.calcul_types<>'EW'".$where;
        //print_r($sql_list);
        $data= $this->db->query($sql_list)->result_object();
		return $data;
    }
        
    public function getdate_limit5() {
        $sql_list = "SELECT DISTINCT date,DATE_FORMAT(date, '%Y-%m') as yyyymm  from idx_month where provider='IFRC' group by yyyymm order by yyyymm desc limit 1,5;";
        $data['date'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getHighlights() {
        $sql_list = "select * from article_description where article_id=(select article_id from article where category_id=(select category_id from category where category_code='IFRC_PSI'));";
        $data['highlights'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    
}