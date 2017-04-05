<?php

class Report_daily_model extends CI_Model {
	
	
	
	public function __construct() {
		parent::__construct();
	}
    public function getReport($date = '', $provider ='',$curr='',$prtr='',$q_search='', $page = 1, $rp = 20) {
        $lang = $this->session->userdata('curent_language');
        $start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        $where1 = '';
        if ($date != '' && $date != '0') {
            $where.=" AND a.date='$date' ";
            $where1.=" AND a.date='$date' ";
        }
        if ($provider != '' && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $where.=" AND a.provider='$provider' ";
            
        }
        if ($curr != '' && $curr != '0') {
            $curr = str_replace('\\', '', $curr);
            $where.=" AND b.idx_curr='$curr' ";
            
        }
        if ($prtr != '' && $prtr != '0') {
            $prtr = str_replace('\\', '', $prtr);
            $where.=" AND b.idx_type='$prtr' ";
            
        }
        $search ='';  
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (b.idx_name like '%".$q_search."%' OR b.idx_code LIKE '%".$q_search."%') ";    
        }  
               
        if(($date == '' || $date == '0') && ($provider ==''||$provider == '0')&& ($curr ==''||$curr == '0')&& ($prtr ==''||$prtr == '0')) $where =' AND b.idx_code=b.idx_mother AND a.date=(select max(date) from idx_day)'.$search;
        if(($date == '' || $date == '0')) $where1 =' AND a.date=(select max(date) from idx_day)';
            $sql_list=" select temp.id,temp.date,temp.provider,temp.code,temp.name,FORMAT(temp.close,2) close,FORMAT(pclose_temp.pclose,2) as pclose,
            FORMAT(temp.var,2) as var ,mtd_temp.last_mtd last_mtd,ytd_temp.last_ytd, FORMAT(100*((close/last_mtd)-1),2) mtd, FORMAT(100*((close/last_ytd)-1),2) ytd
             from (select a.id,a.date,a.provider,a.code as code,UPPER(b.idx_name_sn) as name,a.close as close,a.close  as pclose,a.perform as var
            from idx_day as a,idx_ref as b where a.code not like 'PVN05%' and a.code=b.idx_code  ".$where.$search." ) temp
            LEFT JOIN
            (select code, date mtd_date, close last_mtd from idx_day
            where  date = (select date from idx_day where ((month('".$date."') > month('2015-01-01') and month(date) = if(day('".$date."')=1,month('".$date."') - 2,month('".$date."') - 1)) or (month('".$date."') = 1 
            and month(date) = 12 and year(date) = year('".$date."') - 1)) and code = 'VNX25PRVND' order by date desc limit 1)) mtd_temp on temp.code = mtd_temp.code
            LEFT JOIN
            (select code, date ytd_date, close last_ytd from idx_day
            where date = (select date from idx_day where (year(date) = year('".$date."') - 1)order by date desc limit 1)) ytd_temp
             on temp.code = ytd_temp.code 
             LEFT JOIN
            (select code, b.date as prv_date, close as pclose, a.date  from idx_calendar as a,idx_day as b  where a.prv_date=b.date  ".$where1.")
            pclose_temp on temp.code = pclose_temp.code and temp.code<>'PVN05%' order by temp.var desc LIMIT ".$start.", ".$rp.";";
       // print_r($sql_list); die();
        $data['listindexes'] = $this->db->query($sql_list)->result_object();
		return $data;
    }
    
    public function countGetreport($date = '', $provider ='',$curr='',$prtr='', $q_search='') {
        $lang = $this->session->userdata('curent_language');
        //$start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        if ($date != '' && $date != '0') {
            $where.=" AND a.date='$date' ";
        }
        if ($provider != '' && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $where.=" AND a.provider='$provider' ";   
        } 
        if ($curr != '' && $curr != '0') {
            $curr = str_replace('\\', '', $curr);
            $where.=" AND b.idx_curr='$curr' ";   
        } 
        if ($prtr != '' && $prtr != '0') {
            $prtr = str_replace('\\', '', $prtr);
            $where.=" AND b.idx_type='$prtr' ";
            
        }
         $search ='';  
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (b.idx_name like '%".$q_search."%' OR b.idx_code LIKE '%".$q_search."%') ";    
        }         
        if(($date == '' || $date == '0') && ($provider ==''||$provider == '0')&& ($curr ==''||$curr == '0')&& ($prtr ==''||$prtr == '0')) $where =' AND a.date=(select max(date) from idx_day)'.$search;
        $sql_list = "select count(a.code) as count
        from idx_day as a,idx_ref as b where a.code=b.idx_code".$where.$search;

        $data= $this->db->query($sql_list)->result_object();
		return $data;
    }
        
    public function getdate_limit5() {
        $sql_list = "SELECT DISTINCT date  from idx_day where provider='IFRC' order by date desc limit 5;";
        $data['date'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getprovider_idx_day() {
        $sql_list = "SELECT DISTINCT provider as provider from idx_day 
where provider in ('HOSE','HNX','PVN','IFRC','IFRCGWC','PROVINCIAL','IFRCLAB','IFRCRESEARCH') AND provider<>'' order by provider asc;";
        $data['provider'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    
    public function getSName($vnx = false) {
        $where = "";
        if ($vnx == true) {
            $where .= "AND CODE IN (SELECT idx_code FROM idx_ref WHERE idx_code = idx_mother)";
        }
        $sql_list = "SELECT DISTINCT SHORTNAME from idx_sample 
                    WHERE 1	{$where} AND PROVIDER in ('HOSE','HNX','PVN','IFRC','IFRCGWC','PROVINCIAL','IFRCLAB','IFRCRESEARCH') AND provider<>''
				ORDER BY NAME ASC";
        $data['shortname'] = $this->db->query($sql_list)->result_object();
        return $data;  
    }
    public function getcurrency() {
        $sql_list = "select  DISTINCT idx_curr as curr  from idx_ref where idx_code=idx_mother;";
        $data['curr'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getPRTR() {
        $sql_list = "select  DISTINCT if(idx_type='P','PR',if(idx_type='R','TR',idx_type)) as PRTR,idx_type from idx_ref where idx_type <>'';";
        $data['PRTR'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
  
}