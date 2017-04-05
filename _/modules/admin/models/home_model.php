<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model {

    public $table = 'article';
    public $article_description = 'article_description';
    public $article_option = 'article_option';

    function __construct() {
        parent::__construct();
    }
    
    public function showArticles($lang_code = NULL){
        if ($lang_code == NULL):
            $lang_code = $this->session->userdata('curent_language');
        endif;
        $lang_code_default = $this->session->userdata('default_language');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->article_description, $this->table . '.article_id =' . $this->article_description . '.article_id');
        $this->db->join('category_description', $this->table . '.category_id = category_description.category_id');
        $this->db->where('article_description.lang_code', $lang_code);
        $this->db->where('category_description.lang_code', $lang_code_default['code']);
        $this->db->order_by("article.date_modified", "desc");
        $this->db->limit(10);
        return $this->db->get()->result_array();
    }

    public function showUsers(){
        $sql = 'SELECT id,email,username,created_on,last_login,active FROM user ORDER BY created_on DESC limit 0,10';
        return $this->db->query($sql)->result_array();
    }
}