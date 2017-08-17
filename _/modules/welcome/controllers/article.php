<?php

require('_/modules/welcome/controllers/block.php');
/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  VNFDB
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  article.php 
 * ---------------------------------------------------------------------------------------------------------------------
 * Entry Server ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Called By    ：  System
 * ---------------------------------------------------------------------------------------------------------------------
 * Notice       ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Copyright    ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Comment      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * History      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Version V001 ：  2013.07.8 (LongNguyen)        New Create 
 * ******************************************************************************************************************* */

class Article extends Welcome {
    /*     * ***********************************************************************************************************
     * Name         ： __construct
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
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    function __construct() {
        parent::__construct();
        $this->load->model('article_model', 'marticle');
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
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    public function index($cate_id = "", $art_id = "") {
        
        if ($this->uri->segment(4) === false) {
            Redirect(base_url());
        } else {
            $this->data->cate_id = $cate_id;
			
            $listArticles = array();

            $sql = "SELECT category_id
                    FROM category
                    WHERE category_code = '{$cate_id}';";
            $cate_id = @$this->db->query($sql)->row()->category_id;
			
            $sql = "SELECT art.article_id, art_des.title
                    FROM article art, article_description art_des, category cate
                    WHERE art.article_id = art_des.article_id
                    AND art.category_id = cate.category_id
                    AND cate.category_id = '{$cate_id}';";
            $listArticles = $this->db->query($sql)->result_array();

            foreach($listArticles as $key => $value) {
                if(strtolower(utf8_convert_url($value['title'])) == strtolower(str_replace(".html", "", $art_id))) {
                    $art_id = $value['article_id'];
                    break;
                }
            }
            unset($listArticles);

            $block = new Block;
            //$sql = "SELECT * FROM article LEFT JOIN article_description ON article.article_id = article_description.article_id WHERE category_id = '$code' AND lang_code = '$lang'";        
            $this->data->newsletter = $block->newsletter();
            $this->data->actualites = $block->actualites();
            
            $data = $this->marticle->get_article_by_id($art_id);
            $this->data->data = $data;
            
            $list_code = $data['current']['meta_keyword'];
            $list_code = explode(',', $list_code);
            $code = ($list_code[0] != "") ? $list_code[0] : '';
			
            
            $this->data->page = $this->marticle->get_page_by_cate_id($cate_id);
            $this->data->compare_chart = $block->compare_chart($code);
            $this->template->write_view('content', 'article/detail', $this->data);
            if (is_array($this->data->data)) {
                if (isset($this->data->data['current']['title']) && $this->data->data['current']['title'] != '') {
                    $title = $this->data->data['current']['title'];
                } else {
                    $title = $this->data->data['default']['title'];
                }
            }
            if (isset($this->data->data['current']['description'])) {
                $desciptions = cut_str(html_entity_decode(strip_tags($this->data->data['current']['description'])), 200);
            } else {
                $desciptions = cut_str(html_entity_decode(strip_tags($this->data->data['default']['description'])), 200);
            }
            $this->data->cate_id = $cate_id;
            $this->template->write('title', $title);
            $this->template->write('desciption', $desciptions);

            $this->template->render();
        }
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */