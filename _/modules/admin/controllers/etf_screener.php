<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ******************************************************************************************************************* *
 *   Author: Minh Handsome                                                                                               *
 * * ******************************************************************************************************************* */

class Etf_screener extends Admin {

    public function __construct() {
        parent::__construct();
        $this->load->model('Etf_screener_model', 'etf_screener_model');
    }
    
    public function index() {
        $this->data->info = $this->etf_screener_model->get_data();
        $this->template->write_view('content', 'etf_screener/index', $this->data);
        $this->template->write('title', 'ETF Screener');
        $this->template->render();
    }
    
    public function process_step() {
        if ($this->input->is_ajax_request()) {
            set_time_limit( 0 );
            $country = $_POST['sum_country'];
            $ratio = array($_POST['min_ratio'],$_POST['max_ratio']);
            $issuer = $_POST['sum_issuer'];
            $structure = $_POST['sum_structure'];
            $size = $_POST['sum_size'];
            $style = $_POST['sum_style'];
            $general = $_POST['sum_general'];
            $specific = $_POST['sum_specific'];
            $currency = $_POST['sum_currency'];
            $price = array($_POST['min_price'],$_POST['max_price']);
            $aum = array($_POST['min_aum'],$_POST['max_aum']);
            $filter = $this->_get_filter($country,$ratio,$issuer,$structure,$size,$style,$general,$specific,$currency,$price,$aum);
            if ( $filter != FALSE ) {
                $row = $this->db->query("SELECT * FROM ETFDB_ALL WHERE ".$filter)->num_rows();
                $respone['country'] = $row;
                $respone['ratio'] = $row;
                $respone['issuer'] = $row;
                $respone['structure'] = $row;
                $respone['size'] = $row;
                $respone['style'] = $row;
                $respone['general'] = $row;
                $respone['specific'] = $row;
                $respone['currency'] = $row;
                $respone['price'] = $row;
                $respone['aum'] = $row;
            }else {
                $respone['country'] = 0;
                $respone['ratio'] = 0;
                $respone['issuer'] = 0;
                $respone['structure'] = 0;
                $respone['size'] = 0;
                $respone['style'] = 0;
                $respone['general'] = 0;
                $respone['specific'] = 0;
                $respone['currency'] = 0;
                $respone['price'] = 0;
                $respone['aum'] = 0;
            }
            echo json_encode( $respone );
        }
    }
    
