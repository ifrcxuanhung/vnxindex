<?php

/* * ****************************************************************************
 * Model nIDX dùng để xử lý các truy vấn database ở bên ngoài
 *
 */

class Midx_model extends CI_Model {
    /*     * ************************************************************************
     * lấy ra TYPE ở table idx_sample
     * *********************************************************************** */

    public function __construct() {
        parent::__construct();
        $this->db3 = $this->load->database('database3', TRUE);
    }

    public function getType($provider = NULL, $vnx = false) {

        $where = NULL;
        if ($provider != NULL) {
            if ($provider == 'IFRC') {
                $where = "AND idx_sample.PROVIDER='IFRC'";
            } else {
                $where = "AND (PROVIDER <> 'IFRC' or ISNULL(PROVIDER)) ";
                //		$where = "and idx_sample.code=obs_home.code and (idx_sample.PROVIDER <> 'IFRC' or ISNULL(idx_sample.PROVIDER)) ";
            }
        }
        if ($vnx == true) {
            $where .= "AND LEFT(idx_sample.CODE, 3) LIKE '%VNX%' AND CODE IN (SELECT CODE FROM idx_ref)";
        } else {
            $where .= "AND CODE IN (SELECT CODE FROM obs_home)";
        }
        $sql = "select DISTINCT TYPE from idx_sample WHERE 1 {$where} AND VNXI = 1 ORDER BY TYPE ASC";
        //	$sql = "select DISTINCT idx_sample.TYPE,if(idx_sample.type='EQUITY','', idx_sample.type) as my_order from idx_sample , obs_home  WHERE 1 {$where} ORDER BY my_order ASC";

        $types = $this->db->query($sql)->result_array();
        if ($types) {
            foreach ($types as $k => $type) {
                $sql = "SELECT DISTINCT SUB_TYPE
                        FROM idx_sample
                        WHERE 1
                        {$where}
                        AND TYPE ='{$type['TYPE']}'
                        AND CODE IN (SELECT CODE FROM obs_home)
                        ORDER BY SUB_TYPE ASC";
                //		$sql = "select DISTINCT idx_sample.SUB_TYPE, if(idx_sample.SUB_TYPE='Blue Chips','', idx_sample.SUB_TYPE) as my_order2 from idx_sample , obs_home  WHERE 1 {$where} and TYPE ='{$type['TYPE']}' ORDER BY my_order2 ASC";
                $result[$k]['type'] = $type;
                $result[$k]['sub_type'] = $this->db->query($sql)->result_array();
            }

            return $result;
        }
    }

    public function getProviderFIX() {
        $this->db->where('key', 'PVN');
        $setting = $this->db->get('setting')->row_array();

		$sql = "select provider from obs_home_vn where provider <> 'IFRCGWC' group by provider";
        $providers = $this->db3->query($sql)->result_array();
        array_unshift($providers, array('provider' => 'TOP10_PERFORMANCE'));

        if ($providers) {
            foreach ($providers as $k => $provider) {

                if ($provider['provider'] == 'TOP10_PERFORMANCE') {
                    if ($setting['value'] == 1)
                    {
                        $sql = "SELECT DISTINCT SUB_TYPE
                                FROM idx_sample
                               WHERE provider NOT IN ('IFRCRESEARCH', 'PROVINCIAL')
                               AND CODE IN (SELECT CODE FROM obs_home_vn) AND type <> 'CURRENCY'
                               ORDER BY SUB_TYPE ASC";
                    }
                    else
                    {
                        $sql = "SELECT DISTINCT SUB_TYPE
                               FROM idx_sample
                                WHERE  provider NOT IN ('IFRCRESEARCH','PVN', 'IFRCRESEARCH')
                                AND CODE IN (SELECT CODE FROM obs_home_vn) AND type <> 'CURRENCY'
                               ORDER BY SUB_TYPE ASC";
                    }

                    //$sql = "SELECT NULL SUB_TYPE";
                }else {

                    $sql = "SELECT DISTINCT bbs as SUB_TYPE FROM obs_home_vn
                            WHERE provider ='$provider[provider]'";
                }


                $result[$k]['provider'] = $provider;

				
                $result[$k]['sub_type'] = $this->db3->query($sql)->result_array();
            }

            return $result;
        }
    }

    public function getProviderFIX_bk10082017() {
        $this->db->where('key', 'PVN');
        $setting = $this->db->get('setting')->row_array();

        $sql = "select provider from obs_home where provider <> 'IFRCGWC' group by provider";
        $providers = $this->db->query($sql)->result_array();
        array_unshift($providers, array('provider' => 'TOP10_PERFORMANCE'));

        if ($providers) {
            foreach ($providers as $k => $provider) {

                if ($provider['provider'] == 'TOP10_PERFORMANCE') {
                    if ($setting['value'] == 1)
                    {
                        $sql = "SELECT DISTINCT SUB_TYPE
                                FROM idx_sample
                               WHERE provider NOT IN ('IFRCRESEARCH', 'PROVINCIAL')
                               AND CODE IN (SELECT CODE FROM obs_home) AND type <> 'CURRENCY'
                               ORDER BY SUB_TYPE ASC";
                    }
                    else
                    {
                        $sql = "SELECT DISTINCT SUB_TYPE
                               FROM idx_sample
                                WHERE  provider NOT IN ('IFRCRESEARCH','PVN', 'IFRCRESEARCH')
                                AND CODE IN (SELECT CODE FROM obs_home) AND type <> 'CURRENCY'
                               ORDER BY SUB_TYPE ASC";
                    }

                    //$sql = "SELECT NULL SUB_TYPE";
                }else {

                    $sql = "SELECT DISTINCT bbs as SUB_TYPE FROM obs_home
                            WHERE provider ='$provider[provider]'";
                }


                $result[$k]['provider'] = $provider;


                $result[$k]['sub_type'] = $this->db->query($sql)->result_array();
            }
            echo "<pre>";print_r($result);exit;
            return $result;
        }
    }

