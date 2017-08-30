<?php

class Report_monthly_model extends CI_Model {
	
	
	
	public function __construct() {
		parent::__construct();
		
	}
	
    public function getReport_backup_05042017($date = '', $provider ='',$type ='',$curr='',$prtr='',$q_search='', $page = 1, $rp = 20) {
        $lang = $this->session->userdata('curent_language');
        $start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        //$where1 = '';
        if ($date != '' && $date != '0') {
            $where.=" AND eit.date ='$date' ";
            //$where1.=" AND a.date='$date' ";
        }
        if ($provider != '' && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $where.=" AND isa.provider='$provider' ";

        }



        $search ='';
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (isa.name like '%".$q_search."%' OR isa.code LIKE '%".$q_search."%') ";
        }

       // if(($date == '' || $date == '0') && ($provider ==''||$provider == '0') && ($type ==''||$type == '0')&& ($curr ==''||$curr == '0')) $where =' AND eit.date=(select date from efrc_indvn_stats GROUP BY date, YEAR(date), month(date) order by date desc limit 1,1)'.$search;
       // if(($date == '' || $date == '0')) $where1 =' AND a.date=(select max(date) from idx_day)';
            $sql_list="select eit.periodid as yyyymm, eit.id,eit.codeifrc as code, eit.date, eit.adjclose as close, eit.volat1y as ytd, eit.rt as var, isa.`name`, isa.provider, isa.type 
from efrc_indvn_stats eit, idx_sample isa where eit.codeifrc = isa.`code` and eit.periodid = '201704' and eit.period = 'M'".$where." LIMIT ".$start.", ".$rp.";";

       //print_r($sql_list);
        $data['listindexes'] = $this->db->query($sql_list)->result_object();
       //echo "<pre>";print_r($sql_list);exit;

		//echo "<pre>";print_r($data);exit;
		return $data;
    }

    public function countGetreport_backup_05042017($date = '', $provider ='',$type='',$curr='',$prtr='',$q_search='') {
        $lang = $this->session->userdata('curent_language');
        //$start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        if ($date != '' && $date != '0') {
            $where.=" AND eit.date ='$date' ";
            //$where1.=" AND a.date='$date' ";
        }
        if ($provider != '' && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $where.=" AND isa.provider='$provider' ";

        }

        if ($curr != '' && $curr != '0') {
            $curr = str_replace('\\', '', $curr);
            $where.=" AND isa.curr='$curr' ";

        }
        if ($prtr != '' && $prtr != '0') {
            $prtr = str_replace('\\', '', $prtr);
            $where.=" AND isa.type='$prtr' ";

        }
        $search ='';
        if (($q_search != '') && (trim($q_search) != '')) {
            $search=" AND (isa.name like '%".$q_search."%' OR isa.code LIKE '%".$q_search."%') ";
        }
        if(($date == '' || $date == '0') && ($provider ==''||$provider == '0') && ($type ==''||$type == '0')&& ($curr ==''||$curr == '0')) $where =' AND a.date=(select max(date) from efrc_indvn_stats)'.$search;
        $sql_list = "select count(eit.codeifrc) as count
