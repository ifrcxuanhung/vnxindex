<?php

include_once "model/first_model.php";
include_once "model/translate_model.php";
include_once "block_controller.php";

Class Company_Controller {

    protected $first_model;
    protected $block;

    Public function __construct()
    {
        $this->first_model = new First_Model();
        $this->translate_model = new Translate_model();
        $this->block = new Block_Controller();
    }

    public function code()
    {
        $code = basename($_SERVER['REQUEST_URI']);
        $dataCompany = $this->first_model->getDetailCompany($code);
        if (count($dataCompany) == 1)
        {
            $data = array();
            $sortQuery = "";
            $sortIndex = "";
            $sortYTD = "";
            $sortWGT = "";
            $classH2 = "";
            $sessionBody = "";
            $data['trans'] = $this->translate_model;

            if (isset($_SESSION['membership_sort']))
            {
                switch ($_SESSION['membership_sort'])
                {
                    case "index_asc":
                        $sortIndex = " sort-asc";
                        $sortQuery = "order by idx_sample.SHORTNAME asc";
                        break;
                    case "index_desc":
                        $sortIndex = " sort-desc";
                        $sortQuery = "order by idx_sample.SHORTNAME desc";
                        break;
                    case "ytd_asc":
                        $sortYTD = " sort-asc";
                        $sortQuery = "order by obs_home.varyear asc";
                        break;
                    case "ytd_desc":
                        $sortYTD = " sort-desc";
                        $sortQuery = "order by obs_home.varyear desc";
                        break;
                    case "wgt_asc":
                        $sortWGT = " sort-asc";
                        $sortQuery = "order by idx_compo.WEIGHT asc";
                        break;
                    case "wgt_desc":
                        $sortWGT = " sort-desc";
                        $sortQuery = "order by idx_compo.WEIGHT desc";
                        break;
                    default:
                        break;
                }
                $classH2 = " current";
                $sessionBody = "style='display: block;'";
            }
            $dataPerformance = $this->first_model->getPerformanceCompany($code);
            $dataMembership = $this->first_model->getMembershipCompany($code, $sortQuery, CODE_CATE);
            include("view/company/index.php");
        }
        else
        {
            header("Location: " . BASE_URL);
            exit;
        }
    }

}
