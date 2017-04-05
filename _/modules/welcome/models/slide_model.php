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

class Slide_model extends CI_Model{
    protected $_table = 'media';
    protected $_table_detail = 'media_description';
    protected $_table_cate = 'category';

    public function __construct(){
        parent::__construct();
    }

    public function media($categoryCode) {
        $lang = $this->session->userdata('curent_language');
        $sql = 'SELECT s.*, d.*
        FROM ' . $this->_table . ' s,' . $this->_table_detail . ' d,' . $this->_table_cate . ' c
        WHERE s.media_id = d.media_id AND s.category_id = c.category_id
        AND s.status = 1
                AND c.category_code="'.$categoryCode.'"
                AND d.lang_code = "' . $lang['code'] . '"
                ORDER BY s.sort_order';
        $sqlDF = 'SELECT s.*, d.*
        FROM ' . $this->_table . ' s,' . $this->_table_detail . ' d,' . $this->_table_cate . ' c
        WHERE s.media_id = d.media_id AND s.category_id = c.category_id
        AND s.status = 1
                AND c.category_code="'.$categoryCode.'"
                AND d.lang_code = "' . LANG_DEFAULT . '"
                ORDER BY s.sort_order';
        $data['curent'] = $this->db->query($sql)->result_array();
        $data['default'] = $this->db->query($sqlDF)->result_array();
        if ($data['curent']) {
            $data['curent'] = replaceValueNull($data['curent'], $data['default']);
        }
       //echo "<pre>";print_r($sql);exit;
        return $data;
    }
}