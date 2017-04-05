<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  vndb_page_model.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  model vndb_page                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.09.28 (Tung)        New Create      */
/* * ****************************************************************** */


class Vndb_page_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	public function getIdx($idx_code, $where = array()){

		$tables = array('vndb_reference_final', 'vndb_dividends_final', 'vndb_cpaction_final');
		foreach($tables as $table){
			if($table != 'vndb_cpaction_final'){
				$sql = "SELECT A.* FROM {$table} A, (SELECT MAX(_maxdate) AS maxdate FROM {$table} WHERE ticker = '{$idx_code}') B WHERE ticker = '{$idx_code}' AND A._maxdate = B.maxdate";
				if($table != 'vndb_reference_final'){
					$sql = "SELECT * FROM {$table} WHERE ticker = '{$idx_code}' ORDER BY date_ex DESC LIMIT 0, 10";
				}else{
					$sql = "SELECT A.*, C.value FROM {$table} A LEFT JOIN vndb_freefloat_final C ON A.ticker = C.ticker AND A.market = C.market, (SELECT MAX(date) AS maxdate FROM {$table} WHERE ticker = '{$idx_code}') B WHERE A.ticker = '{$idx_code}' AND A.date = B.maxdate";
				}
			}else{
				$sql = "SELECT * FROM {$table} WHERE ticker = '{$idx_code}'";
			}
			// echo $sql . '<br />';
			$query = $this->db->query($sql);
			$info = $query->result_array();
			if(count($info) != 0){
				$data[$table] = $info;
			}else{
				$data[$table] = '';
			}
		}
		return $data;
	}

	public function getMdata($ticker){
		// $this->
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