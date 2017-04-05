<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends Admin {

    function __construct() {
        parent::__construct();
        $this->load->model('Category_model', 'category');
        $this->load->model('Article_model', 'article');
        $this->load->model('Help_model', 'help_model');

        $this->load->helper(array('my_array_helper', 'form'));
    }

    function index() {
         
        if (!$this->input->is_ajax_request()) {
            $this->load->helper('form');
            $this->data->title = 'Tests';
            self::_left();
            $this->template->write_view('content', 'tests/tests_list', $this->data);
            $this->template->write('title', 'Tests');
            $this->template->render();
        } else {
            if (isset($_POST['id']) == TRUE) {
                $lang_code_current = $this->session->userdata('curent_language');
                $article_current = $this->article->get_one($_POST['id'], $lang_code_current['code'], '1');
                $lang_code_default = $this->session->userdata('default_language');
                $article_default = $this->article->get_one($_POST['id'], $lang_code_default['code'], '1');
                $article_default['name_cate'] = $this->category->get_name_article($_POST['id'], $lang_code_default['code']);
                $article_current['name_cate'] = $this->category->get_name_article($_POST['id'], $lang_code_current['code']);
                $article_current = replaceValueNull($article_current, $article_default);
                $result = $article_current;
            }
            $this->output->set_output(json_encode($result));
        }
    }

    function detail($id) {
        $this->load->helper('form');
        $this->data->id = $id;
        $cate_id = $this->article->getArticleCategory($id);
        $this->data->cate_id = $cate_id[0]['category_id'];
        //$this->data->cate_id = $this->article->get();
        self::_left();
        $this->template->write_view('content', 'tests/tests_detail', $this->data);
        $this->template->write('title', 'Index Handbook');
        $this->template->render();
    }

    private function _left() {
        $list_article = array();
        $lang_code = $this->data->default_language;
        $this->data->list_cate = $this->category->list_category_code('tests', $lang_code);
        $lang_code_curent = $this->session->userdata('curent_language');
        $this->data->list_cate_curent_lang = $this->category->list_category_code('tests', $lang_code_curent);
        $list_cates = array();
        $list_cates_curent = array();
        if ($this->data->list_cate != NULL && is_array($this->data->list_cate) == TRUE && count($this->data->list_cate) > 0) {
            foreach ($this->data->list_cate as $key => $value) {
                $list_cates[$value->category_id] = $value;
            }
        }
        if ($this->data->list_cate_curent_lang != NULL && is_array($this->data->list_cate_curent_lang) == TRUE && count($this->data->list_cate_curent_lang) > 0) {
            foreach ($this->data->list_cate_curent_lang as $key => $value) {
                $list_cates_curent[$value->category_id] = $value;
            }
        }

        foreach ($list_cates as $key => $value) {
            if (isset($list_cates_curent[$key]) == true) {
                if ($list_cates_curent[$key]->name != '') {
                    $list_cates[$key]->name = $list_cates_curent[$key]->name;
                }
            }
        }
        $this->data->list_cate = $list_cates;
        $list_article_curent = array();
        $list_article_curent = NULL;
        if (isset($list_cates) && is_array($list_cates) && count($list_cates) > 0):
            foreach ($list_cates as $key => $value) {
                if(isset($value->category_code) == TRUE) {
                    $list_article[$value->category_code] = $this->article->getAllArticleByCateParentCode($value->category_code, $lang_code);
                    if (count($this->article->getAllArticleByCateParentCode($value->category_code, $lang_code_curent)) > 0) {
                        $list_article_curent[$value->category_code] = $this->article->getAllArticleByCateParentCode($value->category_code, $lang_code_curent);
                    } else {
                        $list_article_curent[$value->category_code] = $this->article->getAllArticleByCateParentCode($value->category_code, $lang_code);
                    }
                }
            }
        endif;

        $list_article = replaceValueNull($list_article_curent, $list_article);

        $this->data->article = $list_article;
    }

}