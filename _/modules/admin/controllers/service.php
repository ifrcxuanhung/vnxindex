<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends Admin {

    protected $data = '';

    function __construct() {
        parent::__construct();
        $this->load->model('Service_model', 'service_model');
    }

    function index() {
        $this->data->title = 'Services';
        $this->template->write_view('content', 'service/service_list', $this->data);
        $this->template->write('title', 'Services');
        $this->template->render();
    }

    function listData() {
        if ($this->input->is_ajax_request()) {
            $this->data->list_service = $this->service_model->find();
            if ((isset($this->data->list_service) == TRUE) && ($this->data->list_service != '') && (is_array($this->data->list_service) == TRUE)) {
                $aaData = array();
                foreach ($this->data->list_service as $key => $value) {
                    $aaData[$key][] = $value['id'];
                    $aaData[$key][] = $value['name'];
                    $aaData[$key][] = $value['alias'];
                    $aaData[$key][] = implode('|',unserialize($value['right']));
                    $aaData[$key][] = '<ul class="keywords" style="text-align: center;"><li class="green-keyword"><a title="Edit" class="with-tip" href="' . admin_url() . 'service/edit/' . $value['id'] . '">Edit</a></li>
                                   <li class="red_fx_keyword"><a  title="Delete" class="with-tip action-delete " service_id="' . $value['id'] . '" href="#">Delete</a></li></ul>';
                }
                $output = array(
                    "aaData" => $aaData
                );
                $this->output->set_output(json_encode($output));
            }
        }
    }

    function add() {
        $this->data->input = $this->input->post();
        $this->data->title = 'Add';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        if ($this->form_validation->run() == FALSE) :
            $this->data->error = validation_errors();
        else:
            if ($this->service_model->add($this->input->post()) == 1):
                redirect(admin_url() . 'service');
            else:
                $this->data->error = 'insert error';
            endif;
        endif;
        $this->template->write_view('content', 'service/service_form', $this->data);
        $this->template->write('title', 'Service Add');
        $this->template->render();
    }

    function edit($id) {
        $this->data->id = $id;
        $this->data->input = $this->service_model->find($id);
        count($this->data->input) == 0 ? redirect(admin_url() . 'service') : $this->data->input = $this->data->input[0];
        $this->data->input['right']=unserialize($this->data->input['right']);
        $this->data->title = 'Edit';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        if ($this->form_validation->run() == FALSE) :
            $this->data->error = validation_errors();
        else :
            if (self::_name_check($this->input->post('name')) != FALSE) :
                if ($this->service_model->update($this->input->post(), $id) == 1):
                    redirect(admin_url() . 'service');
                else:
                    $this->data->error = 'update error';
                endif;
            endif;
        endif;
        $this->template->write_view('content', 'service/service_form', $this->data);
        $this->template->write('title', 'Edit');
        $this->template->render();
    }

    //delete resource
    function delete() {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request()) {
            echo $this->service_model->delete($this->input->post('id'));
        }
    }

    //check resource name exist
    private function _name_check($module, $controller) {
        if ($this->service_model->check_name($module, $controller, $this->data->id)) {
            return true;
        } else {
            $this->data->error = trans('resource_name_already_exists', 1);
            return false;
        }
    }
}