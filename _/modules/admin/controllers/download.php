<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  IMS v3.0
 * ---------------------------------------------------------------------------------------------------------------------
 * Program Name ：  hsx.php
 * ---------------------------------------------------------------------------------------------------------------------
 * Entry Server ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Called By    ：  System
 * ---------------------------------------------------------------------------------------------------------------------
 * Notice       ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Copyright    ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Comment      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * History      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Version V001 ：  2012.09.20 (Tung)        New Create
 * ******************************************************************************************************************* */

class Download extends Admin {

    protected $data;
    private $cal_dates;
    protected $_option;

    public function __construct() {
        parent::__construct();
        set_time_limit(0);
        $this->load->library('curl');
        $this->load->library('simple_html_dom');
        $this->load->Model('download_model', 'mdownload');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
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
     * M001         ： New  2012.10.16 (Tung)
     * *************************************************************************************************************** */

    public function histoday(){
        $info['code_dwl'] = $this->mdownload->findAll();
        $info['code_info'] = $this->mdownload->findAll('code_info');
        $info['market'] = $this->mdownload->findAll('market');
        $info['url'] = $this->mdownload->findAll('url');
        $info['input'] = $this->mdownload->findAll('input');
        $info['time'] = $this->mdownload->findAll('time');
        $this->data->info = $info;

        $this->data->title = "Download Histoday";
        $this->template->write_view('content', 'download/histoday', $this->data);
        $this->template->write('title', 'HSX');
        $this->template->render();
    }

    public function links(){
        if($this->input->is_ajax_request()){
            $value = $this->input->get('value');
            if($value != ''){
                $temp = explode("|", $value);
                $value = array();
                $value[$temp[0]] = $temp[1];
            }
            $data = $this->mdownload->listInfo($value);
            $aaData = array();
            foreach($data as $key => $item){
                $aaData[$key][] = '<input type="checkbox" class="chk" id="' . $item['id'] . '" code="' . $item['code_dwl'] . '" />';
                $aaData[$key][] = $item['source'];
                $aaData[$key][] = $item['code_dwl'];
                $aaData[$key][] = $item['market'];
                $aaData[$key][] = $item['language'];
                $aaData[$key][] = $item['information'];
                $aaData[$key][] = '<p style="width:120px"><a class="copy" href="javascript:void(0)" style="position: relative">' . htmlentities($item['url']) . '</a></p>';
                $aaData[$key][] = $item['time'];
                $aaData[$key][] = $item['output'];
                $aaData[$key][] = $item['input'];
                $aaData[$key][] = '<ul class="keywords" style="text-align:center;"><li class="green-keyword"><a class="btn-excute" title="" class="with-tip" code="' . $item['code_dwl'] . '" date="' . $item['time'] . '" input="' . $item['input'] . '">' . trans('bt_excute', 1) . '</a></li></ul>';
                $aaData[$key][] = $item['phpchk'];
            }
            $response = array(
                'aaData' => $aaData
            );
            echo json_encode($response);
            exit();
        }
        $this->data->title = "Download Links";
        $this->template->write_view('content', 'download/links', $this->data);
        $this->template->write('title', 'Download Links');
        $this->template->render();
    }

    public function download_links(){
        if($this->input->is_ajax_request()){
            $dir = '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\DOWNLOAD_TEST\\';
            // remove expired file
            // if($info['duration'] != ''){
            //     $check_files = glob($dir . $info['time'] . '\\' . substr($info['code_dwl'], 0, 3) . '\\' . $info['code_dwl'] . '*.txt');
            //     foreach($check_files as $item){
            //         if(checkFileExpire($item)){
            //             unlink($item);
            //         }
            //     }
            // }

            $response = '';
            $this->load->Model('exchange_model', 'mexchange');
            $this->load->library('curl');
            $curl = new curl();
            $file_exist = 0;
            $info = $this->input->post('options');
            $page = $this->input->post('page');
            $start = $this->input->post('start');
            $end = $this->input->post('end');
            $cont_tick = $this->input->post('ticker');
            $param_type = 'get';
            $param = NULL;
            $check = TRUE;
            if($info['param'] != ''){
                $param_type = 'post';
                $param = $info['param'];
                $param = str_replace(' ', '', $param);
                $param = str_replace('<<page>>', $page, $param); 
            }
            
            
            if(isset($info['market'])){
                $codes = $this->mdownload->findCodeByMarket($info['market']);
            }else{
                $codes = $this->mdownload->findCodeByMarket();
            }
            $options = $this->mexchange->getOption($info['code_dwl']);
            $format = $this->mexchange->getMetaFormat($info['output']);
            $headers = array_keys($format);
            if($page == 1){
                $method = 'w';
                $contents = strtoupper(implode(chr(9) ,$headers)) . PHP_EOL;
            }else{
                $method = 'a';
                $contents = '';
            }
            $date = time();
            if($start == ''){
                $start = $date;
            }else{
                $start = strtotime($start);
            }
            if($end == ''){
                $end = $date;
            }else{
                $end = strtotime($end);
            }
            $baseurl = $info['url'];
            if(strpos($baseurl, '<<TICKER>>') != '' || strpos($baseurl, '<<ticker>>') != ''){
                $tickers = $this->mexchange->getTicker($info['market']);
/* xoa'*/
              /*  foreach($tickers as $key => $ticker){
                     if($key > 3)
                         unset($tickers[$key]);
                }*/
/*****/
            }
            $now = time(); 
            while($start <= $end){
                $date = $start;
                $name = $info['code_dwl'] . '_' . date('Ymd', $start) . '.txt';
                $file = $dir . $info['time'] . '\\' . $info['code_src'] . '\\' . $name;
                $url = str_replace('<<date_dd/mm/yyyy>>', date('d/m/Y', $date), $baseurl);
                $url = str_replace('<<date_dd-mm-yyyy>>', date('d-m-Y', $date), $url);
                $url = str_replace('<<date_mm/dd/yyyy', date('m/d/Y', $date), $url);
                $url = str_replace('<<date_yyyymmdd>>', date('Ymd', $date), $url);
                $url = str_replace('<<page>>', $page, $url);
                $date = date('Ymd', $date);
                
                // if <<TICKER>> exist in url
                if(strpos($baseurl, '<<TICKER>>') != '' || strpos($baseurl, '<<ticker>>') != ''){
                    // while(1){
                    //     $html = $curl->makeRequest($param_type, $url, explode(',', $param), 3);
                    //     $status = substr($html, strpos($html, 'HTTP/1.1 ') + 9, 3);
                    //     if($status == 200 || $status == '200'){
                    //         break;
                    //     }
                    // }
                    // $from = strpos($html, $info['left']);
                    // $len = strpos($html, $info['right'], $from) - $from;
                    // $html = substr($html, $from, $len);
                    foreach($tickers as $ticker){
                        $contents = strtoupper(implode(chr(9) ,$headers)) . PHP_EOL;
                        if($page > 1){
                            $contents = '';
                        }
                        $ticker = $ticker['code'];
                        $name = $info['code_dwl'] . '_' . $ticker . '.txt';
                        // $dir = '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\DOWNLOAD_TEST\\' . $info['code_src'];
                        if(!is_dir($dir)){
                            mkdir($dir);
                        }
                        $file = $dir . $info['time'] . '\\' . $info['code_src'] . '\\' . $name;
                        if(!is_file($file) || (is_file($file) && $page > 1 && $method == 'a')){
                            if($page == 1){
                                $cont_tick = array();
                                $cont_tick[] = $ticker;
                                
                            }else{
                                if(is_array($cont_tick)){
                                    if(!in_array($ticker, $cont_tick)){
                                        $check = FALSE;
                                    }else{
                                        $check = TRUE;
                                    }
                                }
                            }
                            // $response['check'] = $check;
                            if($check != FALSE){
                                // $response['test'] = 123;
                                if($info['input'] == 'XLS'){
                                    $file = $dir . $info['time'] . '\\' . $info['code_src'] . '\\' . $name;
                                    $basepath = str_replace('file:/', '', $baseurl);
                                    $path = str_replace('<<TICKER>>', strtoupper($ticker), $basepath);
                                    $path = str_replace('<<ticker>>', strtolower($ticker), $path);
                                   // echo $path . '<br />';
                                    if(is_file($path)){
                                        $html = file_get_contents($path);
                                        // $html = $curl->makeRequest($param_type, $url, explode(',', $param1));
                                        $from = strpos($html, $info['left']);
                                        $len = strpos($html, $info['right'], $from) - ($from + strlen($info['left']));
                                        $html = substr($html, $from, $len);
                                        $html = str_replace($info['left'], '', $html);
                                        $html = str_replace($info['right'], '', $html);

                                        if($info['left2'] != ''){
                                            $from = strpos($html, $info['left2']);
                                            if($info['right2'] != ''){
                                                $len = strpos($info['right2'], $from) - ($from + strlen($info['left2']));
                                            }else{
                                                $len = NULL;
                                            }
                                            $html = substr($html, $from, $len);
                                            $html = str_replace($info['left2'], '', $html);
                                            $html = str_replace($info['right2'], '', $html);
                                        }
                                        if($info['del_bllef'] == ''){
                                            $info['del_bllef'] = '<tr';
                                        }
                                        $result[0] = explode($info['del_bllef'], $html);
                                        array_shift($result[0]);
                                        if(!empty($result[0])){
                                            $data = convertMetaStock($result[0], $format, $options, $info, '', $ticker);
                                            if(is_array($data)){
                                                foreach($data as $key => $item){
                                                    $data[$key]['ticker'] = $ticker;
                                                }
                                                foreach($data as $key => $item){
                                                    $item['date'] = explode('/', $item['date']);
                                                    $item['date'] = $item['date'][2] . '/' . $item['date'][1] . '/' . $item['date'][0];
                                                    $data[$key]['date'] = $item['date'];
                                                    $data[$key]['yyyymmdd'] = str_replace('/', '', $item['date']);
                                                }
                                                // pre($data);
                                                foreach($data as $item){
                                                    $values = '';
                                                    foreach($item as $key => $value){
                                                        if($key == 'source'){
                                                            $values[] = 'VSTX';
                                                        }else{
                                                            $values[] = $value;
                                                        }        
                                                    }
                                                    $contents .= implode(chr(9), $values);
                                                    $contents .= PHP_EOL;
                                                }
                                            }
                                        }                                    
                                    }
                                
                                }else{
                                    $url = str_replace('<<TICKER>>', strtoupper($ticker), $baseurl);
                                    $url = str_replace('<<ticker>>', strtolower($ticker), $url);
                                    $param1 = str_replace('<<ticker>>', $ticker, $param);
                                    $html = $curl->makeRequest($param_type, $url, explode(',', $param1));
                                    $status = substr($html, strpos($html, 'HTTP/1.1 ') + 9, 3);
                                    if($status == 200 || $status == '200'){
                                        // $html = $curl->makeRequest($param_type, $url, explode(',', $param1));
                                        $from = strpos($html, $info['left']);
                                        $len = strpos($html, $info['right'], $from) - ($from + strlen($info['left']));
                                        $html = substr($html, $from, $len);
                                        $html = str_replace($info['left'], '', $html);
                                        $html = str_replace($info['right'], '', $html);

                                        if($info['left2'] != ''){
                                            $from = strpos($html, $info['left2']);
                                            if($info['right2'] != ''){
                                                $len = strpos($info['right2'], $from) - ($from + strlen($info['left2']));
                                            }else{
                                                $len = NULL;
                                            }
                                            if($len == NULL){
                                                $html = substr($html, $from);
                                            }else{
                                                $html = substr($html, $from, $len);
                                            }
                                            $html = str_replace($info['left2'], '', $html);
                                            $html = str_replace($info['right2'], '', $html);
                                        }
                                        if($info['del_bllef'] == ''){
                                            $info['del_bllef'] = '<tr';
                                        }
                                        $result[0] = explode($info['del_bllef'], $html);
                                        array_shift($result[0]);

                                        if($info['body'] == 'Y'){
                                            // $rule = "/\<tr.*\>(.*)\<\/tr\>/msU";
                                            // preg_match_all($rule, $html, $result);
                                            // array_shift($result[0]);
                                            // $data = convertMetastock($result[0], $format, $options, $info, '', $ticker);
                                            $data = convertMetastock($result[0], $format, $options, $info, '', $ticker);
                                        }else{
                                            if($info['left2'] != ''){
                                                $from = strpos($html, $info['left2']);
                                                if($info['right2'] != ''){
                                                    $len = strpos($info['right2'], $from) - ($from + strlen($info['left2']));
                                                }else{
                                                    $len = NULL;
                                                }
                                                $html = substr($html, $from, $len);
                                                $html = str_replace($info['left2'], '', $html);
                                                $html = str_replace($info['right2'], '', $html);
                                            }
                                            $format[strtolower($info['code_info'])] = $html;
                                            $format['source'] = $info['source'];
                                            $format['ticker'] = $ticker;
                                            $format['market'] = $info['market'];
                                            $format['date'] = date('Y-m-d', $start);
                                            $format['yyyymmdd'] = date('Ymd', $start);
                                            $data[0] = $format;
                                        }
                                        // pre($data);
                                        if(is_array($data)){
                                            foreach($data as $item){
                                                $values = '';
                                                if($item['ticker'] != '&nbsp' && $item['ticker'] != '&nbsp;'){
                                                    foreach($item as $key => $value){
                                                        $value = str_replace('&nbsp;', '', $value);
                                                        $value = str_replace('&nbsp', '', $value);
                                                        $values[] = $value;
                                                    }
                                                    $contents .= implode(chr(9), $values);
                                                    $contents .= PHP_EOL;
                                                }
                                            }
                                        }
                                    }
                                }
                                $dir1 = str_replace('\\' . pathinfo($file, PATHINFO_BASENAME), '', $file);
                                if(!is_dir($dir1)){
                                    mkdir($dir1);
                                }
                                $f = fopen($file, $method);                            
                                fwrite($f, $contents);
                            }
                        }else{
                            $file_exist = 1;
                        }
                    }
                    break;
                }else{
                    $tickers = array(array('code' => ''));
                    if(strpos($param, '<<TICKER>>') != '' || strpos($param, '<<ticker>>') != '' || strpos($baseurl, '<<code_stp>>') != ''){
                        $tickers = $this->mexchange->getTicker($info['market']);
                    }
                    // $tickers = array(
                    //     array('code' => 'AGC'),
                    //     array('code' => 'AAA'),
                    //     array('code' => 'NKD'),
                    // );
                    $stox = $this->mdownload->getTickerId();
                    foreach($tickers as $ticker){
                        $content = $contents;
                        $ticker = $ticker['code'];
                        $param1 = '';
                        if($param != ''){
                            $param1 = str_replace('<<ticker>>', $ticker, $param);
                            $param1 = str_replace('<<page>>', $page, $param1);
                        }
                        // pre($stox);die();
                        if($ticker != ''){
                            $name = $info['code_dwl'] . '_' . $ticker . '.txt';
                            $url = str_replace('<<code_stp>>', $stox[$ticker], $baseurl);
                        }

                        $file = $dir . $info['time'] . '\\' . $info['code_src'] . '\\' . $name;
                        if(!is_file($file) || (is_file($file) && $page > 1 && $method == 'a')){
                            $len = NULL;
                            $count = 0;
                            if(isset($result[0])){
                                unset($result[0]);
                            }

                            while($count < 5){
                                $html = $curl->makeRequest($param_type, $url, explode(',', $param1));
                                // echo $html;die();
                                $status = substr($html, strpos($html, 'HTTP/1.1 ') + 9, 3);
                                if($status == 200 || $status == '200'){
                                    break;
                                }
                                $count++;
                            }
                            
                            $from = strpos($html, $info['left']);
                            if($info['right'] != ''){
                                if(strpos($html, $info['right'], $from) != ''){
                                    $len = strpos($html, $info['right'], $from) - ($from + strlen($info['left']));
                                    $html = substr($html, $from, $len);
                                }
                                if($len == NULL){
                                    $result[0] = 0;
                                }
                                // else{                                    
                                //     $html = substr($html, $from, $len);
                                // }
                            }else{
                                $html = substr($html, $from);
                            }
                            $html = str_replace($info['left'], '', $html);
                            $html = str_replace($info['right'], '', $html);
                            if($info['left2'] != ''){
                                $from = strpos($html, $info['left2']);
                                if($info['right2'] != ''){
                                    $len = strpos($info['right2'], $from) - ($from + strlen($info['left2']));
                                }else{
                                    $len = NULL;
                                }
                                if($len == NULL){
                                    $html = substr($html, $from);
                                }else{
                                    $html = substr($html, $from, $len);
                                }

                                $html = str_replace($info['left2'], '', $html);
                                $html = str_replace($info['right2'], '', $html);
                            }
                            if($info['del_bllef'] == ''){
                                $info['del_bllef'] = '<tr';
                            }
                            if(!isset($result[0])){
                                $result[0] = explode($info['del_bllef'], $html);
                            }

                            if(is_array($result[0])){
                                array_shift($result[0]);

                                $data = convertMetastock($result[0], $format, $options, $info, $date, $ticker);
                                if(is_array($data)){
                                    foreach($data as $item){
                                        $values = '';
                                        if(isset($item['ticker'])){
                                            if($item['ticker'] != '&nbsp' && $item['ticker'] != '&nbsp;'){
                                                foreach($item as $key => $value){
                                                    $value = str_replace('&nbsp;', '', $value);
                                                    $value = str_replace('&nbsp', '', $value);
                                                    $values[] = $value;
                                                }
                                                $content .= implode(chr(9), $values);
                                                $content .= PHP_EOL;
                                            }
                                        }else{
                                            foreach($item as $key => $value){
                                                $value = str_replace('&nbsp;', '', $value);
                                                $value = str_replace('&nbsp', '', $value);
                                                $values[] = $value;
                                            }
                                            $response['value'][] = $values;
                                            $content .= implode(chr(9), $values);
                                            $content .= PHP_EOL;
                                        }
                                    }
                                }
                                // $f = fopen($_SERVER['DOCUMENT_ROOT'] . '/ifrcdata/assets/test/' . $name, $method);
                                $dir_temp = str_replace('\\' . pathinfo($file, PATHINFO_BASENAME), '', $file);
                                if(!is_dir($dir_temp)){
                                    mkdir($dir_temp);
                                }
                                $f = fopen($file, $method);
                                fwrite($f, $content);
                                //print_r($data);
                            }
                        }else{
                            $file_exist = 1;
                        }
                    }
                    
                }

                
                $start = strtotime("+1 day", $start);
            }
            $response['ticker'] = $cont_tick;
            $response['file_exist'] =$file_exist;
            echo json_encode($response);
            
        }
    }

    public function listByColumn(){
        if($this->input->is_ajax_request()){
            $column = $this->input->post('column');
            str_replace('>>', '', $column);
            if($column == '0'){
                echo 0;
                exit();
            }
            $data = $this->mdownload->findAll($column);
            foreach($data as $item){
                if($item[$column] != '');
                $response[] = $item[$column];
            }
            echo json_encode($response);
        }
    }

    public function getOptions(){
        if($this->input->is_ajax_request()){
            $request = $this->input->post();
            if($request['code_dwl'] == '0'){
                array_shift($request);
                foreach($request as $key => $item){
                    if($item == '0'){
                        unset($request[$key]);
                    }
                }
            }else{
                $request['code_dwl'] = array_shift($request);
            }
            $info = $this->mdownload->listInfo($request);
            if(empty($info)){
                echo 0;
                exit();
            }
            echo json_encode($info);
        }
    }

    public function getInfo(){
        if($this->input->is_ajax_request()){
            $info = $this->mdownload->listInfo(array('code_dwl' => $this->input->post('code')));
            if(empty($info)){
                echo 0;
                exit();
            }
            $dir = '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\DOWNLOAD_TEST\\';
            // remove expired file
            if($info[0]['duration'] != '' && $info[0]['duration'] != 0){
                $check_files = glob($dir . $info[0]['time'] . '\\' . substr($info[0]['code_dwl'], 0, 3) . '\\' . $info[0]['code_dwl'] . '*.txt');
                foreach($check_files as $item){
                    if(checkExpiredFile($item, $info[0]['duration'])){
                        unlink($item);
                    }
                }
            }
            $this->output->set_output(json_encode($info));
        }
    }

    public function getData(){
        if($this->input->is_ajax_request()){
            $this->load->Model('exchange_model', 'mexchange');
            $this->load->library('curl');
            $curl = new curl();
            $info = $this->input->post('options');
            $page = $this->input->post('page');
            if(isset($info['market'])){
                $codes = $this->mdownload->findCodeByMarket($info['market']);
            }else{
                $codes = $this->mdownload->findCodeByMarket();
            }
            $options = $this->mexchange->getOption($info['code_dwl']);
            $format = $this->mexchange->getMetaFormat($info['output']);
            $date = time();
            $url = $info['url'];
            $url = str_replace('<<_dd/mm/yyyy>>', date('d/m/Y', $date), $url);
            $url = str_replace('<<_dd-mm-yyyy>>', date('d-m-Y', $date), $url);
            $url = str_replace('<<_yyyymmdd>>', date('Ymd', $date), $url);
            $url = str_replace('<<page>>', $page, $url);
            $date = date('Ymd', $date);
            $html = $curl->makeRequest('get', $url, NULL);
            $from = strpos($html, $info['left']);
            $len = strpos($html, $info['right'], $from) - $from;
            $html = substr($html, $from, $len);

            if(strpos($url, '<<TICKER>>') != -1 || strpos($url, '<<TICKER>>') != 1)

            if($len == '</table>'){
                $html .= '</table>';
            }
            $rule = "/\<tr.*\>(.*)\<\/tr\>/msU";
            preg_match_all($rule, $html, $result);
            //$headers = array_shift($result[0]);
            // foreach($result[0] as $key => $item){
            //     $item = explode('</td>', $item);
            //     foreach($item as $value){
            //         $data[$key][] = str_replace('&nbsp;', '', trim(strip_tags($value)));
            //     }
            // }
            $headers = array_keys($format);
            if($page == 1){
                $method = 'w';
                $contents = strtoupper(implode(chr(9) ,$headers)) . PHP_EOL;
            }else{
                $method = 'a';
                $contents = '';
            }
            
            $data = convertMetastock($result[0], $format, $options, $info, $date);
            foreach($data as $item){
                $values = '';
                foreach($item as $key => $value){
                    $values[] = $value;
                }
                $contents .= implode(chr(9), $values);
                $contents .= PHP_EOL;
            }
            
            $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/ifrcdata/assets/test/test.txt', $method);
            fwrite($file, $contents);
            print_r($data);
        }
    }

    public function daily(){
        
    }

    public function get_shares_caf(){
        $now = time();
        // $now = strtotime('2012-12-24');
        $source = 'CAF';
        $this->load->library('curl');
        $this->load->Model('exchange_model', 'mexchange');
        $curl = new curl;
        $tickers = $this->mexchange->getTicker();
        // $tickers = array(array('code' => 'AAA'));
        $temp_url = 'http://s.cafef.vn/Ajax/CongTy/BanLanhDao.aspx?sym=<<ticker>>';
        $f = fopen('\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\REFERENCE\CAF\CAF_' . date('Ymd', $now) . '.txt', 'w');
        $data[0] = array('sources', 'ticker', 'name', 'market', 'date', 'yyyymmdd', 'ipo', 'ipo_shli', 'ipo_shou', 'ftrd', 'ftrd_cls', 'shli', 'shou', 'shfn', 'capi', 'capi_fora', 'capi_forn', 'capi_stat');
        $content = implode(chr(9), end($data)) . PHP_EOL;
        fwrite($f, $content);
        foreach($tickers as $ticker){
            $ticker = $ticker['code'];
            $url = str_replace('<<ticker>>', $ticker, $temp_url);
            $html = $curl->makeRequest('get', $url, NULL);
            $start = 'KL CP đang ';
            $end = 'cp';
            $rule = "/(?<=$start).*(?=$end)/msU";
            preg_match_all($rule, $html, $result);
            if(!empty($result)){
                $market = $this->mdownload->getMarket($ticker);
                $data[] = array(
                    'sources' => $source,
                    'ticker' => $ticker,
                    'name' => '',
                    'market' => $market,
                    'date' => date('Y/m/d', $now),
                    'yyyymmdd' => str_replace('/', '', date('Y/m/d', $now)),
                    'ipo' => '',
                    'ipo_shli' => '',
                    'ipo_shou' => '',
                    'ftrd' => '',
                    'ftrd_cls' => '',
                    'shli' => trim(str_replace('&nbsp;', '', str_replace(',', '', str_replace('niêm yết :', '', $result[0][0])))) * 1,
                    'shou' => trim(str_replace('&nbsp;', '', str_replace(',', '', str_replace('lưu hành :', '', $result[0][1])))) * 1,
                    'shfn' => '',
                    'capi' => '',
                    'capi_fora' => '',
                    'capi_forn' => '',
                    'capi_stat' => ''
                );
                $content = implode(chr(9), end($data)) . PHP_EOL;
                fwrite($f, $content);
            }
            
        }
        fclose($f);
        // $this->db->insert('vndb_shares_dwl', end($data));
        // $this->db->where('sources', $source);        
        // $this->db->where('date', date('Y-m-d', $now));
        // $this->db->delete('vndb_shares_dwl');
        // $this->db->insert_batch('vndb_shares_dwl', $data);
    }

    public function get_shares_stox(){
        $now = time();
        $source = 'STP';
        $this->load->library('curl');
        $this->load->Model('download_model', 'mdownload');
        $curl = new curl;
        $tickers = $this->mdownload->getTickerId();
        // $tickers = array(array('code' => 'AAA'));
        // $tickers = array(746);
        $temp_url = 'http://stoxplus.com/stoxpage/stoxpage.asp?MenuID=4&subMenuID=13&action=home&CompanyID=<<id>>';
        $f = fopen('\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\REFERENCE\STP\STP_' . date('Ymd', $now) . '.txt', 'w');
        $i=0;
        foreach($tickers as $key => $ticker){
            unset($tickers[$key]);
            if($key == 'KBT'){
                break;
            }
        }
        $data[0] = array('sources', 'ticker', 'name', 'market', 'date', 'yyyymmdd', 'ipo', 'ipo_shli', 'ipo_shou', 'ftrd', 'ftrd_cls', 'shli', 'shou', 'shfn', 'capi', 'capi_fora', 'capi_forn', 'capi_stat');
        $content = implode(chr(9), end($data)) . PHP_EOL;
        fwrite($f, $content);
        foreach($tickers as $key => $ticker){
            // $i++;
            // if($i == 10) break;
            $url = str_replace('<<id>>', $ticker, $temp_url);
            $html = $curl->makeRequest('get', $url, NULL);
            $start = '<td class="stoxpage_text_xanh_small" style="border-bottom:#EFEFEF solid 1px;">Share outstanding<\/td>';
            $end = '<\/td>';
            $rule = "/(?<=$start).*(?=$end)/msU";
            preg_match_all($rule, $html, $result);
            
            if(!empty($result)){
                $market = $this->mdownload->getMarket($key);
                $shou = trim(str_replace('&nbsp;', '', strip_tags(str_replace(',', '', $result[0][0]))));
                if(!is_numeric($shou)){
                    $shou = 0;
                }
                $data[] = array(
                    'sources' => $source,
                    'ticker' => $key,
                    'name' => '',
                    'market' => $market,
                    'date' => date('Y/m/d', $now),                    
                    'yyyymmdd' => str_replace('/', '', date('Y/m/d', $now)),
                    'ipo' => '',
                    'ipo_shli' => '',
                    'ipo_shou' => '',
                    'ftrd' => '',
                    'ftrd_cls' => '',
                    'shli' => '',                    
                    'shou' => $shou,
                    'shfn' => '',
                    'capi' => '',
                    'capi_fora' => '',
                    'capi_forn' => '',
                    'capi_stat' => ''
                );
                $content = implode(chr(9), end($data)) . PHP_EOL;
                fwrite($f, $content);
            }
            
        }
        fclose($f);        
        // $this->db->insert('vndb_shares_dwl', end($data));
        // $this->db->where('source', $source);
        // $this->db->where('date', date('Y-m-d', $now));
        // $this->db->delete('vndb_shares_dwl');
        // $this->db->insert_batch('vndb_shares_dwl', $data);
        echo time() - $now;
    }

    public function get_shares_hnx(){
        $now = time();
        $table = 'vndb_reference_day_hnxupc';
        $this->db->truncate($table);
        $market = 'HNX';
        $this->db->where('date', date('Y-m-d', $now));
        $this->db->where('market', $market);
        $this->db->delete($table);
        $source = 'EXC';
        $this->load->library('curl');
        $this->load->Model('exchange_model', 'mexchange');
        $tickers = $this->mexchange->getTicker2($market);
        $curl = new curl;
        $url = 'http://hnx.vn/web/guest/tong-quan/';
        $f = fopen('\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\REFERENCE\EXC\SHOU\SHOU_HNX_' . date('Ymd', $now) . '.txt', 'w');
        $data[0] = array('sources', 'ticker', 'name', 'market', 'date', 'yyyymmdd', 'ipo', 'ipo_shli', 'ipo_shou', 'ftrd', 'ftrd_cls', 'shli', 'shou', 'shfn', 'capi', 'capi_fora', 'capi_forn', 'capi_stat');
        $content = implode(chr(9), end($data)) . PHP_EOL;
        fwrite($f, $content);
        $html = '';
        foreach($tickers as $ticker){
            $ticker = $ticker['ticker'];
            $post = array('maCk=' . $ticker, '_hstongquan_WAR_HnxIndexportlet_anchor=optionSelected', 'p_p_col_count=1', 'p_p_col_id=column-9', 'p_p_id=hstongquan_WAR_HnxIndexportlet', 'p_p_lifecycle=1', 'p_p_mode=view', 'p_p_state=exclusive');
            $start = '<a style="cursor: pointer;" onclick="loadPage';
            $end = '</a>';
            $start = preg_quote($start, '/');
            $end = preg_quote($end, '/');
            $rule = "/$start.*>(.*)$end/msU";
            while(1){   
                $html = $curl->makeRequest('post', $url, $post, 3);                
                preg_match_all($rule, $html, $result);
                if(!empty($result[1])){
                    if(isset($result[1][3]) || isset($result[1][4])){
                        break;
                    }
                }
            }
            
            if(!empty($result[1])){
                $shli = '';
                $shou = '';
                if(isset($result[1][3])){
                    $shou = trim(str_replace('.', '', $result[1][3]));
                    $shou = trim(str_replace(',', '', $shou)) * 1;
                }
                if(isset($result[1][4])){
                    $shli = trim(str_replace('.', '', $result[1][4]));
                    $shli = trim(str_replace(',', '', $shli)) * 1;
                }

                $data[] = array(
                    'sources' => $source,
                    'ticker' => $ticker,
                    'name' => '',
                    'market' => $market,
                    'date' => date('Y/m/d', $now),                    
                    'yyyymmdd' => str_replace('/', '', date('Y/m/d', $now)),
                    'ipo' => '',
                    'ipo_shli' => '',
                    'ipo_shou' => '',
                    'ftrd' => '',
                    'ftrd_cls' => '',
                    'shli' => $shli,                    
                    'shou' => $shou,
                    'shfn' => '',
                    'capi' => '',
                    'capi_fora' => '',
                    'capi_forn' => '',
                    'capi_stat' => ''
                );
                $content = implode(chr(9), end($data)) . PHP_EOL;
                fwrite($f, $content);
            }
        }
        array_shift($data);
        $this->db->insert_batch($table, $data);
        echo time() - $now;
        fclose($f);
    }

    public function get_shares_upc(){
        $now = time();
        $market = 'UPC';
        $table = 'vndb_reference_day_hnxupc';
        $this->db->where('date', date('Y-m-d', $now));
        $this->db->where('market', $market);
        $this->db->delete($table);
        $source = 'EXC';
        $this->load->library('curl');
        $this->load->Model('exchange_model', 'mexchange');
        $tickers = $this->mexchange->getTicker2($market);
        $curl = new curl;
        $url = 'http://hnx.vn/web/guest/tong-quan1/';
        $f = fopen('\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\REFERENCE\EXC\SHOU\SHOU_UPC_' . date('Ymd', $now) . '.txt', 'w');
        $data[0] = array('sources', 'ticker', 'name', 'market', 'date', 'yyyymmdd', 'ipo', 'ipo_shli', 'ipo_shou', 'ftrd', 'ftrd_cls', 'shli', 'shou', 'shfn', 'capi', 'capi_fora', 'capi_forn', 'capi_stat');
        $content = implode(chr(9), end($data)) . PHP_EOL;
        fwrite($f, $content);
        foreach($tickers as $ticker){
            $ticker = $ticker['ticker'];

            //$ticker = 'ABI';

            $post = array('maCk=' . $ticker, '_hstongquan_WAR_HnxIndexportlet_anchor=optionSelected', 'p_p_col_count=1', 'p_p_col_id=column-9', 'p_p_id=hstongquan_WAR_HnxIndexportlet', 'p_p_lifecycle=1', 'p_p_mode=view', 'p_p_state=exclusive');
            $start = '<a style="cursor: pointer;" onclick="loadPage';
            $end = '</a>';
            $start = preg_quote($start, '/');
            $end = preg_quote($end, '/');
            $rule = "/$start.*>(.*)$end/msU";
            $html = '';
            while(1){   
                $html = $curl->makeRequest('post', $url, $post, 3);
                preg_match_all($rule, $html, $result);
                if(!empty($result[1])){
                    if(isset($result[1][3]) || isset($result[1][4])){
                        break;
                    }
                }
            }
            if(!empty($result[1])){
                $shli = '';
                $shou = '';
                if(isset($result[1][3])){
                    $shou = trim(str_replace('.', '', $result[1][3]));
                    $shou = trim(str_replace(',', '', $shou)) * 1;
                }
                if(isset($result[1][4])){
                    $shli = trim(str_replace('.', '', $result[1][4]));
                    $shli = trim(str_replace(',', '', $shli)) * 1;
                }


                $data[] = array(
                    'sources' => $source,
                    'ticker' => $ticker,
                    'name' => '',
                    'market' => $market,
                    'date' => date('Y/m/d', $now),                    
                    'yyyymmdd' => str_replace('/', '', date('Y/m/d', $now)),
                    'ipo' => '',
                    'ipo_shli' => '',
                    'ipo_shou' => '',
                    'ftrd' => '',
                    'ftrd_cls' => '',
                    'shli' => $shli,                    
                    'shou' => $shou,
                    'shfn' => '',
                    'capi' => '',
                    'capi_fora' => '',
                    'capi_forn' => '',
                    'capi_stat' => ''
                );
                $content = implode(chr(9), end($data)) . PHP_EOL;
                fwrite($f, $content);
            }else{
                $fails[] = $ticker;
            }
        }
        array_shift($data);
        $this->db->insert_batch($table, $data);
        echo time() - $now;
        fclose($f);
    }

    function action(){
        if($this->input->is_ajax_request()){
            $this->get_shares_hnx();
            $this->get_shares_upc();
        }        
        $this->data->title = "Action";
        $this->template->write_view('content', 'download/action', $this->data);
        $this->template->write('title', 'Action');
        $this->template->render();

    }

    public function get_exc(){
        $now = time();
        $table = 'vndb_stats_auto';
        // get hsx
        $market = 'HSX';
        $this->load->library('curl');
        $curl = new curl;
        $url = 'http://www.hsx.vn/hsx/Modules/Giaodich/KQGDCN.aspx';
        $method = 'post';
        $post = NULL;
        $start = 'Cổ Phiếu / Stocks</span></td>';
        $end = '</td>';
        $value = download_exc($market, $url, $start, $end, $method, $post);

        $start = 'Chứng Chỉ Quỹ / IFCs</span></td>';
        $value2 = download_exc($market, $url, $start, $end, $method, $post);
    
        $svlm_exc = 0;
        $strn_exc = 0;
        $svlmkl_exc = 0;
        $strnkl_exc = 0;

        if($value != ''){
            $value = $value[0];
            if(isset($value[0])){
                $svlm_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $value[0]))), 'vn') * 1;
                if($value2 != ''){
                    if(isset($value2[0][0])){
                        $svlmkl_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $value2[0][0]))), 'vn') * 1;
                        $svlmkl_exc += $svlm_exc;
                    }
                }
            }
            if(isset($value[1])){
                $strn_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $value[1]))), 'vn') * 1000;
                if($value2 != ''){
                    if(isset($value2[0][1])){
                        $strnkl_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $value2[0][1]))), 'vn') * 1000;
                        $strnkl_exc += $strn_exc;
                    }
                }
            }
            
            
            $data = array(
                'market' => $market,
                'date' => date('Y/m/d', $now),                    
                'yyyymmdd' => date('Ymd', $now),
                'yyyymm' => date('Ym', $now),
                'yyyy' => date('Y', $now),
                'per' => 'D',
                'svlm_exc' => $svlm_exc,
                'strn_exc' => $strn_exc,
                'svlmkl_exc' => $svlmkl_exc,
                'strnkl_exc' => $strnkl_exc
            );
            $where = array(
                'market' => $data['market'],
                'yyyymmdd' => $data['yyyymmdd']
            );
            // $this->mdownload->update_exc($table, $data, $where);

            $file = '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\STATISTICS\DAY\STATS_HSX_' . $data['yyyymmdd'] . '.txt';
            $headers = array_keys($data);
            $content = implode(chr(9), $headers) . PHP_EOL;
            $content .= implode(chr(9), $data) . PHP_EOL;
            $f = fopen($file, 'w');
            fwrite($f, $content);
            fclose($f);
            
        }

        // get hnx
        $market = 'HNX';
        $this->load->library('curl');
        $curl = new curl;
        $post = 'p_p_id=gdtkkqgd_WAR_HnxIndexportlet&p_p_lifecycle=1&p_p_state=exclusive&p_p_mode=view&p_p_col_id=column-1&p_p_col_count=2&_gdtkkqgd_WAR_HnxIndexportlet_anchor=queryAction&_gdtkkqgd_WAR_HnxIndexportlet_cmd=&_gdtkkqgd_WAR_HnxIndexportlet_par_tk_type=0&_gdtkkqgd_WAR_HnxIndexportlet_par_ad_view=&_gdtkkqgd_WAR_HnxIndexportlet_par_idx=HNX_INDEX&_gdtkkqgd_WAR_HnxIndexportlet_par_chart_kl=&_gdtkkqgd_WAR_HnxIndexportlet_par_chart_gt=&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=0&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=1&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=2&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_idx=HNX_INDEX&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_idx=HNX30&as_fid=rlMD6I7rsttLF64BTe/G';
        $post = explode('&', $post);
        $method = 'post';
        $url = 'http://hnx.vn/web/guest/ket-qua-giao-dich';

        $start = '<tr class=';
        $end = '<td>';
        $value = download_exc($market, $url, $start, $end, $method, $post);

        $svlm_exc = 0;
        $strn_exc = 0;
        $svlmtt_exc = 0;
        $strntt_exc = 0;
        $method = 'w';
        if($value != ''){
            foreach($value as $item){
                $content = '';
                $data = '';
                if(isset($item[0])){
                    $date = trim(strip_tags($item[0]));
                    $date = strtotime($date);
                    $date = date('Y-m-d', $date);
                }
                if(isset($item[1])){
                    $svlm_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $item[1]))), 'vn') * 1;
                }
                if(isset($item[2])){
                    $strn_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $item[2]))), 'vn') * 1000;
                }  
                if(isset($item[5])){
                    $svlmtt_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $item[5]))), 'vn') * 1;
                }
                if(isset($item[6])){
                    $strntt_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $item[6]))), 'vn') * 1000;
                }
                $data = array(
                    'market' => $market,
                    'date' => date('Y/m/d', $now),                    
                    'yyyymmdd' => date('Ymd', strtotime($date)),
                    'yyyymm' => date('Ym', strtotime($date)),
                    'yyyy' => date('Y', strtotime($date)),
                    'per' => 'D',
                    'svlm_exc' => $svlm_exc,
                    'strn_exc' => $strn_exc,
                    'svlmkl_exc' => $svlm_exc,
                    'strnkl_exc' => $strn_exc,
                    'svlmtt_exc' => $svlmtt_exc,
                    'strntt_exc' => $strntt_exc
                );
                $where = array(
                    'market' => $data['market'],
                    'yyyymmdd' => $data['yyyymmdd']
                );
                // $this->mdownload->update_exc($table, $data, $where);

                $file = '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\STATISTICS\DAY\STATS_HNX_' . str_replace('/', '', $data['date']) . '.txt';
                if($method == 'w'){
                    $headers = array_keys($data);
                    $content .= implode(chr(9), $headers) . PHP_EOL;
                }
                $content .= implode(chr(9), $data) . PHP_EOL;
                $f = fopen($file, $method);
                fwrite($f, $content);
                fclose($f);
                $method = 'a';
            }
        }

        //get upc
        $market = 'UPC';
        $this->load->library('curl');
        $curl = new curl;
        $post = 'p_p_id=gdtkkqgd_WAR_HnxIndexportlet&p_p_lifecycle=1&p_p_state=exclusive&p_p_mode=view&p_p_col_id=column-1&p_p_col_count=1&_gdtkkqgd_WAR_HnxIndexportlet_anchor=queryAction&_gdtkkqgd_WAR_HnxIndexportlet_cmd=&_gdtkkqgd_WAR_HnxIndexportlet_par_tk_type=0&_gdtkkqgd_WAR_HnxIndexportlet_par_ad_view=&_gdtkkqgd_WAR_HnxIndexportlet_par_idx=UPCOM_INDEX&_gdtkkqgd_WAR_HnxIndexportlet_par_chart_kl=&_gdtkkqgd_WAR_HnxIndexportlet_par_chart_gt=&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=0&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=1&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=2&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_idx=UPCOM_INDEX&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_idx=HNX30&as_fid=Kqrm0ZM5htjGvZ+oxs38';
        $post = explode('&', $post);
        $method = 'post';
        $url = 'http://hnx.vn/web/guest/ket-qua-giao-dich2';

        $start = '<tr class=';
        $end = '<td>';
        $value = download_exc($market, $url, $start, $end, $method, $post);
        $svlm_exc = 0;
        $strn_exc = 0;
        $svlmtt_exc = 0;
        $strntt_exc = 0;
        $method = 'w';
        if($value != ''){
            foreach($value as $item){
                $content = '';
                $data = '';
                if(isset($item[0])){
                    $date = trim(strip_tags($item[0]));
                    $date = strtotime($date);
                    $date = date('Y-m-d', $date);
                }
                if(isset($item[1])){
                    $svlm_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $item[1]))), 'vn') * 1;
                }
                if(isset($item[2])){
                    $strn_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $item[2]))), 'vn') * 1000;
                }
                if(isset($item[5])){
                    $svlmtt_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $item[5]))), 'vn') * 1;
                }
                if(isset($item[6])){
                    $strntt_exc = convertNumber2Us(trim(strip_tags(str_replace('""', '"', $item[6]))), 'vn') * 1000;
                }
                $data = array(
                    'market' => $market,
                    'date' => date('Y/m/d', $now),                    
                    'yyyymmdd' => date('Ymd', strtotime($date)),
                    'yyyymm' => date('Ym', strtotime($date)),
                    'yyyy' => date('Y', strtotime($date)),
                    'per' => 'D',
                    'svlm_exc' => $svlm_exc,
                    'strn_exc' => $strn_exc,
                    'svlmkl_exc' => $svlm_exc,
                    'strnkl_exc' => $strn_exc,
                    'svlmtt_exc' => $svlmtt_exc,
                    'strntt_exc' => $strntt_exc
                );

                $where = array(
                    'market' => $data['market'],
                    'yyyymmdd' => $data['yyyymmdd']
                );
                // $this->mdownload->update_exc($table, $data, $where);

                $file = '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\STATISTICS\DAY\STATS_UPC_' . str_replace('/', '', $data['date']) . '.txt';
                if($method == 'w'){
                    $headers = array_keys($data);
                    $content .= implode(chr(9), $headers) . PHP_EOL;
                }
                $content .= implode(chr(9), $data) . PHP_EOL;
                $f = fopen($file, $method);
                fwrite($f, $content);
                fclose($f);
                $method = 'a';
            }

        }

        $array = array();
        $array = array(
            'D' => '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\STATISTICS\DAY\\',
            'M' => '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\STATISTICS\MONTH\\',
            'Y' => '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\STATISTICS\YEAR\\',
        );
        foreach($array as $key => $item){
            $this->import_exc($item, $key);
        }

        $this->db->query("UPDATE vndb_stats_daily A, vndb_stats_auto B SET 
        A.SVLM_EXC = IF(B.SVLM_EXC = 0 || B.SVLM_EXC IS NULL, A.SVLM_EXC, B.SVLM_EXC),
        A.STRN_EXC = IF(B.STRN_EXC = 0 || B.STRN_EXC IS NULL, A.STRN_EXC, B.STRN_EXC),
        A.SVLMKL_EXC = IF(B.SVLMKL_EXC = 0 || B.SVLMKL_EXC IS NULL, A.SVLMKL_EXC, B.SVLMKL_EXC),
        A.STRNKL_EXC = IF(B.STRNKL_EXC = 0 || B.STRNKL_EXC IS NULL , A.STRNKL_EXC, B.STRNKL_EXC),
        A.SVLMTT_EXC = IF(B.SVLMTT_EXC = 0 || B.SVLMTT_EXC IS NULL, A.SVLMTT_EXC, B.SVLMTT_EXC),
        A.STRNTT_EXC = IF(B.STRNTT_EXC = 0 || B.STRNTT_EXC IS NULL , A.STRNTT_EXC, B.STRNTT_EXC)
        WHERE A.MARKET = B.MARKET AND A.YYYYMMDD = B.YYYYMMDD AND B.per = 'D'");
        $this->mdownload->order_table('vndb_stats_daily', array('yyyymmdd'=>'DESC', 'market'=>'ASC'));
        
    }

    public function get_exc_monthly(){
        $this->load->Model('exchange_model', 'mexchange');

        $now = time();
        $path = '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\STATISTICS\MONTH\\';
        $array = array(
            array(
                'code_dwl' => 'EXCSTAMHNX',
                'market' => 'HNX',
            ),
            array(
                'code_dwl' => 'EXCSTAMUPC',
                'market' => 'UPC',
            ),
            array(
                'code_dwl' => 'EXCSTAMHSX1',
                'market' => 'HSX1',
            ),
            array(
                'code_dwl' => 'EXCSTAMHSX3',
                'market' => 'HSX3',
            ),
        );

        foreach($array as $item){
            $file = $path . 'STATS_' . $item['market'] . '_' . date('Ymd', $now) . '.txt';
            $info = '';
            $info = $this->mdownload->listInfo(array('code_dwl' => $item['code_dwl']));
            $info = $info[0];
            $options = $this->mexchange->getOption($item['code_dwl']);
            $format = $this->mexchange->getMetaFormat($info['output']);
            $market = $item['market'];
            $this->load->library('curl');
            $curl = new curl;
            $post = NULL;
            $url = str_replace('<<_date_yyyymm>>', date('Ym', $now), $info['url']);
            $html = $curl->makeRequest($info['vfpgetpost'], $url, $post);
            $len = '';
            $from = strpos($html, $info['left']);
            if(strpos($html, $info['right'], $from) != ''){
                $len = strpos($html, $info['right'], $from) - ($from + strlen($info['left']));
            }
            if($len == ''){
                $html = substr($html, $from);
            }else{
                $html = substr($html, $from, $len);
            }
            if($info['del_bllef'] == ''){
                $info['del_bllef'] = '<tr';
            }


            $result[0] = explode($info['del_bllef'], $html);
            array_shift($result[0]);
            if(isset($format['per'])){
                unset($format['per']);
            }
            if($item['market'] == 'HSX1'){
                unset($format['svlmkl_exc']);
                unset($format['strnkl_exc']);
                unset($format['svlmtt_exc']);
                unset($format['strntt_exc']);
            }
            if($item['market'] == 'HSX3'){
                unset($format['svlm_exc']);
                unset($format['strn_exc']);
            }

            unset($format['yyyymmdd']);
            $data = convertMetaStock($result[0], $format, $options, $info);

            array_pop($data);
            foreach($data as $key => $item){
                if($item['market'] == 'HSX'){
                    $delimitor = '-';
                    if(isset($item['svlmtt_exc']) || isset($item['strntt_exc'])){
                        $item['svlmtt_exc'] += $item['svlmkl_exc'];
                        $item['strntt_exc'] += $item['strnkl_exc'];
                    }
                }else{
                    $delimitor = '/';
                }
                $dtemp = explode($delimitor, $item['yyyymm']);
                $item['yyyymm'] = $dtemp[1] . '-' . $dtemp[0];
                // pre($item);
                $date = strtotime($item['yyyymm']);                
                $item['yyyymm'] = date('Ym', $date);
                $item['yyyy'] = date('Y', $date);
                $item['date'] = date('Y-m-d');
                $item['per'] = 'M';
                $table = 'vndb_stats_auto';
                $where = array(
                    'market' => $item['market'],
                    'yyyymm' => $item['yyyymm']
                );
                $this->mdownload->update_exc($table, $item, $where);
                $data[$key] = $item;
            }
            pre($data);
            $content = implode(chr(9), array_keys(end($data))) . PHP_EOL;
            foreach($data as $item){
                $content .= implode(chr(9), $item) . PHP_EOL;
            }
            $f = fopen($file, 'w');
            fwrite($f, $content);
            fclose($f);
        }
        $this->db->query("UPDATE vndb_stats_monthly A, vndb_stats_auto B SET 
        A.SVLM_EXC = IF(B.SVLM_EXC = 0 || B.SVLM_EXC IS NULL, A.SVLM_EXC, B.SVLM_EXC),
        A.STRN_EXC = IF(B.STRN_EXC = 0 || B.STRN_EXC IS NULL, A.STRN_EXC, B.STRN_EXC),
        A.SVLMKL_EXC = IF(B.SVLMKL_EXC = 0 || B.SVLMKL_EXC IS NULL, A.SVLMKL_EXC, B.SVLMKL_EXC),
        A.STRNKL_EXC = IF(B.STRNKL_EXC = 0 || B.STRNKL_EXC IS NULL , A.STRNKL_EXC, B.STRNKL_EXC),
        A.SVLMTT_EXC = IF(B.SVLMTT_EXC = 0 || B.SVLMTT_EXC IS NULL, A.SVLMTT_EXC, B.SVLMTT_EXC),
        A.STRNTT_EXC = IF(B.STRNTT_EXC = 0 || B.STRNTT_EXC IS NULL , A.STRNTT_EXC, B.STRNTT_EXC)
        WHERE A.MARKET = B.MARKET AND A.YYYYMM = B.YYYYMM AND B.per = 'M'");
        // $this->mdownload->order_table('vndb_stats_daily', array('date'=>'DESC', 'market'=>'ASC'));
    }

    public function get_exc_yearly(){
        $this->load->Model('exchange_model', 'mexchange');

        $now = time();
        $path = '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\STATISTICS\YEAR\\';
        $array = array(
            array(
                'code_dwl' => 'EXCSTAYHNX',
                'market' => 'HNX',
            ),
            array(
                'code_dwl' => 'EXCSTAYUPC',
                'market' => 'UPC',
            ),
        );

        foreach($array as $item){
            $file = $path . 'STATS_' . $item['market'] . '_' . date('Ymd', $now) . '.txt';
            $info = '';
            $info = $this->mdownload->listInfo(array('code_dwl' => $item['code_dwl']));
            $info = $info[0];
            $options = $this->mexchange->getOption($item['code_dwl']);
            $format = $this->mexchange->getMetaFormat($info['output']);
            $market = $item['market'];
            $this->load->library('curl');
            $curl = new curl;
            $post = NULL;
            $url = str_replace('<<_date_yyyy>>', date('Y', $now), $info['url']);
            $html = $curl->makeRequest($info['vfpgetpost'], $url, $post);
            $len = '';
            $from = 0;
            if($info['left'] != ''){
                $from = strpos($html, $info['left']);
            }
            if(strpos($html, $info['right'], $from) != ''){
                $len = strpos($html, $info['right'], $from) - ($from + strlen($info['left']));
            }
            
            if($len == ''){
                $html = substr($html, $from);
            }else{
                $html = substr($html, $from, $len);
            }
            if($info['del_bllef'] == ''){
                $info['del_bllef'] = '<tr';
            }
            $result[0] = explode($info['del_bllef'], $html);
            array_shift($result[0]);
            if(isset($format['per'])){
                unset($format['per']);
            }
            unset($format['yyyymmdd']);
            unset($format['yyyymm']);
            $data = convertMetaStock($result[0], $format, $options, $info);

            array_pop($data);
            foreach($data as $key => $item){                
                $item['date'] = date('Y-m-d');
                $item['per'] = 'Y';
                $table = 'vndb_stats_auto';
                $where = array(
                    'market' => $item['market'],
                    'yyyy' => $item['yyyy']
                );
                $this->mdownload->update_exc($table, $item, $where);
                $data[$key] = $item;
            }

            $content = implode(chr(9), array_keys(end($data))) . PHP_EOL;
            foreach($data as $item){
                $content .= implode(chr(9), $item) . PHP_EOL;
            }
            $f = fopen($file, 'w');
            fwrite($f, $content);
            fclose($f);
        }
        $this->db->query("UPDATE vndb_stats_yearly A, vndb_stats_auto B SET 
        A.SVLM_EXC = IF(B.SVLM_EXC = 0 || B.SVLM_EXC IS NULL, A.SVLM_EXC, B.SVLM_EXC),
        A.STRN_EXC = IF(B.STRN_EXC = 0 || B.STRN_EXC IS NULL, A.STRN_EXC, B.STRN_EXC),
        A.SVLMKL_EXC = IF(B.SVLMKL_EXC = 0 || B.SVLMKL_EXC IS NULL, A.SVLMKL_EXC, B.SVLMKL_EXC),
        A.STRNKL_EXC = IF(B.STRNKL_EXC = 0 || B.STRNKL_EXC IS NULL , A.STRNKL_EXC, B.STRNKL_EXC),
        A.SVLMTT_EXC = IF(B.SVLMTT_EXC = 0 || B.SVLMTT_EXC IS NULL, A.SVLMTT_EXC, B.SVLMTT_EXC),
        A.STRNTT_EXC = IF(B.STRNTT_EXC = 0 || B.STRNTT_EXC IS NULL , A.STRNTT_EXC, B.STRNTT_EXC)
        WHERE A.MARKET = B.MARKET AND A.YYYY = B.YYYY AND B.per = 'Y'");

        // $this->mdownload->order_table('vndb_stats_daily', array('date'=>'DESC', 'market'=>'ASC'));
    }

    public function update_exc(){
        $table = 'vndb_stats_daily';
        $sql = "UPDATE {$table} A, (SELECT yyyymmdd, market, vlm, trn FROM vndb_prices_history WHERE LENGTH(ticker) = 3) B SET A.svlm_vndb = B.vlm WHERE A.yyyymmdd = B.yyyymmdd AND A.market = B.market AND (A.svlm_vndb = 0 OR A.svlm_vndb IS NULL);
                UPDATE {$table} A, (SELECT yyyymmdd, market, vlm, trn FROM vndb_prices_history WHERE LENGTH(ticker) = 3) B SET A.strn_vndb = B.trn WHERE A.yyyymmdd = B.yyyymmdd AND A.market = B.market AND (A.strn_vndb = 0 OR A.strn_vndb IS NULL);
                UPDATE {$table} A, (SELECT yyyymmdd, market, vlm, trn FROM vndb_prices_history) B SET A.svlmkl_vndb = B.vlm WHERE A.yyyymmdd = B.yyyymmdd AND A.market = B.market AND (A.svlmkl_vndb = 0 OR A.svlmkl_vndb IS NULL);
                UPDATE {$table} A, (SELECT yyyymmdd, market, vlm, trn FROM vndb_prices_history) B SET A.strnkl_vndb = B.trn WHERE A.yyyymmdd = B.yyyymmdd AND A.market = B.market AND (A.strnkl_vndb = 0 OR A.strnkl_vndb IS NULL);
                UPDATE {$table} SET correct_vlm = (IF(svlm_exc = svlm_vndb, 1, 0)), correct_trn = (IF(strn_exc = strn_vndb, 1, 0));
                UPDATE {$table} SET correct = (IF(correct_vlm = 1 AND correct_trn = 1, 1, 0));
                UPDATE {$table} SET svlm_diff = svlm_exc - svlm_vndb, strn_diff = strn_exc - strn_vndb";
        $sql = explode(';', $sql);
        foreach($sql as $item){
            $this->db->query($item);
        }
    }


    public function test(){
        $start = '2013-01-02';
        $end = '2013-01-07';
        $date = $start;
        $markets = array('HNX', 'UPC');
        $path = '\\\LOCAL\IFRCDATA\DOWNLOADS\VNDB\METASTOCK\REFERENCE\EXC2\\';
        foreach($markets as $market){
            $start = $date;
            while($start <= $end){
                $this->db->where('date', $start);
                $this->db->where('market', $market);
                $rows = $this->db->get('vndb_reference_daily')->result_array();
                pre($rows);
                if(!empty($rows)){
                    $f = fopen($path . 'REF_' . $market . '_' . str_replace('-', '', $start) . '.txt', 'w');
                    $headers = array_keys($rows[0]);
                    $content = implode(chr(9), $headers) . PHP_EOL;
                    foreach($rows as $key => $row){
                        $rows[$key]['shli'] = $row['shou'];
                        $rows[$key]['shou'] = $row['shli'];
                        $content .= implode(chr(9), $rows[$key]) . PHP_EOL;
                    }
                    fwrite($f, $content);
                    fclose($f);
                }
                $start = strtotime("+1 day", strtotime($start));
                $start = date('Y-m-d', $start);
            }
        }
        
    }
    
    public function get_exc_history(){
        $now = time();

        // get hsx
        $market = 'HSX';
        $this->load->library('curl');
        $curl = new curl;
        $url = 'http://www.hsx.vn/hsx/Modules/Giaodich/KQGDCN.aspx';
        $method = 'post';
        $start = 'Cổ Phiếu / Stocks</span></td>';
        $end = '</td>';
        $post = NULL;
        $value = download_exc($market, $url, $start, $end, $method, $post);
    
        $svlm_exc = '';
        $strn_exc = '';
        if(isset($value)){
            if(isset($value[0])){
                $svlm_exc = trim(str_replace('.', '', strip_tags(str_replace('""', '"', $value[0])))) * 1;
            }
            if(isset($value[1])){
                $strn_exc = trim(str_replace('.', '', strip_tags(str_replace('""', '"', $value[1])))) * 1000;
            }
            if($svlm_exc != '' || $strn_exc != ''){
                $data = array(
                    'market' => $market,
                    'date' => date('Y/m/d', $now),                    
                    'yyyymmdd' => str_replace('/', '', date('Y/m/d', $now)),
                    'svlm_exc' => $svlm_exc,
                    'strn_exc' => $strn_exc
                );
                pre($data);
                $this->mdownload->update_exc($data);
            }
            
        }

        // get hnx
        $market = 'HNX';
        $this->load->library('curl');
        $curl = new curl;
        $post = 'p_p_id=gdtkkqgd_WAR_HnxIndexportlet&p_p_lifecycle=1&p_p_state=exclusive&p_p_mode=view&p_p_col_id=column-1&p_p_col_count=2&_gdtkkqgd_WAR_HnxIndexportlet_anchor=queryAction&_gdtkkqgd_WAR_HnxIndexportlet_cmd=&_gdtkkqgd_WAR_HnxIndexportlet_par_tk_type=0&_gdtkkqgd_WAR_HnxIndexportlet_par_ad_view=&_gdtkkqgd_WAR_HnxIndexportlet_par_idx=HNX_INDEX&_gdtkkqgd_WAR_HnxIndexportlet_par_chart_kl=&_gdtkkqgd_WAR_HnxIndexportlet_par_chart_gt=&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=0&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=1&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=2&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_idx=HNX_INDEX&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_idx=HNX30&as_fid=rlMD6I7rsttLF64BTe/G';
        $post = explode('&', $post);
        $method = 'post';
        $url = 'http://hnx.vn/web/guest/ket-qua-giao-dich';

        $start = '<tr class="odd">';
        $end = '<td>';

        $value = download_exc($market, $url, $start, $end, $method, $post);

        $svlm_exc = '';
        $strn_exc = '';
        if(isset($value)){
            if(isset($value[0])){
                $date = trim(strip_tags($value[0]));
                $date = strtotime($date);
                $date = date('Y-m-d', $date);
            }
            if(isset($value[1])){
                $svlm_exc = trim(str_replace('.', '', strip_tags(str_replace('""', '"', $value[1])))) * 1;
            }
            if(isset($value[2])){
                $strn_exc = trim(str_replace('.', '', strip_tags(str_replace('""', '"', $value[2])))) * 1;
            }
            if($svlm_exc != '' || $strn_exc != ''){
                $data = array(
                    'market' => $market,
                    'date' => date('Y/m/d', $now),                    
                    'yyyymmdd' => str_replace('/', '', date('Y/m/d', $now)),
                    'svlm_exc' => $svlm_exc,
                    'strn_exc' => $strn_exc
                );
                pre($data);
                $this->mdownload->update_exc($data);
            }
            
        }

        //get upc
        $market = 'UPC';
        $this->load->library('curl');
        $curl = new curl;
        $post = 'p_p_id=gdtkkqgd_WAR_HnxIndexportlet&p_p_lifecycle=1&p_p_state=exclusive&p_p_mode=view&p_p_col_id=column-1&p_p_col_count=1&_gdtkkqgd_WAR_HnxIndexportlet_anchor=queryAction&_gdtkkqgd_WAR_HnxIndexportlet_cmd=&_gdtkkqgd_WAR_HnxIndexportlet_par_tk_type=0&_gdtkkqgd_WAR_HnxIndexportlet_par_ad_view=&_gdtkkqgd_WAR_HnxIndexportlet_par_idx=UPCOM_INDEX&_gdtkkqgd_WAR_HnxIndexportlet_par_chart_kl=&_gdtkkqgd_WAR_HnxIndexportlet_par_chart_gt=&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=0&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=1&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_tk_type=2&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_idx=UPCOM_INDEX&_gdtkkqgd_WAR_HnxIndexportlet_rd_par_idx=HNX30&as_fid=Kqrm0ZM5htjGvZ+oxs38';
        $post = explode('&', $post);
        $method = 'post';
        $url = 'http://hnx.vn/web/guest/ket-qua-giao-dich2';

        $start = '<tr class="odd">';
        $end = '<td>';
        $value = download_exc($market, $url, $start, $end, $method, $post);
        $svlm_exc = '';
        $strn_exc = '';
        if(isset($value)){
            if(isset($value[0])){
                $date = trim(strip_tags($value[0]));
                $date = strtotime($date);
                $date = date('Y-m-d', $date);
            }
            if(isset($value[1])){
                $svlm_exc = trim(str_replace('.', '', strip_tags(str_replace('""', '"', $value[1])))) * 1;
            }
            if(isset($value[2])){
                $strn_exc = trim(str_replace('.', '', strip_tags(str_replace('""', '"', $value[2])))) * 1;
            }
            if($svlm_exc != '' || $strn_exc != ''){
                $data = array(
                    'market' => $market,
                    'date' => date('Y/m/d', $now),                    
                    'yyyymmdd' => str_replace('/', '', date('Y/m/d', $now)),
                    'svlm_exc' => $svlm_exc,
                    'strn_exc' => $strn_exc
                );
                pre($data);
                $this->update_exc($data);
            }
                
            
        }
        $this->mdownload->order_table('vndb_stats_daily', array('date'=>'DESC', 'market'=>'ASC'));
    }

    function import_exc($path, $type = 'D'){
        $check = array();
        $files = glob($path . '*.txt');
        switch($type){
            case 'D':
                $date_type = 'yyyymmdd';
                $date_format = 'Ymd';
            break;
            case 'M':
                $date_type = 'yyyymm';
                $date_format = 'Ym';
            break;
            case 'Y':
                $date_type = 'yyyy';
                $date_format = 'Y';
            break;
        }
        if(!empty($files)){
            foreach($files as $file1){
                // echo $file1 . '<br />';continue;
                $data = '';
                $file = fopen($file1, 'r');
                $i = 0;
                while($content = fgetcsv($file, 0, "\t")){
                    if($i == 0){
                        $headers = $content;
                    }else{
                        foreach($content as $key => $item){
                            $temp[$headers[$key]] = $item;
                        }
                        
                        if(!in_array($temp[$date_type], $check)){
                            $check[] = $temp[$date_type];
                            $temp['per'] = $type;
                            $data[] = $temp;
                        }
                        $temp = '';
                    }                    
                    $i++;
                }
                pre($data);
                if(is_array($data)){
                    foreach($data as $item){   
                        $where = array(
                            'market' => $item['market'],
                            $date_type => $item[$date_type],
                            'per' => $date_format
                        );
                        $this->mdownload->update_exc('vndb_stats_auto', $item, $where);
                    }
                }
            }        
        }
    }

    function checkTicker(){
        if($this->input->is_ajax_request()){
            $path = $this->input->post('path');
            $market = $this->input->post('market');
            $code = $this->input->post('code');
            $pos = $this->input->post('pos');
            $this->output->set_output(json_encode(checkTicker($path, $code, $market, $pos)));
        }
    }

    function downloadtest(){
        $this->mdownload->order_table('vndb_stats_daily', array('date'=>'DESC', 'market'=>'ASC'));
    }
}
