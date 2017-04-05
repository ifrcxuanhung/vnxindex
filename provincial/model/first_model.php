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
        $data = $this->db->selectQuery($sql);
        return $data;
        print_r($data);
        return 'Connect Success Model<br/>';
    }

    public function getEmailContact()
    {
        $sql = "select contact_email
                from config
                limit 1;";
        return $this->db->selectQuery($sql);
    }

    public function getLogisticsIndexes()
    {
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                FROM idx_sample,obs_home,idx_ref
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = COMPO_PARENT
                AND `idx_sample`.`SHORTNAME` LIKE '%LOGISTICS%'
                ORDER BY `idx_sample`.`SUB_TYPE`, idx_ref.ims_order ASC;";
        return $this->db->selectQuery($sql);
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
        return $this->db->selectQuery($sql);
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
        $data['current'] = $this->db->selectQuery($sql);

        $sql = "select id.description
                from indexes_description id
                where id.index = '{$code}'
                and id.lang_code = '{$_SESSION['LANG_DEFAULT']}'
                union all
                select id.description
                from indexes_description id
                where id.index = left('{$code}', length('{$code}') - 5)
                and id.lang_code = '{$_SESSION['LANG_DEFAULT']}';";
        $data['default'] = $this->db->selectQuery($sql);

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
                $this->db->excuteQuery($query);
            }
        }
        return $this->db->selectQuery("SELECT a.*, b.perf  FROM idx_compo as a left join stk_perf as b on b.ticker= a.isin where b.year=YEAR(date) and a.code = @IDXMOTHER ORDER BY a.WEIGHT DESC;");
    }

    public function saveRequestContact($name = "", $email = "", $message = "")
    {
        $sql = "insert into send_request(name, email, comment, time) values ('$name', '$email', '$message', now())";
        return $this->db->excuteQuery($sql);
    }

    public function getLanguage()
    {
        $sql = "SELECT * FROM `language` WHERE `status` = 1 ORDER BY `sort_order`";
        return $this->db->selectQuery($sql);
    }

    public function getLastUpdate()
    {
        $sql = "SELECT MAX(date) date FROM obs_home LIMIT 1;";
        return $this->db->selectQuery($sql);
    }
    public function getLastUpdate1()
    {
        $sql = "SELECT `value` as date FROM setting where `key`='date_ud' LIMIT 1;";
        return $this->db->selectQuery($sql);
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
                return $this->db->selectQuery($value);
            }
            else
            {
                $this->db->excuteQuery($value);
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
        return $this->db->selectQuery($sql);
    }
     public function getnumber($code = "") {
        $sql = "SET @IDXCODE = '{$code}';
                SET @IDXMOTHER = IF((SELECT idx_mother FROM idx_ref WHERE idx_code = @IDXCODE) IS NULL, @IDXCODE,
                (SELECT idx_mother FROM idx_ref WHERE idx_code = @IDXCODE));";
        $listQueries = explode(";", $sql);
        foreach ($listQueries as $query) {
            if ($query != "") {
                $this->db->excuteQuery($query);
            }
        }
        return $this->db->selectQuery("SELECT count(a.ISIN) as number FROM idx_compo as a, stk_perf as b WHERE code = @IDXMOTHER and a.ISIN=b.ticker and b.year=year(CURDATE()) ORDER BY WEIGHT DESC;");
    }

    public function getDataPerformanceRanking($sort = "", $provider = "", $article_id = "")
    {
        $output = array();
        $indexes = '';
        $sql = "select meta_keyword
                from article_description
                where article_id = '{$article_id}'
                limit 1;";
        $listIndexesQuery = $this->db->selectQuery($sql);
        $listIndexes = $this->db->selectQuery($listIndexesQuery[0]['meta_keyword']);
        foreach ($listIndexes as $valueListIndexes)
        {
            $indexes .= "'{$valueListIndexes['CODE']}',";
        }
        if ($indexes != '')
        {
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
            $output = $this->db->selectQuery($sql);
        }
        return $output;
    }

    public function getProviderByCode($code = "")
    {
        $sql = "SELECT PROVIDER
                FROM idx_sample
                WHERE CODE = '{$code}';";
        return $this->db->selectQuery($sql);
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
        return $this->db->selectQuery($sql);
    }

    public function getGWCIndexes($sql = '')
    {
        return $this->db->selectQuery($sql);
    }
    public function getnumberlistindexes($sql = '')
    {
        $sql = "select count(DISTINCT code) as getnumberlistindexes from idx_compo where  PROVIDER in ('REGIONAL','PROVINCIAL')";
        return $this->db->selectQuery($sql);
    }
    
    public function getResearchPublicatons($sql = '', $start = 0, $total = 0)
    {
        $limit = "";
        if ($total != 0)
        {
            $limit = " LIMIT $start,$total ";
        }
        $sql .= $limit;
        return $this->db->selectQuery($sql);
    }

    public function getQuery($sql)
    {
        return $this->db->selectQuery($sql);
    }

    public function getAllResearchPublicatons($sql = '')
    {
        return $this->db->selectQuery($sql);
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
        return $this->db->selectQuery($sql);
    }

    public function getPerformanceCompany($code = '')
    {
        $sql = "select year, close, perf,eoy
                from stk_perf
                where ticker = '{$code}'
                order by year desc;";
        return $this->db->selectQuery($sql);
    }

    public function getMembershipCompany($code = '', $sort = '', $codeCate = '')
    {
        $orderBy = $sort == "" ? "order by idx_sample.SHORTNAME asc" : $sort;
        $sql = "select replace(idx_sample.SHORTNAME, ' (VND)', '') SHORTNAME, obs_home.varyear, idx_compo.WEIGHT, idx_compo.CODE
                from idx_compo, obs_home, idx_sample
                where idx_compo.CODE = obs_home.code
                and idx_sample.CODE = obs_home.code
                and idx_compo.PROVIDER in ('IFRC', 'PROVINCIAL','IFRCLAB')
                and idx_compo.ISIN = '{$code}'
                {$orderBy};";
        $output = $this->db->selectQuery($sql);
        $sql = "select a.article_id
                from article a, category c
                where a.category_id = c.category_id
                and c.category_code = '{$codeCate}'
                and a.status = 1
                and (a.group like 'index%' or a.group like '%;index')
                limit 1;";
        $id = $this->db->selectQuery($sql);
        if (isset($id[0]['article_id']))
        {
            $article_id = $id[0]['article_id'];
            $sql = "select meta_keyword
                    from article_description
                    where article_id = '{$article_id}'
                    limit 1;";
            $listIndexesQuery = $this->db->selectQuery($sql);
            $listIndexes = $this->db->selectQuery($listIndexesQuery[0]['meta_keyword']);
            foreach ($listIndexes as $valueListIndexes)
            {
                foreach ($output as $keyOutput => $valueOutput)
                {
                    if ($valueListIndexes['CODE'] == $valueOutput['CODE'])
                    {
                        $output[$keyOutput]['has_link'] = 'yes';
                    }
                }
            }
        }
        else
        {
            $sql = "select replace(idx_sample.SHORTNAME, ' (VND)', '') SHORTNAME, obs_home.varyear, idx_compo.WEIGHT, idx_compo.CODE
                    from idx_compo, obs_home, idx_sample
                    where idx_compo.CODE = obs_home.code
                    and idx_sample.CODE = obs_home.code
                    and idx_compo.PROVIDER in ('IFRC', 'PROVINCIAL')
                    and idx_compo.ISIN = '{$code}'
                    {$orderBy};";
        }
        return $output;
    }

    public function getListSearchIndexes($key = '', $codeCate = '')
    {
        $output = array();
        $sql = "select a.article_id
                from article a, category c
                where a.category_id = c.category_id
                and c.category_code = '{$codeCate}'
                and a.status = 1
                and (a.group like 'index%' or a.group like '%;index')
                limit 1;";
        $id = $this->db->selectQuery($sql);
        if (isset($id[0]['article_id']))
        {
            $article_id = $id[0]['article_id'];
            $sql = "select meta_keyword
                    from article_description
                    where article_id = '{$article_id}'
                    limit 1;";
            $listIndexesQuery = $this->db->selectQuery($sql);
            $listIndexes = $this->db->selectQuery($listIndexesQuery[0]['meta_keyword']);
            $count = 0;
            foreach ($listIndexes as $keyListIndexes => $valueListIndexes)
            {
                if (strpos(strtoupper("{$valueListIndexes['CODE']} {$valueListIndexes['SHORTNAME']}"), strtoupper($key)) !== false)
                {
                    $output[$count]['data'] = $listIndexes[$keyListIndexes]['CODE'];
                    $output[$count]['value'] = $listIndexes[$keyListIndexes]['SHORTNAME'];
                }
                $count++;
            }
        }
        return $output;
    }

    public function getListSearchCompanies($key = '', $codeCate = '')
    {
        $output = array();
        $indexes = '';
        $sql = "select a.article_id
                from article a, category c
                where a.category_id = c.category_id
                and c.category_code = '{$codeCate}'
                and a.status = 1
                and (a.group like 'index%' or a.group like '%;index')
                limit 1;";
        $id = $this->db->selectQuery($sql);
        if (isset($id[0]['article_id']))
        {
            $article_id = $id[0]['article_id'];
            $sql = "select meta_keyword
                    from article_description
                    where article_id = '{$article_id}'
                    limit 1;";
            $listIndexesQuery = $this->db->selectQuery($sql);
            $listIndexes = $this->db->selectQuery($listIndexesQuery[0]['meta_keyword']);
            foreach ($listIndexes as $valueListIndexes)
            {
                $indexes .= "'{$valueListIndexes['CODE']}',";
            }
        }
        if ($indexes != '')
        {
            $indexes = rtrim($indexes, ',');
            switch ($_SESSION['LANG_CURRENT'])
            {
                case 'vn':
                    $sql = "select stk_ref.ticker data, stk_ref.stk_name_sn_vn value
                        from stk_ref, idx_compo
                        where stk_ref.ticker like '%{$key}%' or stk_ref.stk_name_sn_vn like '%{$key}%'
                        and stk_ref.ticker = idx_compo.ISIN
                        and idx_compo.PROVIDER in ('IFRC', 'IFRCLAB', 'PVN', 'PROVINCIAL', '')
                        and idx_compo.CODE in ({$indexes})
                        group by stk_ref.stk_name_sn_vn
                        order by stk_ref.stk_name_sn_vn asc;";
                    break;
                default:
                    $sql = "select stk_ref.ticker data, stk_ref.stk_name_sn value
                        from stk_ref, idx_compo
                        where stk_ref.ticker like '%{$key}%' or stk_ref.stk_name_sn like '%{$key}%'
                        and stk_ref.ticker = idx_compo.ISIN
                        and idx_compo.PROVIDER in ('IFRC', 'IFRCLAB', 'PVN', 'PROVINCIAL', '')
                        and idx_compo.CODE in ({$indexes})
                        group by stk_ref.stk_name_sn
                        order by stk_ref.stk_name_sn asc;";
                    break;
            }
            $output = $this->db->selectQuery($sql);
        }
        return $output;
    }

}