    protected function _get_filter($country,$ratio,$issuer,$structure,$size,$style,$general,$specific,$currency,$price,$aum){
        set_time_limit(0);
        $data['info'] = $this->etf_screener_model->get_data();
        // COUNTRY
        if ( $country != "" ) {
            $country = str_replace( '(Empty Country)', '', $country );
            $ex_c = explode( ",", $country );
            $sum_ex_c = count( $ex_c );
            if ( $sum_ex_c != 1 ) {
                $data_c = '(\''.implode( '\',\'', $ex_c ).'\')';
                $filter_country = "COUNTRY IN ".$data_c;
            }else {
                $data_c = $ex_c[0];
                $filter_country = "COUNTRY = '".$data_c."'";
            }
            // RATIO
            $filter_ratio = "EXPENSE_RATIO BETWEEN ".$ratio[0]." AND ".$ratio[1];
            // ISSUER
            if ( $issuer != "" ) {
                $issuer = str_replace( '(Empty Issuer)', '', $issuer );
                $ex_i = explode( ",", $issuer );
                $sum_ex_i = count( $ex_i );
                if ( $sum_ex_i != 1 ) {
                    $data_i = '(\''.implode( '\',\'', $ex_i ).'\')'; 
                    $filter_issuer = "ISSUER IN ".$data_i;
                }else {
                    $data_i = $ex_i[0];
                    $filter_issuer = "ISSUER = '".$data_i."'";
                }
                // STRUCTURE
                if ( $structure != "" ) {
                    $structure = str_replace( '(Empty Structure)', '', $structure );
                    $ex_s = explode( ",", $structure );
                    $sum_ex_s = count( $ex_s );
                    if ( $sum_ex_s != 1 ) {
                        $data_s = '(\''.implode( '\',\'', $ex_s ).'\')'; // Filter ??a v?o query
                        $filter_structure = "STRUCTURE IN ".$data_s;
                    }else {
                        $data_s = $ex_s[0];
                        $filter_structure = "STRUCTURE = '".$data_s."'";
                    }
                    //SIZE
                    if ( $size != "" ) {
                        $size = str_replace( '(Empty Size)', '', $size );
                        $ex_si = explode( ",", $size );
                        $sum_ex_si = count( $ex_si );
                        if ( $sum_ex_si > 1 ) {
                            $data_si = '(\''.implode( '\',\'', $ex_si ).'\')'; // Filter ??a v?o query
                            $filter_size = "SIZE IN ".$data_si;
                        }else {
                            $data_si = $ex_si[0];
                            $filter_size = "SIZE = '".$data_si."'";
                        }
                        // STYLE
                        if ( $style != "" ) {
                            $style = str_replace( '(Empty Style)', '', $style );
                            $ex_st = explode( ",", $style );
                            $sum_ex_st = count( $ex_st );
                            if ( $sum_ex_st > 1 ) {
                                $data_st = '(\''.implode( '\',\'', $ex_st ).'\')'; // Filter ??a v?o query
                                $filter_style = "STYLE IN ".$data_st;
                            }else {
                                $data_st = $ex_st[0];
                                $filter_style = "STYLE = '".$data_st."'";
                            }
                            //GENERAL
                            if($general != ""){
                                $general = str_replace( '(Empty General)', '', $general );
                                $ex_g = explode( ",", $general );
                                $sum_ex_g = count( $ex_g );
                                if ( $sum_ex_g > 1 ) {
                                    $data_g = '(\''.implode( '\',\'', $ex_g ).'\')'; // Filter ??a v?o query
                                    $filter_general = "REGION_GEN IN ".$data_g;
                                }else {
                                    $data_g = $ex_g[0];
                                    $filter_general = "REGION_GEN = '".$data_g."'";
                                }
                                //SPECIFIC
                                if($specific != ""){
                                    $specific = str_replace( '(Empty Specific)', '', $specific );
                                    $ex_sp = explode( ",", $specific );
                                    $sum_ex_sp = count( $ex_sp );
                                    if ( $sum_ex_sp > 1 ) {
                                        $data_sp = '(\''.implode( '\',\'', $ex_sp ).'\')'; 
                                        $filter_specific = "REGION_SPE IN ".$data_sp;
                                    }else {
                                        $data_sp = $ex_sp[0];
                                        $filter_specific = "REGION_SPE = '".$data_sp."'";
                                    }
                                    //CURRENCY
                                    if($currency != ""){
                                        $currency = str_replace( '(Empty Currency)', '', $currency );
                                        $ex_cu = explode( ",", $currency );
                                        $sum_ex_cu = count( $ex_cu );
                                        if ( $sum_ex_cu > 1 ) {
                                            $data_cu = '(\''.implode( '\',\'', $ex_cu ).'\')'; 
                                            $filter_currency = "CURRENCY IN ".$data_cu;
                                        }else {
                                            $data_cu = $ex_cu[0];
                                            $filter_currency = "CURRENCY = '".$data_cu."'";
                                        }
                                        //PRICE
                                        $filter_price = "PRICE BETWEEN ".$price[0]." AND ".$price[1];
                                        //AUM
                                        $filter_aum = "AUM BETWEEN ".$aum[0]." AND ". $aum[1];
                                        $filter_all = $filter_country." AND ".$filter_ratio." AND ".$filter_issuer." AND ". $filter_structure ." AND ".$filter_size." AND ".$filter_style. " AND ".$filter_general." AND ".$filter_specific." AND ".$filter_currency." AND ".$filter_price." AND ".$filter_aum;
                                        return $filter_all;
                                    }else{
                                        $data_cu = '(\''.implode( '\',\'', $data['info']['currency'] ).'\')'; 
                                        $filter_currency = "CURRENCY NOT IN ".$data_cu;
                                        $filter_all = $filter_country." AND ".$filter_ratio." AND ".$filter_issuer." AND ". $filter_structure ." AND ".$filter_size." AND ".$filter_style. " AND ".$filter_general." AND ".$filter_specific." AND ".$filter_currency;
                                        return FALSE;
                                    }
                                }else{
                                    $data_sp = '(\''.implode( '\',\'', $data['info']['region_spe'] ).'\')'; 
                                    $filter_specific = "REGION_SPE NOT IN ".$data_sp;
                                    $filter_all = $filter_country." AND ".$filter_ratio." AND ".$filter_issuer." AND ". $filter_structure ." AND ".$filter_size." AND ".$filter_style. " AND ".$filter_general." AND ".$filter_specific;
                                    return FALSE;
                                }
                            }else{
                                $data_g = '(\''.implode( '\',\'', $data['info']['region_gen'] ).'\')';
                                $filter_general = "REGION_GEN NOT IN ".$data_g;
                                $filter_all = $filter_country." AND ".$filter_ratio." AND ".$filter_issuer." AND ". $filter_structure ." AND ".$filter_size." AND ".$filter_style. " AND ".$filter_general;
                                return FALSE;
                            }
                        }else {
                            $data_st = '(\''.implode( '\',\'', $data['info']['style'] ).'\')';
                            $filter_style = "STYLE NOT IN ".$data_st;
                            $filter_all = $filter_country." AND ".$filter_ratio." AND ".$filter_issuer." AND ". $filter_structure ." AND ".$filter_size." AND ".$filter_style;
                            return FALSE;
                        }
                    }else {
                        $data_si = '(\''.implode( '\',\'', $data['info']['size'] ).'\')';
                        $filter_size = "SIZE NOT IN ".$data_si;
                        $filter_all = $filter_country." AND ".$filter_ratio." AND ".$filter_issuer." AND ". $filter_structure ." AND ".$filter_size;
                        return FALSE;
                    }
                }else {
                    $data_s = '(\''.implode( '\',\'', $data['info']['structure'] ).'\')';
                    $filter_structure = "STRUCTURE NOT IN ".$data_s;
                    $filter_all = $filter_country." AND ".$filter_ratio." AND ".$filter_issuer." AND ". $filter_structure;
                    return FALSE;
                }
            }else {
                $data_i = '(\''.implode( '\',\'', $data['info']['issuer'] ).'\')';
                $filter_issuer = "ISSUER NOT IN ".$data_i;
                $filter_all = $filter_country." AND ".$filter_ratio." AND ".$filter_issuer;
                return FALSE;
            }
        }else {
            $data_c = '(\''.implode( '\',\'', $data['info']['country'] ).'\')';
            $filter_country = "COUNTRY NOT IN ".$data_c;
            $filter_all = $filter_country;
            return FALSE;
        }
    }
    
