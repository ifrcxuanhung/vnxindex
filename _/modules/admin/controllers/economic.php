<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  article.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  controller article                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.08.14 (LongNguyen)        New Create      */
/* * ****************************************************************** */

class Economic extends Admin {

    protected $data;
    public $vndb_economics_data = "vndb_economics_data";
    public $vndb_economics_ref = "vndb_economics_ref";

    function __construct() {
        parent::__construct();
        $this->load->helper(array('my_array_helper', 'form'));
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
        
        $this->data->title = 'List Economics';
        // $this->db->limit(3, 0);
        $this->data->ecoms = $this->db->get('vndb_economics_ref')->result_array();


        $this->template->write_view('content', 'economic/economic_list', $this->data);
        $this->template->write('title', 'Economics ');
        $this->template->render();
    }

    function data($code = ""){
        $this->data->title = 'List Economics';
        $sql = "SELECT indcode, code_ctr, CONCAT({$this->vndb_economics_ref}.name, ' - ', {$this->vndb_economics_data}.name) AS name, year, value, last_upd
                FROM {$this->vndb_economics_data}
                LEFT JOIN {$this->vndb_economics_ref}
                ON {$this->vndb_economics_data}.indcode = {$this->vndb_economics_ref}.code
                WHERE code = '{$code}';";
        if($this->input->is_ajax_request()){
            echo $sql;
            exit();
        }
        $this->data->ecoms = $this->db->query($sql)->result_array();
        $this->template->write_view('content', 'economic/economic_data_list', $this->data);
        $this->template->write('title', 'Economics ');
        $this->template->render();
    }

    public function export(){
        if($this->input->is_ajax_request()){
            $sql = $this->input->post('sql');
            $row = $this->db->query($sql)->result_array();

            $sql = "SHOW COLUMNS FROM vndb_economics_data";
            $query = $this->db->query($sql);
            $columns = $query->result_array();
            foreach ($columns as $key => $item) {
                $headers[] = $item['Field'];
            }
            $temp = '';
            foreach ($headers as $value) {
                $temp .= $value . chr(9);
            }
            $data[0] = trim($temp) . PHP_EOL;
            foreach ($row as $key => $item) {
                $temp = '';
                foreach ($headers as $value) {
                    $temp .= $item[$value] . chr(9);
                }
                $data[] = trim($temp) . PHP_EOL;
            }
            $path_file = APPPATH . '../../assets/download/views/vndb_economics_data.txt';
            file_put_contents($path_file, $data);
            $response['file'] = 'vndb_economics_data.txt';
            $response['path'] = $path_file;
            echo json_encode($response);
        }
    }
}