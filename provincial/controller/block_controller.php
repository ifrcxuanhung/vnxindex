<?php

include_once "model/first_model.php";
include_once "model/article_model.php";
include_once "model/chart_model.php";
include_once "model/translate_model.php";

Class Block_Controller {

    protected $first_model;

    Public function __construct()
    {
        $this->first_model = new First_Model();
        $this->article_model = new Article_Model();
        $this->chart_model = new Chart_Model();
        $this->translate_model = new Translate_model();
    }

    public function documentation()
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        $list_documentation = $this->article_model->getCategoryByCodeParent('DOCUMENTATION');
        $list_document = $this->article_model->getDocumentsByArticleSortOrder(999, CODE_CATE);
        include("view/block/documentation.php");
    }

    public function listindex($id = '')
    {
        $data = array();
        $data['article'] = $this->article_model->getArticleById($id);
        if (isset($data['article']['current'][0]['title']))
        {
            $data['trans'] = $this->translate_model;
            $title = $data['article']['current'][0]['title'];
            $meta_keyword = $data['article']['current'][0]['meta_keyword'];
            $lastUpdate = $this->first_model->getLastUpdate();
            $getnumberlistindexes=$this->first_model->getnumberlistindexes();
            $data['gwc'] = $this->first_model->getGWCIndexes($meta_keyword);
            include("view/block/listindex.php");
        }
    }
    
    public function listpublications($id = '')
    {
        $data = array();
        $data['article'] = $this->article_model->getArticleById($id);
        if (isset($data['article']['current'][0]['title']))
        {
            $data['trans'] = $this->translate_model;
            $title = $data['article']['current'][0]['title'];
            $meta_keyword = $data['article']['current'][0]['meta_keyword'];
            $lastUpdate = $this->first_model->getLastUpdate();
            $data['publications'] = $this->first_model->getResearchPublicatons($meta_keyword,0,10);
            $all = $this->first_model->getAllResearchPublicatons($meta_keyword);
            $sum = count($all);
            $total = ceil($sum/10);
            include("view/block/research_publications.php");
        }
    }
    
    public function project_progress($id = '')
    {
        $data = array();
        $data['article'] = $this->article_model->getArticleById($id);
        if (isset($data['article']['current'][0]['title']))
        {
            $data['trans'] = $this->translate_model;
            $title = $data['article']['current'][0]['title'];
            $meta_keyword = $data['article']['current'][0]['meta_keyword'];
            $lastUpdate = $this->first_model->getLastUpdate();
            $data['progress'] = $this->first_model->getQuery($meta_keyword);
            include("view/block/project_progress.php");
        }
    }

    public function contact()
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        include("view/block/contact.php");
    }

    public function footer()
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        include("view/block/footer.php");
    }

    public function header()
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        $language = $this->first_model->getLanguage();
        include("view/block/header.php");
    }

    public function profile()
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        $data['info'] = $this->article_model->getArticleProfile(CODE_CATE);
        include("view/block/profile.php");
    }

    public function head()
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        include("view/block/head.php");
    }

    public function script()
    {
        include("view/block/script.php");
    }

    public function compare_chart($code = '')
    {
        $data['icode'] = $code;
        include('view/block/compare_chart.php');
    }

    public function compare_chart_2()
    {
        $date = $this->chart_model->getDate($_POST);
        $dataCode = array();
        foreach ($_POST as $key => $value)
        {
            if (strpos($key, 'code') !== false)
            {
                $dataCode[$value] = $this->chart_model->getClose($value, $date);
                $response['name'][$value] = $this->chart_model->getIndexName($value);
            }
        }
        $response['data'] = $dataCode;
        echo json_encode($response);
    }

    public function performance_ranking($id = '')
    {
        $data = array();
        $lastUpdate = $this->first_model->getLastUpdate();
        $data['trans'] = $this->translate_model;
        $sortQuery = "";
        $sortMTD = "";
        $sortYTD = "";
        $listProvider = array('all', 'ifrc', 'pvn', 'ifrc_lab', 'other');
        $checkProvider = "all";
        $providerQuery = "and idx_sample.provider not in ('')";
        $classH2 = "";
        $sessionBody = "";

        if (isset($_SESSION['performance_ranking_sort']))
        {
            switch ($_SESSION['performance_ranking_sort'])
            {
                case "mtd_asc":
                    $sortMTD = " sort-asc";
                    $sortQuery = "order by obs_home.varmonth asc";
                    break;
                case "mtd_desc":
                    $sortMTD = " sort-desc";
                    $sortQuery = "order by obs_home.varmonth desc";
                    break;
                case "ytd_asc":
                    $sortYTD = " sort-asc";
                    $sortQuery = "order by obs_home.varyear asc";
                    break;
                case "ytd_desc":
                    $sortYTD = " sort-desc";
                    $sortQuery = "order by obs_home.varyear desc";
                    break;
                default:
                    break;
            }
            $classH2 = " current";
            $sessionBody = "style='display: block;'";
        }

        if (isset($_SESSION['performance_ranking_provider']))
        {
            switch ($_SESSION['performance_ranking_provider'])
            {
                case "all":
                    $checkProvider = "all";
                    $providerQuery = "and idx_sample.provider not in ('')";
                    break;
                case "ifrc":
                    $checkProvider = "ifrc";
                    $providerQuery = "and idx_sample.provider = 'IFRC'";
                    break;
                case "pvn":
                    $checkProvider = "pvn";
                    $providerQuery = "and idx_sample.provider = 'PVN'";
                    break;
                case "ifrc_lab":
                    $checkProvider = "ifrc_lab";
                    $providerQuery = "and idx_sample.provider = 'IFRCLAB'";
                    break;
                case "other":
                    $checkProvider = "other";
                    $providerQuery = "and idx_sample.provider not in ('IFRC', 'PVN', 'IFRCLAB', '')";
                    break;
                default:
                    break;
            }
            $classH2 = " current";
            $sessionBody = "style='display: block;'";
        }
        $data['performance'] = $this->first_model->getDataPerformanceRanking($sortQuery, $providerQuery, $id);
        require_once("view/block/performance_ranking.php");
    }

    public function home_article($id = '')
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        $data['article'] = $this->article_model->getArticleById($id);
        if (isset($data['article']['current'][0]['title']))
        {

            include("view/block/home_article.php");
        }
    }

    public function compare_chart_company($code = '')
    {
        $data['icode'] = $code;
        include('view/block/compare_chart_company.php');
    }

    public function compare_chart_company_2()
    {
        $ticker = $_POST['code1'];
        $dataCode = array();
        $market = $this->chart_model->getMarketCompany($ticker);

        if (isset($market))
        {
            $date = $this->chart_model->getDateCompareChartCompany($ticker, $market);
            /* company chart */
            $dataCode[$ticker] = $this->chart_model->getAdjClose($ticker, $date);
            $dataName = $this->first_model->getDetailCompany($ticker);
            $response['name'][$ticker] = $dataName[0]['stk_name'];

            /* market chart */
            switch (strtolower($market))
            {
                case 'vnxhn':
                    $dataCode['IFRCHNX'] = $this->chart_model->getClose('IFRCHNX', $date);
                    $response['name']['IFRCHNX'] = $this->chart_model->getIndexName('IFRCHNX');
                    break;
                case 'vnxhm':
                    $dataCode['IFRCVNI'] = $this->chart_model->getClose('IFRCVNI', $date);
                    $response['name']['IFRCVNI'] = $this->chart_model->getIndexName('IFRCVNI');
                    break;
            }

            /* index sector chart */
            $indexSector = $this->chart_model->getIndexSectorCompany($ticker);
            $dataCode[$indexSector] = $this->chart_model->getClose($indexSector, $date);
            $response['name'][$indexSector] = $this->chart_model->getIndexName($indexSector);

            $response['data'] = $dataCode;
        }
        else
        {
            $response['name'] = '';
            $response['data'] = array();
        }
        echo json_encode($response);
    }
    
    public function our_website($id = '')
    { 
        $data['trans'] = $this->translate_model;
        $cate = "our_website";
        if($id != "")
        {
            $article = $this->article_model->getArticleById($id);
            $cate = $article['current']['0']['meta_keyword'];
        }
        $larticle = $this->article_model->list_article_cate($cate);
        $data['article'] = $larticle['curent'];
        include('view/block/our_website.php');
    }

}
