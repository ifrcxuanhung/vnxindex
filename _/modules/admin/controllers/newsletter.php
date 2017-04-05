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

class Newsletter extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        // load model category

        $this->load->model('Newsletter_model', 'newsletter');
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
        $data = $this->newsletter->getEmailReceiveNews();
        
        //print_r($data);exit;
        $this->template->write_view('content', 'newsletter/newsletter_list', $this->data);
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
            //$list_email = $this->newsletter->getEmailReceiveNews();
            //print_r($list_email);exit('1234567');
        if ($this->input->is_ajax_request()) {
            $data = array();

            //declare lang default
            //$lang_code_default = $this->session->userdata('default_language');
            
            $list_email = $this->newsletter->getEmailReceiveNews();

            //set list_article = $list_article to show on view list
            $this->data->list_email = $list_email;
            
            if ((isset($this->data->list_email) == TRUE) && ($this->data->list_email != '') && (is_array($this->data->list_email) == TRUE)) {
                $aaData = array();
                $stt = 0;
                foreach ($this->data->list_email as $key => $value) {
                    $aaData[$key][] = ++$stt;
                    $aaData[$key][] = $value['email'];
                    $aaData[$key][] = $value['time'];
                    if ($value['active'] == '1') {
                        $aaData[$key][] = '<ul style="text-align: center;"><a style="color: green;" class="article-active" email_id="' . $value['id'] . '" href="javascript: void(0);">Enable</a></ul>';
                    } else {
                        $aaData[$key][] = '<ul style="text-align: center;"><a style="color: red;" class="article-active" email_id="' . $value['id'] . '" href="javascript: void(0);">Disable</a></ul>';
                    }
                    $aaData[$key][] = '<ul class="keywords" style="text-align: center;"><li class="green-keyword"><a title="" class="with-tip" href="' . admin_url() . 'newsletter/edit/' . $value['id'] . '">' . trans('bt_edit', 1) . '</a></li>
                    <li class="red_fx_keyword"><a title="" class="with-tip action-delete ' . ($value['id'] == 0 ? 'is_admin' : '') . '" email_id="' . $value['id'] . '" href="#">' . trans('bt_delete', 1) . '</a></li></ul>';
                }
                $output = array(
                    "aaData" => $aaData
                );
                $this->output->set_output(json_encode($output));
            }
        }
    }
    
    function edit($id = "") {
        //Load Helper
        $this->load->helper('form');
        $this->data->title = 'Newsletter - Edit new';
        // nếu người dùng muốn add hoặc edit

        $data = $this->newsletter->getOneEmailNewsLetter($id);
        if ($data != FALSE) {
            $this->data->input = $data[0];
        }
        if ($this->input->post('ok', TRUE)) {
            //call function insert data
            $this->update($id);
        }
        // load view and set data
        $this->template->write_view('content', 'newsletter/newsletter_form', $this->data);
        // set data for title
        $this->template->write('title', trans('Edit', 1));
        //render template
        $this->template->render();
    }
    
    function update($id)
    {
        $arrNewsletter = array();

        $this->data->input['email'] = $this->input->post('email');
        $this->data->input['active'] = $this->input->post('active');
        
        $arrNewsletter['newsletter'] = array(
            'email' => $this->input->post('email'),
            'active' => (int) $this->input->post('active')
        );

        if ($this->newsletter->edit($arrNewsletter, $id)) {
            redirect(admin_url() . 'newsletter');
        } else {
            $this->data->error = trans('edit_error', 1);
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
            $response = $this->newsletter->delete($this->input->post('id'));
            $this->output->set_output($response);
        }
    
    }

    function chang_active() {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request()) {
            echo $this->newsletter->change_status($this->input->post('id'), $this->input->post('text'));
        }
    }
    
    function synchronization()
    {
        print_r($this->newsletter->synchronization());
    }

}