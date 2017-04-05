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

class general extends Admin {

    protected $data;

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
    /*    M001 : New  2012.08.14 (Tung)                            */
    /*     * ************************************************************** */

    public function getFilter(){
        if($this->input->is_ajax_request()){
            $resp = array(
                'data' => '',
                'err' => ''
            );
            $columns = $this->input->post('columns');
            $table = $this->input->post('table');
            $ticker = $this->input->post('ticker');
            foreach($columns as $column){
                $this->db->select($column);
                $this->db->distinct();
                if($ticker && $ticker != 'all'){
                    $this->db->where("{$table}.ticker", $ticker);
                }
                $this->db->join('vndb_company', "{$table}.ticker = vndb_company.code",'left');
                $tmp = $this->db->get($table)->result_array();
                foreach($tmp as $item){
                    $dotCheck = strpos($column, '.');
                    if($dotCheck != ''){
                        $column = substr($column, $dotCheck + 1);
                    }
                    $data[$column][] = $item[$column];
                }
            }
            $resp['data'] = $data;
            $this->output->set_output(json_encode($resp));
        }
    }
}