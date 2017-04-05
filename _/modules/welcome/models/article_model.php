<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  article_model.php               	      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  model article                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.09.28 (Tung)        New Create      */
/* * ****************************************************************** */

class Article_model extends CI_Model{
    protected $_table = 'article';
    protected $_table_detail = 'article_description';
    protected $_table_cate = 'category';
    protected $_table_cate_detail = 'category_description';
    protected $_lang;

	public function __construct(){
		parent::__construct();
        $this->_lang = $this->session->userdata('curent_language');
	}

	public function list_article_cate($codeCate, $limit=null) {
        $data = '';
        if ($limit) {
            $limit = "LIMIT $limit";
        }
        $this->db->select('category_id');
        $this->db->where('category_code', $codeCate);
        $rows = $this->db->get($this->_table_cate)->row_array();
        if(!empty($rows)){
            $listcodeCate = $this->ds_code_cate_news($rows['category_id']);
            $cate = $rows['category_id'];
            foreach ($listcodeCate as $key => $value) {
                $cate .= "," . $value['category_id'];
            }
            $sql = 'SELECT d.article_id,d.title,d.file,d.description,d.long_description,n.date_added,n.article_id as newsid,n.category_id,n.image,n.date_added,c.name as catename,
                    (SELECT ' . $this->_table_cate . '.category_code FROM ' . $this->_table_cate . ' WHERE ' . $this->_table_cate . '.category_id = n.category_id LIMIT 1) category_code
                    FROM ' . $this->_table . ' n, ' . $this->_table_detail . ' d, ' . $this->_table_cate_detail . ' c
                    WHERE 
                        n.category_id in (' . $cate . ') 
                    AND 
                        n.article_id = d.article_id 
                    AND 
                        n.status = 1 
                    AND 
                        d.lang_code = "' . $this->_lang['code'] . '"
                    AND 
                        c.lang_code = "' . $this->_lang['code'] . '" 
                    AND 
                        c.category_id = n.category_id 
                    ORDER BY n.sort_order ASC ' . $limit;
            $sqlDF = 'SELECT d.article_id,d.title,d.file,d.description,d.long_description,n.date_added,n.article_id as newsid,n.category_id,n.image,n.date_added,c.name as catename,
                    (SELECT ' . $this->_table_cate . '.category_code FROM ' . $this->_table_cate . ' WHERE ' . $this->_table_cate . '.category_id = n.category_id LIMIT 1) category_code
                    FROM ' . $this->_table . ' n, ' . $this->_table_detail . ' d, ' . $this->_table_cate_detail . ' c
                    WHERE 
                        n.category_id in (' . $cate . ') 
                    AND 
                        n.article_id = d.article_id 
                    AND 
                        n.status = 1 
                    AND 
                        d.lang_code = "' . LANG_DEFAULT . '"
                    AND 
                        c.lang_code = "' . LANG_DEFAULT . '" 
                    AND 
                        c.category_id = n.category_id 
                    ORDER BY n.sort_order ASC ' . $limit;
            $data['curent'] = $this->db->query($sql)->result_array();
            $data['default'] = $this->db->query($sqlDF)->result_array();
            if ($data['curent'] || empty($data['curent'])) {
                $data['curent'] = replaceValueNull($data['curent'], $data['default']);
            }
        }
        return $data;
    }

    public function num_row_article_cate($codeCate) {
        $data = '';

        $this->db->select('category_id');
        $this->db->where('category_code', $codeCate);
        $rows = $this->db->get($this->_table_cate)->row_array();
        if(!empty($rows)){
            $listcodeCate = $this->ds_code_cate_news($rows['category_id']);
            $cate = $rows['category_id'];
            foreach ($listcodeCate as $key => $value) {
                $cate .= "," . $value['category_id'];
            }
            $sql = 'SELECT count(*) as num_row 
                    FROM ' . $this->_table . ' n, ' . $this->_table_detail . ' d, ' . $this->_table_cate_detail . ' c
                    WHERE 
                        n.category_id in (' . $cate . ') 
                    AND 
                        n.article_id = d.article_id 
                    AND 
                        n.status = 1 
                    AND 
                        d.lang_code = "' . $this->_lang['code'] . '"
                    AND 
                        c.lang_code = "' . $this->_lang['code'] . '" 
                    AND 
                        c.category_id = n.category_id ';
            $data = $this->db->query($sql)->result_array();
        }
        $post_per_page =  $this->config->item('post_per_page');
        $num_row = $data[0]['num_row'];
        $num_page = ceil($num_row/$post_per_page);
        $num_page = max(1,$num_page);
        return $num_page;
    }

