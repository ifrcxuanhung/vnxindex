<?php

include_once "model/first_model.php";
include_once "block_controller.php";
include_once "model/article_model.php";

Class Home_Controller {

    protected $first_model;
    protected $block;
    protected $article_model;

    Public function __construct()
    {
        $this->first_model = new First_Model();
        $this->block = new Block_Controller();
        $this->article_model = new Article_Model();
    }

    public function index()
    {
        $listArticle = $this->article_model->getListArticleHome(CODE_CATE);
        include("view/home/index.php");
    }

    public function detail()
    {

        echo 'Controller : Home<br/>';
        echo 'Action : detail<br/>';
        include("view/home/detail.php");
    }

}
