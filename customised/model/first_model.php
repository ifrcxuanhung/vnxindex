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
        return $this->db->selectQuery("SELECT * FROM idx_compo WHERE code = @IDXMOTHER ORDER BY WEIGHT DESC;");
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
                where date < (select max(date) from idx_year where code = '{$code}')
                and code = '{$code}'
                and perform is not null
                and perform != ''
                order by year(date) desc;";
        return $this->db->selectQuery($sql);
    }

    public function getDataPerformanceRanking($sort = "", $provider = "")
    {
        $orderBy = $sort == "" ? "ORDER BY `obs_home`.`varyear` DESC" : $sort;
        $sql = "SELECT REPLACE(`idx_sample`.`SHORTNAME`, ' (VND)', '') SHORTNAME, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar`,`idx_sample`.`SUB_TYPE`
                FROM idx_sample,obs_home,idx_ref
                WHERE `obs_home`.`code`=`idx_sample`.`CODE`
                AND idx_ref.idx_code= `obs_home`.`code`
                AND `idx_sample`.`TYPE`='EQUITY'
                AND `idx_sample`.`code` = COMPO_PARENT
                {$provider}
                AND `idx_sample`.`SHORTNAME` LIKE '%LOGISTICS%'
                {$orderBy};";
        return $this->db->selectQuery($sql);
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

}
