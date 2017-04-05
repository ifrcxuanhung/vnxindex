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

class Bottomslider_model extends CI_Model {
 	protected $_lang;
    public function __construct() {
        parent::__construct();
		 $this->_lang = $this->session->userdata('curent_language');
		
    }
	
	public function article_by_category($clean_cat){
		if($this->_lang['code'] == 'us') $this->_lang['code'] = 'en'; 
		$this->db->select('*');
		$this->db->where('clean_cat', $clean_cat);
		$this->db->where('lang_code', $this->_lang['code']);
		$this->db->where('status', 1);
		$this->db->limit(5);
		$this->db->order_by("clean_order", "asc"); 
		$query = $this->db->get('ifrc_articles');
		$kq = $query->result_array();
		if (!$kq || empty($kq)) {
			$this->db->select('*');
			$this->db->where('clean_cat', $clean_cat);
			$this->db->where('lang_code', 'en');
			$this->db->where('status', 1);
			$this->db->limit(5);
			$this->db->order_by("clean_order", "asc"); 
			$query = $this->db->get('ifrc_articles');
			$kq = $query->result_array();
		}
		return $kq;
}

}