    public function process_final() {
        set_time_limit( 0 );
        $mScreener = new Models_Screener_mScreener();
        $type= $_POST['sum_type'];
        $category = $_POST['sum_category'];
        $provider = $_POST['sum_provider'];
        $place = $_POST['sum_place'];
        $price = $_POST['sum_price'];
        $curr = $_POST['sum_curr'];
        $month = $_POST['month'];
        $limit = $_POST['limit'];
        $data_final = $this->_get_data_final( $type, $category, $provider, $place, $price, $curr, $month, $limit );
        if ( $data_final != FALSE ) {
            $data_year = $mScreener->fetch( "SELECT DISTINCT(YEAR(DATE)) as YEAR FROM IDX_YEAR WHERE YEAR(DATE) >= 2008 AND YEAR(CURDATE()) ORDER BY YEAR DESC" );
            $data = array();
            foreach ( $data_final as $row_final ) {
                $data_name[] = $row_final['NAME'];
                $data_code[] = $row_final['CODE'];
                if($row_final['MONTH'] != '-' || $row_final['MONTH'] != 0){
                    $data_month[] = number_format((float)$row_final['MONTH'],2,'.','');
                }else{
                    $data_month[] = $row_final['MONTH'];
                }
                if($row_final['YTD'] != '-' || $row_final['YTD'] != 0){
                    $data_ytd[] = number_format((float)$row_final['YTD'],2,'.','');
                }else{
                    $data_ytd[] = $row_final['YTD'];
                }
                foreach($data_year as $dy){
                     if($row_final[$dy['YEAR']] != '-' || $row_final[$dy['YEAR']] != 0){
                        $data[$dy['YEAR']][] = number_format((float)$row_final[$dy['YEAR']],2,'.','');
                     }else{
                         $data[$dy['YEAR']][] = $row_final[$dy['YEAR']];
                     }
                }
            }
            $respone['data_name'] = $data_name;
            $respone['data_code'] = $data_code;
            $respone['data_month'] = $data_month;
            $respone['data_ytd'] = $data_ytd;
            foreach ( $data as $kd => $vd ) {
                $respone["data"][$kd] = $vd;
            }
            $respone["data_error"] = TRUE;
        }else {
            $respone["data_error"] = FALSE;
        }
        echo json_encode( $respone );
    }
    
