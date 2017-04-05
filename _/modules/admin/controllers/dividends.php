<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dividends extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();

        $this->load->model('Dividends_model', 'mdividends');
        $this->load->helper(array('my_array_helper', 'form'));
    }

    function index($time = '') {
        if($this->input->is_ajax_request()){
            if(!in_array($time, array('history', 'today', 'future', ''))){
                $output = $this->mdividends->listDivFinalByMoment2('', $time);
            }else{
                $output = $this->mdividends->listDivFinalByMoment2($time);
            }
            $this->output->set_output(json_encode($output));
        }else{
            $this->template->write_view('content', 'dividends/dividends_list', $this->data);
            $this->template->write('title', 'Dividends ');
            $this->template->render();
        }
    }
    public function add($id = ''){
        if($id != ''){
            $this->data->input = $this->mdividends->getFinalById($id);
        }
        if($this->input->post()){
            $now = time();
            $this->data->input = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ticker', 'Ticker', 'required');
            $this->form_validation->set_rules('date_ex', 'Ex-right date', 'required');
            if($this->form_validation->run()){
                $this->data->input['date_upd'] = date('Y-m-d', $now);
                if($this->data->input['date_cnf'] == 'now'){
                    $this->data->input['date_cnf'] = date('Y-m-d', $now);
                }else{
                    unset($this->data->input['date_cnf']);
                }
                if($this->mdividends->addFinal($this->data->input)){
                    redirect(admin_url() . 'dividends');
                }
            }
        }
        $this->template->write_view('content', 'dividends/dividends_add', $this->data);
        $this->template->write('title', 'Dividends ');
        $this->template->render();
    }

    public function delete(){
        if($this->input->is_ajax_request()){
            $id = $this->input->post('id');
            if($this->mdividends->deleteFinal($id)){
                $this->output->set_output('1');
            }
        }
    }

    public function checkDivExists(){
        $ticker = $this->data->input['ticker'];
        $date_ex = $this->data->input['date_ex'];
        if($this->mdividends->countFinalDiv($ticker, $date_ex) >= 1){
            $this->form_validation->set_message('checkDivExists', 'This Dividend has been added');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function import(){
        if($this->input->is_ajax_request()){
            $text = html_entity_decode($this->input->post('text'));
            $data['market'] = $this->input->post('market');
            $data['pay_met'] = 'Cash';
            $data['notice'] = $text;
            $sources = array(
                'date_ann' => array(
                    'start' => 'Ngày ',
                    'end' => ', Sở Giao dịch',
                    'date' => 'd/m/Y',
                ),
                'ticker' => array(
                    'start' => 'mã CK: ',
                    'end' => '\)',
                ),
                'date_ex' => array(
                    'start' => 'Ngày giao dịch không hưởng quyền:',
                    'end' => '\n',
                    'date' => 'd/m/Y',
                ),
                'date_rec' => array(
                    'start' => 'Ngày đăng ký cuối cùng:',
                    'end' => '\n',
                    'date' => 'd/m/Y',
                ),
                'date_pay' => array(
                    'start' => 'Thời gian thanh toán: ',
                    'end' => '\n',
                    'date' => 'd/m/Y',
                ),
                'pay_yr' => array(
                    'start' => 'năm ',
                    'end' => '[ \n]',
                ),
                'dividend' => array(
                    'start' => 'mệnh giá \(',
                    'end' => ' đ',
                ),
                'yield' => array(
                    'start' => 'Tỷ lệ thực hiện: ',
                    'end' => '\/mệnh giá',
                ),

            );
            if($data['market'] == 'HNX'){
                $sources['date_pay'] = array(
                    'start' => 'Thời gian thực hiện: ',
                    'end' => '\n',
                    'date' => 'd/m/Y',
                );
                $sources['ticker'] = array(
                    'start' => 'cổ phiếu ',
                    'end' => ' ',
                );
                $sources['pay_per'] = array(
                    'start' => 'Trả cổ tức bằng tiền ',
                    'end' => ' năm 2012',
                );
            }
            foreach($sources as $type => $source){
                $value = '';
                $start = $source['start'];
                $end = $source['end'];
                $rule = "/(?<=$start).*(?=$end)/msU";
                preg_match($rule, $text, $result);
                if(!empty($result)){
                    $value = trim($result[0]);
                }
                if($value != ''){
                    if(isset($source['date'])){
                        $delimiter = substr($source['date'], 1, 1);
                        $current_format_key = explode($delimiter, $source['date']);
                        $current_format_value = explode($delimiter, $value);
                        foreach($current_format_key as $key => $item){
                            $format_value[$item] = $current_format_value[$key];
                        }
                        $value = $format_value['Y'] . '-' . $format_value['m'] . '-' . $format_value['d'];
                        unset($current_format_key);
                        unset($current_format_value);
                    }
                }
                $value = str_replace('%', '', $value);
                $data[$type] = $value;
                unset($result);                
            }
            $response['data'] = $data;
            $this->output->set_output(json_encode($response));
        }
    }
}
