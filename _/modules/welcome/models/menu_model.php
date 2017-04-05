<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  menu_model.php               	      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  model calendar_page                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.09.28 (Tung)        New Create      */
/* * ****************************************************************** */

class Menu_model extends CI_Model {

    protected $_table = 'menu';
    protected $_table_detail = 'menu_description';

    public function __construct() {
        parent::__construct();
    }

    public function load_top_menu() {
        $lang = $this->session->userdata('curent_language');
        $sql = 'SELECT d.menu_id,m.link,d.name 
                FROM ' . $this->_table . ' m,' . $this->_table_detail . ' d
        WHERE
                    m.id = d.menu_id
        AND
                    d.lang_code = "' . $lang['code'] . '"
        AND
                    m.parent_id = 7
        AND
                    m.status = 1
                ORDER BY sort_order ASC';
        $sqlDF = 'SELECT d.menu_id,m.link,d.name
                FROM ' . $this->_table . ' m,' . $this->_table_detail . ' d
                WHERE
                    m.id = d.menu_id
        AND
                    d.lang_code = "' . LANG_DEFAULT . '"
        AND
                    m.parent_id = 7
        AND
                    m.status = 1
        ORDER BY sort_order ASC';
        $data['curent'] = $this->db->query($sql)->result_array();
        $data['default'] = $this->db->query($sqlDF)->result_array();
        if ($data['curent']) {
            $data['curent'] = replaceValueNull($data['curent'], $data['default']);
        }
        return $data;
    }

    public function show_menu_treeview($data, $level = 0) {
        $menu = '';
        if ($data) {
			//echo "<pre>";print_r($data);exit;
            foreach ($data as $value) {
                if (strpos($value['link'], "http") === false) {
                    $value['link'] = base_url() . $value['link'];
                }
                if ($level == 0) {
                    $menu.='<li class="menu-item menu-item-type-custom menu-item-object-custom parent">
                            <a href="' . $value['link'] . '">' . $value['name'] . '</a>';
                } else {
                    $menu.='    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="' . $value['link'] . '">' . $value['name'] . '</a>';
                }
                if ($value['sub']) {
                    $menu.='
                                <ul class="sub-menu">
                                ';
                    $menu.=$this->show_menu_treeview($value['sub'], 1);
                    $menu.='</ul>';
                }
                if ($level == 0) {
                    $menu.='
                        </li>
                        ';
                } else {
                    $menu.= '
                                    </li>   
                                ';
                }
            }
            return $menu;
        }
    }

    public function list_menu($mother_code = 0, $data = NULL) {
        if (!$data) {
            $data = array();
        }
        $lang = $this->session->userdata('curent_language');
        $sql = 'SELECT m.id as menuid,m.parent_id as pid,m.link,d.name 
                FROM menu m,menu_description d 
                WHERE 
                    d.lang_code = "' . $lang['code'] . '" 
                AND
                    d.menu_id = m.id 
                AND 
                    m.parent_id=' . $mother_code . '
                AND 
                    m.status = 1
                ORDER BY sort_order ASC';
        $sqlDF = 'SELECT m.id as menuid,m.parent_id as pid,m.link,d.name 
                FROM menu m,menu_description d 
                WHERE 
                    d.lang_code = "' . LANG_DEFAULT . '" 
                AND
                    d.menu_id = m.id 
                AND 
                    m.parent_id=' . $mother_code . '
                AND 
                    m.status = 1
                ORDER BY sort_order ASC';
        $row = $this->db->query($sql)->result_array();
        $rowDF = $this->db->query($sqlDF)->result_array();
        if ($row) {
            $row = replaceValueNull($row, $rowDF);
        }
        if ($row)
            foreach ($row as $key => $value) {
                $data[$key] = $value;
                $data[$key]['sub'] = $this->list_menu($value['menuid']);
            }
        return $data;
    }

}