from efrc_indvn_stats eit, idx_sample isa where eit.codeifrc = isa.`code` and eit.periodid = '201704' and eit.period = 'M'";
       // echo "<pre>";print_r($sql_list);exit .$where.$search;
        $data= $this->db->query($sql_list)->result_object();
        return $data;
    }

    public function getReport($date = '', $provider ='',$type ='',$curr='',$prtr='',$q_search='', $page = 1, $rp = 20) {
        $lang = $this->session->userdata('curent_language');
        $start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $where = '';
        //$where1 = '';
        if ($date != '' && $date != '0') {
            $where.=" AND a.date ='$date' ";
            //$where1.=" AND a.date='$date' ";
        }
        if ($provider != '' && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $where.=" AND a.provider='$provider' ";

        }
        if ($type != '' && $type != '0') {
            $type = str_replace('\\', '', $type);
            $where.=" AND b.idx_bbs='$type' ";

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

        if(($date == '' || $date == '0') && ($provider ==''||$provider == '0') && ($type ==''||$type == '0')&& ($curr ==''||$curr == '0')&& ($prtr ==''||$prtr == '0')) $where =' AND a.date=(select date from idx_month GROUP BY date, YEAR(date), month(date) order by date desc limit 1,1)'.$search;
        // if(($date == '' || $date == '0')) $where1 =' AND a.date=(select max(date) from idx_day)';
        $sql_list="select temp.id,DATE_FORMAT(temp.date, '%Y-%m') as date,temp.provider,temp.code,temp.name,FORMAT(temp.close,2) close,temp.var var,
            ytd_temp.last_ytd,  FORMAT(100*((close/last_ytd)-1),2) ytd,temp.type, yyyymm_temp.yyyymm,temp.idx_mother
             from (select a.id,a.date,a.provider,a.code as code,UPPER(b.idx_name_sn) as name,a.close as close, perform as var, b.idx_bbs as type,b.idx_mother
            from idx_month as a,idx_ref as b where a.provider not in ('HOSE','HNX') and a.code not like 'PVN05%' and a.code=b.idx_code".$where.$search." ) temp
            LEFT JOIN
            (select code, date ytd_date, close last_ytd from idx_month
            where date = (select date from idx_month where (year(date) = year('".$date."') - 1)order by date desc limit 1)) ytd_temp
			on temp.code = ytd_temp.code 
			LEFT JOIN
			(select code, max(month) as yyyymm from _performance group by code) as yyyymm_temp on  temp.idx_mother =yyyymm_temp.code
             where temp.code<>'PVN05%' order by temp.var desc LIMIT ".$start.", ".$rp.";";
       // echo "<pre>";print_r($sql_list);exit;
       // print_r($sql_list);
        $data['listindexes'] = $this->db->query($sql_list)->result_object();
       // echo "<pre>";print_r($sql_list);exit;


        return $data;
    }

    public function countGetreport($date = '', $provider ='',$type='',$curr='',$prtr='',$q_search='') {
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
        if ($type != '' && $type != '0') {
            $type = str_replace('\\', '', $type);
            $where.=" AND b.idx_bbs='$type' ";    
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
        if(($date == '' || $date == '0') && ($provider ==''||$provider == '0') && ($type ==''||$type == '0')&& ($curr ==''||$curr == '0')&& ($prtr ==''||$prtr == '0')) $where =' AND a.date=(select max(date) from idx_month)'.$search;
        $sql_list = "select count(a.code) as count
        from idx_month as a,idx_ref as b where a.code=b.idx_code".$where.$search;
        //print_r($sql_list);
        $data= $this->db->query($sql_list)->result_object();
		return $data;
    }
        
    public function getdate_limit5() {
        $sql_list = "SELECT max(DISTINCT date) date ,DATE_FORMAT(date, '%Y-%m') as yyyymm  from efrc_indvn_stats where period='M' group by yyyymm order by yyyymm desc LIMIT 5;";
        $data['date'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getdate_limit5_backup() {
        $sql_list = "SELECT max(DISTINCT date) date ,DATE_FORMAT(date, '%Y-%m') as yyyymm  from idx_month where provider='IFRC' group by yyyymm order by yyyymm desc;";
        $data['date'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getprovider_idx_day_backup() {
        $sql_list = "SELECT DISTINCT provider as provider from idx_month 
where provider in ('PVN','IFRC','IFRCGWC','PROVINCIAL','IFRCLAB','IFRCRESEARCH') AND provider<>'' order by provider asc;";
        $data['provider'] = $this->db->query($sql_list)->result_object();
        return $data;
    }
    public function getprovider_idx_day() {
        $sql_list = "SELECT DISTINCT provider as provider from idx_sample 
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