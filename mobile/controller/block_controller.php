<?php

include_once "model/first_model.php";
include_once "model/article_model.php";
include_once "model/chart_model.php";
include_once "model/translate_model.php";
include_once "model/ifrc_article_model.php";

Class Block_Controller {

    protected $first_model;

    Public function __construct() {
        $this->first_model = new First_Model();
        $this->article_model = new Article_Model();
        $this->chart_model = new Chart_Model();
        $this->translate_model = new Translate_model();
        $this->int_article_model = new Ifrc_article_model();
    }

    public function documentation($cate = '',$query='',$title='') {
        $data = array();
        $data['trans'] = $this->translate_model;
        $title = $title;
		$title_default = str_replace(' ','',$title);
        //print_R($title_default);exit;
		//$list_documentation = $this->article_model->getCategoryByCodeParent('DOCUMENTATION');
		
		$list_documentation = $this->int_article_model->list_category_code_groupby($cate);
		//
	   // $list_document = $this->article_model->getDocumentsByArticleSortOrder($data['article']['current'][0]['sort_order'], CODE_CATE);
		 $list_document = $this->int_article_model->list_article_cate_document_1($cate,$query);
		//echo "<pre>";print_r($list_document);exit;
		include("view/block/documentation.php");
    }

    public function listindex_backup()
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        $getnumberlistindexes=$this->first_model->getnumberlistindexes();
        $data['vnx'] = $this->first_model->getDataVNX();
        $data['pvn'] = $this->first_model->getDataPVN();
        $data['ifrclab'] = $this->first_model->getDataIFRCLAB();
        $data['ifrcresearch'] = $this->first_model->getDataIFRCRESEARCH();
        $data['other'] = $this->first_model->getDataOTHER();
        require_once("view/block/listindex.php");
    }
	 public function listindex()
    {
        $data = array();
		$data['trans'] = $this->translate_model;
        $getnumberlistindexes=$this->first_model->getnumberlistindexes();
        $data['all'] = $this->first_model->getProviderFIX();
		$data['vnx'] = $this->first_model->getDataVNX();
		$data['ifrcresearch'] = $this->first_model->getDataIFRCRESEARCH();
		$data['pvn'] = $this->first_model->getDataPVN();
        $data['ifrclab'] = $this->first_model->getDataIFRCLAB();
		$data['other'] = $this->first_model->getDataOTHER();
		//echo "<pre>";print_r($data['vnx']);exit; 
        require_once("view/block/listindex.php");
    }

    public function listpublications($cate = '',$query='',$title='') {
        $data = array();
        //print_R($data['article']);exit;
            $data['trans'] = $this->translate_model;
            $title = $title!='' ? $title : 'PUBLICATIONS';
            $title_default = $title!='' ? $title : 'PUBLICATIONS';
            $meta_keyword = $query;
            $meta_description = $cate;
            $category = $meta_description;
            $lastUpdate = $this->first_model->getLastUpdate();
            $data['publications'] = $this->first_model->getResearchPublicatons($query, 0, 10);
            $all = $this->first_model->getAllResearchPublicatons($query);
            $sum = count($all);
            $total = ceil($sum / 10);
            include("view/block/research_publications.php");
    }

    public function project_progress($id = '') {
        $data = array();
        $data['article'] = $this->article_model->getArticleById($id);
        if (isset($data['article']['current'][0]['title'])) {
            $data['trans'] = $this->translate_model;
            $title = $data['article']['current'][0]['title'];
            $title_default = $data['article']['current'][0]['title_default'];
            $meta_keyword = $data['article']['current'][0]['meta_keyword'];
            $lastUpdate = $this->first_model->getLastUpdate();
            $data['progress'] = $this->first_model->getQuery($meta_keyword);
            //print_r($data['progress']);
            include("view/block/project_progress.php");
        }
    }

    public function contact() {
        $data = array();
        $data['trans'] = $this->translate_model;
        include("view/block/contact.php");
    }

    public function footer() {
        $data = array();
        $data['trans'] = $this->translate_model;
        include("view/block/footer.php");
    }

    public function header() {
        $data = array();
        $data['trans'] = $this->translate_model;
        $language = $this->first_model->getLanguage();
        include("view/block/header.php");
    }

    public function profile() {
        $data = array();
        $data['trans'] = $this->translate_model;
        $data['info'] = $this->article_model->list_article_cate('mobile', 1);
        //$data['info'] = $this->int_article_model->getArticleProfile('mobile');
        include("view/block/profile.php");

    }

    public function head() {
        $data = array();
        $data['trans'] = $this->translate_model;
        include("view/block/head.php");
    }
    
    public function block_company($code = '') {
        $data = array();
        $data['trans'] = $this->translate_model;
        $show = '';
        $datasummary = $this->first_model->getSummaryCompanyCode($code);
        if(!empty($datasummary)) {
            include("view/block/block_company.php");
        }
    }
    
    

    public function script() {
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

    public function performance_ranking() {
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

        if (isset($_SESSION['performance_ranking_sort'])) {
            switch ($_SESSION['performance_ranking_sort']) {
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

        if (isset($_SESSION['performance_ranking_provider'])) {
            switch ($_SESSION['performance_ranking_provider']) {
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
                    $providerQuery = "and idx_sample.provider not in ('IFRC', 'PVN', 'IFRCLAB','PROVINCIAL', '')";
                    break;
                default:
                    break;
            }
            $classH2 = " current";
            $sessionBody = "style='display: block;'";
        }
        $data['performance'] = $this->first_model->getDataPerformanceRankingNoId($sortQuery, $providerQuery);
        require_once("view/block/performance_ranking.php");
    }

    public function home_article($id = '') {
        $data = array();
        $data['trans'] = $this->translate_model;
        $data['article'] = $this->article_model->getArticleById($id);
        if (isset($data['article']['current'][0]['title'])) {
            $title = $data['article']['current'][0]['title'];
            $title_default = $data['article']['current'][0]['title_default'];
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
    
    public function sector_breakdown($code)
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        $data['sector_breakdown'] = $this->first_model->getsector_breakdown($code);
        //print_R($data['sector_breakdown']);exit;
        $sector_daily = $this->first_model->getsectorweightdaily($code);
        $rs = array();
        foreach($data['sector_breakdown'] as $value)
        {
            $results[$value['stk_sector']][] = $value;
        }
        unset($data['sector_breakdown']);
        include('view/block/sector_breakdown.php');
    }

    public function size_breakdown($code)
    {
        $data = array();
        $data['trans'] = $this->translate_model;
        $listData = $this->first_model->getsize_breakdown($code);
        //print_R($listData);
        foreach($listData as $value) {
            $data['size_breakdown'][$value['CODE']][] = $value;
        }
        unset($listData);
        include('view/block/size_breakdown.php');
    }
	public function GetBetween($var1="",$var2="",$pool){
		$temp1 = strpos($pool,$var1)+strlen($var1);
		$result = substr($pool,$temp1,strlen($pool));
		$dd=strpos($result,$var2);
		if($dd == 0){
		$dd = strlen($result);
		}
		
		return substr($result,0,$dd);
	}
    public function catelog($cate = '', $where = ' (1=1)', $sort=' clean_order asc', $title='') { 
        $data['trans'] = $this->translate_model;
        if($cate != "")
        {
            //$article = $this->article_model->getArticleByTitle($cate);
            //print_r($data['article']);exit;
            $title = @$title;
            $title_default = str_replace(' ','',$title);
			$category = @$cate;
        }
        //$larticle = $this->int_article_model->list_article_cate_1($cate,$query);
        //$data['glossary'] = $larticle['current'];
        $lcategory = $this->int_article_model->list_category_code_groupby($cate);
		$where = $where;
		$sort = $sort;
        $glossaryCate = $lcategory['current'];
        include("view/block/catelog.php");
    }
    //EVENT
    public function article_company2($id)
    { 
        $data['trans'] = $this->translate_model;
        $articles=$this->article_model->getArticleById($id);
        
        $article=$this->int_article_model->getArticleByTitle($articles['current'][0]['title']);
        //print_R($article);exit;
        include("view/block/article_company.php");
    }
	  public function article_company($id, $open=false, $show_img=true, $header_color='', $cate='', $title ='')
    { 
        $data['trans'] = $this->translate_model;
        //print_R($title);exit;
        if($cate != 'ifrc_research_list'){
            $article=$this->int_article_model->getArticleById($id);
        }else{
            $article=$this->int_article_model->getArticleByTitleAndCate($title, 'ifrc_research_list_detail');
            //print_R($article);exit;
        }
        include("view/block/article_company.php");
    }

}
