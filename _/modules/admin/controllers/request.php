<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  newletter.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  controller newletter                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2013.10.31 (HongTien)        New Create      */
/* * ****************************************************************** */

class Request extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        // load model category

        $this->load->model('Request_model', 'request');
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
    /*    M001 : New  2012.08.14 (LongNguyen)                            */
    /*     * ************************************************************** */

    function index() {
    
        //print_r($data);exit;
        $this->template->write_view('content', 'request/request_list', $this->data);
        $this->template->render();
    }

    /*     * ************************************************************** */
    /*    Name ： listdata                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ：  data table ajax  */
    /* --------------------------------------------------------------- */
    /*    Params  ：  None                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：                                                 */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                  */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                            */
    /*     * ************************************************************** */

    function listData() {
            //$list_email = $this->request->getSendRequest();
            //print_r($list_email);
        if ($this->input->is_ajax_request()) {
            $data = array();

            //declare lang default
            //$lang_code_default = $this->session->userdata('default_language');
            
            $list_request = $this->request->getSendRequest();

            //set list_article = $list_article to show on view list
            $this->data->list_request = $list_request;
            
            if ((isset($this->data->list_request) == TRUE) && ($this->data->list_request != '') && (is_array($this->data->list_request) == TRUE)) {
                $aaData = array();
                $stt = 0;
                foreach ($this->data->list_request as $key => $value) {
                    $aaData[$key][] = ++$stt;
                    $aaData[$key][] = $value['name'];
                    $aaData[$key][] = $value['email'];
                    $aaData[$key][] = $value['comment'];
					$aaData[$key][] = $value['time'];
                    $aaData[$key][] = '<ul class="keywords" style="text-align: center;"><li class="red_fx_keyword"><a title="" class="with-tip action-delete ' . ($value['id_request'] == 0 ? 'is_admin' : '') . '" request_id="' . $value['id_request'] . '" href="#">' . trans('bt_delete', 1) . '</a></li></ul>';
                }
                $output = array(
                    "aaData" => $aaData
                );
                $this->output->set_output(json_encode($output));
            }
        }
    }

  
    /*    Name ： delete                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ： delete 1 category   call by ajax               */
    /* --------------------------------------------------------------- */
    /*    Params  ：  $_POST id                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：   return 0 when delete false return 1 when delete success  */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                     */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                             */
    /*     * ************************************************************** */
    function delete() {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request()) {
            $response = $this->request->delete($this->input->post('id'));
            $this->output->set_output($response);
        }
    
    }

    function chang_active() {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request()) {
            echo $this->newsletter->change_status($this->input->post('id'), $this->input->post('text'));
        }
    }

}