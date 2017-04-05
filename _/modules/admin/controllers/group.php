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

class Group extends Admin {

    protected $data = '';

    function __construct() {
        parent::__construct();
        $this->load->model('Group_model', 'group_model');
        $this->load->model('Services_model', 'services_model');
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
        $this->data->title = 'List user group';
        $this->template->write_view('content', 'group/group_list', $this->data);
        $this->template->write('title', 'User group');
        $this->template->render();
    }

    /*     * ***********************************************************************************************************
     * Name         ： listdata
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

    function listData() {
        if ($this->input->is_ajax_request()) {
            $listGroup = $this->group_model->find();
            if ((isset($listGroup) == true) && count($listGroup) > 0) {
                $aaData = array();
                foreach ($listGroup as $key => $value) {
                    $aaData[$key][] = $value['name'];
                    $aaData[$key][] = $value['description'];
                    $aaData[$key][] = '<ul class="keywords" style="text-align: center;">
                                            <li class="green-keyword"><a class="with-tip" href="' . admin_url() . 'group/edit/' . $value['id'] . '">' . trans('bt_edit', 1) . '</a></li>
                                            <li class="red_fx_keyword"><a class="with-tip delete " group_id="' . $value['id'] . '" href="javascript: void(0);">' . trans('bt_delete', 1) . '</a></li></ul>';
                }
                $output = array(
                    "aaData" => $aaData
                );
                $this->output->set_output(json_encode($output));
            }
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
        $this->data->input = $this->input->post();
        $this->data->list_services = $this->services_model->find();
        $this->data->title = trans('group', 1);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'trim|required|is_unique[group.name]');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->input->post() != FALSE) {
            $this->data->services = $this->input->post('services');
        }
        if ($this->form_validation->run() == FALSE) :
            $this->data->error = validation_errors();
        else:
            $services = $this->input->post('services');
            $data_post = $this->input->post();
            unset($data_post['services']);
            $id = $this->group_model->add($data_post);
            if ($id != FALSE) {
                if (is_array($services) && count($services) > 0) {
                    foreach ($services as $service) {
                        if (is_array($service) && count($service) > 0) {
                            foreach ($service as $right) {
                                $right['bind'] = $id;
                                $this->group_model->update_service_info($right, $right['services_code']);
                            }
                        }
                    }
                }
                redirect(admin_url() . 'group');
            } else {
                $this->data->error = 'insert error';
            }
        endif;
        $this->template->write_view('content', 'group/group_form', $this->data);
        $this->template->write('title', 'Add new');
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
        $this->data->id = $id;
        $this->data->input = $this->group_model->find($id);
        count($this->data->input) == 0 ? redirect(admin_url() . 'group') : $this->data->input = $this->data->input[0];
        $this->data->list_services = $this->services_model->find();
        $this->data->services = $this->services_model->get_service_info('group', $id);

        $this->data->title = trans('group', 1);
        $this->data->id = $id;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->input->post() != FALSE) {
            if ($this->form_validation->run() == FALSE) :
                $this->data->error = validation_errors();
                $this->data->services = $this->input->post('services');
            else :
                if (self::_name_check($this->input->post('name')) != FALSE) :
                    $services = $this->input->post('services');
                    $data_post = $this->input->post();
                    unset($data_post['services']);
                    if ($this->group_model->update($data_post, $id) == 1) {

                        if (is_array($services) && count($services) > 0) {
                            foreach ($services as $service) {
                                if (is_array($service) && count($service) > 0) {
                                    foreach ($service as $right) {
                                        $right['bind'] = $id;
                                        $this->group_model->update_service_info($right, $right['services_code']);
                                    }
                                }
                            }
                        }
                        redirect(admin_url() . 'group');
                    } else {
                        $this->data->error = 'update error';
                    }
                endif;
            endif;
        }

        $this->template->write_view('content', 'group/group_form', $this->data);
        $this->template->write('title', 'Edit');
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
            echo $this->group_model->delete($this->input->post('id'));
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

    private function _name_check($name) {
        if ($this->group_model->check_name($name, $this->data->id)) {
            return true;
        } else {
            $this->data->error = 'Group name already exists!';
            return false;
        }
    }

}