    public function get_cate($code) {
        $data = '';
        $this->db->select('category_id');
        $this->db->where('category_code', $code);
        $rows = $this->db->get($this->_table_cate)->row_array();
        if(!empty($rows)){
            $sql = "SELECT name,category_id
            FROM " . $this->_table_cate_detail . "
            WHERE 
                        lang_code = '" . $this->_lang['code'] . "'
            AND 
                        category_id = '" . $rows['category_id'] . "'";
            $sqlDF = "SELECT name,category_id
            FROM " . $this->_table_cate_detail . "
            WHERE 
                        lang_code = '" . LANG_DEFAULT . "'
            AND 
                        category_id = '" . $rows['category_id'] . "'";
            $data['curent'] = $this->db->query($sql)->row_array();
            $data['default'] = $this->db->query($sqlDF)->row_array();
            if ($data['curent'] || empty($data['curent'])) {
                $data['curent'] = replaceValueNull($data['curent'], $data['default']);
            }
        }
        return $data;
    }

    public function ds_code_cate_news($parent_id = '', $data = NULL) {
        if (!$data)
            $data = array();

        // $row = $this->select('cate_news', '*', "parent_id = '$parent_id'", ' sort_order asc');
        $this->db->where('parent_id', $parent_id);
        $this->db->order_by('sort_order', 'ASC');
        $row = $this->db->get($this->_table_cate)->result_array();
        if (count($row) > 0)
            foreach ($row as $key => $value) {
                // $name = $this->select('cate_news_detail', 'name', "code_cate_news = '$value[code_cate_news]' and lang_code = '$this->lang['code']'");
                $this->db->select('name');
                $this->db->where('category_id', $value['category_id']);
                $this->db->where('lang_code', $this->_lang['code']);
                $name = $this->db->get($this->_table_cate_detail)->result_array();
                $data[] = array('category_id' => $value['category_id'], 'name' => $name[0]['name']);
                $data = $this->ds_code_cate_news($value['category_id'], $data);
            }
        return $data;
    }

    public function list_article_two_cate($codeCate1, $codeCate2) {
        $data = ''; 
        $this->db->select('category_id');
        $this->db->where('category_code', $codeCate1);
        $rows = $this->db->get($this->_table_cate)->row_array();
        if(!empty($rows)){
            $listcodeCate1 = $this->ds_code_cate_news($rows['category_id']);
            $cate = "'" . $rows['category_id'] . "'";
            foreach ($listcodeCate1 as $key => $value) {
                $cate .= ",'" . $value['category_id'] . "'";
            }
        }

        $this->db->select('category_id');
        $this->db->where('category_code', $codeCate1);
        $rows = $this->db->get($this->_table_cate)->row_array();

        if(!empty($rows)){
            $listcodeCate2 = $this->ds_code_cate_news($rows['category_id']);
            $cate = "'" . $rows['category_id'] . "'";
            foreach ($listcodeCate2 as $key => $value) {
                $cate .= ",'" . $value['category_id'] . "'";
            }
        }

        if(isset($cate)){
            $sql = 'SELECT d.article_id,d.title,d.description,d.long_description,n.date_modified,n.article_id as newsid,n.category_id,n.image,c.name as catename,
                    (SELECT ' . $this->_table_cate . '.category_code FROM ' . $this->_table_cate . ' WHERE ' . $this->_table_cate . '.category_id = n.category_id LIMIT 1) category_code
                    FROM ' . $this->_table . ' n, ' . $this->_table_detail . ' d, ' . $this->_table_cate_detail . ' c
                    WHERE 
                        n.category_id in (' . $cate . ')
                    AND 
                        n.article_id = d.article_id
                    AND 
                        n.status = 1 
                    AND 
                        d.lang_code = "' . $this->_lang['code'] . '"
                    AND 
                        c.lang_code = "' . $this->_lang['code'] . '" 
                    AND 
                        c.category_id = n.category_id 
                    GROUP BY n.article_id
                    ORDER BY n.sort_order ASC ';
            $sqlDF = 'SELECT d.article_id,d.title,d.description,d.long_description,n.date_modified,n.article_id as newsid,n.category_id,n.image,c.name as catename,
                    (SELECT ' . $this->_table_cate . '.category_code FROM ' . $this->_table_cate . ' WHERE ' . $this->_table_cate . '.category_id = n.category_id LIMIT 1) category_code
                    FROM ' . $this->_table . ' n, ' . $this->_table_detail . ' d, ' . $this->_table_cate_detail . ' c
                    WHERE 
                        n.category_id in (' . $cate . ')
                    AND 
                        n.article_id = d.article_id
                    AND 
                        n.status = 1  
                    AND 
                        d.lang_code = "' . LANG_DEFAULT . '"
                    AND 
                        c.lang_code = "' . LANG_DEFAULT . '" 
                    AND 
                        c.category_id = n.category_id 
                    GROUP BY n.article_id
                    ORDER BY n.sort_order ASC ';
            $data['curent'] = $this->db->query($sql)->result_array();
            $data['default'] = $this->db->query($sqlDF)->result_array();
            if ($data['curent'] || empty($data['curent'])) {
                $data['curent'] = replaceValueNull($data['curent'], $data['default']);
            }
        }
        return $data;
    }
	
