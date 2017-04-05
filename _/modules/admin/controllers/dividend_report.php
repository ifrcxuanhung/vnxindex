<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  article.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  controller article                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.08.14 (LongNguyen)        New Create      */
/* * ****************************************************************** */

class Dividend_report extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        $this->load->helper(array('my_array_helper', 'form'));
        $this->load->Model('dividend_report_model', 'mreport');
    }

    /*     * ************************************************************** */
    /*    Name ： index                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ：  this function will be called automatically  */
    /*                   when the controller is called               */
    /* --------------------------------------------------------------- */
    /*    Params  ：  None                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：                                                 */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                  */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (Tung)                            */
    /*     * ************************************************************** */

    function index() {
        if ($this->input->is_ajax_request()) {
            $markets = array('HNX', 'HSX', 'UPC');
            $start = $this->input->post('start');
            $data = $this->mreport->listByDate($start);
            $response = array();
            foreach ($data as $key => $item) {
                $aaData[$key][] = $item['date_ex'];
                $aaData[$key][] = $item['ticker'];
                $aaData[$key][] = $item['market'];
                $aaData[$key][] = number_format($item['div_value']);
                $aaData[$key][] = number_format($item['exc_info']);
            }
            if(empty($aaData)){
                $aaData = '';
            }
                $response = array(
                    'aaData' => $aaData
                );

            $this->output->set_output(json_encode($response));
            
        } else {
            $now = time();
            $date = date('Y-m-d', $now);
            $this->data->dividends = $this->mreport->listByDate($date);
            $this->data->title = 'Dividend Report';
            $this->template->write_view('content', 'dividend_report/index', $this->data);
            $this->template->write('title', 'VNDB Report');
            $this->template->render();
        }
    }

}