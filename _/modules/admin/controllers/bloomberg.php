<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  bloomberg.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  controller sys format                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2013.03.01 (Tung)        New Create      */
/* * ****************************************************************** */

class Bloomberg extends Admin {

    public $table;
    public $pages;

    public function __construct() {
        parent::__construct();
        $this->load->Model('sysformat_model', 'msys');
        $this->table = $this->input->get('table');
        if ($this->table == '') {
            $this->table = 'sys_format';
        }
        $this->pages = $this->uri->segment(2);
    }

    public function index(){
        $now = time();
        $code = 'JPYVND';
        $this->db->select('code');
        $codes = $this->db->get('cur_ref')->result_array();        
        $headers = $this->db->list_fields('vndb_currency');
        $contents = implode(chr(9), $headers) . PHP_EOL;
        $i = 0;
        foreach($codes as $code){
            $data = array();
            $code = $code['code'];
            $url = 'http://www.bloomberg.com/apps/data?pid=webpxta&Securities='. $code . ':CUR&TimePeriod=5Y&Outfields=HDATE,PR004-H,PR005-H,PR006-H,PR007-H,PR008-H,PR013-H%22';
            $html = file_get_contents($url);
            $data = explode("\n", $html);
            array_shift($data);
            array_pop($data);
            array_pop($data);
            foreach($data as $key => $item){
                $data[$key] = trim($item);
                $item = substr($item, 0, strlen($item) - 2);
                $data[$key] = str_replace(array('" "', '"'), chr(9), $item);
                $yyyymmdd =  substr($data[$key], 0, 8);
                $data[$key] = date('Y-m-d', $now) . chr(9) . $code . chr(9) . $data[$key];
                $contents .= $data[$key] . PHP_EOL;
                $temp = '';
                $temp = explode(chr(9), $data[$key]);
                foreach($headers as $k => $header){
                    $data_insert[$i][$header] = $temp[$k];
                }
                $i++;
                $this->db->where(array('code' => $code, 'yyyymmdd' => $yyyymmdd));
                $this->db->delete('vndb_currency');
            }
        }
        $this->db->insert_batch('vndb_currency', $data_insert);
        $path = $this->_host . 'IFRCDATA\DOWNLOADS\VNDB\METASTOCK\CURRENCY\VNDB_CURRENCY_' . date('Ymd', $now) . '.txt'; 
        $f = fopen($path, 'w');
        fwrite($f, $contents);
        fclose($f);
        redirect(admin_url());
    }

}