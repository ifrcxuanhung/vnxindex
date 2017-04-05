<?php

include_once "model/first_model.php";
include_once "block_controller.php";
include_once "model/translate_model.php";

Class Country_Controller {

    protected $first_model;
    protected $block;


    Public function __construct()
    {
        $this->first_model = new First_Model();
        $this->block = new Block_Controller();
        $this->translate_model = new Translate_model();
    }

    public function framer()
    {
        $country = basename($_SERVER['REQUEST_URI']);
        $country_summary = $this->first_model->getSummaryCountryCode($country);
        $country_woment = $this->first_model->getWomentCountryCEO($country);
        //print_r($country_woment);
        $data['trans'] = $this->translate_model;
        include("view/country/index.php");
    }

    
}
