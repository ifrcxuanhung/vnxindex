<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends Admin {

    public function __construct() {
        parent::__construct();
        $this->load->model('export_model', 'mexport');
    }    

    public function index() {
        if ($this->input->is_ajax_request()) {
            /* rule of date */
            $rule = '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/';

            $response = array(
                'error' => '',
                'filename' => '',
                'path'
            );

            $table = $this->input->post('table');
            $filename = $table . '.txt';
            $exceptions = $this->input->post('exceptions');
            $exceptions = json_decode($exceptions, 1);
            $where = $this->input->post('where');
            $where = json_decode($where, 1);
            $order = $this->input->post('order');
            $order = json_decode($order, 1);
            $path = APPPATH . '../../assets/download/views/';
            $file_path = $path . $filename;
            $response['file'] = $filename;
            $response['path'] = $file_path;
            $total = $this->mexport->countItems($table, $where);
            $display = 5000;
            $totalPage = ceil($total / $display);
            $page = 0;
            $hasData = FALSE;
            while($page <= $total){
                $contents = '';
                if($page == 0){
                    $method = 'w';
                }else{
                    $method = 'a';
                }
                $data = array();
                $limit = array($page, $display);
                $page += $display;
                // pre($limit);continue;
                $data = $this->mexport->getData2($table, $where, $order, $exceptions, $limit);
                if(is_array($data)){
                    $hasData = TRUE;
                    if($page != $display){
                        array_shift($data);
                    }
                    foreach ($data as $key => $item) {
                        foreach ($item as $key => $value) {
                            if(preg_match($rule, $value)){
                                $value = str_replace('-', '/', $value);
                            }
                            $item[$key] = $value;
                            // $contents .= $value . chr(9);
                        }
                        $contents .= implode(chr(9), $item) . PHP_EOL;
                    }
                    // echo $file_path;die();
                    $f = fopen($file_path, $method);
                    fwrite($f, $contents);
                    fclose($f);
                }

            }
            if(!$hasData){
                $response['error'] = 'No data';
            }
            $this->output->set_output(json_encode($response));

        }
    }

    public function makeFile(){
        if($this->input->is_ajax_request()){
            $response = array(
                'error' => '',
                'file' => '',
                'path'
            );
            $data = $this->input->post('data');
            $method = $this->input->post('method');
            $filename = $this->input->post('filename');             
            $contents = '';
            if($method == 'w'){
                $contents .= implode(chr(9), array_keys(current($data))) . PHP_EOL;
            }
            $path = APPPATH . '../../assets/download/views/' . $filename;
            $rule = '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/';
            foreach ($data as $key => $item) {
                foreach ($item as $key => $value) {
                    if(preg_match($rule, $value)){
                        $value = str_replace('-', '/', $value);
                    }
                    $item[$key] = $value;
                    // $contents .= $value . chr(9);
                }
                $contents .= implode(chr(9), $item) . PHP_EOL;
            }
            // echo $file_path;die();
            $f = fopen($path, $method);
            fwrite($f, $contents);
            fclose($f);
            $response['file'] = $filename;
            $response['path'] = $path;
            $this->output->set_output(json_encode($response));
        }
    }

    public function index2() {
        if ($this->input->is_ajax_request()) {
            $filename = $this->input->post('name');
            $table = $this->input->post('table');
            $ids = $this->input->post('ids');
            $exceptions = $this->input->post('exceptions');
            $exceptions = json_decode($exceptions);
            $path = APPPATH . '../../assets/download/views/';
            $file_path = $path . $filename;
            $data = $this->mexport->getData($table, $ids, $exceptions);
            $response = array(
                'error' => ''
            );
            if(is_array($data)){
                foreach ($data as $key => $item) {
                    $temp = '';
                    foreach ($item as $value) {
                        $temp .= strip_tags($value) . chr(9);
                    }
                    $contents[] = trim($temp) . PHP_EOL;
                }

                file_put_contents($file_path, $contents);
                $response['file'] = $filename;
                $response['path'] = $file_path;
             
            }else{
                $response['error'] = 'No data';
            }

            echo json_encode($response);

        }
    }

    public function export_data() {
        if ($this->input->is_ajax_request()) {
            /* rule of date */
            $rule = '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/';

            $response = array(
                'error' => '',
                'filename' => '',
                'path'
            );

            $table = $this->input->post('table');
            $filename = $table . '.txt';
            $exceptions = $this->input->post('exceptions');
            $exceptions = json_decode($exceptions, 1);
            $where = $this->input->post('where');
            $where = json_decode($where, 1);
            $order = $this->input->post('order');
            $order = json_decode($order, 1);
            $path = APPPATH . '../../assets/download/views/';
            $file_path = $path . $filename;
            $response['file'] = $filename;
            $response['path'] = $file_path;
            $total = $this->mexport->countItems2($table, $where);
            $display = 5000;
            $totalPage = ceil($total / $display);
            $page = 0;
            $hasData = FALSE;
            while($page <= $total){
                $contents = '';
                if($page == 0){
                    $method = 'w';
                }else{
                    $method = 'a';
                }
                $data = array();
                $limit = array($page, $display);
                // pre($limit);continue;
                $data = $this->mexport->getData3($table, $where, $order, $exceptions, $limit);
                if(is_array($data)){
                    $hasData = TRUE;
                    $headers = array_shift($data);
                    if($page < $display){
                        $contents = $headers;
                    }
                    foreach ($data as $key => $item) {
                        foreach ($item as $key => $value) {
                            if(preg_match($rule, $value)){
                                $value = str_replace('-', '/', $value);
                            }
                            $item[$key] = $value;
                            // $contents .= $value . chr(9);
                        }
                        $contents .= implode(chr(9), $item) . PHP_EOL;
                    }
                    // echo $file_path;die();
                    $f = fopen($file_path, $method);
                    fwrite($f, $contents);
                    fclose($f);
                }
                $page += $display;

            }
            if(!$hasData){
                $response['error'] = 'No data';
            }
            $this->output->set_output(json_encode($response));

        }
    }

    public function export_data_2() {
        if ($this->input->is_ajax_request()) {
            /* rule of date */
            $rule = '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/';

            $response = array(
                'error' => '',
                'filename' => '',
                'path'
            );

            $table = $this->input->post('table');
            $filename = $table . '.txt';
            $exceptions = $this->input->post('exceptions');
            $exceptions = json_decode($exceptions, 1);
            $where = $this->input->post('where');
            $where = json_decode($where, 1);
            $order = $this->input->post('order');
            $order = json_decode($order, 1);
            $path = APPPATH . '../../assets/download/views/';
            $file_path = $path . $filename;
            $response['file'] = $filename;
            $response['path'] = $file_path;
            $total = $this->mexport->countItems3($table, $where);
            $display = 5000;
            $totalPage = ceil($total / $display);
            $page = 0;
            $hasData = FALSE;
            while($page <= $total){
                $contents = '';
                if($page == 0){
                    $method = 'w';
                }else{
                    $method = 'a';
                }
                $data = array();
                $limit = array($page, $display);
                // pre($limit);continue;
                $data = $this->mexport->getData4($table, $where, $order, $exceptions, $limit);
                if(is_array($data)){
                    $hasData = TRUE;
                    $headers = array_shift($data);
                    if($page < $display){
                        $contents = $headers;
                    }
                    foreach ($data as $key => $item) {
                        foreach ($item as $key => $value) {
                            if(preg_match($rule, $value)){
                                $value = str_replace('-', '/', $value);
                            }
                            $item[$key] = $value;
                            // $contents .= $value . chr(9);
                        }
                        $contents .= implode(chr(9), $item) . PHP_EOL;
                    }
                    // echo $file_path;die();
                    $f = fopen($file_path, $method);
                    fwrite($f, $contents);
                    fclose($f);
                }
                $page += $display;

            }
            if(!$hasData){
                $response['error'] = 'No data';
            }
            $this->output->set_output(json_encode($response));

        }
    }
}