    public function process_sort(){
        set_time_limit(0);
        $sort= $_POST['sort'];
        $title = $_POST['title'];
        $mScreener = new Models_Screener_mScreener();
        $data_year = $mScreener->fetch("SELECT DISTINCT(YEAR(DATE)) as YEAR FROM IDX_YEAR WHERE YEAR(DATE) >= 2008 AND YEAR(CURDATE()) ORDER BY YEAR DESC");
        $data_result = $mScreener->fetch("SELECT * FROM TMP_SCREENER ORDER BY  CAST(`{$title}` as SIGNED INTEGER) {$sort}");
        $data = array();
        foreach($data_result as $row_final){
          $data_name[] = $row_final['NAME'];
          $data_code[] = $row_final['CODE'];
          if($row_final['MONTH'] != '-' || $row_final['MONTH'] != 0){
              $data_month[] = number_format((float)$row_final['MONTH'],2,'.','');
          }else{
              $data_month[] = $row_final['MONTH'];
          }
          if($row_final['YTD'] != '-' || $row_final['YTD'] != 0){
              $data_ytd[] = number_format((float)$row_final['YTD'],2,'.','');
          }else{
              $data_ytd[] = $row_final['YTD'];
          }
          foreach($data_year as $dy){
               if($row_final[$dy['YEAR']] != '-' || $row_final[$dy['YEAR']] != 0){
                  $data[$dy['YEAR']][] = number_format((float)$row_final[$dy['YEAR']],2,'.','');
               }else{
                   $data[$dy['YEAR']][] = $row_final[$dy['YEAR']];
               }
          }
        }
        $respone['data_name'] = $data_name;
        $respone['data_code'] = $data_code;
        $respone['data_month'] = $data_month;
        $respone['data_ytd'] = $data_ytd;
        foreach($data as $kd => $vd){
             $respone["data"][$kd] = $vd;
        }
        echo json_encode($respone);
    }
    
