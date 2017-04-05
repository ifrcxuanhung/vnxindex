<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Currency extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        $this->load->model('Currency_model', 'currency_model');
    }

    function index($time = '') {
        if($this->input->is_ajax_request()){
            $output = $this->currency_model->listCurr();
            $this->output->set_output(json_encode($output));
        }else{
            $this->template->write_view('content', 'currency/index', $this->data);
            $this->template->write('title', 'Currency');
            $this->template->render();
        }
    }

    public function get_data_by_table() {
        if ($this->input->is_ajax_request()) {
            ini_set('memory_limit', '2048M');
            $table = $this->input->post('table');
            // $sql = "SELECT code, date, close
            //         FROM {$table}
            //         ORDER BY date DESC;";
            // $this->data->list_currency = $this->db->query($sql)->result_array();
            // if ((isset($this->data->list_currency) == TRUE) && ($this->data->list_currency != '') && (is_array($this->data->list_currency) == TRUE)) {
            //     $aaData = array();                
            //     foreach ($this->data->list_currency as $key => $value) {
            //         $aaData[$key][] = '<ul class="currency-detail" id="'.$table.'"><a href="JavaScript: void(0)" id="'.$value['code'].'" >' . $value['code'] . '</a></ul>';
            //         $aaData[$key][] = '<ul>' . $value['date'] . '</ul>';
            //         $aaData[$key][] = '<ul>' . number_format($value['close'], 2) . '</ul>';
            //     }
            //     $result = array("aaData" => $aaData);
            // }
            $result = $this->currency_model->get_data_by_table($table);
            $aaData = array();
            foreach($result['aaData'] as $key => $item){
                $aaData[$key][] = $item[1];
                $aaData[$key][] = $item[0];
                $aaData[$key][] = $item[3];

            }
            $result['aaData'] = $aaData;
            $this->output->set_output(json_encode($result));
        }
    }

    public function get_name_currency() {
        if ($this->input->is_ajax_request()) {
            ini_set('memory_limit', '2048M');
            $curr = $this->input->post('curr');
            $sql = "SELECT CONCAT(SUBSTRING(code,4,3), '/', SUBSTRING(code,7,3)) as currency, SUBSTRING(code,4,3) as form_curr, SUBSTRING(code,7,3) as des_curr
                    FROM vndb_currency_year
                    WHERE SUBSTRING(code,4,3) = '{$curr}' GROUP BY des_curr";
            $this->data->list_currency = $this->db->query($sql)->result_array();
            if ((isset($this->data->list_currency) == TRUE) && ($this->data->list_currency != '') && (is_array($this->data->list_currency) == TRUE)) {
                $aaData = array();                
                foreach ($this->data->list_currency as $key => $value) {
                    $aaData[$key][] = '<ul class="CompareCurrency" id="'.$value['currency'].'"><a class="CompareCurrency" href="JavaScript: void(0)" id="' . $value['currency'] . '">' . $value['currency'] . '</a></ul>';
                }
                $result = array("aaData" => $aaData);
            }
            $this->output->set_output(json_encode($result));
        }
    }

    public function get_name_currency_2() {
        if ($this->input->is_ajax_request()) {
            ini_set('memory_limit', '2048M');
            $curr = $this->input->post('curr');
            $data_result = $this->db->query("SELECT CONCAT(SUBSTRING(code,4,3), '/', SUBSTRING(code,7,3)) as currency, SUBSTRING(code,4,3) as form_curr, SUBSTRING(code,7,3) as des_curr
                    FROM vndb_currency_year
                    WHERE SUBSTRING(code,4,3) = '{$curr}' GROUP BY des_curr")->result_array();
            $data_final = array();
            foreach($data_result as $rs_key => $rs_value){
                $data_final[$rs_key][] = $rs_value['currency'];
            }
            $this->output->set_output(json_encode($data_final));
        }
    }

    public function get_compare_currency() {
        if ($this->input->is_ajax_request()) {
            ini_set('memory_limit', '2048M');
            $table = $this->input->post('table');
            $curr1 = $this->input->post('curr1');
            $curr2 = $this->input->post('curr2');
            $sql = "SELECT CONCAT(SUBSTRING(code,4,3), '/', SUBSTRING(code,7,3)) as currency, close, date
                    FROM {$table}
                    WHERE SUBSTRING(code,4,3) = '".$curr1."' AND SUBSTRING(code,7,3) = '".$curr2."'";
            $this->data->list_currency = $this->db->query($sql)->result_array();
            if ((isset($this->data->list_currency) == TRUE) && ($this->data->list_currency != '') && (is_array($this->data->list_currency) == TRUE)) {
                $aaData = array();                
                foreach ($this->data->list_currency as $key => $value) {
                    $aaData[$key][] = '<ul>' . $value['date'] . '</ul>';
                    $aaData[$key][] = '<ul>' . $value['currency'] . '</ul>';
                    $aaData[$key][] = '<ul>' . $value['close'] . '</ul>';
                }
                $result = array("aaData" => $aaData);
            }
            $this->output->set_output(json_encode($result));
        }
    }

    public function get_data_for_chart() {
        if ($this->input->is_ajax_request()) {
            $table = $this->input->post('table');
            $curr1 = $this->input->post('curr1');
            $curr2 = $this->input->post('curr2');
             $data_result = $this->db->query("SELECT SUBSTRING(a.code,4,3) as from_curr, SUBSTRING(a.code,7,3) as compare_curr, close, date, multiplies
                    FROM {$table} a join vndb_ref_currency_final b on SUBSTRING(a.code,4,3) = SUBSTRING(b.code,4,3) and SUBSTRING(a.code,7,3) = SUBSTRING(b.code,7,3)
                    WHERE SUBSTRING(a.code,4,3) = '".$curr1."' AND SUBSTRING(a.code,7,3) = '".$curr2."'")->result_array();
            $data_final = array();
            foreach($data_result as $dr_k => $dr_v){
                list($year,$month,$day) = explode('-',$dr_v['date']);
                // $dr_v['date'] = 'Date.UTC('.$year.','.$month.','.$day.')';
                $dr_v['date'] = strtotime("$year-$month-$day") * 1000;
                $data_final[$dr_k][] = $dr_v['date'];
                $data_final[$dr_k][] = $dr_v['close'] *1;
                $data_final[$dr_k][] = $dr_v['multiplies'];
            }
            $this->output->set_output(json_encode($data_final));
        }
    }
}
