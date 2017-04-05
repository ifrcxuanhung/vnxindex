<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends CI_Model{

    public function __construct() {
        parent::__construct();
    }
    
    public function getCategoryByCodeParent($code_parent)
    {
        $lang = $this->session->userdata('curent_language');
        $lang_code = $lang['code'];
        $lang_default = LANG_DEFAULT;
        
        $sql = "SELECT c.category_id, c.category_code, c.image, c.parent_id, cd.`name`, cd.description 
                FROM category c, category_description cd, (SELECT category_id FROM category WHERE category_code = '$code_parent') cp
                WHERE c.category_id = cd.category_id AND c.parent_id = cp.category_id
                AND cd.lang_code = '$lang_code' AND c.status = 1 
                ORDER BY sort_order";
        
        $sqlDF = "SELECT c.category_id, c.category_code, c.image, c.parent_id, cd.`name`, cd.description 
                FROM category c, category_description cd, (SELECT category_id FROM category WHERE category_code = '$code_parent') cp
                WHERE c.category_id = cd.category_id AND c.parent_id = cp.category_id
                AND cd.lang_code = '$lang_default' AND c.status = 1 
                ORDER BY sort_order";
        
        $data['curent'] = $this->db->query($sql)->result_array();
        $data['default'] = $this->db->query($sqlDF)->result_array();
        if ($data['curent']) {
            $data['curent'] = replaceValueNull($data['curent'], $data['default']);
        }
        return $data;
    }
}
    