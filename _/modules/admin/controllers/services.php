<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  IMS v3.0
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  services.php
 * ---------------------------------------------------------------------------------------------------------------------
 * Entry Server ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Called By    ：  System
 * ---------------------------------------------------------------------------------------------------------------------
 * Notice       ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Copyright    ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Comment      ：  controller services  
 * ---------------------------------------------------------------------------------------------------------------------
 * History      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Version V001 ：  2013.06.24 (LongNguyen)        New Create 
 * ******************************************************************************************************************* */

class services extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        // load model services
        $this->load->model('services_model', 'services_model');
        $this->load->helper(array('my_array_helper', 'form'));
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */

    function index() {
        $categories = array();
        $list_services = $this->services_model->list_services_fix();

        $this->data->list_services = $list_services;
        // data for dropdown list parent services
        if (isset($this->data->list_services) == TRUE && $this->data->list_services != '' && is_array($this->data->list_services) == TRUE) {
            foreach ($this->data->list_services as $key => $value) {
                $categories[$value->services_id] = $value->name;
            }
        }
        $this->data->title = 'List categories';
        $this->data->list_services_selectbox = $categories;
        $this->template->write_view('content', 'services/services_list', $this->data);
        $this->template->write('title', 'Categories ');
        $this->template->render();
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */

    function listdata($id) {
        if ($this->input->is_ajax_request()) {
            if (!is_numeric($id)) {
                $id = '';
            }
            $this->data->list_services = $this->services_model->list_services_fix($id);
            $aaData = array();
            if (isset($this->data->list_services) == TRUE && $this->data->list_services != '' && is_array($this->data->list_services) == TRUE) {
                foreach ($this->data->list_services as $key => $value) {
                    $aaData[$key][] = $value->name;
                    $aaData[$key][] = $value->sort_order;
                    if ($value->status == 1) {
                        $aaData[$key][] = '<a style="color: green;" class="services-active" services_id="' . $value->services_id . '" href="javascript: void(0);">Enable</a>';
                    } else {
                        $aaData[$key][] = '<a style="color: red;" class="services-active" services_id="' . $value->services_id . '" href="javascript: void(0);">Disable</a>';
                    }
                    
                    $aaData[$key][] = '<ul class="keywords" style="text-align: center;"><li class="green-keyword"><a title="" class="with-tip" href="' . admin_url() . 'services/edit/' . $value->services_id . '">' . trans('bt_edit', 1) . '</a></li>
                                   <li class="red_fx_keyword"><a title="" class="with-tip action-delete ' . ($value->parent_id == 0 ? 'is_admin' : '') . '" services_id="' . $value->services_id . '" href="#">' . trans('bt_delete', 1) . '</a></li></ul>';
                }
            }
            $output = array(
                "aaData" => $aaData
            );
            $this->output->set_output(json_encode($output));
        }
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */

    function add() {
        $categories = NULL;
        $this->data->input = $this->input->post();
        $this->data->title = 'Categories - Add new';
        // load form helper
        // load validation lib
        $this->load->library('form_validation');
        // set rule validate
        
        // $this->form_validation->set_rules('services_code', 'Code services', 'required');
        $this->form_validation->set_rules('status');
        $this->form_validation->set_rules('sort_order', 'Sort Order', 'required|is_natural');
        // set validate theo language code
        
        $this->form_validation->set_rules('name', "name services ", 'required');
        // run validate
        if ($this->form_validation->run() == FALSE) :
            // set error message
            $this->data->error = validation_errors();
        else :
            if ($this->services_model->add($this->data->input, $this->data->list_language) == 1):
                redirect(admin_url() . 'services');
            else:
                $this->data->error = 'insert error';
            endif;
        endif;
        //get all services
        $list_services = $this->services_model->list_services_fix();
        // data for dropdown list parent services
        if ($list_services != '' && is_array($list_services)) {
            foreach ($list_services as $value) {
                $categories[$value->services_id] = $value->name;
            }
        }
        // set data for list_services
        $this->data->list_services = $categories;
        // load view and set data
        $this->template->write_view('content', 'services/services_form', $this->data);
        // set data for title
        $this->template->write('title', 'Add ');
        //render template
        $this->template->render();
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */

    function edit($id) {
        $categories = NULL;
        $this->data->title = 'Categories - Edit';
        // load form helper
        $this->load->helper('form');
        // load validation lib
        $this->load->library('form_validation');
        // set rule validate
        
        //  $this->form_validation->set_rules('services_code', 'Code services', 'required');
        $this->form_validation->set_rules('status');
        $this->form_validation->set_rules('sort_order', 'Sort Order', 'required|is_natural');
        // set validate theo language code
        $this->form_validation->set_rules('name', "name services in tab name", 'required');
        // run validate
        if ($this->form_validation->run() == FALSE) :
            // set error message
            $this->data->input = $this->input->post();
            $this->data->error = validation_errors();
        else :
            if ($this->services_model->edit($this->input->post(), $this->data->list_language, $id) == TRUE):
                redirect(admin_url() . 'services');
            else:
                $this->data->error = 'edit error';
            endif;
        endif;
        //get all services
        $list_services = $this->services_model->list_services_fix();
        // data for dropdown list parent services
        if ($list_services != '' && is_array($list_services)) {
            foreach ($list_services as $value) {
                $categories[$value->services_id] = $value->name;
            }
        }
        // set data for list_services
        $this->data->list_services = $categories;
        // load view and set data
        $info = $this->services_model->get_one($id);

        $this->data->input = $info[0];
        $this->data->input['right']=unserialize($this->data->input['right']);
        $this->template->write_view('content', 'services/services_form', $this->data);
        // set data for title
        $this->template->write('title', 'Edit');
        //render template
        $this->template->render();
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */

    function delete() {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request()) {
            $response = $this->services_model->delete($this->input->post('id'));
            $this->output->set_output($response);
        }
    }
    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    function chang_active() {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request()) {
            echo $this->services_model->change_active($this->input->post('id'), $this->input->post('text'));
        }
    }

}