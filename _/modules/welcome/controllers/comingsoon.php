<?php

class Comingsoon extends Welcome {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('article_model', 'marticle');
        $list_art = $this->marticle->list_article_cate('firstpage');
        $this->data->list_art = $list_art['curent'];

        $this->load->view('page_coming_soon', $this->data);
        
    }

}

?>