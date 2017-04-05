<?php
include_once "model/article_model.php";
include_once "model/translate_model.php";
include_once "block_controller.php";
include_once "model/ifrc_layout_model.php";
include_once "model/ifrc_article_model.php";

Class Article_Controller {

    protected $article_model;
    protected $translate_model;
    protected $block;

    Public function __construct()
    {
        $this->article_model = new Article_Model();
        $this->translate_model = new Translate_model();
        $this->block = new Block_Controller();
        $this->ifrc_layout_model = new Ifrc_layout_Model();
        $this->int_article_model  = new Ifrc_article_model();
    }

     function detail() {
        $title = substr(basename($_SERVER['REQUEST_URI']), 0, -5);
        //get article_id
        $article = $this->int_article_model->getArticleByTitleReturnId($title);
        //print_R($article);exit;
        //get listArticles by Category from article_id
        $dataArticle = $this->int_article_model->getArticleById($article['id']);
        
       // $listArticle = $this->article_model->list_article_cate($dataArticle['current'][0]['meta_keyword']);
        $listArticle = array();
        $listBlock = $this->ifrc_layout_model->getListBlockHome("ifrcresearch.com");
        unset($dataArticle);
     	include("view/article/index.php");
     }

}
