<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Etf_screener_model extends CI_Model {

    protected $_table = 'ETFDB_ALL';
    
    function __construct() {
        parent::__construct();
    }
    
    function get_data(){
            $this->db->query("OPTIMIZE TABLE $this->_table");
            $result = $this->db->query("SELECT A.*,B.count_all  FROM {$this->_table} A, (SELECT COUNT(*) AS count_all FROM {$this->_table})B")->result_array();
            $count_all = number_format($result[0]['count_all']);
            foreach($result as $rs){
                if($rs['country'] != ''){
                    $country[] = $rs['country'];
                }else{
                    $country[] = '(Empty Country)';
                }
                if($rs['expense_ratio'] != ''){
                    $expense_ratio[] = $rs['expense_ratio'];
                }else{
                    $expense_ratio[] = '0';
                }
                if($rs['issuer'] != ''){
                    $issuer[] = $rs['issuer'];
                }else{
                    $issuer[] = '(Empty Issuer)';
                }
                if($rs['structure'] != ''){
                    $structure[] = $rs['structure'];
                }else{
                    $structure[] = '(Empty Structure)';
                }
                if($rs['size'] != ''){
                    $size[] = $rs['size'];
                }else{
                    $size[] = '(Empty Size)';
                }
                if($rs['style'] != ''){
                    $style[] = $rs['style'];
                }else{
                    $style[] = '(Empty Style)';
                }
                if($rs['region_gen'] != ''){
                    $region_gen[] = $rs['region_gen'];
                }else{
                    $region_gen[] = '(Empty General)';
                }
                if($rs['region_spe'] != ''){
                    $region_spe[] = $rs['region_spe'];
                }else{
                    $region_spe[] = '(Empty Specific)';
                }
                if($rs['currency'] != ''){
                    $currency[] = $rs['currency'];
                }else{
                    $currency[] = '(Empty Currency)';
                }
                if($rs['price'] != ''){
                    $price[] = $rs['price'];
                }else{
                    $price[] = '0';
                }
                if($rs['aum'] != ''){
                    $aum[] = $rs['aum'];
                }else{
                    $aum[] = '0';
                }
            }
            sort($country);
            sort($expense_ratio);
            sort($issuer);
            sort($structure);
            sort($size);
            sort($style);
            sort($region_gen);
            sort($region_spe);
            sort($currency);
            sort($price);
            sort($aum);
            $data['count'] = $count_all;
            $data['country'] = array_unique($country);
            $data['expense_ratio'] = array_unique($expense_ratio);
            $data['issuer'] = array_unique($issuer);
            $data['structure'] = array_unique($structure);
            $data['size'] = array_unique($size);
            $data['style'] = array_unique($style);
            $data['region_gen'] = array_unique($region_gen);
            $data['region_spe'] = array_unique($region_spe);
            $data['currency'] = array_unique($currency);
            $data['price'] = array_unique($price);
            $data['aum'] = array_unique($aum);
            $data['min_ratio'] = min($expense_ratio);
            $data['max_ratio'] = max($expense_ratio);
            $data['min_price'] = min($price);
            $data['max_price'] = max($price);
            $data['min_aum'] = min($aum);
            $data['max_aum'] = max($aum);
            //pre($data);
            return $data;
	}

}