	public function get_ifrc_article($code){
		
			
		if($this->_lang['code'] == 'us'){
			$this->_lang['code'] = 'en';
		}
	
		 $sql = "SELECT *
                    FROM ifrc_articles
       WHERE clean_cat = '{$code}' AND status = 1 AND lang_code = '".$this->_lang['code']."'";
		$result  = $this->db->query($sql)->result_array();
		 
		return $result;
         	
	}

    public function get_article_by_cate_id($id){
        $data = '';
        $sql = "SELECT *, (SELECT category.category_code FROM category WHERE category.category_id = article.category_id LIMIT 1) category_code
                FROM article LEFT JOIN article_description ON article.article_id = article_description.article_id WHERE category_id = '$id' AND status = 1 AND lang_code = '" . $this->_lang['code'] . "' ORDER BY sort_order";
        if($row = $this->db->query($sql)){
            $data['current'] = $row->result_array();
        }
        $sql = "SELECT *, (SELECT category.category_code FROM category WHERE category.category_id = article.category_id LIMIT 1) category_code
                FROM article LEFT JOIN article_description ON article.article_id = article_description.article_id WHERE category_id = '$id' AND status = 1 AND lang_code = '" . LANG_DEFAULT . "' ORDER BY sort_order";
        if($row = $this->db->query($sql)){
            $data['default'] = $row->result_array();
        }
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
	
        return $data;
    }

    public function get_article_by_id($id){
        $data = '';
        $sql = "SELECT *, (SELECT category.category_code FROM category WHERE category.category_id = article.category_id LIMIT 1) category_code
                FROM article LEFT JOIN article_description ON article.article_id = article_description.article_id WHERE article.article_id = '$id' AND lang_code = '" . $this->_lang['code'] . "'";
        if($row = $this->db->query($sql)){
            $data['current'] = $row->result_array();
        }
        $sql = "SELECT *, (SELECT category.category_code FROM category WHERE category.category_id = article.category_id LIMIT 1) category_code
                FROM article LEFT JOIN article_description ON article.article_id = article_description.article_id WHERE article.article_id = '$id' AND lang_code = '" . LANG_DEFAULT . "'";
        if($row = $this->db->query($sql)){
            $data['default'] = $row->result_array();
        }
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'][0];
        $data['default'] = @$data['default'][0];

        return $data;
    }

    public function get_page_by_cate_id($id){
        $data = '';
        $sql = "SELECT *, cd.name
                FROM (SELECT p.id, p.layout_id, p.value, p.sort_order, p.code, pd.page_id, pd.lang_code, pd.title, pd.description, pd.meta_description, pd.meta_keyword
                FROM page p
                LEFT JOIN page_description pd ON p.id = pd.page_id
                WHERE p.value = '{$id}'
                AND pd.lang_code = '{$this->_lang['code']}') AS temp, category_description cd
                WHERE cd.category_id = temp.value
                AND cd.lang_code = '{$this->_lang['code']}';";
        if($row = $this->db->query($sql)){
            $data['current'] = $row->result_array();
        }
        $sql = "SELECT *, cd.name
                FROM (SELECT p.id, p.layout_id, p.value, p.sort_order, p.code, pd.page_id, pd.lang_code, pd.title, pd.description, pd.meta_description, pd.meta_keyword
                FROM page p
                LEFT JOIN page_description pd ON p.id = pd.page_id
                WHERE p.value = '{$id}'
                AND pd.lang_code = '{$this->_lang['code']}') AS temp, category_description cd
                WHERE cd.category_id = temp.value
                AND cd.lang_code = '" . LANG_DEFAULT . "';";
        if($row = $this->db->query($sql)){
            $data['default'] = $row->result_array();
        }
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'][0];
        $data['default'] = @$data['default'][0];
        return $data;
    }
    
    public function getArticleByGroup($group)
    {
        $setting = $this->registry->setting;
        $data = '';
        $order_by = '';
        if($group == "news"){
           $order_by = 'ORDER BY article.date_modified DESC';
        }
        $sql = "SELECT *, (SELECT category.category_code FROM category WHERE category.category_id = article.category_id LIMIT 1) category_code
                FROM article LEFT JOIN article_description ON article.article_id = article_description.article_id WHERE article.`group` like '%$group%' AND lang_code = '" . $this->_lang['code'] . "' {$order_by} limit 0,{$setting['newslimit']}";
                
        $sqlDF = "SELECT *, (SELECT category.category_code FROM category WHERE category.category_id = article.category_id LIMIT 1) category_code
                FROM article LEFT JOIN article_description ON article.article_id = article_description.article_id WHERE article.`group` like '%$group%' AND lang_code = '" . LANG_DEFAULT . "' {$order_by} limit 0,{$setting['newslimit']}";

        $data['curent'] = $this->db->query($sql)->result_array();
        $data['default'] = $this->db->query($sqlDF)->result_array();
        if ($data['curent'] || empty($data['curent'])) {
            $data['curent'] = replaceValueNull($data['curent'], $data['default']);
        }
        return $data;
    }
}