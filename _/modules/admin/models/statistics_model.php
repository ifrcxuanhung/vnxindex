<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  article.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  model article                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.08.14 (Tung)        New Create      */
/* * ****************************************************************** */

class Statistics_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function shliStatistics() {
        //if ($this->input->is_ajax_request()) {
            $from = microtime(true);
            //$f = fopen($_SERVER['DOCUMENT_ROOT'] . '/ifrcdata/assets/test/a.php', 'a');
            set_time_limit(0);
            $list_ticker = $this->db->query("select DISTINCT ticker from shli_statistics order by ticker asc")->result_array();
            foreach ($list_ticker as $vlist_ticker) {
                $data_update = array();
                $arr = $this->db->query("select id,FPT,VSTX,VSTH, shli from shli_statistics where ticker = '{$vlist_ticker['ticker']}'  ORDER BY `date` asc")->result_array();
                // $arr = $this->db->query("select id,VSTH from shli_statistics where ticker = '{$vlist_ticker['ticker']}'  ORDER BY `date` asc")->result_array();
               $arr_plus = array('VSTX', 'FPT', 'VSTH', 'shli');
                // $arr_plus = array('FPT');
                $max = count($arr);
                foreach($arr_plus as $value_arr_plus){
                    for ($i = 0; $i < $max - 1; $i++) {
                        //foreach ($arr_plus as $value_arr_plus) {
                            if ($arr[$i][$value_arr_plus] != 0 && $arr[$i][$value_arr_plus] != '') {
                                for ($j = $i + 1; $j < $max; $j++) {
                                    if ($arr[$j][$value_arr_plus] != 0 && $arr[$j][$value_arr_plus] != '') {
                                        if ($arr[$j][$value_arr_plus] == $arr[$i][$value_arr_plus]) {
                                            
                                            for ($k = $i + 1; $k < $j; $k++) {
                                                // $contents = $value_arr_plus . ' ' . $i . ' ' . $j . PHP_EOL;
                                                // fwrite($f, $contents);
                                                //$arr[$k][$value_arr_plus] = $arr[$i][$value_arr_plus];
                                                $data_update[$k]['id'] = $arr[$k]['id'];
                                                $data_update[$k][$value_arr_plus] = $arr[$i][$value_arr_plus];
                                                //pre($data_update[$k]);
                                                
                                            }
                                        }
                                        $i = $j - 1;
                                        break;
                                    }
                                }
                            }
                        //}
                    }
                }
                //pre($data_update);
                if(!empty($data_update)){
                    //pre($data_update);
                    $this->db->update_batch('shli_statistics', $data_update, 'id');
                }
            }
            $total = microtime(true) - $from;
            echo $total;
        //}
    }

    public function shouStatistics() {
        //if ($this->input->is_ajax_request()) {
            $from = microtime(true);
            //$f = fopen($_SERVER['DOCUMENT_ROOT'] . '/ifrcdata/assets/test/a.php', 'a');
            set_time_limit(0);
            $list_ticker = $this->db->query("select DISTINCT ticker from vndb_shares order by ticker asc")->result_array();
            foreach ($list_ticker as $vlist_ticker) {
                $data_update = array();
                // $arr = $this->db->query("select id,shou_fpt,shou_cafef,shou_vstx,shou_vsth,shou_stp from vndb_shares where ticker = '{$vlist_ticker['ticker']}'  ORDER BY `date` asc")->result_array();
                $arr = $this->db->query("select id,shli_fpt,shli_cafef,shli_vstx,shli_vsth,shli_exc,shli_final,shli_final,shou_cafef,shou_vstx,shou_vsth,shou_exc,shou_final from vndb_shares where ticker = '{$vlist_ticker['ticker']}'  ORDER BY `date` asc")->result_array();
                // $arr = $this->db->query("select id,VSTH from shli_statistics where ticker = '{$vlist_ticker['ticker']}'  ORDER BY `date` asc")->result_array();
                $arr_plus = array('shli_fpt','shli_cafef','shli_vstx','shli_vsth','shli_exc','shli_final');
                // $arr_plus = array('shli_fpt','shli_cafef','shli_vstx','shli_vsth','shli_exc','shli_final','shou_cafef','shou_vstx','shou_vsth','shou_exc','shou_final');
                // $arr_plus = array('FPT');
                $max = count($arr);
                foreach($arr_plus as $value_arr_plus){
                    for ($i = 0; $i < $max - 1; $i++) {
                        //foreach ($arr_plus as $value_arr_plus) {
                            if ($arr[$i][$value_arr_plus] != 0 && $arr[$i][$value_arr_plus] != '') {
                                for ($j = $i + 1; $j < $max; $j++) {
                                    if ($arr[$j][$value_arr_plus] != 0 && $arr[$j][$value_arr_plus] != '') {
                                        if ($arr[$j][$value_arr_plus] == $arr[$i][$value_arr_plus]) {
                                            
                                            for ($k = $i + 1; $k < $j; $k++) {
                                                // $contents = $value_arr_plus . ' ' . $i . ' ' . $j . PHP_EOL;
                                                // fwrite($f, $contents);
                                                //$arr[$k][$value_arr_plus] = $arr[$i][$value_arr_plus];
                                                $data_update[$k]['id'] = $arr[$k]['id'];
                                                $data_update[$k][$value_arr_plus] = $arr[$i][$value_arr_plus];
                                                //pre($data_update[$k]);
                                                
                                            }
                                        }
                                        $i = $j - 1;
                                        break;
                                    }
                                }
                            }
                        //}
                    }
                }
                //pre($data_update);
                if(!empty($data_update)){
                    //pre($data_update);
                    $this->db->update_batch('vndb_shares', $data_update, 'id');
                }
            }
            $total = microtime(true) - $from;
            echo $total;
        //}
    }
    public function update_statistics(){
        set_time_limit(0);
        $data_table = array(
            /* Economics ------------------------------------------------------------------------------------------------------ */
            'eco_ref' => array(
                'type' => 'Economics',
                'table' => 'vndb_economics_ref',
                'join' => '',
                'link' => 'economic',
                'name' => 'REFERENCE',
                'stocks' => 'code',
                'from' => '',
                'filter' => '',
                'class' => ''
            ),
			'eco_data' => array(
                'type' => 'Economics',
                'table' => 'vndb_economics_data',
                'join' => '',
                'link' => 'economic',
                'name' => 'DATA',
                'stocks' => 'indcode',
                'from' => 'year',
                'filter' => '',
                'class' => ''
            ),
			'fin' => array(
                'type' => 'Economics',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'FINANCIALS',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => ''
            ),
            'nfin' => array(
                'type' => 'Economics',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'NOT FINANCIALS',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => ''
            ),
            /* Currencies ------------------------------------------------------------------------------------------------------ */
            'curr_ref' => array(
                'type' => 'Currencies',
                'table' => 'vndb_currency_ref',
                'join' => '',
                'link' => 'currency',
                'name' => 'REFERENCE',
                'stocks' => 'curr_code',
                'from' => '',
                'filter' => '',
                'class' => ''
            ),
            'curr_d' => array(
                'type' => 'Currencies',
                'table' => 'vndb_currency_day',
                'join' => '',
                'link' => 'currency',
                'name' => 'DATA',
                'stocks' => 'code',
                'from' => 'date',
                'filter' => '',
                'class' => ''
            ),
            /*'curr_m' => array(
                'type' => 'Currencies',
                'table' => 'vndb_currency_month',
                'join' => '',
                'link' => 'currency',
                'name' => 'MONTHLY',
                'stocks' => 'code',
                'from' => 'date',
                'filter' => '',
                'class' => ''
            ),
            'curr_y' => array(
                'type' => 'Currencies',
                'table' => 'vndb_currency_year',
                'join' => '',
                'link' => 'currency',
                'name' => 'YEAR',
                'stocks' => 'code',
                'from' => 'date',
                'filter' => '',
                'class' => ''
            ),*/
            'curr_etf' => array(
                'type' => 'Currencies',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'ETF',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => ''
            ),
            /* Equities ------------------------------------------------------------------------------------------------------ */
            'ref' => array(
                'type' => 'Equities',
                'table' => 'vndb_reference_final',
                'join' => '',
                'link' => 'reference',
                'name' => 'REFERENCES',
                'stocks' => 'ticker',
                'from' => 'date',
                'filter' => '',
                'class' => ''
            ),
            'pri' => array(
                'type' => 'Equities',
                'table' => 'vndb_prices_final',
                'join' => '',
                'link' => 'prices',
                'name' => 'PRICES & VOLUMES',
                'stocks' => 'ticker',
                'from' => 'date',
                'filter' => '',
                'class' => ''
            ),
            'div' => array(
                'type' => 'Equities',
                'table' => 'vndb_dividends_final',
                'join' => '',
                'link' => 'dividends',
                'name' => 'DIVIDENDS',
                'stocks' => 'ticker',
                'from' => 'date_ex',
                'filter' => '',
                'class' => ''
            ),
            'cpa' => array(
                'type' => 'Equities',
                'table' => 'vndb_cpaction_final',
                'join' => '',
                'link' => 'cpaction',
                'name' => 'CORPORATE ACTIONS',
                'stocks' => 'ticker',
                'from' => 'date_ex',
                'filter' => "date_ex <> '0000-00-00'",
                'class' => ''
            ),
            'fun' => array(
                'type' => 'Equities',
                'table' => 'vndb_fundamental',
                'join' => '',
                'link' => 'fundamental',
                'name' => 'FUNDAMENTAL',
                'stocks' => 'ticker',
                'from' => 'date',
                'filter' => '',
                'class' => ''
            ),
            /* Commodities ------------------------------------------------------------------------------------------------------ */
            'com_phy' => array(
                'type' => 'Commodities',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'PHYSICAL',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => 'no_active'
            ),
            'com_der' => array(
                'type' => 'Commodities',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'DERIVATIVES',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => 'no_active'
            ),
            'com_etf' => array(
                'type' => 'Commodities',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'ETF',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => 'no_active'
            ),
            /* Bond ------------------------------------------------------------------------------------------------------ */
            'bon_ref' => array(
                'type' => 'Bond',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'REFERENCES',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => 'no_active'
            ),
            'bon_pri' => array(
                'type' => 'Bond',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'PRICES & VOLUMES',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => 'no_active'
            ),
            'bon_etf' => array(
                'type' => 'Bond',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'ETF',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => 'no_active'
            ),
            /* Indexes ------------------------------------------------------------------------------------------------------ */
            'inx_vie' => array(
                'type' => 'Indexes',
                'table' => 'idx_equity_day',
                'join' => 'idx_sample|idx_equity_day.code|idx_sample.code',
                'link' => 'indexes/vietnam',
                'name' => 'VIETNAM',
                'stocks' => 'idx_sample.name',
                'from' => 'launch',
                'filter' => "idx_sample.place = 'VIETNAM'",
                'class' => ''
            ),
            'inx_int' => array(
                'type' => 'Indexes',
                'table' => 'idx_equity_day',
                'join' => 'idx_sample|idx_equity_day.code|idx_sample.code',
                'link' => 'indexes/international',
                'name' => 'INTERNATIONAL',
                'stocks' => 'idx_equity_day.code',
                'from' => 'launch',
                'filter' => "idx_sample.place <> 'VIETNAM'",
                'class' => ''
            ),
            'inx_ifr' => array(
                'type' => 'Indexes',
                'table' => 'idx_equity_day',
                'join' => 'idx_sample|idx_equity_day.code|idx_sample.code',
                'link' => 'indexes/ifrc',
                'name' => 'IFRC',
                'stocks' => 'idx_equity_day.code',
                'from' => 'launch',
                'filter' => "idx_sample.provider = 'IFRC'",
                'class' => ''
            ),
            'inx_etf' => array(
                'type' => 'Indexes',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => 'ETF',
                'stocks' => '',
                'from' => '',
                'filter' => "",
                'class' => ''
            ),
			/* International data ------------------------------------------------------------------------------------------------------ */
            'innter_ref' => array(
                'type' => 'International Data',
                'table' => '',
                'join' => '',
                'link' => '',
                'name' => '',
                'stocks' => '',
                'from' => '',
                'filter' => '',
                'class' => 'no_active'
            ),
        );
        foreach($data_table as $name => $table){
            //if($table['type'] != 'Indexes'){
                if($table['from'] != ''){
                    $filter_form = "min(if(". $table['from'] ." = '0000-00-00' OR ". $table['from'] ." = '', '9999-12-31',". $table['from'] .")) as `from`";
                }else{
                    $filter_form = "'' as `from`";
                }
                if($table['table'] != ''){
                    $first_sql = "SELECT '".$table['type']."' as `type`, '".$table['table']."' as `table`, '".$table['name']."' as name, '".$table['link']."' as link, count(DISTINCT ". $table['stocks'] .") as stocks, count(*) as entries, ".$filter_form.", '".$table['class']."' as class FROM ";
                    if($table['join'] != ''){
                        $data_join = explode('|',$table['join']);
                        $medium_sql = $table['table']." join ".$data_join[0]." on ".$data_join[1]." = ".$data_join[2];
                    }else{
                        $medium_sql = $table['table'];
                    }
                    if($table['filter'] == ''){
                        $data_result[$name] = $this->db->query($first_sql.$medium_sql)->row_array();
                    }else{
                        $data_result[$name] = $this->db->query($first_sql.$medium_sql ." WHERE ".$table['filter'])->row_array();
                    }
                }else{
                    $sql = "SELECT '".$table['type']."' as `type`, '".$table['table']."' as `table`, '".$table['name']."' as name, '".$table['link']."' as link, 0 as stocks, 0 as entries, '' as `from`, '".$table['class']."' as class";
                    $data_result[$name] = $this->db->query($sql)->row_array();
                }
            //}
        }
        foreach($data_result as $dr_k => $dr_v){
            $data_insert[] = $dr_v;
        }
        $this->db->query('TRUNCATE TABLE statistics_table');
        $this->db->insert_batch('statistics_table',$data_insert);
    }

}