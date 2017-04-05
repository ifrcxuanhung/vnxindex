<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class indexlist_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function getAllIndex()
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE` 
                FROM idx_sample,obs_home,idx_ref 
                WHERE `obs_home`.`code`=`idx_sample`.`CODE` AND idx_ref.idx_code= `obs_home`.`code` AND `idx_sample`.`TYPE`='EQUITY' AND `idx_sample`.`code` = COMPO_PARENT 
                ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC";
        return $this->db->query($sql)->result_array();
    }
    
    public function getAllPerformance()
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE` 
                FROM idx_sample,obs_home,idx_ref 
                WHERE `obs_home`.`code`=`idx_sample`.`CODE` AND idx_ref.idx_code= `obs_home`.`code` AND `idx_sample`.`TYPE`='EQUITY' AND `idx_sample`.`code` = COMPO_PARENT
                ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC";
        return $this->db->query($sql)->result_array();
    }
    
    public function getPerformance($code = "")
    {
        $sql = "set @code = '{$code}';
                set @mindate = (select min(date) from idx_day where code = @code);
                set @maxdate = (select max(date) from idx_day where code = @code);
                set @mtd = (select date from idx_day where ((month(@maxdate) > 1 and month(date) = month(@maxdate) - 1) or (month(@maxdate) = 1 and month(date) = 12 and year(date) = year(@maxdate) - 1)) and code = @code order by date desc limit 1);
                set @ytd = (select date from idx_day where (year(date) = year(@maxdate) - 1) and code = @code order by date desc limit 1);
                set @52w = (select max(date) from idx_day where concat(substr(@maxdate, 6, 2), substr(@maxdate, 9, 2)) - concat(substr(date, 6, 2), substr(date, 9, 2)) >= 0 and year(date) = year(@maxdate) - 1 and code = @code order by date asc limit 1);

                set @maxdate_last = (select close from idx_day where code = @code and date = @maxdate);

                select date, last, var, mtd_date, mtd_last, mtd_var, ytd_date, ytd_last, ytd_var, life_date, life_last, life_var, 52w_date, 52w_last, 52w_var
                from (select code, date, close last, perform var
                from idx_day
                where code = @code
                and date = @maxdate) temp
                left join
                (select code, date mtd_date, close mtd_last, ((@maxdate_last - close) / close * 100) mtd_var
                from idx_day
                where code = @code
                and date = @mtd) mtd_temp on temp.code = mtd_temp.code
                left join
                (select code, date ytd_date, close ytd_last, ((@maxdate_last - close) / close * 100) ytd_var
                from idx_day
                where code = @code
                and date = @ytd) ytd_temp on temp.code = ytd_temp.code
                left join
                (select code, date life_date, close life_last, ((@maxdate_last - close) / close * 100) life_var
                from idx_day
                where code = @code
                and date = @mindate) life_temp on temp.code = life_temp.code
                left join
                (select code, date 52w_date, close 52w_last, ((@maxdate_last - close) / close * 100) 52w_var
                from idx_day
                where code = @code
                and date = @52w) 52w_temp on temp.code = 52w_temp.code";
        $listQueries = explode(';', $sql);
        foreach ($listQueries as $key => $value)
        {
            if ($key == count($listQueries) - 1)
            {
                return $this->db->query($value)->result_array();
            }
            else
            {
                $this->db->query($value);
            }
        }
    }
    
    public function getPerformanceYearButNewest($code = "")
    {
        $sql = "select year(date) year, date, close, perform
                from idx_year
                where date < (select max(date) from idx_year where code = '{$code}')
                and code = '{$code}'
                and perform is not null
                and perform != ''
                order by year(date) desc;";
        return $this->db->query($sql)->result_array();
    }
    
    public function getComposition($code = "")
    {
        $sql = "SET @IDXCODE = '{$code}';
                SET @IDXMOTHER = IF((SELECT idx_mother FROM idx_ref WHERE idx_code = @IDXCODE) IS NULL, @IDXCODE,
                (SELECT idx_mother FROM idx_ref WHERE idx_code = @IDXCODE));";
        $listQueries = explode(";", $sql);
        foreach ($listQueries as $query)
        {
            if ($query != "")
            {
                $this->db->query($query);
            }
        }
        return $this->db->query("SELECT * FROM idx_compo WHERE code = @IDXMOTHER ORDER BY WEIGHT DESC;")->result_array();
    }
}