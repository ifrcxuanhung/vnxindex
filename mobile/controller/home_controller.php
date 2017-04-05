<?php
include_once "block_controller.php";
include_once "model/ifrc_layout_model.php";

Class Home_Controller {
    protected $block;
    protected $article_model;

    Public function __construct()
    {
        $this->block = new Block_Controller();
        $this->ifrc_layout_model = new Ifrc_layout_Model();
    }

    public function index()
    {
        $listBlock = $this->ifrc_layout_model->getListBlockHome("m.vnxindex.com");
		$listArticle =array();
        //$our_website = $this->first_model->getourwebsite();
        include("view/home/index.php");
    }

    public function detail()
    {

        echo 'Controller : Home<br/>';
        echo 'Action : detail<br/>';
        include("view/home/detail.php");
    }

}
