<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  idx_page_model.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  model idx_page                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.09.28 (Tung)        New Create      */
/* * ****************************************************************** */


class Idx_page_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	public function getIdx($idx_code){
		$tables = array('idx_ref', 'idx_ca', 'idx_composition', 'idx_specs');
		foreach($tables as $table){
			if($table == 'idx_ref'){
				//$this->db->join('sec_ref', 'sec_code = stk_sector', 'left');
				//$this->db->join('mar_ref', 'mar_code = stk_market', 'left');
				//$this->db->join('idx_ref', 'idx_code = idx_mother');
				$this->db->select('r1.idx_code, r1.idx_curr, r1.idx_base, r1.idx_dtbase, r1.idx_type, r1.idx_bbs, r1.idx_mother, r2.idx_name_sn AS idx_name_sn, r1.idx_name_sn AS idx_name_sn2');
				$this->db->from('idx_ref r1');
				$this->db->join('idx_ref r2', 'r2.idx_code = r1.idx_mother');
				$this->db->where('r1.idx_code', $idx_code);
			}else{
				$this->db->from($table);
				if($table == 'idx_composition'){
					$this->db->select('exdate, stk_divnet, stk_divgross, idx_composition.stk_code as code1, stk_div.stk_code as code2, idx_composition.stk_name as name1, stk_div.stk_name as name2, stk_price, stk_shares_idx, stk_capp_idx, stk_float_idx, stk_mcap_idx, stk_wgt');
					$this->db->join('stk_div', 'stk_div.stk_code = idx_composition.stk_code', 'left');
				}
				if($data['idx_ref'] != ''){
					$this->db->where('idx_code', $data['idx_ref'][0]['idx_mother']);
				}else{
					$this->db->get();
					return false;
				}
			}
			$query = $this->db->get();
			$info = $query->result_array();
			if(count($info) != 0){
				$data[$table] = $info;
			}else{
				$data[$table] = '';
			}
		}
		return $data;
	}

	public function showLinkedIndex($code){
		$this->db->select('idx_mother');
		$this->db->where('idx_code', $code);
		$rows = $this->db->get('idx_specs')->result_array();
		$this->db->where('idx_mother', $rows[0]['idx_mother']);
		return $this->db->count_all_results('idx_specs');
	}

	public function findSpecs($code){
		$this->db->select('idx_code, idx_name');
		$this->db->where('idx_mother', $code);
		$query = $this->db->get('idx_specs');
		$rows = $query->result_array();
		foreach($rows as $item){
			$data[] = array($item['idx_code'], $item['idx_name']);
		}
		return $data;
	}
}