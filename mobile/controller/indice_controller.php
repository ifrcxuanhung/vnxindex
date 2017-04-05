<?php

include_once "model/first_model.php";
include_once "model/translate_model.php";
include_once "block_controller.php";
include_once "model/ifrc_layout_model.php";

Class Indice_Controller {

    protected $first_model;
    protected $block;

    Public function __construct()
    {
        $this->first_model = new First_Model();
        $this->translate_model = new Translate_model();
        $this->block = new Block_Controller();
        $this->ifrc_layout_model = new Ifrc_layout_Model();
    }

    public function code()
    {
        $code = basename($_SERVER['REQUEST_URI']);
        $dataIndex = $this->first_model->getDetailIndex($code);
        //$listBlock = $this->ifrc_layout_model->getListBlockHome("m.vnxindex.com");
        $listBlockDocument = $this->ifrc_layout_model->getListBlockHome("m.vnxindex.com",'','documentation');
        //print_r($listBlock);exit;
        if (count($dataIndex) == 1)
        {
            $data = array();
            $data['trans'] = $this->translate_model;
            $dataIndexDescription = $this->first_model->getIndexDescription($code);
            $lastUpdate = $this->first_model->getLastUpdate();
            $countcompo = $this->first_model->getnumber($code);
            $dataComposition = $this->first_model->getComposition($code);
            $dataPerformance = $this->first_model->getPerformance($code);
            $dataPerformanceYear = $this->first_model->getPerformanceYearButNewest($code);
            $provider = $this->first_model->getProviderByCode($code);
            $relatedIndexes = $this->first_model->getRelatedIndexes($code);
           // print_R($provider);
            if(isset($provider[0]['PROVIDER']) && in_array($provider[0]['PROVIDER'], array("IFRC", "PVN", "IFRCLAB"))) {
                $checkOther = false;
                $checkCurrency = false;
            } else {
                $checkOther = true;
                $checkCurrency = count($relatedIndexes) > 1 ? false : true;
            }
            include("view/indice/index.php");
        }
        else
        {
            header("Location: " . BASE_URL);
            exit;
        }
    }

}
