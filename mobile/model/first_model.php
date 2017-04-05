<?php

Class First_Model {

    private $db;

    public function First_Model()
    {
        $this->db = new DB();
    }

    Public function modelFirst()
    {
        $sql = "select * from user";
        $data = $this->db->selectQuery2($sql);
        return $data;
        //print_r($data);
        return 'Connect Success Model<br/>';
    }

    public function getEmailContact()
    {
        $sql = "select contact_email
                from config
                limit 1;";
        return $this->db->selectQuery2($sql);
    }
	
	 public function getProviderFIX() {
        $sql = "SELECT DISTINCT provider FROM idx_sample WHERE (PROVIDER ='IFRC') AND CODE IN (SELECT CODE FROM obs_home) ORDER BY provider";
        
        $providers = $this->db->selectQuery2($sql);
		
        array_unshift($providers, array('provider' => 'TOP10_PERFORMANCE'));
		
        $sql2 = "SELECT DISTINCT provider FROM idx_sample WHERE (PROVIDER ='IFRCLAB' OR PROVIDER ='IFRCRESEARCH' OR PROVIDER ='PROVINCIAL') AND CODE IN (SELECT CODE FROM obs_home) ORDER BY provider";
		
        $providers2 = $this->db->selectQuery2($sql2);
        foreach($providers2 as $item) {
            $providers[] = $item;
        }
		$providers[] = array('provider' => 'IFRCCURRENCY');
        $providers[] = array('provider' => 'OTHERS');
		
        if ($providers) {
            foreach ($providers as $k => $provider) {
                if ($provider['provider'] == 'TOP10_PERFORMANCE') {
                   
                       $sql = "SELECT DISTINCT SUB_TYPE
                               FROM idx_sample
                                WHERE  provider NOT IN ('IFRCRESEARCH','PVN','IFRCRESEARCH')
                                AND CODE IN (SELECT CODE FROM obs_home) AND type <> 'CURRENCY'
                               ORDER BY SUB_TYPE ASC";
                                 
                } 
				else if($provider['provider'] == 'IFRCCURRENCY'){
					$sql = "SELECT DISTINCT SUB_TYPE FROM idx_sample
                                WHERE  provider NOT IN ('IFRCRESEARCH','PVN')
                                AND CODE IN (SELECT CODE FROM obs_home) AND `TYPE` = 'CURRENCY'
                               ORDER BY SUB_TYPE ASC";
				}
                else if ($provider['provider'] == 'OTHERS'){
                    $sql = "SELECT DISTINCT SUB_TYPE
                                FROM idx_sample
                               WHERE provider  not in('IFRC','VNX', 'PVN', 'IFRCLAB','IFRCRESEARCH','PROVINCIAL')
                               AND CODE IN (SELECT CODE FROM obs_home)
                               ORDER BY SUB_TYPE ASC";
                }
                else {
                    $sql = "SELECT DISTINCT SUB_TYPE
                            FROM idx_sample
                            WHERE  provider ='{$provider['provider']}'
                            AND CODE IN (SELECT CODE FROM obs_home)
                            ORDER BY SUB_TYPE ASC";
                }
                $result[$k]['provider'] = $provider; 
                $result[$k]['sub_type'] = $this->db->selectQuery2($sql);
            }
			
            return $result;
        }
    }
	public function getDataAll($provider)
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                FROM idx_sample,obs_home,idx_ref
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = COMPO_PARENT
                AND (`idx_sample`.`PROVIDER` = '$provider')
                AND `idx_sample`.`code` NOT LIKE '%PVN05%'
                ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC;";
				
        return $this->db->selectQuery2($sql);
    }

    public function getDataVNX()
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                FROM idx_sample,obs_home,idx_ref
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = COMPO_PARENT
                AND (`idx_sample`.`PROVIDER` = 'IFRC')
                AND `idx_sample`.`code` NOT LIKE '%PVN05%'
                ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC;";
				
        return $this->db->selectQuery2($sql);
    }

    public function getDataPVN()
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                FROM idx_sample,obs_home,idx_ref
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = COMPO_PARENT
                AND (`idx_sample`.`PROVIDER` = 'PVN')
                AND `idx_sample`.`code` NOT LIKE '%PVN05%'
                ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC;";
        return $this->db->selectQuery2($sql);
    }

    public function getDataIFRCLAB()
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                FROM idx_sample,obs_home,idx_ref
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = COMPO_PARENT
                AND (`idx_sample`.`PROVIDER` = 'IFRCLAB')
                AND `idx_sample`.`code` NOT LIKE '%PVN05%'
                ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC;";
        return $this->db->selectQuery2($sql);
    }
    public function getDataIFRCRESEARCH()
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                FROM idx_sample,obs_home,idx_ref
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = COMPO_PARENT
                AND (`idx_sample`.`PROVIDER` = 'IFRCRESEARCH')
                AND `idx_sample`.`code` NOT LIKE '%PVN05%'
                ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC;";
        return $this->db->selectQuery2($sql);
    }

    /* public function getDataOTHER()
      {
      $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
      FROM idx_sample,obs_home,idx_ref
      WHERE `obs_home`.`code`=`idx_sample`.`CODE`
      AND idx_ref.idx_code= `obs_home`.`code`
      AND `idx_sample`.`TYPE`='EQUITY'
      AND (`idx_sample`.`PROVIDER` = 'HOSE' OR `idx_sample`.`PROVIDER` = 'HNX')
      AND `idx_sample`.`code` NOT LIKE '%PVN05%'
      ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC;";
      return $this->db->selectQuery2($sql);
      } */

    public function getDataOTHER()
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                    FROM idx_sample,obs_home
                    WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                    AND `idx_sample`.`TYPE`='EQUITY'
                    AND `idx_sample`.`PLACE`='Vietnam'
                    AND `idx_sample`.`code` = COMPO_PARENT
                    AND (`idx_sample`.`PROVIDER` not in ('IFRC','IFRCLAB','PVN','PROVINCIAL','IFRCRESEARCH',''))
                    AND `idx_sample`.`vnxi` =1 AND `idx_sample`.`SUB_TYPE`<>''                    
                    ORDER BY `idx_sample`.`SUB_TYPE` ASC,`obs_home`.`date` desc, `obs_home`.`code` asc;";
        return $this->db->selectQuery2($sql);
    }

    public function getDetailIndex($code = "")
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                FROM idx_sample,obs_home
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
               --  AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = '{$code}'
                LIMIT 1;";
        return $this->db->selectQuery2($sql);
    }

    public function getIndexDescription($code = "")
    {
        $data = array('current' => array(), 'default' => array());
        $sql = "select id.description
                from indexes_description id
                where id.index = '{$code}'
                and id.lang_code = '{$_SESSION['LANG_CURRENT']}'
                union all
                select id.description
                from indexes_description id
                where id.index = left('{$code}', length('{$code}') - 5)
                and id.lang_code = '{$_SESSION['LANG_CURRENT']}';";
        $data['current'] = $this->db->selectQuery2($sql);

        $sql = "select id.description
                from indexes_description id
                where id.index = '{$code}'
                and id.lang_code = '{$_SESSION['LANG_DEFAULT']}'
                union all
                select id.description
                from indexes_description id
                where id.index = left('{$code}', length('{$code}') - 5)
                and id.lang_code = '{$_SESSION['LANG_DEFAULT']}';";
        $data['default'] = $this->db->selectQuery2($sql);

        if ($data['current'] || empty($data['current']))
        {
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }

        return $data['current'];
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
                $this->db->excuteQuery2($query);
            }
        }
        return $this->db->selectQuery2("SELECT a.*,b.perf FROM idx_compo as a, stk_perf as b WHERE code = @IDXMOTHER and a.ISIN=b.ticker and b.year=year(CURDATE()) ORDER BY WEIGHT DESC;");
    }
    public function getnumber($code = "") {
        $sql = "SET @IDXCODE = '{$code}';
                SET @IDXMOTHER = IF((SELECT idx_mother FROM idx_ref WHERE idx_code = @IDXCODE) IS NULL, @IDXCODE,
                (SELECT idx_mother FROM idx_ref WHERE idx_code = @IDXCODE));";
        $listQueries = explode(";", $sql);
        foreach ($listQueries as $query) {
            if ($query != "") {
                $this->db->excuteQuery2($query);
            }
        }
        return $this->db->selectQuery2("SELECT count(a.ISIN) as number FROM idx_compo as a, stk_perf as b WHERE code = @IDXMOTHER and a.ISIN=b.ticker and b.year=year(CURDATE()) ORDER BY WEIGHT DESC;");
    }

    public function saveRequestContact($name = "", $email = "", $message = "")
    {
        $sql = "insert into send_request(name, email, comment, time) values ('$name', '$email', '$message', now())";
        return $this->db->excuteQuery2($sql);
    }

    public function getLanguage()
    {
        $sql = "SELECT * FROM `language` WHERE `status` = 1 ORDER BY `sort_order`";
        return $this->db->selectQuery2($sql);
    }

    public function getLastUpdate()
    {
        $sql = "SELECT MAX(date) date FROM obs_home LIMIT 1;";
        return $this->db->selectQuery2($sql);
    }

    public function getPerformance($code = "")
    {
        $sql = "set @code = '{$code}';
                set @mindate = (select min(date) from idx_day where code = @code);
                set @maxdate = (select max(date) from idx_day where code = @code);
                set @mtd = (select date from idx_day where ((month(@maxdate) > 1 and month(date) = month(@maxdate) - 1) or (month(@maxdate) = 1 and month(date) = 12 and year(date) = year(@maxdate) - 1)) and code = @code order by date desc limit 1);
                set @ytd = (select date from idx_day where (year(date) = year(@maxdate) - 1) and code = @code order by date desc limit 1);
                set @52w = (select max(date) from idx_day where concat(substr(@maxdate, 6, 2), substr(@maxdate, 9, 2)) - concat(substr(date, 6, 2), substr(date, 9, 2)) >= 0 and year(date) = year(@maxdate) - 1 and code = @code order by date asc limit 1);
                set @n=(select 1/((DATEDIFF(@maxdate,@mindate))/365));
                set @maxdate_last = (select close from idx_day where code = @code and date = @maxdate);

                select date, last, var, mtd_date, mtd_last, mtd_var, ytd_date, ytd_last, ytd_var, life_date, life_last, life_var, 52w_date, 52w_last, 52w_var, 100*(pow((last/life_last),@n)-1) as annua
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
                return $this->db->selectQuery2($value);
            }
            else
            {
                $this->db->excuteQuery2($value);
            }
        }
    }

    public function getPerformanceYearButNewest($code = "")
    {
        $sql = "select year(date) year, date, close, perform
                from idx_year
                where code = '{$code}'
                and perform is not null
                and perform != ''
                order by year(date) desc;";
        return $this->db->selectQuery2($sql);
    }
    // CODE CU
   /* public function getPerformanceYearButNewest($code = "")
    {
        $sql = "select year(date) year, date, close, perform
                from idx_year
                where date < (select max(date) from idx_year where code = '{$code}')
                and code = '{$code}'
                and perform is not null
                and perform != ''
                order by year(date) desc;";
        return $this->db->selectQuery2($sql);
    }*/

    public function getDataPerformanceRankingNoId($sort = "", $provider = "")
    {
        $orderBy = $sort == "" ? "ORDER BY `obs_home`.`varyear` DESC" : $sort;
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                FROM idx_sample,obs_home,idx_ref
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = COMPO_PARENT
                {$provider}
                AND `idx_sample`.`code` NOT LIKE '%PVN05%'
                {$orderBy};";
        return $this->db->selectQuery2($sql);
    }
    
    public function getDataPerformanceRankingId($sort = "", $provider = "", $article_id = "")
    {
        $output = array();
        $indexes = '';
        $sql = "select meta_keyword
                from article_description
                where article_id = '242'
                limit 1;";
        $listIndexesQuery = $this->db->selectQuery2($sql);
        $listIndexes = $this->db->selectQuery2($listIndexesQuery[0]['meta_keyword']);
        foreach ($listIndexes as $valueListIndexes) {
            $indexes .= "'{$valueListIndexes['CODE']}',";
        }
        if ($indexes != '') {
            $indexes = rtrim($indexes, ',');
            $orderBy = $sort == "" ? "ORDER BY `obs_home`.`varyear` DESC" : $sort;
            $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                    FROM idx_sample,obs_home,idx_ref
                    WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                    AND idx_ref.idx_code= `obs_home`.`code`
                    AND `idx_sample`.`TYPE`='EQUITY'
                    AND `idx_sample`.`CODE` = COMPO_PARENT
                    AND `idx_sample`.`CODE` IN ({$indexes})
                    {$provider}
                    
                    {$orderBy};";
            $output = $this->db->selectQuery2($sql);
        }
        return $output;
    }

    public function getProviderByCode($code = "")
    {
        $sql = "SELECT PROVIDER
                FROM idx_sample
                WHERE CODE = '{$code}';";
        return $this->db->selectQuery2($sql);
    }

    public function getRelatedIndexes($code = "")
    {
        $sql = "select CODE, PRICE, CURR
                from idx_sample, (
                    select COMPO_PARENT
                    from idx_sample
                    where CODE = '{$code}') temp
                where idx_sample.COMPO_PARENT = temp.COMPO_PARENT
                order by PRICE, CURR;";
        return $this->db->selectQuery2($sql);
    }

    public function getListSearchIndexes($key = '')
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') value, `idx_sample`.`CODE` data
                FROM idx_sample,obs_home,idx_ref
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = COMPO_PARENT
                AND (`idx_sample`.`PROVIDER` != '' AND !ISNULL(`idx_sample`.`PROVIDER`))
                AND (`idx_sample`.`code` LIKE '%{$key}%' OR `idx_sample`.`SHORTNAME` LIKE '%{$key}%')
                AND `idx_sample`.`code` NOT LIKE '%PVN05%'
                ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC;";
        return $this->db->selectQuery2($sql);
    }

    public function getDetailCompany($code = '')
    {
        switch ($_SESSION['LANG_CURRENT'])
        {
            case 'vn':
                $sql = "select upper(stk_name_sn_vn) as stk_name, stk_market, stk_curr, upper(b.sec_name_vn) as sec_name, c.country, d.mar_name,upper(e.curr_name) as curr_name
                        from stk_ref as a, sec_ref as b, gwc_country_ref as c, mar_ref as d, vndb_currency_ref as e
                        where a.ticker = '{$code}' and a.stk_sector=b.sec_code
                        and a.country=c.ccountry and a.stk_market=d.mar_code and a.stk_curr=e.curr_code
                        order by a.ipo desc                        
                        limit 1;";
                break;
            default:
                $sql = "select upper(stk_name_sn) as stk_name, stk_market, stk_curr, upper(b.sec_name) as sec_name,c.country, d.mar_name,upper(e.curr_name) as curr_name
                        from stk_ref as a, sec_ref as b, gwc_country_ref as c, mar_ref as d, vndb_currency_ref as e
                        where a.ticker = '{$code}' and a.stk_sector=b.sec_code
                        and a.country=c.ccountry and a.stk_market=d.mar_code and a.stk_curr=e.curr_code
                        order by a.ipo desc                        
                        limit 1;";
                break;
        }
        return $this->db->selectQuery2($sql);
    }
    
    public function getPerformanceCompany($code = '')
    {
        $sql = "select year, close, perf,eoy
                from stk_perf
                where ticker = '{$code}'
                order by year desc;";
        return $this->db->selectQuery2($sql);
    }
    
    public function getMembershipCompany($code = '', $sort = '')
    {
        $orderBy = $sort == "" ? "order by idx_sample.SHORTNAME asc" : $sort;
        $sql = "select replace(idx_sample.SHORTNAME, ' (VND)', '') SHORTNAME, obs_home.varyear, idx_compo.WEIGHT, idx_compo.CODE
                from idx_compo, obs_home, idx_sample
                where idx_compo.CODE = obs_home.code
                and idx_sample.CODE = obs_home.code
                and idx_compo.PROVIDER = 'IFRC'
                and idx_compo.ISIN = '{$code}'
                {$orderBy};";
        return $this->db->selectQuery2($sql);
    }
    
    public function getListSearchCompanies($key = '')
    {
        switch ($_SESSION['LANG_CURRENT']) {
            case 'vn':
                $sql = "select stk_ref.ticker data, stk_ref.stk_name_sn_vn value
                        from stk_ref, idx_compo
                        where stk_ref.ticker like '%{$key}%' or stk_ref.stk_name_sn_vn like '%{$key}%'
                        and stk_ref.ticker = idx_compo.ISIN
                        and idx_compo.PROVIDER in ('IFRC', 'IFRCLAB', 'PVN', '')
                        group by stk_ref.stk_name_sn_vn
                        order by stk_ref.stk_name_sn_vn asc;";
                break;
            default:
                $sql = "select stk_ref.ticker data, stk_ref.stk_name_sn value
                        from stk_ref, idx_compo
                        where stk_ref.ticker like '%{$key}%' or stk_ref.stk_name_sn like '%{$key}%'
                        and stk_ref.ticker = idx_compo.ISIN
                        and idx_compo.PROVIDER in ('IFRC', 'IFRCLAB', 'PVN', '')
                        group by stk_ref.stk_name_sn
                        order by stk_ref.stk_name_sn asc;";
                break;
        }
        return $this->db->selectQuery2($sql);
    }
    
    public function getsector_breakdown($code = "")
    {
        if($code == "") return;
        /*
        $sql = "select a.ISIN, a.name, a.WEIGHT, b.stk_sector, c.sec_name
                from idx_compo as a, stk_ref as b, sec_ref as c 
                where a.ISIN=b.ticker and a.code='$code' and b.stk_sector=c.sec_code";
        */
        $sql = "select ISIN,name,perf,WEIGHT,stk_sector, c.sec_name from (select a.ISIN, a.name, stk_perf.perf, a.WEIGHT, b.stk_sector
                from idx_compo as a, stk_ref as b, stk_perf
                where a.ISIN=b.ticker and a.code='{$code}' and b.ticker=stk_perf.ticker and stk_perf.year=year(CURDATE()) group by isin) as d
                LEFT JOIN sec_ref as c on c.sec_code=d.stk_sector
                ORDER BY WEIGHT DESC;";
        return $this->db->selectQuery2($sql);
    }
    
    public function getsectorweightdaily($code = "")
    {
        $sql = "select iswd.*, sr.sec_name, sr.sec_name_vn 
                from idx_sector_weight_daily iswd LEFT JOIN sec_ref sr on sr.sec_code = iswd.sector
                where iswd.`idx_code` = '$code' 
                order by iswd.weight DESC";
        return $this->db->selectQuery2($sql);
    }

    public function getsize_breakdown($code = "")
    {
        $sql = "select b.CODE, b.SHORTNAME, a.ISIN, a.NAME, a.perf, a.WEIGHT
                from (select ic.CODE, ic.ISIN, ic.NAME, sp.perf, ic.WEIGHT
                from stk_perf sp,
                (select compo.CODE, compo.ISIN, compo.NAME, compo.WEIGHT
                from idx_compo compo, idx_ref ref
                where ref.idx_code='{$code}'
                and ref.idx_mother=compo.CODE) ic
                where ic.ISIN=sp.ticker
                and sp.year=year(curdate())
                group by ic.isin
                order by ic.WEIGHT desc) a
                left join (select idx_compo.CODE, idx_compo.ISIN, REPLACE(idx_sample.SHORTNAME, ' (VND)', '') SHORTNAME
                from idx_compo, idx_sample
                where idx_compo.CODE=idx_sample.CODE
                and idx_compo.CODE in ('VNXASLGPRVND', 'VNXASMDPRVND', 'VNXASSMPRVND')) b
                on a.ISIN=b.ISIN order by SHORTNAME asc, WEIGHT desc;";
        return $this->db->selectQuery2($sql);
    }
     public function getnumberlistindexes($sql = '')
    {
        $sql = "select count(DISTINCT code) as getnumberlistindexes from idx_compo where  PROVIDER ='IFRC'";
        return $this->db->selectQuery2($sql);
    }

}
