<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  slide_model.php                       */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  model slide                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.09.28 (Tung)        New Create      */
/* * ****************************************************************** */

class Tickers_model extends CI_Model{
    protected $_idx_ref = 'index_idx_ref';
    protected $_idx_specs = 'idx_specs';

    public function __construct(){
        parent::__construct();
        $this->db3 = $this->load->database('database3', TRUE);
    }

    public function getTickers() {
        $data = '';
        $sql = "SELECT RTRIM(LTRIM(REPLACE(REPLACE({$this->_idx_specs}.idx_name,'IFRC',''),'(VND)',''))) as idx_name, {$this->_idx_specs}.idx_last, {$this->_idx_specs}.idx_var, {$this->_idx_specs}.date
                FROM `{$this->_idx_specs}` JOIN {$this->_idx_ref}
                ON {$this->_idx_specs}.idx_code = {$this->_idx_ref}.idx_code
                WHERE {$this->_idx_specs}.`idx_code` = {$this->_idx_specs}.`idx_mother` and {$this->_idx_ref}.publications=1
                ORDER BY {$this->_idx_ref}.ims_order";
       // echo "<pre>";print_r($sql);exit;
        $data = $this->db3->query($sql)->result_array();
		
        return $data;
    }
    public function getTickers2() {
        $data = '';
       /* $sql = "select a.date, REPLACE(b.idx_name_sn,' (VND)','') as idx_name_sn, varyear from obs_home as a, idx_ref as b 
                                        where a.code= b.idx_mother and a.code <>'PVN05PRVND' and  a.provider in('IFRC', 'IFRCLAB','PVN') 
                                       and year(a.date)=year(curdate()) group by a.code  order by a.varyear desc limit 10";*/
		$sql = "select a.date, REPLACE(b.idx_name_sn,' (VND)','') as idx_name_sn, varyear from obs_home_vn as a, index_idx_ref as b 
                                        where a.code= b.idx_mother and a.code <>'PVN05PRVND' and  a.provider in('IFRC', 'IFRCLAB','PVN') 
                                       group by a.code  order by a.date desc, a.varyear desc limit 10";
        $data = $this->db3->query($sql)->result_array();
		//echo "<pre>";print_r($data);exit; 
        return $data;
        
    }

}