    public function getProviderFIX_backup() {
        $this->db->where('key', 'PVN');
        $setting = $this->db->get('setting')->row_array();

        if ($setting['value'] == 1) {
            $sql = "SELECT DISTINCT provider FROM idx_sample WHERE (PROVIDER ='IFRC' or PROVIDER ='PVN') AND CODE IN (SELECT CODE FROM obs_home WHERE CODE<>'PVN05PRVND') ORDER BY provider desc";
        } else {
            $sql = "SELECT DISTINCT provider FROM idx_sample WHERE (PROVIDER ='IFRC' OR PROVIDER ='IFRCRESEARCH') AND CODE IN (SELECT CODE FROM obs_home) ORDER BY provider";
        }

        $providers = $this->db->query($sql)->result_array();

        array_unshift($providers, array('provider' => 'TOP10_PERFORMANCE'));

        $sql2 = "SELECT DISTINCT provider FROM idx_sample WHERE (PROVIDER ='IFRCLAB' OR PROVIDER ='IFRCRESEARCH' OR PROVIDER ='PROVINCIAL') AND CODE IN (SELECT CODE FROM obs_home) ORDER BY provider";

        $providers2 = $this->db->query($sql2)->result_array();
        foreach($providers2 as $item) {
            $providers[] = $item;
        }
        $providers[] = array('provider' => 'IFRCCURRENCY');
        $providers[] = array('provider' => 'OTHERS');


        if ($providers) {
            foreach ($providers as $k => $provider) {
                if ($provider['provider'] == 'TOP10_PERFORMANCE') {
                    if ($setting['value'] == 1)
                    {
                        $sql = "SELECT DISTINCT SUB_TYPE
                                FROM idx_sample
                               WHERE provider NOT IN ('IFRCRESEARCH', 'PROVINCIAL')
                               AND CODE IN (SELECT CODE FROM obs_home) AND type <> 'CURRENCY'
                               ORDER BY SUB_TYPE ASC";
                    }
                    else
                    {
                        $sql = "SELECT DISTINCT SUB_TYPE
                               FROM idx_sample
                                WHERE  provider NOT IN ('IFRCRESEARCH','PVN', 'IFRCRESEARCH')
                                AND CODE IN (SELECT CODE FROM obs_home) AND type <> 'CURRENCY'
                               ORDER BY SUB_TYPE ASC";
                    }
                    //$sql = "SELECT NULL SUB_TYPE";                   
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


                $result[$k]['sub_type'] = $this->db->query($sql)->result_array();
            }
           // echo "<pre>";print_r($result);exit;
            return $result;
        }
    }

    /*     * ************************************************************************
     * lấy ra last update obs_home
     * *********************************************************************** */

    public function getLastUpdate() {
        $sql = "SELECT MAX(date) AS date FROM obs_home LIMIT 1";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    /*     * ************************************************************************
     * lấy ra tổng  số chỉ số ở table idx_sample
     * *********************************************************************** */

    public function getTotal($provider = NULL) {
        $where = NULL;
        if ($provider != NULL) {
            if ($provider == 'IFRC') {
                $where = "WHERE PROVIDER='IFRC'";
            } else {
                $where = "WHERE PROVIDER <> 'IFRC' or ISNULL(PROVIDER)";
            }
        }
        //$sql = "select count(CODE) as TOTAL from idx_sample WHERE PLACE='vietnam' and (PROVIDER = 'IFRC' or PROVIDER = 'PVN') AND VNXI = 1";
       // $sql = "select count(CODE) as TOTAL from idx_sample WHERE PLACE='vietnam' and PROVIDER in('HNX','HOSE','IFRC','IFRCLAB','IFRCRESEARCH','IFRCPROVINCIAL','IFRCCURRENCY','PVN','IFRCGWC') AND VNXI = 1";
        $sql = "select count(CODE) as TOTAL from obs_home b WHERE b.PROVIDER in('HNX','HOSE','IFRC','IFRCLAB','IFRCRESEARCH','IFRCPROVINCIAL','IFRCCURRENCY','PVN','IFRCGWC')";
        //echo $sql = "select count(CODE) as TOTAL from idx_sample $where";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    /*     * ************************************************************************
     * lấy ra tổng  số chỉ số ở table idx_sample
     * *********************************************************************** */

    public function getTotalVnx($provider = NULL) {
        $where = "";
        if ($provider != NULL) {
            if ($provider == 'IFRC') {
                $where .= " AND PROVIDER='IFRC'";
            } else {
                $where .= " AND PROVIDER <> 'IFRC' or ISNULL(PROVIDER)";
            }
        }
        $sql = "SELECT COUNT(CODE) AS TOTAL
                FROM idx_sample
                WHERE 1 = 1
                AND PLACE = 'vietnam'
                AND PROVIDER = 'ifrc'
                {$where};";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    /*     * ************************************************************************
     * lấy ra code và short name idx_sample
     * *********************************************************************** */

    public function getSample($provider = NULL) {
        $where = NULL;
        if ($provider != NULL) {
            if ($provider == 'IFRC') {
                $where = "WHERE PROVIDER='IFRC'";
            } else {
                $where = "WHERE PROVIDER <> 'IFRC' or ISNULL(PROVIDER)";
            }
        }
        $sql = "select SHORTNAME,CODE from idx_sample $where ORDER BY ORD DESC,SHORTNAME ASC";
        return $this->db->query($sql)->result_array();
    }

    /*     * ************************************************************************
     * lấy ra code và short name idx_sample box international indexes
     * *********************************************************************** */

    public function getSampleKey($provider = NULL, $key = null) {
        $where = '';
        if ($provider != NULL) {
            if ($provider == 'IFRCLAB') {
                $where = " `idx_sample`.`PROVIDER`='IFRCLAB' ";
            } else {
                if ($provider == 'PVN')
                    $where = " `idx_sample`.`PROVIDER`='PVN' ";
                else {
                    $where = " `idx_sample`.`PROVIDER`='IFRC' ";
                }
            }
        } else {
            $where = " ( `idx_sample`.`PROVIDER`='IFRC' OR `idx_sample`.`PROVIDER`='PVN' ) ";
        }

        if ($key != '') {
            $where .= "AND ( `idx_sample`.SHORTNAME LIKE '%{$key}%' OR `idx_sample`.CODE LIKE '%{$key}%') ";
        }
        //echo $sql = "SELECT SHORTNAME,CODE from idx_sample where 1=1 {$where} ORDER BY ORD DESC,SHORTNAME ASC";

        $sql = "SELECT `idx_sample`.`SHORTNAME`, `idx_sample`.`CODE`  
                    FROM idx_sample,obs_home 
                    WHERE `obs_home`.`code`=`idx_sample`.`CODE` 
                    AND `idx_sample`.`TYPE`='EQUITY' AND `idx_sample`.`code` = COMPO_PARENT
                    AND {$where}";

        return $this->db->query($sql)->result_array();
    }

    /*     * ************************************************************************
     * lấy ra code và short name idx_sample observatory
     * *********************************************************************** */

    public function getSampleKeyObs($provider = NULL, $key = null, $type = null) {
        $where = '';
        if ($provider != NULL) {
            if ($provider == 'IFRC') {
                $where = " and PROVIDER='IFRC'";
            } else {
                $where = " and (1 = 1 or ISNULL(PROVIDER))";
            }
        }
        if ($type != NULL) {
            if ($type == 'VNX') {
                $where .= " and SUBSTR(`CODE` FROM 1 FOR 3) = 'VNX'";
            }
        }
        if ($key != '') {
            $arr_key = explode(" ", $key);
            $key = implode("%", $arr_key);
            $where .= " and (SHORTNAME LIKE '%{$key}%' OR CODE LIKE '%{$key}%') ";
        }
        $sql = "select SHORTNAME,CODE from idx_sample where 1=1 AND PLACE = 'Vietnam' {$where} AND VNXI = 1 and code in(select DISTINCT codeifrc from efrc_indvn_stats) ORDER BY ORD DESC,SHORTNAME ASC";
		//echo "<pre>";print_r($sql);exit; 
        return $this->db3->query($sql)->result_array();
    }
    /*     * ************************************************************************
     * lấy ra code và short name cho trang Report - PHUONG- 20150603
     * *********************************************************************** */

    
    public function getSampleKeyObs1($provider = NULL, $key = null, $type = null) {
        $where = '';
        if ($provider != NULL) {
            if ($provider == 'IFRC') {
                $where = " and PROVIDER='IFRC'";
            } else {
                $where = " and (1 = 1 or ISNULL(PROVIDER))";
            }
        }
        if ($type != NULL) {
            if ($type == 'VNX') {
                $where .= " and SUBSTR(`CODE` FROM 1 FOR 3) = 'VNX'";
            }
        }
        if ($key != '') {
            $arr_key = explode(" ", $key);
            $key = implode("%", $arr_key);
            $where .= " and (SHORTNAME LIKE '%{$key}%' OR CODE LIKE '%{$key}%') ";
        }
        $sql = "select SHORTNAME,CODE from idx_sample where 1=1 AND PROVIDER IN ('PVN','IFRC','IFRCGWC','PROVINCIAL','IFRCLAB','IFRCRESEARCH') AND PLACE = 'Vietnam' {$where} 
        AND CODE IN (SELECT idx_code FROM idx_ref WHERE idx_code = idx_mother) AND VNXI = 1 and code in(select DISTINCT codeifrc from efrc_indvn_stats) ORDER BY ORD DESC,SHORTNAME ASC";
        return $this->db->query($sql)->result_array();
    }
/*=====================-=====================================*/  
   public function getstk_ref($key = null) {
        $where = '';
        if ($key != '') {
            $arr_key = explode(" ", $key);
            $key = implode("%", $arr_key);
            $where .= " and (stk_name_sn LIKE '%{$key}%' OR stk_code LIKE '%{$key}%')  ";
        }
        $sql = "select stk_code as CODE  ,stk_name_sn as SHORTNAME from stk_ref where 1=1 {$where}  order by SHORTNAME asc";
        //echo $sql;
        return $this->db->query($sql)->result_array();
    }

    /*     * *************************************************************************
     * lấy ra place ở table idx_sample
     * ************************************************************************ */

    public function getPlace($provider = NUll, $vnx = false) {
        $where = "";
        if ($provider != NULL) {
            //$where = " AND PROVIDER = '{$provider}'";
            $where = " AND {$provider}";
        }
        if ($vnx != false) {
            $where = " AND PROVIDER = 'ifrc'
AND SUBSTR(`CODE` FROM 1 FOR 3) = 'VNX' ";
        }
        $sql = "SELECT DISTINCT PLACE
				FROM idx_sample
				WHERE 1 AND PLACE = 'Vietnam'
				{$where} AND VNXI = 1
				ORDER BY PLACE ASC ";
        $place = $this->db->query($sql)->result_array();
        if ($place) {
            foreach ($place as $vplace) {
                $temp[] = $vplace['PLACE'];
            }
            return $temp;
        }
        return "";
    }

    /*     * *************************************************************************
     * lấy ra place ở table idx_sample
     * ************************************************************************ */

    public function getParent($parentcode) {
        $sql = "select DISTINCT CODE,SHORTNAME from idx_sample WHERE INDEX_PARENT='" . $parentcode . "' ORDER BY SHORTNAME ASC ";
        return $this->db->query($sql)->result_array();
    }

    /*     * *************************************************************************
     * lấy ra price ở table idx_sample
     * ************************************************************************ */

    public function getPrice($provider = NULL, $vnx = false) {
        $where = "";
        if ($provider != NULL) {
            $where = " AND {$provider}";
        }
        if ($vnx == true) {
            $where .= " AND LEFT(CODE, 3) LIKE '%VNX%'";
        }
        $sql = "SELECT DISTINCT PRICE
				FROM idx_sample
				WHERE 1
				{$where}
				ORDER BY PRICE ASC";
        $price = $this->db->query($sql)->result_array();
        if ($price) {
            foreach ($price as $value) {
                $temp[] = $value['PRICE'];
            }
            return $temp;
        }
        return "";
    }

    /*     * *************************************************************************
     * lấy ra PROVIDER ở table idx_sample
     * ************************************************************************ */

    public function getProvider($vnx = false) {
        $where = "";
        if ($vnx == true) {
            $where .= "AND LEFT(CODE, 3) LIKE '%VNX%'";
        }
        $sql = "select DISTINCT PROVIDER
				FROM idx_sample
				WHERE 1 AND PLACE = 'Vietnam'
				{$where} AND VNXI = 1
				ORDER BY PROVIDER ASC";
        $provider = $this->db->query($sql)->result_array();
        foreach ($provider as $value) {
            $temp[] = $value['PROVIDER'];
        }
        return $temp;
    }

    /*     * *************************************************************************
     * lấy ra code ở table idx_sample
     * ************************************************************************ */

    public function getCode($vnx = false) {
        $where = "";
        if ($vnx == true) {
            $where .= " AND LEFT(CODE, 3) LIKE '%VNX%'";
        }
        $sql = "SELECT DISTINCT CODE
				FROM idx_sample
				WHERE 1
				{$where} AND VNXI = 1;";
        $code = $this->db->query($sql)->result_array();
        foreach ($code as $value) {
            $temp[] = $value['CODE'];
        }
        return $temp;
    }

    /*     * *************************************************************************
     * lấy ra Subtype ở table idx_sample
     * ************************************************************************ */

    public function getSubtype($vnx = false) {
        $where = "";
        if ($vnx == true) {
            $where .= "AND LEFT(CODE, 3) LIKE '%VNX%'";
        }
        $sql = "SELECT DISTINCT SUB_TYPE
				FROM idx_sample
				WHERE 1
				{$where} AND VNXI = 1;";
        $code = $this->db->query($sql)->result_array();
        foreach ($code as $value) {
            $temp[] = $value['SUB_TYPE'];
        }
        return $temp;
    }

    /*     * *************************************************************************
     * lấy ra CURR ở table idx_sample
     * ************************************************************************ */

    public function getCurr($provider = NULL, $vnx = false) {
        $where = "";
        if ($provider != NULL) {
            // $where = " AND PROVIDER = '{$provider}'";
            $where = " AND {$provider}";
        }
        if ($vnx == true) {
            $where .= " AND LEFT(CODE, 3) LIKE '%VNX%'";
        }
        $sql = "SELECT DISTINCT CURR
				FROM idx_sample
				WHERE 1
				{$where} AND VNXI = 1
				ORDER BY CURR ASC";
        $curr = $this->db->query($sql)->result_array();
        if ($curr) {
            foreach ($curr as $v) {
                $temp[] = $v['CURR'];
            }
            return $temp;
        }
        return "";
    }

//    /*     * *************************************************************************
//     * lấy ra data table box ifrc indexes trang home theo place và type
//     * ************************************************************************ */

    public function getDataTableIFRC($type = NULL, $place = NULL, $curr = NULL, $price = NULL, $provider = NULL, $search = NULL, $subtype = NULL, $page = 1, $rp = 10,$home_maxday) {
//
// get setting

        /*if($type == 'P_CURRENCY'){
        $subtype = '';
        }*/
        @$start = @$start == 1 ? 0 : ($page - 1) * $rp;

        $and = NULL;
        if ($type != NULL && $type != '0') {
            $and.=" AND `idx_sample`.`TYPE`='" . $type . "' ";
        }
        if ($subtype != NULL && $subtype != '0') {
            $and.=" AND `idx_sample`.`SUB_TYPE`='" . $subtype . "' ";
        }
        if ($place != NULL && $place != '0') {
            $and.=" AND `idx_sample`.`PLACE`='" . $place . "' ";
        }
        if ($curr != NULL && $curr != '0') {
            $and.=" AND `idx_sample`.`CURR`='" . $curr . "' ";
        }
        if ($price != NULL && $price != '0') {
            $and.=" AND `idx_sample`.`PRICE`='" . $price . "' ";
        }
//$provider='TOP10_PERFORMANCE';
        if ($provider != NULL && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $provider = str_replace('PROVIDER', '`idx_sample`.`PROVIDER`', $provider);
            if (strpos($provider, 'TOP10_PERFORMANCE') == true) {
                $this->db->where('key', 'PVN');
                $setting = $this->db->get('setting')->row_array();
                if ($setting['value'] == 1) {
                    $provider = "idx_sample.PROVIDER NOT IN ('IFRCRESEARCH', 'PROVINCIAL')";
                } else {
                    $provider = "idx_sample.PROVIDER NOT IN ('IFRCRESEARCH', 'IFRCRESEARCH','PVN')";
                }
                $orderBy = " order by obs_home.varyear desc limit $start,$rp";
            }
            else if (strpos($provider, 'OTHERS') == true) {
                $this->db->where('key', 'PVN');
                $setting = $this->db->get('setting')->row_array();
                if ($setting['value'] == 1) {
                    $provider = "idx_sample.PROVIDER NOT IN ('IFRC','VNX', 'PVN', 'IFRCLAB','IFRCRESEARCH','PROVINCIAL')";
                } else {
                    $provider = "idx_sample.PROVIDER NOT IN ('IFRC','VNX', 'PVN', 'IFRCLAB','IFRCRESEARCH','PROVINCIAL')";
                }
                $orderBy = "ORDER BY idx_ref.ims_order ASC LIMIT $start,$rp";
            }

            else if(strpos($provider, 'IFRCCURRENCY') == true){
                $provider = "idx_sample.PROVIDER = 'IFRCCURRENCY'";
                $orderBy = "ORDER BY idx_ref.ims_order ASC LIMIT $start,$rp";
            }

            else {
                $orderBy = "ORDER BY idx_ref.ims_order ASC LIMIT $start,$rp";
            }
            $and.=" AND ($provider) ";
        }
        if ($search != NULL) {
            $and = " AND (`idx_sample`.`SHORTNAME` LIKE '%" . $search . "%' or `idx_sample`.`CODE` LIKE '%" . $search . "%') AND ($provider) AND idx_ref.publications=1 ";
        }
        /*
        echo $sql = "SELECT `idx_sample`.`SHORTNAME`,
        `idx_sample`.`CODE`,
        `obs_home`.`date`,
        `obs_home`.`id`,
        `obs_home`.`close`,
        `obs_home`.`varmonth`,
        `obs_home`.`varyear`,
        `obs_home`.`volat`
        FROM idx_sample,obs_home
        WHERE `obs_home`.`code`=`idx_sample`.`CODE` and `obs_home`.`close`!='0' and `idx_sample`.`ORD` != '-1' $and
        ORDER BY `idx_sample`.`ORD` DESC,`idx_sample`.`SHORTNAME` ASC limit $start,$rp";

        */

        /*
        $sql = "SELECT `idx_sample`.`SHORTNAME`, `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`volat` ";
        $sql.= "FROM idx_sample,obs_home ";
        $sql.= "WHERE `obs_home`.`code`=`idx_sample`.`CODE` ";
        $sql.= "AND `idx_sample`.`TYPE`='EQUITY' AND `idx_sample`.`code` = COMPO_PARENT ";
        $sql.= "AND ( {$provider} ) ";
        if($subtype != "") $sql.= "AND `idx_sample`.sub_type = '$subtype' ";
        if($search != "") $sql.= "AND (`idx_sample`.`SHORTNAME` LIKE '%" . $search . "%' or `idx_sample`.`CODE` LIKE '%" . $search . "%') ";
        $sql.= "ORDER BY `idx_sample`.`ORD` DESC,`idx_sample`.`ORD` ASC LIMIT $start,$rp ";
        */

        if($type == 'IFRCCURRENCY'){
            $p_currency_type = 'CURRENCY';

        }else{
            $p_currency_type = 'EQUITY';
        }
        $sql = "SELECT upper(`idx_sample`.`SHORTNAME`) as SHORTNAME , `idx_sample`.`CODE`, `obs_home`.`date`, `obs_home`.`id`, `obs_home`.`close`, `obs_home`.`varmonth`, `obs_home`.`varyear`, `obs_home`.`dvar` ";
        $sql.= "FROM idx_sample,obs_home,idx_ref ";
        $sql.= "WHERE `obs_home`.`code`=`idx_sample`.`CODE` and idx_ref.idx_code= `obs_home`.`code` AND `idx_sample`.`TYPE`='$p_currency_type' ";
        $sql.= "AND `idx_sample`.`code` = COMPO_PARENT AND ( {$provider} ) AND idx_ref.publications=1 AND obs_home.date BETWEEN DATE_SUB(NOW(), INTERVAL $home_maxday DAY) AND NOW() ";
//$sql.= "AND `idx_sample`.`code` = COMPO_PARENT AND ( {$provider} ) AND idx_ref.publications=1 AND left(replace(obs_home.date,'-',''),6)=(select max(left(replace(date,'-',''),6)) as yyyymm from obs_home) ";
        if ($subtype != "") {
            $sql.= "AND `idx_sample`.sub_type = '$subtype' ";
        }
        if ($search != "") {
            $sql.= "AND (`idx_sample`.`SHORTNAME` LIKE '%" . $search . "%' or `idx_sample`.`CODE` LIKE '%" . $search . "%') ";
        }
        $sql .= $orderBy;
//echo "<pre>";print_r($sql);exit;
//echo "<pre>";print_r($p_currency_type);exit;
        $data = $this->db->query($sql)->result_array();
//echo "<pre>";print_r($sql);exit;
        return $data;
    }

// /* * *************************************************************************
// * count data table box ifrc indexes trang home theo place và type
// * ************************************************************************ */

    public function countDataTableIFRC($type = NULL, $place = NULL, $curr = NULL, $price = NULL, $provider = NULL, $search = NULL, $subtype = NULL,$home_maxday) {
// $home_maxday = $this->db->query("select value from setting where `group` = 'setting' AND `key` = 'home_maxdays'")->row_array();
// $home_maxdays = $home_maxday['value'];
        $checkTOP10 = false;
        $and = NULL;
        if ($type != NULL && $type != '0') {
            $and.=" AND `idx_sample`.`TYPE`='" . $type . "' ";
        }
        if ($subtype != NULL && $subtype != '0') {
            $and.=" AND `idx_sample`.`SUB_TYPE`='" . $subtype . "' ";
        }
        if ($place != NULL && $place != '0') {
            $and.=" AND `idx_sample`.`PLACE`='" . $place . "' ";
        }
        if ($curr != NULL && $curr != '0') {
            $and.=" AND `idx_sample`.`CURR`='" . $curr . "' ";
        }
        if ($price != NULL && $price != '0') {
            $and.=" AND `idx_sample`.`PRICE`='" . $price . "' ";
        }

        if ($provider != NULL && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $provider = str_replace('PROVIDER', '`idx_sample`.`PROVIDER`', $provider);
            if (strpos($provider, 'TOP10_PERFORMANCE') == true) {
                $this->db->where('key', 'PVN');
                $setting = $this->db->get('setting')->row_array();
                if ($setting['value'] == 1) {
                    $provider = "idx_sample.PROVIDER NOT IN ('IFRCRESEARCH', 'PROVINCIAL')";
                } else {
                    $provider = "idx_sample.PROVIDER NOT IN ('IFRCRESEARCH', 'PROVINCIAL','PVN')";
                }
                $orderBy = "order by obs_home.varyear desc limit 20";
                $checkTOP10 = true;
            }
            else if (strpos($provider, 'OTHERS') == true) {
                $this->db->where('key', 'PVN');
                $setting = $this->db->get('setting')->row_array();
                if ($setting['value'] == 1) {
                    $provider = "idx_sample.PROVIDER NOT IN ('IFRC','VNX', 'PVN', 'IFRCLAB','IFRCRESEARCH','PROVINCIAL')";
                } else {
                    $provider = "idx_sample.PROVIDER NOT IN ('IFRC','VNX', 'PVN', 'IFRCLAB','IFRCRESEARCH','PROVINCIAL')";
                }
//$orderBy = "ORDER BY idx_ref.ims_order ASC";
                $checkTOP10 = false;
            }

            else if(strpos($provider, 'IFRCCURRENCY') == true){
                $provider = "idx_sample.PROVIDER = 'IFRCCURRENCY'";
//$orderBy = "ORDER BY idx_ref.ims_order ASC";
            }

            else {
// $orderBy = "ORDER BY idx_ref.ims_order ASC";
            }
            $and.=" AND ($provider) ";
        }
        if ($search != NULL) {
            $and = " AND (`idx_sample`.`SHORTNAME` LIKE '%" . $search . "%' or `idx_sample`.`CODE` LIKE '%" . $search . "%') AND ($provider) ";
        }

        if($type == 'IFRCCURRENCY'){
            $p_currency_type = 'CURRENCY';

        }else{
            $p_currency_type = 'EQUITY';
        }
        $sql = "SELECT count(`obs_home`.`code`) as count ";
        $sql.= "FROM idx_sample,obs_home,idx_ref ";
        $sql.= "WHERE `obs_home`.`code`=`idx_sample`.`CODE` and idx_ref.idx_code= `obs_home`.`code` AND `idx_sample`.`TYPE`='$p_currency_type' ";
        $sql.= "AND `idx_sample`.`code` = COMPO_PARENT AND `obs_home`.`code`<>'PVN05PRVND' AND ( {$provider} ) AND obs_home.date BETWEEN DATE_SUB(NOW(), INTERVAL $home_maxday DAY) AND NOW() ";

        if ($subtype != "") {
            $sql.= "AND `idx_sample`.sub_type = '$subtype' ";
        }
        if ($search != "") {
            $sql.= "AND (`idx_sample`.`SHORTNAME` LIKE '%" . $search . "%' or `idx_sample`.`CODE` LIKE '%" . $search . "%') ";
        }
//$sql.= $orderBy;
//echo "<pre>";print_r($sql);exit;
        $data = $this->db->query($sql)->row_array();
        if ($checkTOP10 == true) {
            $data['count'] = $data['count'] > 50 ? 50 : $data['count'];
        }

        return $data;
    }

    /*     * *************************************************************************
     * lấy ra name ở table idx_sample
     * ************************************************************************ */

    public function getName() {
        $sql = "select DISTINCT NAME,CODE from idx_sample ORDER BY NAME ASC";
        $place = $this->db->query($sql)->result_array();
        foreach ($place as $vplace) {
            $temp[] = $vplace['NAME'];
        }
        return $temp;
    }

    /*     * *************************************************************************
     * lấy ra short name ở table idx_sample
     * ************************************************************************ */

    public function getSName($vnx = false) {
        $where = "";
        if ($vnx == true) {
            $where .= "AND LEFT(CODE, 3) LIKE '%VNX%' AND CODE IN (SELECT idx_code FROM idx_ref WHERE idx_code = idx_mother)";
        }
        $sql = "SELECT DISTINCT SHORTNAME
				from idx_sample
				WHERE 1
				{$where} AND VNXI = 1
				AND PLACE = 'Vietnam'
				ORDER BY NAME ASC";
        //echo "<pre>";print_r($sql);exit;
        $place = $this->db->query($sql)->result_array();
        foreach ($place as $vplace) {
            $temp[] = $vplace['SHORTNAME'];
        }
        return $temp;
    }

    /*     * *************************************************************************
     * lấy ra name2 ở table idx_sample
     * ************************************************************************ */

    public function getName2($vnx = false) {
        $where = "";
        if ($vnx == true) {
            $where .= "AND LEFT(CODE, 3) LIKE '%VNX%'";
        }
        $sql = "SELECT DISTINCT NAME, CODE
				FROM idx_sample
				WHERE 1
				{$where} AND VNXI = 1
				ORDER BY NAME ASC";
        return $this->db->query($sql)->result_array();
    }

    /*     * *************************************************************************
     * lấy ra name ở table idx_sample
     * ************************************************************************ */

    public function getObservatory() {
        $sql = "select * from idx_sample ORDER BY WEIGHT DESC,NAME DESC";
        $place = $this->db->query($sql)->result_array();
        return $place;
    }

    /*     * *************************************************************************
     * lấy ra data table box ifrc indexes trang home theo place và type
     * ************************************************************************ */

    public function getDataTableSample(
    $type = NULL, $code = NULL, $provider = NULL, $coverage = NULL, $currency = NULL, $name = NULL, $q_search = NULL, $price = NULL, $page = 1, $rp = 10) {
        $start = isset($start) && $start == 1 ? 0 : ($page - 1) * $rp;
        $and = NULL;
        if ($type != NULL && $type != '0') {
            $and.=" AND idx_sample.TYPE='" . $type . "' ";
        }
        if ($code != NULL && $code != '0') {
            $and.=" AND idx_sample.SUB_TYPE='" . $code . "' ";
        }
        if ($provider != NULL && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $and.=" AND idx_sample.PROVIDER='" . $provider . "' ";
        }
        if ($coverage != NULL && $coverage != '0') {
            $and.=" AND idx_sample.PLACE='" . $coverage . "' ";
        }
        if ($currency != NULL && $currency != '0') {
            $and.=" AND idx_sample.CURR='" . $currency . "' ";
        }
        if ($price != NULL && $price != '0') {
            $and.=" AND idx_sample.PRICE='" . $price . "' ";
        }
        if ($name != NULL && $name != '0') {
            $and.=" AND idx_sample.SHORTNAME='" . $name . "' ";
        }
        if ($type == '0' && $code == '0' && $price == '0' && $provider == '0' && $coverage == '0' && $currency == '0' && $name == '0') {
            if ($q_search != NULL && $q_search != '0' && $q_search != 'undefined') {
                $and = " AND idx_sample.SHORTNAME LIKE '%" . $q_search . "%' OR idx_sample.CODE LIKE '%" . $q_search . "%' ";
            } else {
                $and = NULL;
            }
        }
        $sql = "select *
                    from (select idx_sample.* from (select * from idx_sample 
                    where PLACE='Vietnam' and vnxi=1)as idx_sample INNER JOIN (select * from idx_ref ORDER BY ims_order ASC)as b 
                    where 1=1 and idx_sample.SUB_TYPE ='BlueChips' and idx_sample.code=b.idx_code {$and} group by idx_sample.code ORDER BY ims_order ASC) as a
                UNION
                select *
                    from (select idx_sample.* from (select * from idx_sample 
                    where PLACE='Vietnam' and vnxi=1)as idx_sample INNER JOIN (select * from idx_ref ORDER BY ims_order ASC)as b 
                    where 1=1 and idx_sample.SUB_TYPE <>'BlueChips' and idx_sample.code=b.idx_code {$and} group by idx_sample.code
                    ORDER BY ims_order ASC) as b
				LIMIT {$start}, {$rp};";
        //echo $sql;
		//echo "<pre>";print_r($sql);exit;
        return $this->db->query($sql)->result_array();
    }

    /*     * *************************************************************************
     * count data table box ifrc indexes trang home theo place và type
     * ************************************************************************ */

    public function countDataTableSample(
    $type = NULL, $code = NULL, $provider = NULL, $coverage = NULL, $currency = NULL, $name = NULL, $q_search = NULL, $price = NULL) {
        $and = NULL;
        if ($type != NULL && $type != '0') {
            $and.=" AND TYPE='" . $type . "' ";
        }
        if ($code != NULL && $code != '0') {
            $and.=" AND SUB_TYPE='" . $code . "' ";
        }
        if ($provider != NULL && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $and.=" AND PROVIDER='" . $provider . "' ";
        }
        if ($coverage != NULL && $coverage != '0') {
            $and.=" AND PLACE='" . $coverage . "' ";
        }
        if ($currency != NULL && $currency != '0') {
            $and.=" AND CURR='" . $currency . "' ";
        }
        if ($price != NULL && $price != '0') {
            $and.=" AND PRICE='" . $price . "' ";
        }
        if ($name != NULL && $name != '0') {
            $and.=" AND SHORTNAME='" . $name . "' ";
        }
        if ($type == '0' && $code == '0' && $price == '0' && $provider == '0' && $coverage == '0' && $currency == '0' && $name == '0') {
            if ($q_search != NULL && $q_search != '0' && $q_search != 'undefined') {
                $and = " AND SHORTNAME LIKE '%" . $q_search . "%' OR CODE LIKE '%" . $q_search . "%' ";
            } else {
                $and = NULL;
            }
        }
        $sql = "select count(`CODE`) as count from idx_sample where 1 AND PLACE = 'Vietnam' $and AND VNXI = 1 ORDER BY ORD DESC,SHORTNAME ASC ";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    /*     * *************************************************************************
     * count data table box ifrc vnx trang home theo place và type
     * ************************************************************************ */

    public function countDataTableSampleVnx(
    $type = NULL, $code = NULL, $provider = NULL, $coverage = NULL, $currency = NULL, $name = NULL, $q_search = NULL, $price = NULL) {
        $and = NULL;
        if ($type != NULL && $type != '0') {
            $and.=" AND idx_sample.TYPE='" . $type . "' ";
        }
        if ($code != NULL && $code != '0') {
            $and.=" AND idx_sample.SUB_TYPE='" . $code . "' ";
        }
        if ($provider != NULL && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $and.=" AND idx_sample.PROVIDER='" . $provider . "' ";
        }
        if ($coverage != NULL && $coverage != '0') {
            $and.=" AND idx_sample.PLACE='" . $coverage . "' ";
        }
        if ($currency != NULL && $currency != '0') {
            $and.=" AND idx_sample.CURR='" . $currency . "' ";
        }
        if ($price != NULL && $price != '0') {
            $and.=" AND idx_sample.PRICE='" . $price . "' ";
        }
        if ($name != NULL && $name != '0') {
            $and.=" AND idx_sample.SHORTNAME='" . $name . "' ";
        }
        if ($type == '0' && $code == '0' && $price == '0' && $provider == '0' && $coverage == '0' && $currency == '0' && $name == '0') {
            if ($q_search != NULL && $q_search != '0' && $q_search != 'undefined') {
                $and = " AND idx_sample.SHORTNAME LIKE '%" . $q_search . "%' OR idx_sample.CODE LIKE '%" . $q_search . "%' ";
            } else {
                $and = NULL;
            }
        }
        $sql = "SELECT COUNT(idx_sample.CODE) AS count
				FROM idx_sample, idx_ref
				WHERE 1
				{$and}
				AND LEFT(idx_sample.CODE, 3) LIKE '%VNX%'
				AND idx_sample.CODE = idx_ref.idx_code
				-- AND idx_ref.idx_code = idx_ref.idx_mother
				ORDER BY idx_sample.ORD DESC, idx_sample.SHORTNAME ASC ";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    /* get idx sample perf screener page */

    public function getIdxSample(
    $type = NULL, $code = NULL, $provider = NULL, $coverage = NULL, $currency = NULL, $name = NULL, $q_search = NULL, $price = NULL) {
        $and = NULL;
        if ($type != NULL && $type != '0') {
            $and.=" AND TYPE='" . $type . "' ";
        }
        if ($code != NULL && $code != '0') {
            $and.=" AND SUB_TYPE='" . $code . "' ";
        }
        if ($provider != NULL && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $and.=" AND PROVIDER='" . $provider . "' ";
        }
        if ($coverage != NULL && $coverage != '0') {
            $and.=" AND PLACE='" . $coverage . "' ";
        }
        if ($currency != NULL && $currency != '0') {
            $and.=" AND CURR='" . $currency . "' ";
        }
        if ($price != NULL && $price != '0') {
            $and.=" AND PRICE='" . $price . "' ";
        }
        if ($name != NULL && $name != '0') {
            $and.=" AND SHORTNAME='" . $name . "' ";
        }
        if ($type == '0' && $code == '0' && $price == '0' && $provider == '0' && $coverage == '0' && $currency == '0' && $name == '0') {
            if ($q_search != NULL && $q_search != '0') {
                $and = " AND SHORTNAME LIKE '%" . $q_search . "%' OR CODE LIKE '%" . $q_search . "%' ";
            } else {
                $and = NULL;
            }
        }
        $sql = "select TYPE,SUB_TYPE,PROVIDER,PLACE,PRICE,CURR,SHORTNAME,HISTORY,CODE from idx_sample where 1 $and ORDER BY ORD DESC,SHORTNAME ASC";
//	echo '<!--';
//	echo $sql;
//	echo '-->';
        return $this->db->query($sql)->result_array();
    }

    /* get idx sample perf screener page */

    public function getSelectionCode() {
        $codeArrCookie = explode(',', $_COOKIE['codeJsonCookie']);
        $codeJsonCookie = implode('","', $codeArrCookie);
        $sql = 'select TYPE,SUB_TYPE,PROVIDER,PLACE,PRICE,CURR,SHORTNAME,HISTORY,CODE from idx_sample where CODE IN ("' . $codeJsonCookie . '") ORDER BY ORD DESC,SHORTNAME ASC';

//	echo '<!--';
//	echo $sql;
//	echo '-->';
        return $this->db->query($sql)->result_array();
    }

    public function listCode() {
        $sql = 'SELECT DISTINCT code FROM perf_data pd ORDER BY code ASC';
        return $this->db->query($sql)->result_array();
    }

    public function listName() {
        $sql = 'SELECT b.shortname FROM perf_data a, idx_sample b where a.code = b.code group by a.code';
        return $this->db->query($sql)->result_array();
    }

    public function getUserPerf() {
        $sql = 'SELECT pi.*,admin.user FROM perf_idx pi, admin WHERE (pi.user_id = admin.id) AND ((user_id = 3) OR (publish = 1 AND user_id != 3))';

        return $this->db->query($sql)->result_array();
    }

    public function getPerfData($code) {
        $code = explode(',', $code);
        $code = implode('","', $code);
        $sql = 'SELECT pd.*,isa.SHORTNAME FROM perf_data pd, idx_sample isa WHERE pd.code = isa.CODE AND pd.code IN ("' . $code . '")';
        //echo $sql;
        return $this->db->query($sql)->result_array();
    }

    public function getPerfDataByDate($yyyymm = '') {
        $sql = 'SELECT *,isa.SHORTNAME FROM perf_data pd, idx_sample isa WHERE pd.code = isa.CODE';
        if (is_numeric($yyyymm)) {
            $sql .= "AND pd.yyyymm = '$yyyymm'";
        }
        return $this->db->query($sql)->result_array();
    }

    public function listDate() {
        $sql = 'SELECT yyyymm FROM perf_data pd ORDER BY yyyymm DESC';
        $rows = $this->db->query($sql)->result_array();
        $temp = '';
        foreach ($rows as $key => $row) {
            if ($row['yyyymm'] != '') {
                if ($temp != $row['yyyymm']) {
                    $temp = $row['yyyymm'];
                    continue;
                }
            }
            unset($rows[$key]);
        }
        return $rows;
    }

    public function listDate2($table) {
        $sql = 'SELECT yyyymm FROM ' . $table . ' pd ORDER BY yyyymm DESC';
        $rows = $this->db->query($sql)->result_array();
        $temp;
        foreach ($rows as $key => $row) {
            if ($row['yyyymm'] != '') {
                if ($temp != $row['yyyymm']) {
                    $temp = $row['yyyymm'];
                    continue;
                }
            }
            unset($rows[$key]);
        }
        return $rows;
    }

    /*     * *************************************************************************
     * lấy ra * ở table getDataTableIdx_compo
     * ************************************************************************ */

    public function getDataTableIdx_compo_backup($code, $limit = NULL) {
        // $sql = "select * from idx_compo WHERE CODE='" . $code . "' ORDER BY WEIGHT DESC $limit";
        // mysql_query("set @IDXCODE ='" . $code . "'");
        $sql = "SET @IDXCODE ='{$code}';
        SET @IDXMOTHER =  IF((select idx_mother from idx_ref where idx_code=@IDXCODE)Is NULL,@IDXCODE,
(select idx_mother from idx_ref where idx_code=@IDXCODE))";
        echo "<pre>";print_r($sql);exit;

        $list_query = explode(";", $sql);
        foreach ($list_query as $value) {
            $this->db->query($value);
        }
        //return $this->db->query("select * from idx_compo where code = @IDXMOTHER ORDER BY WEIGHT DESC")->result_array();
        return $this->db->query("select * from (select * from idx_compo where code = @IDXMOTHER) as A
LEFT JOIN (select ticker,eoy,perf from stk_perf order by eoy desc) as B on A.isin=B.ticker and A.date=B.eoy ORDER BY WEIGHT DESC;")->result_array();
    }

    public function getDataTableIdx_compo($code, $limit = NULL) {

        //return $this->db->query("select * from idx_compo where code = @IDXMOTHER ORDER BY WEIGHT DESC")->result_array();
        return $this->db->query("select * from idx_compo_last where code = '$code' ORDER BY WEIGHT DESC;")->result_array();
    }

    /*     * *************************************************************************
     * count ở table getDataTableIdx_compo theo code
     * ************************************************************************ */

    public function countDataTableIdx_compo($code) {
        $sql = "select count(ID) as count from idx_compo WHERE CODE='" . $code . "'";
        $data = $this->db->query($sql)->result_array();
        return $data['0']['count'];
    }

    /*     * *************************************************************************
     * load data o table day theo inter code dung trong trang ob
     * ************************************************************************ */

    public function loadDayOb($code, $date = NULL, $datemax = NULL, $limit = '') {
        $and = NULL;
        $order = 'DESC';
        if ($date != NULL) {
            $and = " AND date BETWEEN '" . $date . "' AND '" . $datemax . "'";
            $order = 'ASC';
        }
        $sql = "select * from efrc_indvn_datas WHERE codeifrc='" . $code . "' $and AND !ISNULL(date) ORDER BY date $order $limit";
		
        return $this->db->query($sql)->result_array();
    }

    public function loadDayObDateBegin($code) {
        $sql = "select date from efrc_indvn_datas WHERE codeifrc='" . $code . "' ORDER BY date ASC limit 1";
        $data = $this->db->query($sql)->row_array();
        if ($data['date']) {
            return $data['date'];
        }
    }

    public function loadMonthObDateBegin($code) {
        $sql = "select date from efrc_indvn_stats WHERE codeifrc='" . $code . "' ORDER BY date ASC limit 1";
        $data = $this->db3->query($sql)->row_array();
        if ($data['date']) {
            return $data['date'];
        }
    }

    public function loadYearObDateBegin($code) {
        $sql = "select date from efrc_indvn_stats WHERE codeifrc='" . $code . "' AND period = 'Y' ORDER BY date ASC limit 1";
        $data = $this->db3->query($sql)->row_array();
        if ($data['date']) {
            return $data['date'];
        }
    }
	
	public function loadQuaterObDateBegin($code) {
        $sql = "select date from efrc_indvn_stats WHERE codeifrc='" . $code . "' AND period = 'Q' ORDER BY date ASC limit 1";
        $data = $this->db3->query($sql)->row_array();
        if ($data['date']) {
            return $data['date'];
        }
    }

    /*     * *************************************************************************
     * load data o table day theo inter code dung trong trang ob count 
     * ************************************************************************ */

    public function loadDayObCount($code, $date = NULL, $datemax = NULL) {
        $and = NULL;
        $order = 'DESC';
        if ($date != NULL) {
            $and = " AND date BETWEEN '" . $date . "' AND '" . $datemax . "'";
            $order = 'ASC';
        }
        $sql = "select count(id) as count from efrc_indvn_datas WHERE codeifrc='" . $code . "' $and ORDER BY date $order limit 1";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    /*     * *************************************************************************
     * load data o table month theo inter code dung trong trang ob
     * ************************************************************************ */

    public function loadMonthOb($code, $date = NULL, $datemax = NULL, $fulldate = NULL, $limit = '') {
		
        $and = NULL;
        $order = 'DESC';
		//echo "<pre>";print_r($date);exit;
        if ($date != NULL) {
           // $and = " AND CONCAT(YEAR(DATE),'-',MONTH(DATE)) BETWEEN '" . $date . "' AND '" . $datemax . "'";
			$and = " AND date BETWEEN '" . $date . "' AND '" . $datemax . "'";
            if ($fulldate != NULL) {
                $and .= " AND date >= '" . $fulldate . "'";
            }
            $order = 'ASC';
        }
        $sql = "select id,date,adjclose,volat1y,beta1y,rt from efrc_indvn_stats WHERE period = 'M' AND codeifrc='" . $code . "' $and 
        AND !ISNULL(date) ORDER BY date $order $limit";
		//echo "<pre>";print_r($sql);exit;
        $data = $this->db3->query($sql)->result_array();
		
        return $data;
    }

    public function loadMonthObCount($code, $date = NULL, $datemax = NULL) {
        $and = NULL;
        $order = 'DESC';
        if ($date != NULL) {
            $and = " AND date BETWEEN '" . $date . "' AND '" . $datemax . "'";
            $order = 'ASC';
        }
        $sql = "select count(id) as count from efrc_indvn_stats WHERE period = 'M' AND codeifrc='" . $code . "' $and 
        ORDER BY date $order limit 1";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    /*     * *************************************************************************
     * load data o table day theo inter code dung trong trang ob
     * ************************************************************************ */

    public function loadYearOb($code, $date = NULL, $datemax = NULL, $limit = '') {
        $and = NULL;

        $order = 'DESC';
        if ($date != NULL) {
            $and = " AND YEAR(date) BETWEEN '" . $date . "' AND '" . $datemax . "'";
            $order = 'ASC';
        }
        $sql = "select * from efrc_indvn_stats WHERE codeifrc='" . $code . "' $and AND period = 'Y' AND !ISNULL(DATE) ORDER BY date $order $limit";
        return $this->db3->query($sql)->result_array();
    }
	
	public function loadQuaterOb($code, $date = NULL, $datemax = NULL, $limit = '') {
        $and = NULL;

        $order = 'DESC';
        if ($date != NULL) {
            $and = " AND YEAR(date) BETWEEN '" . $date . "' AND '" . $datemax . "'";
            $order = 'ASC';
        }
        $sql = "select * from efrc_indvn_stats WHERE codeifrc='" . $code . "' $and AND period = 'Q' AND !ISNULL(DATE) ORDER BY date $order $limit";
        return $this->db3->query($sql)->result_array();
    }

    public function loadYearObCount($code, $date = NULL, $datemax = NULL) {
        $and = NULL;
        $order = 'DESC';
        if ($date != NULL) {
            $and = " AND date BETWEEN '" . $date . "' AND '" . $datemax . "'";
            $order = 'ASC';
        }
        $sql = "select count(id) as count from efrc_indvn_stats WHERE codeifrc='" . $code . "' AND period='Y' $and ORDER BY date $order limit 1";
        //echo $sql;
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }
	public function loadQuaterObCount($code, $date = NULL, $datemax = NULL) {
        $and = NULL;
        $order = 'DESC';
        if ($date != NULL) {
            $and = " AND date BETWEEN '" . $date . "' AND '" . $datemax . "'";
            $order = 'ASC';
        }
        $sql = "select count(id) as count from efrc_indvn_stats WHERE codeifrc='" . $code . "' AND period='Q' $and ORDER BY date $order limit 1";
        //echo $sql;
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    /*     * *************************************************************************
     * lấy ra name theo code
     * ************************************************************************ */

    public function getNameCode($code) {
        $sql = "select NAME,SHORTNAME from idx_sample WHERE CODE='" . $code . "' LIMIT 1";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    /*     * *************************************************************************
     * lấy ra rule
     * ************************************************************************ */

    public function loadRulesOb($code) {
        $sql = "select * from idx_rulesdef WHERE 1 order by FIELD";
        $data = $this->db->query($sql)->row_array();
        foreach ($data as $k => $v) {
            $sql = "select " . $v['FIELD'] . " from idx_rules WHERE CODE='" . $code . "' LIMIT 1";
            $va = $this->db->query($sql)->row_array();
            $temp[$k]['name'] = $v['DESCRIPTION'];
            $temp[$k]['value'] = $va[$v['FIELD']];
        }
        return $temp;
    }

    public function loadRulesOb_sample($code) {
        $sql = "select * from idx_sample WHERE CODE ='" . $code . "' LIMIT 1";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    /*     * *************************************************************************
     * lấy ra public theo code
     * ************************************************************************ */

    public function getPublic($code) {
        $sql = "select *  from idx_publication WHERE CODE = '" . $code . "' or  `GROUP` IN (select GROUP_CODE from idx_group where CODE = '" . $code . "') ";

        return $this->db->query($sql)->result_array();
    }

    /* =====================================================================================
     * min month
     * ==================================================================================== */

    public function LoadMinMonth($code, $date = NULL) {
        $and = NULL;

        if ($date != NULL) {
            $and = " AND date >='" . $date . "'";
        }
        $sql = "select adjclose as min2 from efrc_indvn_stats WHERE period = 'M' AND codeifrc='" . $code . "' $and ORDER BY adjclose ASC limit 1";
        //echo $sql.'<br/>';
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    /* =====================================================================================
     * max monthchart-rank
     * ==================================================================================== */

    public function LoadMaxMonth($code, $date = NULL) {
        $and = NULL;
        if ($date != NULL) {
            $and = " AND date >='" . $date . "'";
        }
        $sql = "select adjclose as max from efrc_indvn_stats WHERE period = 'M' AND codeifrc='" . $code . "' $and ORDER BY adjclose DESC LIMIT 1";
        $temp = $this->db3->query($sql)->row_array();
        return isset($temp['max']) ? $temp['max'] : true;
    }

    /* =====================================================================================
     * min year
     * ==================================================================================== */

    public function LoadMinYear($code, $date = NULL) {
        $and = NULL;
        if ($date != NULL) {
            $and = " AND date >='" . $date . "'";
        }
        $sql = "select adjclose as min2 from efrc_indvn_stats WHERE codeifrc='" . $code . "' $and AND period = 'Y' ORDER BY adjclose ASC limit 1";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }
	
	public function LoadMinQuater($code, $date = NULL) {
        $and = NULL;
        if ($date != NULL) {
            $and = " AND date >='" . $date . "'";
        }
        $sql = "select adjclose as min2 from efrc_indvn_stats WHERE codeifrc='" . $code . "' $and AND period = 'Q' ORDER BY adjclose ASC limit 1";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    /* =====================================================================================
     * max year
     * ==================================================================================== */

    public function LoadMaxYear($code, $date = NULL) {
        $and = NULL;
        if ($date != NULL) {
            $and = " AND date >='" . $date . "'";
        }
        $sql = "select adjclose as max from efrc_indvn_stats WHERE code='" . $code . "' $and AND period = 'Y'  ORDER BY adjclose DESC LIMIT 1";
        $temp = $this->db3->query($sql)->row_array();
        return isset($temp['max']) ? $temp['max'] : true;
    }
	
	 public function LoadMaxQuater($code, $date = NULL) {
        $and = NULL;
        if ($date != NULL) {
            $and = " AND date >='" . $date . "'";
        }
        $sql = "select adjclose as max from efrc_indvn_stats WHERE code='" . $code . "' $and AND period = 'Q'  ORDER BY adjclose DESC LIMIT 1";
        $temp = $this->db3->query($sql)->row_array();
        return isset($temp['max']) ? $temp['max'] : true;
    }

    /* =====================================================================================
     * min day
     * ==================================================================================== */

    public function LoadMinDay($code, $date = NULL) {
        $and = NULL;
        if ($date != NULL) {
            $and = " AND date >='" . $date . "'";
        }
        $sql = "select close as min2 from efrc_indvn_datas WHERE codeifrc='" . $code . "' $and ORDER BY close ASC limit 1";
		//echo "<pre>";print_r($sql);exit; 
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    /* =====================================================================================
     * max day
     * ==================================================================================== */

    public function LoadMaxDay($code, $date = NULL) {
        $and = NULL;
        if ($date != NULL) {
            $and = " AND date >='" . $date . "'";
        }
        $sql = "select close as max from efrc_indvn_datas WHERE codeifrc='" . $code . "' $and ORDER BY close DESC LIMIT 1";
        $temp = $this->db->query($sql)->row_array();
        return isset($temp['max']) ? $temp['max'] : true;
    }

    /* =====================================================================================
     * get date thấp nhất của  code
     * ==================================================================================== */

    public function getdate($table, $code, $order) {
        $sql = "select date from $table WHERE codeifrc='" . $code . "' ORDER BY date $order limit 1";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    public function getdateIDXday($table, $code, $order) {
        $sql = "select date from $table WHERE codeifrc='" . $code . "' ORDER BY date $order limit 1";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    public function getCodeByName($name) {
        $sql = 'select DISTINCT CODE from idx_sample WHERE SHORTNAME = "' . $name . '"';

        $a = $this->db->query($sql)->row_array();
        if ($a) {
            return $a['CODE'];
        }
        return FALSE;
    }

    /****************************************************************************
     * lấy ra data table box ifrc indexes vnx trang home theo place và type
     * ************************************************************************ */

    public function getDataTableSampleVnx(
    $type = NULL, $code = NULL, $provider = NULL, $coverage = NULL, $currency = NULL, $name = NULL, $q_search = NULL, $price = NULL, $page = 1, $rp = 10) {
        $start = $start == 1 ? 0 : ($page - 1) * $rp;
        $and = NULL;
        if ($type != NULL && $type != '0') {
            $and.=" AND idx_sample.TYPE='" . $type . "' ";
        }
        if ($code != NULL && $code != '0') {
            $and.=" AND idx_sample.SUB_TYPE='" . $code . "' ";
        }
        if ($provider != NULL && $provider != '0') {
            $provider = str_replace('\\', '', $provider);
            $and.=" AND idx_sample.PROVIDER='" . $provider . "' ";
        }
        if ($coverage != NULL && $coverage != '0') {
            $and.=" AND idx_sample.PLACE='" . $coverage . "' ";
        }
        if ($currency != NULL && $currency != '0') {
            $and.=" AND idx_sample.CURR='" . $currency . "' ";
        }
        if ($price != NULL && $price != '0') {
            $and.=" AND idx_sample.PRICE='" . $price . "' ";
        }
        if ($name != NULL && $name != '0') {
            $and.=" AND idx_sample.SHORTNAME='" . $name . "' ";
        }
        if ($type == '0' && $code == '0' && $price == '0' && $provider == '0' && $coverage == '0' && $currency == '0' && $name == '0') {
            if ($q_search != NULL && $q_search != '0' && $q_search != 'undefined') {
                $and = " AND idx_sample.SHORTNAME LIKE '%" . $q_search . "%' OR idx_sample.CODE LIKE '%" . $q_search . "%' ";
            } else {
                $and = NULL;
            }
        }
        $sql = "SELECT idx_sample.*
				FROM idx_sample, idx_ref
				WHERE 1
				{$and}
				AND SUBSTR(`CODE` FROM 1 FOR 3) = 'VNX'
				AND idx_ref.idx_code = idx_sample.CODE
				-- AND idx_ref.mother = 1
                                GROUP BY idx_sample.CODE
				ORDER BY idx_ref.ims_order ASC
				LIMIT {$start}, {$rp};";
        //echo $sql;
        return $this->db->query($sql)->result_array();
    }

    public function getTotalIndex() {
        $sql = "SELECT COUNT(DISTINCT code) as count from idx_sample where provider = 'IFRC' and place = 'VietNam' and ord <> -1 AND VNXI = 1";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    public function getNameSelectHome() {
        $sql = "SELECT DISTINCT(a.shortname), a.code from idx_sample a, idx_month b where a.code = b.code and a.provider = 'IFRC' and a.place = 'Vietnam'";
        return $this->db->query($sql)->result_array();
    }

    public function getIndex() {
        $sql = "SELECT shortname from idx_sample GROUP BY shortname";
        return $this->db->query($sql)->result_array();
    }

    public function getIndex_compare() {
        $sql = "SELECT shortname from idx_sample 
        where VNXI=1 and TYPE='equity' and code in(select DISTINCT codeifrc from efrc_indvn_stats) GROUP BY SHORTNAME";
        return $this->db3->query($sql)->result_array();
    }

    /*     * *************************************************************************
     * load data o table month theo inter code dung trong trang ob
     * ************************************************************************ */

    public function loadMonthCompare($code_from, $code_to) {
        $sql = 'SELECT a.id, DATE_FORMAT(a.date,"%Y/%m") as date, a.perform as index_1, b.perform as index_2, (a.perform - b.perform) as total from
(select id, date, perform from efrc_indvn_stats WHERE period = "M" AND codeifrc="' . $code_from . '" AND LENGTH(perform)!=0) a,
(select id, date, perform from efrc_indvn_stats WHERE period = "M" AND codeifrc="' . $code_to . '" AND LENGTH(perform)!=0) b
where CONCAT(YEAR(a.date),"/",MONTH(a.date)) = CONCAT(YEAR(b.date),"/",MONTH(b.date)) order by a.date desc';
        return $this->db3->query($sql)->result_array();
    }

    public function loadMonthCompareChart($code_from, $code_to) {
        $sql = 'SELECT a.id, a.date, a.adjclose as index_1, b.adjclose as index_2, (a.adjclose - b.adjclose) as total from
(select id, date, close from efrc_indvn_stats WHERE codeifrc="' . $code_from . '" AND LENGTH(perform)!=0) a,
(select id, date, close from efrc_indvn_stats WHERE codeifrc="' . $code_to . '" AND LENGTH(perform)!=0) b
where CONCAT(YEAR(a.date),"/",MONTH(a.date)) = CONCAT(YEAR(b.date),"/",MONTH(b.date)) order by a.date asc';
        return $this->db3->query($sql)->result_array();
    }

    public function loadMonthCompareCount($code_from, $code_to) {
        $sql = 'SELECT count(a.id) as count from
(select id, date, perform from efrc_indvn_stats WHERE period = "M" AND codeifrc="' . $code_from . '" AND LENGTH(perform)!=0) a,
(select id, date, perform from efrc_indvn_stats  WHERE period = "M" AND codeifrc="' . $code_to . '" AND LENGTH(perform)!=0) b
where CONCAT(YEAR(a.date),"/",MONTH(a.date)) = CONCAT(YEAR(b.date),"/",MONTH(b.date)) order by a.date desc';
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    /*     * *************************************************************************
     * load data o table day theo inter code dung trong trang ob
     * ************************************************************************ */

    public function loadYearCompare($code_from, $code_to) {
        $sql = 'SELECT a.id, YEAR(a.date) as date, a.perform as index_1, b.perform as index_2, (a.perform - b.perform) as total from
(select id, date, perform from efrc_indvn_stats WHERE codeifrc="' . $code_from . '" AND period = "Y" AND LENGTH(perform)!=0) a,
(select id, date, perform from efrc_indvn_stats WHERE codeifrc="' . $code_to . '" AND period = "Y" AND LENGTH(perform)!=0) b
where YEAR(a.date) = YEAR(b.date) order by a.date desc';
        return $this->db3->query($sql)->result_array();
    }
	
	public function loadQuaterCompare($code_from, $code_to) {
        $sql = 'SELECT a.id, YEAR(a.date) as date, a.perform as index_1, b.perform as index_2, (a.perform - b.perform) as total from
(select id, date, perform from efrc_indvn_stats WHERE codeifrc="' . $code_from . '" AND period = "Q" AND LENGTH(perform)!=0) a,
(select id, date, perform from efrc_indvn_stats WHERE codeifrc="' . $code_to . '" AND period = "Q" AND LENGTH(perform)!=0) b
where YEAR(a.date) = YEAR(b.date) order by a.date desc';
        return $this->db3->query($sql)->result_array();
    }

    public function loadYearCompareChart($code_from, $code_to) {
        $sql = 'SELECT a.id, a.date, a.adjclose as index_1, b.adjclose as index_2, (a.adjclose - b.adjclose) as total from
(select id, date, adjclose from efrc_indvn_stats WHERE codeifrc="' . $code_from . '" AND period = "Y" AND LENGTH(perform)!=0) a,
(select id, date, adjclose from efrc_indvn_stats WHERE codeifrc="' . $code_to . '" AND period = "Y" AND LENGTH(perform)!=0) b
where YEAR(a.date) = YEAR(b.date) order by a.date asc';
        return $this->db3->query($sql)->result_array();
    }
	
	 public function loadQuaterCompareChart($code_from, $code_to) {
        $sql = 'SELECT a.id, a.date, a.adjclose as index_1, b.adjclose as index_2, (a.adjclose - b.adjclose) as total from
(select id, date, adjclose from efrc_indvn_stats WHERE codeifrc="' . $code_from . '" AND period = "Q" AND LENGTH(perform)!=0) a,
(select id, date, adjclose from efrc_indvn_stats WHERE codeifrc="' . $code_to . '" AND period = "Q" AND LENGTH(perform)!=0) b
where YEAR(a.date) = YEAR(b.date) order by a.date asc';
        return $this->db3->query($sql)->result_array();
    }

    public function loadYearCompareCount($code_from, $code_to) {
        $sql = 'SELECT count(a.id) as count from
(select id, date, perform from efrc_indvn_stats WHERE codeifrc="' . $code_from . '" AND period = "Y" AND LENGTH(perform)!=0) a,
(select id, date, perform from efrc_indvn_stats WHERE codeifrc="' . $code_to . '" AND period = "Y" AND LENGTH(perform)!=0) b
where YEAR(a.date) = YEAR(b.date) order by a.date desc';
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }
	
	public function loadQuaterCompareCount($code_from, $code_to) {
        $sql = 'SELECT count(a.id) as count from
(select id, date, perform from efrc_indvn_stats WHERE codeifrc="' . $code_from . '" AND period = "Q" AND LENGTH(perform)!=0) a,
(select id, date, perform from efrc_indvn_stats WHERE codeifrc="' . $code_to . '" AND period = "Q" AND LENGTH(perform)!=0) b
where YEAR(a.date) = YEAR(b.date) order by a.date desc';
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    /*     * *************************************************************************
     * lấy ra name theo code
     * ************************************************************************ */

    public function getNameCodeCompare($code_from, $code_to) {
        $sql = 'SELECT a.name as name_from, a.shortname as shortname_from, b.name as name_to, b.shortname as shortname_to from
(select name, shortname from idx_sample WHERE CODE="' . $code_from . '") a,
(select name, shortname from idx_sample WHERE CODE="' . $code_to . '") b';
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

    public function loadMonthCompareDateBegin($code_from, $code_to) {

        $sql = "SELECT if(a.date > b.date, a.date, b.date) as date FROM 
(SELECT MIN(date) as date FROM efrc_indvn_stats WHERE period = 'M' AND ifrccode = '" . $code_from . "') a,
(SELECT MIN(date) as date FROM efrc_indvn_stats WHERE period = 'M' AND ifrccode = '" . $code_to . "') b";

        $data = $this->db3->query($sql)->row_array();
        if ($data['date']) {
            return $data['date'];
        }
    }

    public function loadYearCompareDateBegin($code_from, $code_to) {

        $sql = "SELECT if(a.date > b.date, a.date, b.date) as date FROM 
(SELECT MIN(date) as date FROM efrc_indvn_stats WHERE period = 'Y' AND codeifrc = '" . $code_from . "') a,
(SELECT MIN(date) as date FROM efrc_indvn_stats WHERE period = 'Y' AND codeifrc = '" . $code_to . "') b";

        $data = $this->db3->query($sql)->row_array();
        if ($data['date']) {
            return $data['date'];
        }
    }
	
	 public function loadQuaterCompareDateBegin($code_from, $code_to) {

        $sql = "SELECT if(a.date > b.date, a.date, b.date) as date FROM 
(SELECT MIN(date) as date FROM efrc_indvn_stats WHERE period = 'Q' AND codeifrc = '" . $code_from . "') a,
(SELECT MIN(date) as date FROM efrc_indvn_stats WHERE period = 'Q' AND codeifrc = '" . $code_to . "') b";

        $data = $this->db3->query($sql)->row_array();
        if ($data['date']) {
            return $data['date'];
        }
    }
	
	

    public function LoadMinMonthCompareChart($code_from, $code_to, $date) {
        $sql = "SELECT if(a.adjclose >= b.adjclose, b.adjclose, a.adjclose) as min FROM 
(SELECT MIN(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Q' AND codeifrc = '" . $code_from . "' AND date >= '" . $date . "') a,
(SELECT MIN(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Q' AND codeifrc = '" . $code_to . "' AND date >= '" . $date . "') b";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    public function LoadMaxMonthCompareChart($code_from, $code_to, $date) {
        $sql = "SELECT if(a.adjclose >= b.adjclose, b.adjclose, a.adjclose) as min FROM 
(SELECT MAX(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'M' AND  codeifrc = '" . $code_from . "' AND date >= '" . $date . "') a,
(SELECT MAX(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'M' AND codeifrc = '" . $code_to . "' AND date >= '" . $date . "') b";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    public function LoadMinYearCompareChart($code_from, $code_to, $date) {
        $sql = "SELECT if(a.adjclose >= b.adjclose, b.adjclose, a.adjclose) as min FROM 
(SELECT MIN(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Y' AND codeifrc = '" . $code_from . "' AND date >= '" . $date . "') a,
(SELECT MIN(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Y' AND codeifrc = '" . $code_to . "' AND date >= '" . $date . "') b";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }
	
	public function LoadMinQuaterCompareChart($code_from, $code_to, $date) {
        $sql = "SELECT if(a.adjclose >= b.adjclose, b.adjclose, a.adjclose) as min FROM 
(SELECT MIN(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Q' AND codeifrc = '" . $code_from . "' AND date >= '" . $date . "') a,
(SELECT MIN(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Q' AND codeifrc = '" . $code_to . "' AND date >= '" . $date . "') b";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    public function LoadMaxYearCompareChart($code_from, $code_to, $date) {
        $sql = "SELECT if(a.adjclose >= b.adjclose, b.adjclose, a.adjclose) as min FROM 
(SELECT MAX(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Y' AND codeifrc = '" . $code_from . "' AND date >= '" . $date . "') a,
(SELECT MAX(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Y' AND codeifrc = '" . $code_to . "' AND date >= '" . $date . "') b";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }
	
	public function LoadMaxQuaterCompareChart($code_from, $code_to, $date) {
        $sql = "SELECT if(a.adjclose >= b.adjclose, b.adjclose, a.adjclose) as min FROM 
(SELECT MAX(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Q' AND codeifrc = '" . $code_from . "' AND date >= '" . $date . "') a,
(SELECT MAX(adjclose) as adjclose FROM efrc_indvn_stats WHERE period = 'Q' AND codeifrc = '" . $code_to . "' AND date >= '" . $date . "') b";
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    /*     * *************************************************************************
     * load data o table month theo inter code dung trong trang compare multi
     * ************************************************************************ */

    public function loadMonthCompareMulti($data) {
        $arr_data = explode(',', $data);
        $total_array = count($arr_data);
        $data_date = array();
        foreach ($arr_data as $data_item) {
            $arr_item = explode(' - ', $data_item);
            $sql = 'select MIN(date) as min, MAX(date) as max from efrc_indvn_stats WHERE period = "M" AND codeifrc="' . $arr_item[0] . '"';
            $data_sql = $this->db3->query($sql)->row_array();
            if ($data_sql['min'] != '' && $data_sql['max'] != '') {
                $data_date[] = $data_sql['min'];
                $data_date[] = $data_sql['max'];
            }
        }
        $data_final = $this->getAllMonths(min($data_date), max($data_date));
        $data_final = array_reverse($data_final);
        $data_final = array_values($data_final);
        $total_final = count($data_final);

        $arr_date = array();
        foreach ($data_final as $date) {
            $arr_date[] = $date['date'];
        }

        for ($i = 0; $i < $total_array; $i++) {
            $i_name = $i + 1;
            $arr_item = explode(' - ', $arr_data[$i]);

            $sql = 'select perform, DATE_FORMAT(date,"%Y/%m") as date from efrc_indvn_stats WHERE period = "M" AND codeifrc="' . $arr_item[0] . '" AND date BETWEEN "' . min($data_date) . '" AND "' . max($data_date) . '"  ORDER BY date desc';

            $data_sql = $this->db3->query($sql)->result_array();

            $total_sql = count($data_sql);

            if ($total_sql != 0) {

                foreach ($data_sql as $key => $value) {
                    $data_final[$key]['id'] = $key + 1;
                    if (in_array($value['date'], $arr_date)) {
                        $data_final[$key][$i_name . "_perform"] = $value['perform'];
                    } else {
                        $data_final[$key][$i_name . "_perform"] = 0;
                    }
                }
            } else {

                for ($j = 0; $j < $total_final; $j++) {
                    $data_final[$j][$i_name . "_perform"] = 0;
                }
            }
        }

        return $data_final;
    }

    public function loadMonthCompareMultiChart($data) {
        $arr_data = explode(',', $data);
        $total_array = count($arr_data);

        $sql_select = array();
        $sql_sub = array();
        $sql_where = array();
        $key_chart = array();

        $i = 0;
        foreach ($arr_data as $key => $data_item) {
            $i++;
            $arr_item = explode(' - ', $data_item);
            $sql_select[] = '`' . $i . '`.close as ' . $i . '_close';
            $sql_sub[] = '(select id, date, adjclose from efrc_indvn_stats WHERE period = "M" AND codeifrc="' . $arr_item[0] . '") `' . $i . '`';
            $key_chart[] = $i;
        }

        $total_key = count($key_chart);
        foreach ($key_chart as $key => $value) {
            if ($key == $total_key - 1) {
                $where = 'CONCAT(YEAR(`' . $value . '`.date),"/",MONTH(`' . $value . '`.date)) = CONCAT(YEAR(`' . $key_chart[0] . '`.date),"/",MONTH(`' . $key_chart[0] . '`.date))';
            } else {
                $value_next = $key_chart[$key + 1];
                $where = 'CONCAT(YEAR(`' . $value . '`.date),"/",MONTH(`' . $value . '`.date)) = CONCAT(YEAR(`' . $value_next . '`.date),"/",MONTH(`' . $value_next . '`.date))';
            }
            $sql_where[] = $where;
        }

        $select = implode(',', $sql_select);
        $query_sub = implode(',', $sql_sub);
        $where_final = implode(' AND ', $sql_where);
        $sql = 'SELECT `' . $key_chart[0] . '`.id, `' . $key_chart[0] . '`.date, ' . $select . ' from ' . $query_sub . ' WHERE ' . $where_final . ' ORDER BY 
`' . $key_chart[0] . '`.date asc';
        return $this->db->query($sql)->result_array();
    }

    public function loadMonthCompareMultiCount($data) {
        $arr_data = explode(',', $data);
        $total_array = count($arr_data);
        $data_date = array();
        foreach ($arr_data as $data_item) {
            $arr_item = explode(' - ', $data_item);
            $sql = 'select MIN(date) as min, MAX(date) as max from efrc_indvn_stats WHERE period = "M" AND codeifrc="' . $arr_item[0] . '"';
            $data_sql = $this->db3->query($sql)->row_array();
            if ($data_sql['min'] != '' && $data_sql['max'] != '') {
                $data_date[] = $data_sql['min'];
                $data_date[] = $data_sql['max'];
            }
        }
        $data_final = $this->getAllMonths(min($data_date), max($data_date));
        $data_final = array_reverse($data_final);
        $data_final = array_values($data_final);
        $total_final = count($data_final);

        $arr_date = array();
        foreach ($data_final as $date) {
            $arr_date[] = $date['date'];
        }

        for ($i = 0; $i < $total_array; $i++) {
            $i_name = $i + 1;
            $arr_item = explode(' - ', $arr_data[$i]);

            $sql = 'select perform, DATE_FORMAT(date,"%Y/%m") as date from efrc_indvn_stats WHERE period = "M" AND codeifrc="' . $arr_item[0] . '" AND date BETWEEN "' . min($data_date) . '" AND "' . max($data_date) . '"  ORDER BY date desc';

            $data_sql = $this->db3->query($sql)->result_array();

            $total_sql = count($data_sql);

            if ($total_sql != 0) {

                foreach ($data_sql as $key => $value) {
                    $data_final[$key]['id'] = $key + 1;
                    if (in_array($value['date'], $arr_date)) {
                        $data_final[$key][$i_name . "_perform"] = $value['perform'];
                    } else {
                        $data_final[$key][$i_name . "_perform"] = 0;
                    }
                }
            } else {

                for ($j = 0; $j < $total_final; $j++) {
                    $data_final[$j][$i_name . "_perform"] = 0;
                }
            }
        }

        $total_data_final = count($data_final);

        return $total_data_final;
    }

    /*     * *************************************************************************
     * load data o table month theo inter code dung trong trang compare multi
     * ************************************************************************ */

    public function loadYearCompareMulti($data) {
        $arr_data = explode(',', $data);
        $total_array = count($arr_data);
        $data_date = array();
        foreach ($arr_data as $data_item) {
            $arr_item = explode(' - ', $data_item);
            $sql = 'select MIN(date) as min, MAX(date) as max from efrc_indvn_stats WHERE period = "Y" AND codeifrc="' . $arr_item[0] . '"';
            $data_sql = $this->db3->query($sql)->row_array();
            if ($data_sql['min'] != '' && $data_sql['max'] != '') {
                $data_date[] = $data_sql['min'];
                $data_date[] = $data_sql['max'];
            }
        }
        $data_final = $this->getAllYear(min($data_date), max($data_date));
        $data_final = array_reverse($data_final);
        $data_final = array_values($data_final);
        $total_final = count($data_final);

        $arr_date = array();
        foreach ($data_final as $date) {
            $arr_date[] = $date['date'];
        }

        for ($i = 0; $i < $total_array; $i++) {
            $i_name = $i + 1;
            $arr_item = explode(' - ', $arr_data[$i]);

            $sql = 'select perform, DATE_FORMAT(date,"%Y") as date from efrc_indvn_stats WHERE period = "Y" AND codeifrc="' . $arr_item[0] . '" AND date BETWEEN "' . min($data_date) . '" AND "' . max($data_date) . '"  ORDER BY date desc';

            $data_sql = $this->db3->query($sql)->result_array();

            $total_sql = count($data_sql);

            if ($total_sql != 0) {

                foreach ($data_sql as $key => $value) {
                    $data_final[$key]['id'] = $key + 1;
                    if (in_array($value['date'], $arr_date)) {
                        $data_final[$key][$i_name . "_perform"] = $value['perform'];
                    } else {
                        $data_final[$key][$i_name . "_perform"] = 0;
                    }
                }
            } else {

                for ($j = 0; $j < $total_final; $j++) {
                    $data_final[$j][$i_name . "_perform"] = 0;
                }
            }
        }
        return $data_final;
    }
	
	
	public function loadQuaterCompareMulti($data) {
        $arr_data = explode(',', $data);
        $total_array = count($arr_data);
        $data_date = array();
        foreach ($arr_data as $data_item) {
            $arr_item = explode(' - ', $data_item);
            $sql = 'select MIN(date) as min, MAX(date) as max from efrc_indvn_stats WHERE period = "Q" AND codeifrc="' . $arr_item[0] . '"';
            $data_sql = $this->db3->query($sql)->row_array();
            if ($data_sql['min'] != '' && $data_sql['max'] != '') {
                $data_date[] = $data_sql['min'];
                $data_date[] = $data_sql['max'];
            }
        }
        $data_final = $this->getAllYear(min($data_date), max($data_date));
        $data_final = array_reverse($data_final);
        $data_final = array_values($data_final);
        $total_final = count($data_final);

        $arr_date = array();
        foreach ($data_final as $date) {
            $arr_date[] = $date['date'];
        }

        for ($i = 0; $i < $total_array; $i++) {
            $i_name = $i + 1;
            $arr_item = explode(' - ', $arr_data[$i]);

            $sql = 'select perform, DATE_FORMAT(date,"%Y") as date from efrc_indvn_stats WHERE period = "Q" AND codeifrc="' . $arr_item[0] . '" AND date BETWEEN "' . min($data_date) . '" AND "' . max($data_date) . '"  ORDER BY date desc';

            $data_sql = $this->db3->query($sql)->result_array();

            $total_sql = count($data_sql);

            if ($total_sql != 0) {

                foreach ($data_sql as $key => $value) {
                    $data_final[$key]['id'] = $key + 1;
                    if (in_array($value['date'], $arr_date)) {
                        $data_final[$key][$i_name . "_perform"] = $value['perform'];
                    } else {
                        $data_final[$key][$i_name . "_perform"] = 0;
                    }
                }
            } else {

                for ($j = 0; $j < $total_final; $j++) {
                    $data_final[$j][$i_name . "_perform"] = 0;
                }
            }
        }
        return $data_final;
    }

    public function loadYearCompareMultiChart($data) {
        $arr_data = explode(',', $data);
        $total_array = count($arr_data);

        $sql_select = array();
        $sql_sub = array();
        $sql_where = array();
        $key_chart = array();

        $i = 0;
        foreach ($arr_data as $data_item) {
            $i++;
            $arr_item = explode(' - ', $data_item);
            $sql_select[] = '`' . $i . '`.close as ' . $i . '_close';
            $sql_sub[] = '(select id, date, adjclose from efrc_indvn_stats WHERE period = "Y" AND codeifrc="' . $arr_item[0] . '") `' . $i . '`';
            $key_chart[] = $i;
        }

        $total_key = count($key_chart);
        foreach ($key_chart as $key => $value) {
            if ($key == $total_key - 1) {
                $where = 'YEAR(`' . $value . '`.date) = YEAR(`1`.date)';
            } else {
                $value_next = $key_chart[$key + 1];
                $where = 'YEAR(`' . $value . '`.date) = YEAR(`' . $value_next . '`.date)';
            }
            $sql_where[] = $where;
        }

        $select = implode(',', $sql_select);
        $query_sub = implode(',', $sql_sub);
        $where_final = implode(' AND ', $sql_where);
        $sql = 'SELECT `1`.id, `1`.date, ' . $select . ' from ' . $query_sub . ' WHERE ' . $where_final . ' ORDER BY 
`1`.date asc';
        return $this->db->query($sql)->result_array();
    }
	
	public function loadQuaterCompareMultiChart($data) {
        $arr_data = explode(',', $data);
        $total_array = count($arr_data);

        $sql_select = array();
        $sql_sub = array();
        $sql_where = array();
        $key_chart = array();

        $i = 0;
        foreach ($arr_data as $data_item) {
            $i++;
            $arr_item = explode(' - ', $data_item);
            $sql_select[] = '`' . $i . '`.close as ' . $i . '_close';
            $sql_sub[] = '(select id, date, adjclose from efrc_indvn_stats WHERE period = "Q" AND codeifrc="' . $arr_item[0] . '") `' . $i . '`';
            $key_chart[] = $i;
        }

        $total_key = count($key_chart);
        foreach ($key_chart as $key => $value) {
            if ($key == $total_key - 1) {
                $where = 'YEAR(`' . $value . '`.date) = YEAR(`1`.date)';
            } else {
                $value_next = $key_chart[$key + 1];
                $where = 'YEAR(`' . $value . '`.date) = YEAR(`' . $value_next . '`.date)';
            }
            $sql_where[] = $where;
        }

        $select = implode(',', $sql_select);
        $query_sub = implode(',', $sql_sub);
        $where_final = implode(' AND ', $sql_where);
        $sql = 'SELECT `1`.id, `1`.date, ' . $select . ' from ' . $query_sub . ' WHERE ' . $where_final . ' ORDER BY 
`1`.date asc';
        return $this->db->query($sql)->result_array();
    }

    public function loadYEARCompareMultiCount($data) {
        $arr_data = explode(',', $data);
        $total_array = count($arr_data);
        $data_date = array();
        foreach ($arr_data as $data_item) {
            $arr_item = explode(' - ', $data_item);
            $sql = 'select MIN(date) as min, MAX(date) as max from efrc_indvn_stats WHERE period = "Y" AND codeifrc="' . $arr_item[0] . '"';
            $data_sql = $this->db3->query($sql)->row_array();
            if ($data_sql['min'] != '' && $data_sql['max'] != '') {
                $data_date[] = $data_sql['min'];
                $data_date[] = $data_sql['max'];
            }
        }
        $data_final = $this->getAllYear(min($data_date), max($data_date));
        $data_final = array_reverse($data_final);
        $data_final = array_values($data_final);
        $total_final = count($data_final);

        $arr_date = array();
        foreach ($data_final as $date) {
            $arr_date[] = $date['date'];
        }

        for ($i = 0; $i < $total_array; $i++) {
            $i_name = $i + 1;
            $arr_item = explode(' - ', $arr_data[$i]);

            $sql = 'select perform, DATE_FORMAT(date,"%Y") as date from efrc_indvn_stats WHERE period = "Y" AND codeifrc="' . $arr_item[0] . '" AND date BETWEEN "' . min($data_date) . '" AND "' . max($data_date) . '"  ORDER BY date desc';

            $data_sql = $this->db3->query($sql)->result_array();

            $total_sql = count($data_sql);

            if ($total_sql != 0) {

                foreach ($data_sql as $key => $value) {
                    $data_final[$key]['id'] = $key + 1;
                    if (in_array($value['date'], $arr_date)) {
                        $data_final[$key][$i_name . "_perform"] = $value['perform'];
                    } else {
                        $data_final[$key][$i_name . "_perform"] = 0;
                    }
                }
            } else {

                for ($j = 0; $j < $total_final; $j++) {
                    $data_final[$j][$i_name . "_perform"] = 0;
                }
            }
        }
        return count($data_final);
    }
	
	
	public function loadQuaterCompareMultiCount($data) {
        $arr_data = explode(',', $data);
        $total_array = count($arr_data);
        $data_date = array();
        foreach ($arr_data as $data_item) {
            $arr_item = explode(' - ', $data_item);
            $sql = 'select MIN(date) as min, MAX(date) as max from efrc_indvn_stats WHERE period = "Q" AND codeifrc="' . $arr_item[0] . '"';
            $data_sql = $this->db3->query($sql)->row_array();
            if ($data_sql['min'] != '' && $data_sql['max'] != '') {
                $data_date[] = $data_sql['min'];
                $data_date[] = $data_sql['max'];
            }
        }
        $data_final = $this->getAllYear(min($data_date), max($data_date));
        $data_final = array_reverse($data_final);
        $data_final = array_values($data_final);
        $total_final = count($data_final);

        $arr_date = array();
        foreach ($data_final as $date) {
            $arr_date[] = $date['date'];
        }

        for ($i = 0; $i < $total_array; $i++) {
            $i_name = $i + 1;
            $arr_item = explode(' - ', $arr_data[$i]);

            $sql = 'select perform, DATE_FORMAT(date,"%Y") as date from efrc_indvn_stats WHERE period = "Q" AND codeifrc="' . $arr_item[0] . '" AND date BETWEEN "' . min($data_date) . '" AND "' . max($data_date) . '"  ORDER BY date desc';

            $data_sql = $this->db3->query($sql)->result_array();

            $total_sql = count($data_sql);

            if ($total_sql != 0) {

                foreach ($data_sql as $key => $value) {
                    $data_final[$key]['id'] = $key + 1;
                    if (in_array($value['date'], $arr_date)) {
                        $data_final[$key][$i_name . "_perform"] = $value['perform'];
                    } else {
                        $data_final[$key][$i_name . "_perform"] = 0;
                    }
                }
            } else {

                for ($j = 0; $j < $total_final; $j++) {
                    $data_final[$j][$i_name . "_perform"] = 0;
                }
            }
        }
        return count($data_final);
    }

    public function loadFactsheet($data) {
        $_data['mtran'] = new Models_models_mTranslates();
        $_data['nn'] = $_SESSION['lang'];

        $arr_column = array(
            'NAME', 'SHORTNAME', 'PRICE', 'CURR', 'NB', 'WEIGHTING', 'FREQUENCY', 'CAPPING', 'CRITERIA', 'REV_COMPO', 'SHARES',
            'REV_FLOAT', 'ARR_FLOAT', 'FUTURES', 'OPTIONS', 'ETF', 'BASE_VALUE', 'BASE_CAPI', 'BASE_DATE', 'HISTORY', 'LAUNCH',
            'WEBSITE'
        );

        $data_column_name = array(
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Full name', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Short name', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Price or Total Return', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Currency', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Constituents number', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Weighting', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Calculation frequency', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Capping', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Qualification criteria', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Composition review', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Shares review', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Free float review', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Free float banding', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Futures products', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Options products', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('ETF products', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Base value', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Base capitalisation', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Base date', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Historical since', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Launching date', $_data['nn']) . '</span>'
            ),
            array(
                'column' => '<span style="font-size:14px">' . $_data['mtran']->get_translates('Website', $_data['nn']) . '</span>'
            )
        );

        $arr_data = explode(",", $data);
        $total_arr = count($arr_data);

        $columns = '`' . implode('`,`', $arr_column) . '`';

        for ($i = 0; $i < $total_arr; $i++) {
            $arr_field = explode(' - ', $arr_data[$i]);
            $sql_sub = "SELECT {$columns} FROM idx_sample WHERE CODE = '" . $arr_field[0] . "'";
            $data_sub = $this->fetchOne($sql_sub);
            $j = 0;
            $array_push = array();
            foreach ($data_sub as $key => $value) {
                if ($key == 'PRICE') {
                    if ($value != '') {
                        $value = $_data['mtran']->get_translates('PRICE_' . $value, $_data['nn']);
                    }
                }
                if ($key == 'WEIGHTING') {
                    if ($value != '') {
                        $value = $_data['mtran']->get_translates('WEIGHTING_' . $value, $_data['nn']);
                    }
                }
                if ($key == 'FREQUENCY') {
                    if ($value != '') {
                        $value = $_data['mtran']->get_translates('FREQUENCY_' . $value, $_data['nn']);
                    }
                }
                if ($key == 'CRITERIA') {
                    if ($value != '') {
                        $value = $_data['mtran']->get_translates('CRITERIA_' . $value, $_data['nn']);
                    }
                }
                if ($key == 'REV_COMPO') {
                    if ($value != '') {
                        $value = $_data['mtran']->get_translates('REV_COMPO_' . $value, $_data['nn']);
                    }
                }
                if ($key == 'SHARES') {
                    if ($value != '') {
                        $value = $_data['mtran']->get_translates('SHARES_' . $value, $_data['nn']);
                    }
                }
                if ($key == 'REV_FLOAT') {
                    if ($value != '') {
                        $value = $_data['mtran']->get_translates('REV_FLOAT_' . $value, $_data['nn']);
                    }
                }
                if ($key == 'ARR_FLOAT') {
                    if ($value != '') {
                        $value = $_data['mtran']->get_translates('ARR_FLOAT_' . $value, $_data['nn']);
                    }
                }
                if ($key == 'WEBSITE') {
                    $url = urlencode($value);
                    $url = rawurldecode($url);
                    $value = '<a href="' . $url . '" target="_blank" style="color:#4098f0">LINK</a>';
                }
                if ($arr_column[$j] == $key) {
                    array_push($data_column_name[$j], $value);
                }
                $j++;
            }
        }

        return $data_column_name;
    }

    public function loadFactsheetCount($data) {
        $sql = 'SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = "idx_sample" and table_schema = "' . DB_DATABASE . '"';
        $data_sql = $this->db->query($sql)->result_array();
        $data_column_name = array();

        foreach ($data_sql as $item) {
            $data_column_name[] = array(
                'column' => $item['COLUMN_NAME']
            );
        }
        return count($data_column_name);
    }

    public function checkObsdate($data) {
        $arr_data = explode(" - ", $data);
        $sql = 'SELECT count(*) as count FROM idx_sample WHERE CODE="' . $arr_data[0] . '" AND OBSDATE IS NOT NULL';
        $data_sql = $this->db->query($sql)->row_array();
        return $data_sql['count'];
    }

    public function getAllMonths($date1, $date2) {
        $array_date = explode('/', $date1);
        $date1 = $array_date[0] . '/' . $array_date[1] . '/1';
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        $my = date('mY', $time2);

        $months[] = array('date' => date('Y/m', $time1));
        while ($time1 < $time2) {
            $time1 = strtotime(date('Y-m-d', $time1) . ' +1 month');
            if (date('mY', $time1) != $my && ($time1 < $time2)) {
                $months[] = array('date' => date('Y/m', $time1));
            }
        }

        $months[] = array('date' => date('Y/m', $time2));
        //$months = array_unique($months);
        return $months;
    }

    public function getAllYear($date1, $date2) {
        $array_date = explode('/', $date1);
        $date1 = $array_date[0] . '/' . $array_date[1] . '/1';
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        $y = date('Y', $time2);

        $years[] = array('date' => date('Y', $time1));
        while ($time1 < $time2) {
            $time1 = strtotime(date('Y-m-d', $time1) . ' +1 year');
            if (date('Y', $time1) != $y && ($time1 < $time2)) {
                $years[] = array('date' => date('Y', $time1));
            }
        }

        $years[] = array('date' => date('Y', $time2));
        //$years = array_unique($years);
        return $years;
    }
	
	 public function getAllQuater($date1, $date2) {
        $array_date = explode('/', $date1);
        $date1 = $array_date[0] . '/' . $array_date[1] . '/1';
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        $y = date('Y', $time2);

        $years[] = array('date' => date('Q', $time1));
        while ($time1 < $time2) {
            $time1 = strtotime(date('Y-m-d', $time1) . ' +1 year');
            if (date('Y', $time1) != $y && ($time1 < $time2)) {
                $years[] = array('date' => date('Y', $time1));
            }
        }

        $years[] = array('date' => date('Y', $time2));
        //$years = array_unique($years);
        return $years;
    }

    public function loadAnnual($year, $option, $limit) {
        $whereFilter = '';
        if ($option['typeFilter'] != 'all') {
            $whereFilter .= 'AND b.price = "' . $option['typeFilter'] . '"';
        }
        if ($option['currencyFilter'] != 'all') {
            $whereFilter .= 'AND b.curr = "' . $option['currencyFilter'] . '"';
        }
        if ($option['providerFilter'] != 'all') {
            if ($option['providerFilter'] == 'OTHER') {
                $whereFilter .= "AND b.provider NOT IN ('IFRC', 'IFRCLAB', 'PVN', '')";
            } else {
                $whereFilter .= 'AND b.provider = "' . $option['providerFilter'] . '"';
            }
        }
        $sort = 'ORDER BY rt ' . $option['sortFilter'];
        $this->db->query('SET @rownum = 0');
        $sql = 'SELECT @rownum:=@rownum+1 as no, a.* from 
                     (SELECT a.id, b.name, b.provider, b.price as type, b.curr, a.date, 
                        ROUND(a.adjclose,2) as close, a.rt as perform, a.codeifrc FROM `efrc_indvn_stats` a, 
                        `idx_sample` b WHERE a.codeifrc = b.code and b.vnxi=1 and b.place="VIETNAM" ' . $whereFilter . ' AND period = "Y" and 
                        YEAR(a.date) = ' . $year . ' ' . $sort . ' ' . $limit . ') a';
       // echo "<pre>";print_r($sql);exit;
        return $this->db3->query($sql)->result_array();
    }

    public function loadAnnualCount($year, $option) {
        $whereFilter = '';
        if ($option['typeFilter'] != 'all') {
            $whereFilter .= ' AND b.price = "' . $option['typeFilter'] . '"';
        }
        if ($option['currencyFilter'] != 'all') {
            $whereFilter .= ' AND b.curr = "' . $option['currencyFilter'] . '"';
        }
        if ($option['providerFilter'] != 'all') {
            if ($option['providerFilter'] == 'OTHER') {
                $whereFilter .= "AND b.provider NOT IN ('IFRC', 'IFRCLAB', 'PVN', '')";
            } else {
                $whereFilter .= 'AND b.provider = "' . $option['providerFilter'] . '"';
            }
        }
        $sql = 'SELECT count(a.id) as count FROM `efrc_indvn_stats` a, 
        `idx_sample` b WHERE a.codeifrc = b.code and b.vnxi=1 and b.place="VIETNAM" ' . $whereFilter . ' and YEAR(a.date) = ' . $year;
        $data = $this->db3->query($sql)->row_array();
        return $data;
    }

    public function loadAllAnnualCount() {
        $sql = 'select COUNT(DISTINCT code) as count from efrc_indvn_stats';
        $data = $this->db3->query($sql)->row_array();
        return $data['count'];
    }

    public function loadAllComparisonCount() {
        $sql = "SELECT COUNT(DISTINCT code) as count from idx_sample where VNXI=1 and TYPE='equity'";
        $data = $this->db->query($sql)->row_array();
        return $data['count'];
    }
    public function getCodebyName1($name) {
        $sql = "select CODE from idx_sample WHERE PROVIDER IN ('PVN','IFRC','IFRCGWC','PROVINCIAL','IFRCLAB','IFRCRESEARCH') AND NAME='" . $name. "' OR SHORTNAME ='". $name."' LIMIT 1";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	 public function getCodebyName1Stock($name) {
		$sql = "select stk_code as CODE  from stk_ref where 1=1 and stk_name_sn='".$name."'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }

}
