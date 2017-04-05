<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ******************************************************************************************************************* *
 *   Author: Minh Handsome                                                                                               *
 * * ******************************************************************************************************************* */

class Screener extends Admin {

    public function __construct() {
        parent::__construct();
        $this->load->model('Screener_model', 'screener_model');
    }
    
    public function screener() {
        $this->data->info($this->screener_model->get_data());
        $this->template->write_view('content', 'screener/index', $this->data);
        $this->template->write('title', 'ETF Screener');
        $this->template->render();
    }
}