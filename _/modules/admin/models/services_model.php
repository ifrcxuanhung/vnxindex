<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  IMS v3.0
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  services.php
 * ---------------------------------------------------------------------------------------------------------------------
 * Entry Server ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Called By    ：  System
 * ---------------------------------------------------------------------------------------------------------------------
 * Notice       ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Copyright    ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Comment      ：  controller services  
 * ---------------------------------------------------------------------------------------------------------------------
 * History      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Version V001 ：  2013.06.24 (LongNguyen)        New Create 
 * ******************************************************************************************************************* */
class services_model extends CI_Model {

    public $table = 'services';

    function __construct() {
        parent::__construct();
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    function list_services($parentID = '', $stop = "", $data = null, $space = "") {
        if ($parentID != '')
            $this->db->where('parent_id', $parentID);
        else
            $this->db->where('parent_id', 0);
        
        $this->db->from($this->table);
        $this->db->order_by("services.services_id", "desc");
        $query = $this->db->get();
        $rows = $query->result();
        if (isset($rows) == TRUE && is_array($rows) == TRUE) {
            foreach ($rows as $value) {
                $arr = (object) array();
                $arr->services_id = $value->services_id;
                if ($value->parent_id == 0) {
                    $arr->name = $space . '<strong>' . $value->name . '</strong>';
                } else {
                    $arr->name = $space . $value->name;
                }
                $arr->sort_order = $value->sort_order;
                
                $arr->status = $value->status;
                $arr->services_code = $value->services_code;
                $arr->right = unserialize($value->right);
                $arr->parent_id = $value->parent_id;
                $data[] = $arr;
                $data = $this->list_services($value->services_id, $stop, $data, $space . '>> ');
            }
        }
        return $data;
    }
    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    function list_services_fix($parentID = '', $stop = "", $data = null, $space = "") {
        if ($parentID == '')
            $parentID = 0;

        if ($stop != '') {
            $stop = 'services_id !=' . $stop;
        }

        $lang_code = $this->session->userdata('curent_language');
        $lang_code = $lang_code['code'];

        $sql = "SELECT c.services_id, c.`name`, c.sort_order, c.`status`, c.parent_id, c.services_code
                FROM services c
                WHERE 
                c.parent_id = '{$parentID}'
                ORDER BY c.services_id;";
        $rows = $this->db->query($sql)->result();

        $lang_code_default = $this->session->userdata('default_language');
        $lang_code_default = $lang_code_default['code'];

        $sql_2 = "SELECT c.services_id, c.`name`, c.sort_order, c.`status`, c.parent_id, c.services_code
                FROM services c
                WHERE  c.parent_id = '{$parentID}'
                ORDER BY c.services_id;";
        $rows_2 = $this->db->query($sql_2)->result();

        if (isset($rows_2) == TRUE && is_array($rows_2) == TRUE) {
            foreach ($rows_2 as $key => $value) {
                $arr = (object) array();
                $arr->services_id = $value->services_id;
                if (isset($rows[$key]->name) == TRUE && $rows[$key]->name != '')
                    $value->name = $rows[$key]->name;
                if ($value->parent_id == 0) {
                    $arr->name = $space . '<strong>' . $value->name . '</strong>';
                } else {
                    $arr->name = $space . $value->name;
                }
                $arr->services_code = $value->services_code;
                $arr->sort_order = $value->sort_order;
                $arr->status = $value->status;
                $arr->parent_id = $value->parent_id;
                $data[] = $arr;
                $data = $this->list_services_fix($value->services_id, $stop, $data, $space . '>> ');
            }
        }
        return $data;
    }
    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    function list_services_code_fix($parentCode = NULL, $stop = "", $data = null, $space = "") {
        if ($parentCode != NULL)
            $parentCode = " AND c.services_code = '" . $parentCode . "'";

        if ($stop != '') {
            $stop = 'services_id !=' . $stop;
        }

        $lang_code = $this->session->userdata('curent_language');
        $lang_code = $lang_code['code'];

        $sql = "SELECT c.services_id, c.`name`, c.sort_order, c.`status`, c.parent_id, c.services_code
                FROM services c
                WHERE 1=1 ";
        $sql .= $parentCode;
        $sql .= " ORDER BY c.services_id;";

        $rows = $this->db->query($sql)->result();

        $lang_code_default = $this->session->userdata('default_language');
        $lang_code_default = $lang_code_default['code'];

        $sql_2 = "SELECT c.services_id, c.`name`, c.sort_order, c.`status`, c.parent_id, c.services_code
                FROM services c
                WHERE 1=1";
        $sql_2 .= $parentCode;
        $sql_2 .= " ORDER BY c.services_id";
        $rows_2 = $this->db->query($sql_2)->result();

        if (isset($rows_2) == TRUE && is_array($rows_2) == TRUE) {
            foreach ($rows_2 as $key => $value) {
                $arr = (object) array();
                $arr->services_id = $value->services_id;
                if (isset($rows[$key]->name) == TRUE && $rows[$key]->name != '')
                    $value->name = $rows[$key]->name;
                if ($value->parent_id == 0) {
                    $arr->name = $space . '<strong>' . $value->name . '</strong>';
                } else {
                    $arr->name = $space . $value->name;
                }
                $arr->services_code = $value->services_code;
                $arr->sort_order = $value->sort_order;
                $arr->status = $value->status;
                $arr->parent_id = $value->parent_id;
                $data[] = $arr;
                $data = $this->list_services_code_fix($value->services_id, $stop, $data, $space . '>> ');
            }
        }
        return $data;
    }
    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    /* TUAN  ANH get cate theo code */

    function list_services_code($parentCode = null, $lang_code = null, $stop = "", $data = null, $space = "") {
        if ($parentCode != NULL) {
            $this->db->where('services.services_code', $parentCode);
        }
        $query = $this->db->get('services');
        $rows = $query->result();
        $arrservicesid = array();
        foreach ($rows as $item) {
            $arrservicesid = $item->services_id;
        }
        if ($arrservicesid)
            $this->db->where('parent_id', $arrservicesid);
        else
            $this->db->where('parent_id', 0);

        if ($stop) {
            $this->db->where($this->table . '.services_id !=', $stop);
        }
        if ($lang_code == NULL):
            $lang_code = $this->session->userdata('curent_language');
        endif;
        $lang_code_default = $this->session->userdata('default_language');
        $lang_code_default = $lang_code_default['code'];
    
        $this->db->from($this->table);
        $this->db->join($this->services_description, $this->table . '.services_id = ' . $this->services_description . '.services_id');
        $this->db->order_by("services.services_id", "desc");
        $query = $this->db->get();
        $rows = $query->result();
        if ($rows) {
            foreach ($rows as $value) {
                $arr = (object) array();
                $arr->services_id = $value->services_id;
                if ($value->parent_id == 0) {
                    $arr->name = $space . '<strong>' . $value->name . '</strong>';
                } else {
                    $arr->name = $space . $value->name;
                }
                $arr->services_code = $value->services_code;
                $arr->sort_order = $value->sort_order;
                $arr->status = $value->status;
                $arr->parent_id = $value->parent_id;
                $data[] = $arr;
                unset($arr);
                $data = $this->list_services($value->services_id, $stop, $data, $space . '>> ');
            }
        }
        return $data;
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */

    function add($data = NULL, $list_language = NULL) {
        if (is_array($data) == TRUE && is_array($list_language) == TRUE) {
            $data_services = array(
                'services_code' => $data['services_code'],
                'sort_order' => $data['sort_order'],
                'parent_id' => isset($data['parent_id'])?$data['parent_id']:0,
                'status' => $data['status'],
                'name' => $data['name'],
                'description' => $data['description'],
                'date_added' => date('Y-m-d H:i:s'),
                'right'=>serialize($data['right'])
            );
            $this->db->trans_begin();
            $this->db->insert($this->table, $data_services);
            $services_id = $this->db->insert_id();
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
            }
            return TRUE;
        }
// return true;
    }
    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    function edit($data = NULL, $list_language = NULL, $id = NULL) {
        if (is_array($data) == TRUE && is_array($list_language) == TRUE && is_numeric($id) == TRUE) {
            $data_services = array(
                'services_code' => $data['services_code'],
                'sort_order' => $data['sort_order'],
                'parent_id' => isset($data['parent_id'])?$data['parent_id']:0,
                'status' => $data['status'],
                'name' => $data['name'],
                'description' => $data['description'],
                'date_modified' => date('Y-m-d H:i:s'),
                'right'=>serialize($data['right'])
            );
            $this->db->trans_begin();
            $this->db->update($this->table, $data_services, array('services_id' => $id));
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
            }
            return TRUE;
        }
    }
    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    function delete($id) {
        if ($this->list_services($id))
            return false;
        else {
            $this->db->where('services_id', $id);
            $this->db->delete($this->table);
            return true;
        }
    }
    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function change_active($id = NULL, $text = NULL) {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $sql = "UPDATE `services`
                SET `services`.`status` = IF (`services`.`status` = 1, 0, 1)
                WHERE `services`.`services_id` = '{$id}'";
        $this->db->query($sql);
        $text = ($text == "Enable") ? "Disable" : "Enable";
        return $text;
    }
    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    function get_one($id = null, $lang_code = NULL, $status = NULL) {

        if ($id == FALSE):
            return FALSE;
        endif;
        if ($status != NULL) {
            $this->db->where('status', $status);
        }
        $this->db->where('services_id', $id);
        $query = $this->db->get($this->table);
        $data = $query->result_array();

        return $data;
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */

    function find($parent_id = 0, $status = NULL) {
        $this->db->where('parent_id', $parent_id);
        if ($status != NULL) {
            $this->db->where('status', $status);
        }
        $this->db->from($this->table);
        $query = $this->db->get();
        $rows = $query->result();

        if ($rows) {
            $arr = NULL;
            foreach ($rows as $key => $value) {
                $data[$key] = $value;
                $data[$key]->right = unserialize($value->right);
                $data[$key]->sub_cate = $this->list_services($value->services_id);
            }
        }
        return $data;
    }
    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function get_service_info($type,$id)
    {
        $services= $this->db->query("SELECT * FROM services_info WHERE `type`='{$type}' AND `bind`='{$id}' ")->result_array();
        if(is_array($services) && count($services) > 0){
            $services2=array();
            foreach ($services as $key => $value) {
                $services2[$value['services_code']][$value['right']]=$value;
            }
            return $services2;
        }
    }
    /*     * ***********************************************************************************************************
     * Name         ： update_service_info
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function update_service_info($data = NULL, $code = NULL,$type=NULL) {
            $this->db->where('services_code', $code);
            $this->db->where('type', $type);
            $this->db->where('bind', $data['bind']);
            $this->db->where('right', $data['right']);
            $this->db->delete('services_info');
        if(isset($data['active']) && $data['active']==1){
            return $this->db->insert('services_info', $data);
        }
        return FALSE;
    }

}