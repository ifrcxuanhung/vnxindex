<?php

Class Chart_Model {

    private $db;

    public function Chart_Model()
    {
        $this->db = new DB();
    }

    public function getSampleCode($dataWhere = array())
    {
        $where = 'WHERE 1=1';
        if (count($dataWhere) != 0)
        {
            foreach ($dataWhere as $key => $item)
            {
                $where .= ' AND ' . $key . ' = "' . $item . '"';
            }
        }
        $sql = 'SELECT shortname, code FROM idx_sample ' . $where;
        $rows = $this->db->selectQuery($sql);
        $data = array();
        if (!empty($rows))
        {
            foreach ($rows as $key => $row)
            {
                $data[$row['code']] = $row['shortname'];
                unset($rows[$key]);
            }
        }
        return $data;
    }

    public function getDate($dataCode)
    {
        $dataDate = array();
        foreach ($dataCode as $code)
        {
            $sql = 'SELECT MIN(date) as minDate FROM idx_month_chart WHERE code = "' . $code . '"';
            $rows = $this->db->selectQuery($sql);
            $dataDate[] = $rows[0]['minDate'];
        }
        $date = max($dataDate);
        return $date;
    }

    public function getClose($code, $date)
    {
        $sql = 'SELECT close, date FROM idx_month_chart WHERE code = "' . $code . '" AND date >= "' . $date . '" ORDER BY date ASC';
        $rows = $this->db->selectQuery($sql);
        $data = array();
        if (!empty($rows))
        {
            foreach ($rows as $key => $item)
            {
                $data[$key]['date'] = strtotime(date("Y/m/d", strtotime($item['date']))) * 1000;
                $data[$key]['value'] = $item['close'] * 1;
            }
        }
        return $data;
    }

    public function getIndexName($code)
    {
        $idx_name = '';
        $sql = "select ref.idx_name_sn
                from idx_ref ref, idx_month_chart mchart
                where ref.idx_code = mchart.code
                and mchart.code = '{$code}'
                limit 1;";
        $rows = $this->db->selectQuery($sql);
        $idx_name = @$rows[0]['idx_name_sn'];
        return $idx_name;
    }

    public function getMarketCompany($code = '')
    {
        $sql = "select market
                from stk_month_chart
                where ticker = '{$code}'
                limit 1;";
        $rows = $this->db->selectQuery($sql);
        return $rows[0]['market'];
    }

    public function getAdjClose($code = '', $date = '')
    {
        $sql = "select adjclose, replace(date, '-', '/') date
                from stk_month_chart
                where ticker = '{$code}'
                and date >= replace('{$date}', '/', '-')
                order by date asc;";
        $rows = $this->db->selectQuery($sql);
        $data = array();
        if (!empty($rows))
        {
            foreach ($rows as $key => $item)
            {
                $data[$key]['date'] = strtotime(date("Y/m/d", strtotime($item['date']))) * 1000;
                $data[$key]['value'] = $item['adjclose'] * 1;
            }
        }
        return $data;
    }

    public function getDateCompareChartCompany($companyCode = '', $market = '')
    {
        switch (strtolower($market))
        {
            case 'vnxhn':
                $sql = "select replace(stk_month_chart.date, '-', '/') date
                        from stk_month_chart, (select date_format(str_to_date(date, '%Y/%m/%d'), '%Y-%m-%d') date
                        from idx_month_chart
                        where CODE = 'IFRCHNX') temp
                        where stk_month_chart.ticker = '{$companyCode}'
                        and stk_month_chart.date = temp.date
                        order by stk_month_chart.date asc
                        limit 1;";
                break;
            case 'vnxhm':
                $sql = "select replace(stk_month_chart.date, '-', '/') date
                        from stk_month_chart, (select date_format(str_to_date(date, '%Y/%m/%d'), '%Y-%m-%d') date
                        from idx_month_chart
                        where CODE = 'IFRCVNI') temp
                        where stk_month_chart.ticker = '{$companyCode}'
                        and stk_month_chart.date = temp.date
                        order by stk_month_chart.date asc
                        limit 1;";
                break;
            default:
                $sql = "select replace(min(date), '-', '/') date
                        from stk_month_chart
                        where ticker = '{$companyCode}';";
                break;
        }
        $date = $this->db->selectQuery($sql);
        return $date[0]['date'];
    }

    public function getIndexSectorCompany($companyCode = '')
    {
        $sql = "select concat(stk_sector, 'PRVND') CODE
                from stk_ref
                where stk_code = '{$companyCode}'
                limit 1;";
        $data = $this->db->selectQuery($sql);
        return $data[0]['CODE'];
    }

}