    public function process_export(){
        set_time_limit(0);
        $mScreener = new Models_Screener_mScreener();
        $data_year = $mScreener->fetch("SELECT DISTINCT(YEAR(DATE)) as YEAR FROM IDX_YEAR WHERE YEAR(DATE) >= 2008 AND YEAR(CURDATE()) ORDER BY YEAR DESC");
        foreach($data_year as $item_year){
            $year[] = implode('',$item_year);
        }
        $year = '`'.implode('`, `',$year).'`';
        $data_result = $mScreener->fetch("SELECT `NAME`, `CODE`, `YTD`, `MONTH`, {$year} FROM TMP_SCREENER");
        $content = array();
        foreach($data_result as $row_final){
            if($row_final['MONTH'] != '-' || $row_final['MONTH'] != 0){
                $row_final['MONTH'] = number_format((float)$row_final['MONTH'],2,'.','');
            }else{
                $row_final['MONTH'] = '';
            }
            if($row_final['YTD'] != '-' || $row_final['YTD'] != 0){
                $row_final['YTD'] = number_format((float)$row_final['YTD'],2,'.','');
            }else{
                $row_final['YTD'] = '';
            }
            foreach($data_year as $dy){
                 if($row_final[$dy['YEAR']] != '-' || $row_final[$dy['YEAR']] != 0){
                    $row_final[$dy['YEAR']] = number_format((float)$row_final[$dy['YEAR']],2,'.','');
                 }else{
                     $row_final[$dy['YEAR']] = '';
                 }
            }
            $header = array_keys($row_final);
            $content[] = implode("\t",$row_final);
        }
        $header = implode("\t", $header);
        $data = implode("\r\n", $content);
        $file = $header . "\r\n";
        $file .= $data;
        $filename = "screener.txt";
        $create = fopen($filename, "w");
        fwrite($create, $file);
        fclose($create);
        $response['file'] = $filename;
        echo json_encode($response);
    }
    
    
    protected function _get_data_final( $type, $category, $provider, $place, $price, $curr, $data_month, $limit ) {
        set_time_limit( 0 );
        $mScreener = new Models_Screener_mScreener();
        $data['info'] = $mScreener->get_data();
        // TYPE
        if ( $type != "" ) {
            $ex_t = explode( ",", $type );
            $sum_ex_t = count( $ex_t );
            if ( $sum_ex_t != 1 ) {
                $data_t = '(\''.implode( '\',\'', $ex_t ).'\')'; // Filter ??a v?o query
                $filter_type = "TYPE IN ".$data_t;
            }else {
                $data_t = $ex_t[0];
                $filter_type = "TYPE = '".$data_t."'";
            }
            // CATEGORY
            if ( $category != "" ) {
                $category = str_replace( '(Empty Category)', '', $category );
                $ex_c = explode( ",", $category );
                $sum_ex_c = count( $ex_c );
                if ( $sum_ex_c != 1 ) {
                    $data_c = '(\''.implode( '\',\'', $ex_c ).'\')'; // Filter ??a v?o query
                    $filter_category = "SUB_TYPE IN ".$data_c;
                }else {
                    $data_c = $ex_c[0];
                    $filter_category = "SUB_TYPE = '".$data_c."'";
                }
                // PROVIDER
                if ( $provider != "" ) {
                    $provider = str_replace( '(Empty Provider)', '', $provider );
                    $ex_p = explode( ",", $provider );
                    $sum_ex_p = count( $ex_p );
                    if ( $sum_ex_p != 1 ) {
                        $data_p = '(\''.implode( '\',\'', $ex_p ).'\')'; // Filter ??a v?o query
                        $filter_provider = "A.PROVIDER IN ".$data_p;
                    }else {
                        $data_p = $ex_p[0];
                        $filter_provider = "A.PROVIDER = '".$data_p."'";
                    }
                    // PLACE
                    if ( $place != "" ) {
                        $place = str_replace( '(Empty Place)', '', $place );
                        $ex_pl = explode( ",", $place );
                        $sum_ex_pl = count( $ex_pl );
                        if ( $sum_ex_pl != 1 ) {
                            $data_pl = '(\''.implode( '\',\'', $ex_pl ).'\')'; // Filter ??a v?o query
                            $filter_place = "PLACE IN ".$data_pl;
                        }else {
                            $data_pl = $ex_pl[0];
                            $filter_place = "PLACE = '".$data_pl."'";
                        }
                        //PRICE
                        if ( $price != "" ) {
                            $price = str_replace( '(Empty Price)', '', $price );
                            $ex_pr = explode( ",", $price );
                            $sum_ex_pr = count( $ex_pr );
                            if ( $sum_ex_pr > 1 ) {
                                $data_pr = '(\''.implode( '\',\'', $ex_pr ).'\')'; // Filter ??a v?o query
                                $filter_price = "PRICE IN ".$data_pr;
                            }else {
                                $data_pr = $ex_pr[0];
                                $filter_price = "PRICE = '".$data_pr."'";
                            }
                            // CURRENCY
                            if ( $curr != "" ) {
                                $curr = str_replace( '(Empty Currency)', '', $curr );
                                $ex_cu = explode( ",", $curr );
                                $sum_ex_cu = count( $ex_cu );
                                if ( $sum_ex_cu > 1 ) {
                                    $data_cu = '(\''.implode( '\',\'', $ex_cu ).'\')'; // Filter ??a v?o query
                                    $filter_curr = "CURR IN ".$data_cu;
                                }else {
                                    $data_cu = $ex_cu[0];
                                    $filter_curr = "CURR = '".$data_cu."'";
                                }
                                // MONTH
                                $year = substr( $data_month, 3, 4 );
                                $month = substr( $data_month, 0, 2 );
                                $filter_month = "MONTH(B.DATE) = {$month} AND YEAR(B.DATE) = {$year}";
                                $filter_all = $filter_type." and ".$filter_category." and ".$filter_provider." and ". $filter_place ." and ".$filter_price." and ".$filter_curr." AND ".$filter_month;
                            }else {
                                $data_cu = '(\''.implode( '\',\'', $data['info']['curr'] ).'\')'; // Filter ??a v?o query
                                $filter_curr = "CURR NOT IN ".$data_cu;
                                $filter_all = $filter_type." and ".$filter_category." and ".$filter_provider." and ". $filter_place ." and ".$filter_price." and ".$filter_curr;
                                return FALSE;
                            }
                        }else {
                            $data_pr = '(\''.implode( '\',\'', $data['info']['price'] ).'\')'; // Filter ??a v?o query
                            $filter_price = "PRICE NOT IN ".$data_pr;
                            $filter_all = $filter_type." and ".$filter_category." and ".$filter_provider." and ". $filter_place ." and ".$filter_price;
                            return FALSE;
                        }

                    }else {
                        $data_pl = '(\''.implode( '\',\'', $data['info']['place'] ).'\')'; // Filter ??a v?o query
                        $filter_place = "PLACE NOT IN ".$data_pl;
                        $filter_all = $filter_type." and ".$filter_category." and ".$filter_provider." and ". $filter_place;
                        return FALSE;
                    }
                }else {
                    $data_p = '(\''.implode( '\',\'', $data['info']['provider'] ).'\')'; // Filter ??a v?o query
                    $filter_provider = "A.PROVIDER NOT IN ".$data_p;
                    $filter_all = $filter_type." and ".$filter_category." and ".$filter_provider;
                    return FALSE;
                }
            }else {
                $data_c = '(\''.implode( '\',\'', $data['info']['category'] ).'\')'; // Filter ??a v?o query
                $filter_category = "SUB_TYPE NOT IN ".$data_c;
                $filter_all = $filter_type." AND ".$filter_category;
                return FALSE;
            }
        }else {
            $data_t = '(\''.implode( '\',\'', $data['info']['type'] ).'\')'; // Filter ??a v?o query
            $filter_type = "TYPE NOT IN ".$data_t;
            $filter_all = $filter_type;
            return FALSE;
        }
        if($limit == 0){
            $filter_limit = "";
        }else{
            $filter_limit = "LIMIT ".$limit;
        }
        $mScreener->query( "DROP TABLE IF EXISTS TMP_SCREENER" );
        $mScreener->query( "CREATE TABLE TMP_SCREENER SELECT SHORTNAME AS NAME, A.CODE, {$month} AS MONTH2, {$year} AS YEAR FROM IDX_SAMPLE A JOIN IDX_MONTH B ON A.CODE = B.CODE WHERE ".$filter_all." GROUP BY SHORTNAME, MONTH2 ORDER BY SHORTNAME ASC ".$filter_limit );
        $mScreener->query( "CREATE INDEX CODEMONTH2YEAR ON TMP_SCREENER (CODE,MONTH2,YEAR) USING BTREE" );
        $mScreener->query( "CREATE INDEX CODEYEAR ON TMP_SCREENER (CODE,YEAR) USING BTREE" );
        $mScreener->query( "ALTER TABLE TMP_SCREENER ADD YTD VARCHAR (30)" );
        $mScreener->query( "ALTER TABLE TMP_SCREENER ADD MONTH VARCHAR (30)" );
        $mScreener->query( "UPDATE TMP_SCREENER SET YTD = '-'" );
        $mScreener->query( "UPDATE TMP_SCREENER SET MONTH = '-'" );
        $data_year = $mScreener->fetch( "SELECT DISTINCT(YEAR(DATE)) as YEAR FROM IDX_YEAR WHERE YEAR(DATE) >= 2008 AND YEAR(CURDATE()) ORDER BY YEAR DESC" );
        foreach ( $data_year as $dy ) {
            $mScreener->query( "ALTER TABLE TMP_SCREENER ADD `{$dy['YEAR']}` VARCHAR (30)" );
            $mScreener->query( "UPDATE TMP_SCREENER SET `{$dy['YEAR']}` = '-'" );
            $mScreener->query( "UPDATE TMP_SCREENER A, IDX_YEAR B SET A.`{$dy['YEAR']}` = IF(B.PERFORM != '',B.PERFORM,'-') WHERE A.CODE = B.CODE AND YEAR(B.DATE) = {$dy['YEAR']}" );
        }
        $mScreener->query( "UPDATE TMP_SCREENER A, IDX_MONTH B SET A.MONTH = IF(B.PERFORM != '',B.PERFORM,'-') WHERE A.CODE = B.CODE AND A.MONTH2 = MONTH(B.DATE) AND A.YEAR = YEAR(B.DATE)" );
        $mScreener->query( "UPDATE TMP_SCREENER A, IDX_YEAR B SET A.YTD = IF(B.PERFORM != '',B.PERFORM,'-') WHERE A.CODE = B.CODE AND YEAR(B.DATE) = {$year}" );
        $mScreener->query( "SELECT * FROM TMP_SCREENER" );
        $row = $mScreener->numrow();
        if ( $row > 0 ) {
            return $mScreener->fetch( "SELECT * FROM TMP_SCREENER" );
        }else {
            return FALSE;
        }
    }
}