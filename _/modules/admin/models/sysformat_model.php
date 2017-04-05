<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  sysformat_model.php                         */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  model sys format                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.08.14 (LongNguyen)        New Create      */
/* * ****************************************************************** */

class Sysformat_model extends CI_Model {

    public $table = "sys_format";
    public $pages;

    function __construct() {
        parent::__construct();
        $this->pages = $this->uri->segment(2);
        if ($this->pages != 'home') {
            $this->pages = 'sysformat';
        }
    }

    public function findSysformatByTable($table, $field = '', $page = 'sysformat') {
        if ($field != '') {
            $this->db->select("$field, fields");
        }
        $this->db->where('page', $page);
        $this->db->where('tables', $table);
        return $this->db->get($this->table)->result_array();
    }

    public function getColumnOrder($table) {
        $this->db->select('MAX(orders) as max');
        $this->db->where('tables', strtolower($table));
        $this->db->where('page', $this->pages);
        $query = $this->db->get($this->table);
        $rows = $query->result_array();
        $total = ceil($rows[0]['max'] / 9);
        return $total;
    }

    /*     * ************************************************************** */
    /*    Name ： load_format                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ：  edit config of jqGrid. Select all fields of   */
    /*                    specified table and orders not equal 0      */
    /* --------------------------------------------------------------- */
    /*    Params  ：  $table, $headers_fields                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：                                                 */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                  */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.09.04 (LongNguyen)                            */
    /*     * ************************************************************** */

    function load_format($table, $headers_fields) {
        $query = $this->db->query("SHOW TABLES WHERE Tables_in_" . $this->db->database . " = '$table'");
        $tables = $query->result_array();
        if (count($tables) == 0) {
            return 1;
        }
        $config = NULL;
        $table = strtolower($table);
        $this->db->where(array(
            'tables' => $table,
            'page' => $this->pages,
            'orders <>' => 0
        ));
        $this->db->order_by('orders', 'asc');
        $query = $this->db->get($this->table);
        $data = $query->result_array();
        if (count($data) != 0) {
            foreach ($data as $row) {
                $colNames[] = $row[$headers_fields];
                $aligns = substr($row['aligns'], 0, 1);
                $weight = substr($row['aligns'], 1, 1);
                $type = $row['edittype'];
                if ($aligns == 'L')
                    $align = 'Left';
                else if ($aligns == 'R')
                    $align = 'Right';
                else
                    $align = 'Center';
                switch ($row['fields']) {
                    case 'idx_code':
                        $this->db->select('idx_code');
                        $code = $this->db->get('idx_ref')->result_array();
                        foreach ($code as $key => $item) {
                            $temp[] = $key . ':' . $item['idx_code'];
                        }
                        $temp = implode(';', $temp);
                        $option['value'] = $temp;
                        $type = 'select';
                        unset($temp);
                        break;
                    case 'stk_code':
                        $this->db->select('stk_code');
                        $code = $this->db->get('idx_ca')->result_array();
                        foreach ($code as $key => $item) {
                            $temp[] = $item['stk_code'] . ':' . $item['stk_code'];
                        }
                        $temp = implode(';', $temp);
                        $option['value'] = $temp;
                        $type = 'select';
                        unset($temp);
                        break;
                    case 'stk_div':

                        break;
                    default:
                        if ($row['editoption'] != '') {
                            $opt_temp = explode('|', $row['editoption']);
                            $option = array(
                                $opt_temp[0] => $opt_temp[1]
                            );
                        } else {
                            $option = '';
                        }
                        break;
                }

                $colModel = array(
                    'name' => $row['fields'],
                    'index' => $row['fields'],
                    'width' => $row['widths'],
                    'align' => $align,
                    'editable' => true,
                    'edittype' => $type,
                    'editoptions' => $option,
                    'fixed' => true,
                    'resizable' => false,
                        //'shrinkToFit' => true
                );
                if ($row['formats'] == 'N')
                    $colModel['formatter'] = 'currency';
                $colModel['formatoptions'] = array(
                    'decimalSeparator' => '.',
                    'thousandsSeparator' => ',',
                    'decimalPlaces' => (int) $row['decimals'],
                    'prefix' => '',
                    'defaulValue' => 0
                );
                if ($row['orders'] < 9) {
                    $colModel['frozen'] = true;
                }
                $colModel_temp[] = $colModel;
                unset($colModel);
                if ($weight == 'B') {
                    $config['font_weight'][] = $row['fields'];
                }
            }
            $config['colNames'] = $colNames;
            $config['colModel'] = $colModel_temp;
            return $config;
        }
        return 0;
    }

    public function load_format_all_fields($table, $headers_fields) {
        $query = $this->db->query("SHOW TABLES WHERE Tables_in_" . $this->db->database . " = '$table'");
        $tables = $query->result_array();
        if (count($tables) == 0) {
            return 1;
        }
        $config = NULL;
        $table = strtolower($table);
        /* $this->db->where(array(
          'tables' => $table,
          'page' => $this->pages,
          'orders <>' => 0
          ));
          $this->db->order_by('orders', 'asc');
          $query = $this->db->get($this->table);
          $data = $query->result_array(); */
        $data = array();
        $int = array('smallint', 'int', 'mediumint', 'float', 'tinyint');
        $fields = $this->db->field_data($table);
        if (is_array($fields) && count($fields) > 0) {
            foreach ($fields as $key => $value) {
                if (strtolower($value->name) != 'id') {
                    $data[$key] = array('id' => $key,
                        'tables' => $this->table,
                        'fields' => $value->name,
                        'headers' => strtoupper($value->name),
                        'widths' => 100,
                        'aligns' => in_array($value->type, $int) ? 'R' : 'L',
                        'formats' => in_array($value->type, $int) ? 'N' : 'C',
                        'decimals' => 0,
                        'orders' => 1,
                        'edittype' => 'text',
                        'editoption' => '',
                        'descriptions' => '',
                        'sortable' => true,
                        'page' => 'sysformat');
                }
            }
        }
        if (count($data) != 0) {
            foreach ($data as $row) {
                $colNames[] = $row[$headers_fields];
                $aligns = substr($row['aligns'], 0, 1);
                $weight = substr($row['aligns'], 1, 1);
                $type = $row['edittype'];
                if ($aligns == 'L')
                    $align = 'Left';
                else if ($aligns == 'R')
                    $align = 'Right';
                else
                    $align = 'Center';
                switch ($row['fields']) {
                    case 'idx_code':
                        $this->db->select('idx_code');
                        $code = $this->db->get('idx_ref')->result_array();
                        foreach ($code as $key => $item) {
                            $temp[] = $key . ':' . $item['idx_code'];
                        }
                        $temp = implode(';', $temp);
                        $option['value'] = $temp;
                        $type = 'select';
                        unset($temp);
                        break;
                    case 'stk_code':
                        $this->db->select('stk_code');
                        $code = $this->db->get('idx_ca')->result_array();
                        foreach ($code as $key => $item) {
                            $temp[] = $key . ':' . $item['stk_code'];
                        }
                        $temp = implode(';', $temp);
                        $option['value'] = $temp;
                        $type = 'select';
                        unset($temp);
                        break;
                    case 'stk_div':

                        break;
                    default:
                        if ($row['editoption'] != '') {
                            $opt_temp = explode('|', $row['editoption']);
                            $option = array(
                                $opt_temp[0] => $opt_temp[1]
                            );
                        } else {
                            $option = '';
                        }
                        break;
                }

                $colModel = array(
                    'name' => $row['fields'],
                    'index' => $row['fields'],
                    //'width' => $row['widths'],
                    'align' => $align,
                    'editable' => true,
                    'edittype' => $type,
                    'editoptions' => $option,
                    'fixed' => true,
                    'resizable' => true,
                        //'shrinkToFit' => true
                );
                if ($row['formats'] == 'N')
                    $colModel['formatter'] = 'currency';
                $colModel['formatoptions'] = array(
                    'decimalSeparator' => '.',
                    'thousandsSeparator' => ',',
                    'decimalPlaces' => (int) $row['decimals'],
                    'prefix' => '',
                    'defaulValue' => 0
                );
                if ($row['orders'] < 9) {
                    $colModel['frozen'] = true;
                }
                $colModel_temp[] = $colModel;
                unset($colModel);
                if ($weight == 'B') {
                    $config['font_weight'][] = $row['fields'];
                }
            }
            $config['colNames'] = $colNames;
            $config['colModel'] = $colModel_temp;
            return $config;
        }
        return 0;
    }

    /*     * ************************************************************** */
    /*    Name ： index                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ：  render code to make jqGrid                     */
    /* --------------------------------------------------------------- */
    /*    Params  ：  $table, $edit_show, $headers_fields, $caption,     */
    /*              $id_div, $id_table, $function, $urls, $list        */
    /* --------------------------------------------------------------- */
    /*    Return  ：                                                 */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                  */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.09.04 (LongNguyen)                            */
    /*     * ************************************************************** */

    public function load_table($table, $page = "", $limit = "", $order = "", $searchField = "", $searchOper = "", $searchString = "", $w = "", $code = NULL) {
        $operate = array(
            "eq" => "= '$searchString'",
            "ne" => "<> '$searchString'",
            "lt" => "< '$searchString'",
            "le" => "<= '$searchString'",
            "gt" => "> '$searchString'",
            "ge" => ">= '$searchString'",
            "cn" => "LIKE '%$searchString%'",
            "nc" => "NOT LIKE '%$searchString%'",
            "bw" => "LIKE '$searchString%'",
            "bn" => "NOT LIKE '$searchString%'",
            "ew" => "LIKE '%$searchString'",
            "en" => "NOT LIKE '%$searchString'",
            "in" => "IN '$searchString'",
            "ni" => "NOT IN '$searchString'",
        );
        $where = "id >0";
        if ($searchField != "" && $searchOper != "" && $searchString != "") {

            $where = " `$searchField` $operate[$searchOper] ";
        }

        if ($where == '' && $w != '')
            $where = $w;
        else if ($where != '' && $w != '')
            $where = $where . ' and ' . $w;
        /* if ($code != NULL) {
          switch ($table) {
          case "idx_yahoo_day":
          $where = $where . " and idxyd_code='" . $code . "'";
          break;
          case "idx_yahoo_list_component":
          $where = $where . " and parent_code='" . $code . "'";
          break;
          }
          } */
        if ($page == "" && $limit == "") {
            $sql = "SELECT * FROM `$table` WHERE $where";
        } else {
            if ($order != '') {
                $order = "ORDER BY $order";
            }
            $sql = "SELECT * FROM `$table` WHERE $where $order LIMIT $page, $limit";
        }

        $query = $this->db->query($sql);
        $data = $query->result_array();
        /* if ($_GET['oper'] == 'excel') {
          $this->export($table, $data);
          } else { */
        return $data;
        //}
    }

    function load_multi_search($table, $page = "", $limit = "", $order = "", $col, $where = '') {
        $arr = array("mod", "act", "view", "_search", "nd", "rows", "page", "sidx", "sord", "searchField", "searchOper", "searchString", "table", "code", "current", "filters");
        foreach ($arr as $key => $item) {
            if (isset($col[$item])) {
                unset($col[$item]);
            }
        }
        //if (isset($col['code']) && $col['code'] != '') {
        //$col['code'] == 'stk_code';
        //}else{
        //}
        /* if ($col['type']) {
          unset($col['type']);
          }
          if ($col['oper']) {
          unset($col['oper']);
          } */

        $sql = "SELECT * FROM $table WHERE ";
        $i = 0;
        foreach ($col as $colum => $value) {
            if ($i == 0)
                $sql .= " $colum LIKE '%$value%' ";
            else
                $sql .= " and $colum LIKE '%$value%' ";
            $i++;
        }
        if ($where != '') {
            $sql .= "and $where";
        }
        if ($order != '') {
            $sql .= " ORDER BY $order ";
        }

        if ($page != "" && $limit != "") {
            $sql .= " LIMIT $page,$limit ";
        }
        $query = $this->db->query($sql);
        $data = $query->result_array();
        /* if ($_GET['oper'] == 'excel') {
          $this->export($table, $data);
          } else { */

        return $data;
        //}
    }

    public function load_order_cols($table) {
        $this->db->order_by('orders', 'asc');
        $where = "AND orders <> 0";
        $sql = "SELECT * FROM " . $this->table . " WHERE tables = '$table' AND page = '" . $this->pages . "' $where ORDER BY orders ASC";

        $query = $this->db->query($sql);
        $data = $query->result_array();
        //$data = $this->select("sys_format", "FIELDS", " TABLES = '$table' and ORDERS <> 0", "ORDERS asc");
        return $data;
    }

    public function load_order_colsFull($table) {
        $data = array();
        $fields = $this->db->field_data($table);
        if (is_array($fields) && count($fields) > 0) {
            foreach ($fields as $key => $value) {
                if (strtolower($value->name) != 'id') {
                    $data[$key]['fields'] = $value->name;
                }
            }
        }
        //$data = $this->select("sys_format", "FIELDS", " TABLES = '$table' and ORDERS <> 0", "ORDERS asc");
        return $data;
    }

    /*     * ************************************************************** */
    /*    Name ： update                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ：  update a specified table with id and data     */
    /* --------------------------------------------------------------- */
    /*    Params  ：  $table, $id, $data                                 */
    /* --------------------------------------------------------------- */
    /*    Return  ：  TRUE/FALSE                                          */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                  */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.09.04 (Tung)                            */
    /*     * ************************************************************** */

    public function update($table, $id, $data) {
        $this->db->where('id', $id);
        pre($data);
        if ($this->db->update($table, $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function find_view() {
        $this->db->where('active >=', 1);
        $query = $this->db->get('idx_files');
        $data = $query->result_array();
        foreach ($data as $key => $value) {
            $data[$key]['table'] = strtolower($value['table']);
        }
        return $data;
    }

    //get by sys_format table
    public function getTableData($table, $page, $limit, $sidx, $sord, $col = '', $where = '', $order_start = '') {
        if ($this->input->get('_search') == 'true') {
            if ($this->input->get('searchField') != '' && $this->input->get('searchOper') != '' && $this->input->get('searchString') != '') {
                $data = $this->load_table($table, $page, $limit, "", $this->input->get('searchField'), $this->input->get('searchOper'), $this->input->get('searchString'), $w = "");
            } else {
                $data = $this->load_multi_search($table, $page, $limit, "", $this->input->get());
            }
            $count = count($data);
        } else {
            $count = $this->db->count_all($table);
        }
        $order = " " . $sidx . " " . $sord . " ";

        if ($count > 0) {
            @$total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;
        $start = $limit * $page - $limit;
        if ($start < 0) {
            return false;
        }
        if ($this->input->get('searchField') != "" || $this->input->get('searchOper') != "" || $this->input->get('searchString') != "" || $this->input->get('_search') == 'true') {
            if ($this->input->get('searchField') != '' && $this->input->get('searchOper') != '' && $this->input->get('searchString') != '') {
                $data = $this->load_table($table, $start, $limit, $order, $this->input->get('searchField'), $this->input->get('searchOper'), $this->input->get('searchString'));
            } else {
                $data = $this->load_multi_search($table, $start, $limit, $order, $this->input->get(), $where);
            }
        } else {
            $data = $this->load_table($table, $start, $limit, $order, $searchField = "", $searchOper = "", $searchString = "", $where);
        }
        $response = (object) array();
        $response->page = $page;
        $response->total = $total_pages;
        $response->records = $count;
        $i = 0;
        //print_r($data);
        if ($col == '') {
            $col_temp = $this->load_order_colsFull($table, $order_start);
            foreach ($col_temp as $key => $item) {
                $col[] = $item['fields'];
            }
        }
        $num = 0;
        if (is_array($data)) {
            foreach ($data as $k => $row) {
                $temp = "";
                foreach ($col as $key => $item) {
                    $temp[] = trim($row[$item]);
                }
                $response->rows[$i]['id'] = $row['id'];
                //unset$row['id'];)
                $response->rows[$i]['cell'] = $temp;
                $i++;
            }
        }
        return $response;
    }

    public function getTableDataFull($table, $page, $limit, $sidx, $sord, $col = '', $where = '', $order_start = '') {
        if ($this->input->get('_search') == 'true') {
            if ($this->input->get('searchField') != '' && $this->input->get('searchOper') != '' && $this->input->get('searchString') != '') {
                $data = $this->load_table($table, "", "", "", $this->input->get('searchField'), $this->input->get('searchOper'), $this->input->get('searchString'), $w = "");
            } else {
                $data = $this->load_multi_search($table, "", "", "", $this->input->get());
            }
        } else {
            $data = $this->load_table($table, '', '', '', '', '', '', $where);
        }

        $count = count($data);
        $order = " " . $sidx . " " . $sord . " ";

        if ($count > 0) {
            @$total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;
        $start = $limit * $page - $limit;
        if ($start < 0) {
            return false;
        }
        if ($this->input->get('searchField') != "" || $this->input->get('searchOper') != "" || $this->input->get('searchString') != "" || $this->input->get('_search') == 'true') {
            if ($this->input->get('searchField') != '' && $this->input->get('searchOper') != '' && $this->input->get('searchString') != '') {
                $data = $this->load_table($table, $start, $limit, $order, $this->input->get('searchField'), $this->input->get('searchOper'), $this->input->get('searchString'));
            } else {
                $data = $this->load_multi_search($table, $start, $limit, $order, $this->input->get(), $where);
            }
        } else {
            $data = $this->load_table($table, $start, $limit, $order, $searchField = "", $searchOper = "", $searchString = "", $where);
        }
        $response = (object) array();
        $response->page = $page;
        $response->total = $total_pages;
        $response->records = $count;
        $i = 0;
        //print_r($data);
        if ($col == '') {
            $col_temp = $this->load_order_colsFull($table, $order_start);
            foreach ($col_temp as $key => $item) {
                $col[] = $item['fields'];
            }
        }
        $num = 0;
        if (is_array($data)) {
            foreach ($data as $k => $row) {
                $temp = "";
                foreach ($col as $key => $item) {
                    $temp[] = trim($row[$item]);
                }
                $response->rows[$i]['id'] = $row['id'];
                //unset$row['id'];)
                $response->rows[$i]['cell'] = $temp;
                $i++;
            }
        }
        return $response;
    }

    /*     * ************************************************************** */
    /*    Name ： listView                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ：  list data of specified table                    */
    /* --------------------------------------------------------------- */
    /*    Params  ：  $table, $edit_show, $headers_fields, $caption,     */
    /*              $id_div, $id_table, $function, $urls, $list        */
    /* --------------------------------------------------------------- */
    /*    Return  ：                                                 */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                  */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.09.04 (LongNguyen)                            */
    /*     * ************************************************************** */

    public function listView($table, $id = '') {
        $sql = "SHOW COLUMNS FROM $table";
        $query = $this->db->query($sql);
        $columns = $query->result_array();
        foreach ($columns as $key => $item) {
            $headers[] = $item['Field'];
        }
        if (is_numeric($id)) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get($table);
        $row = $query->result_array();
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
        return $data;
    }

    public function list_view_qidx_final($table, $id = '', $column) {
        $sql = "SHOW COLUMNS FROM $table";
        $query = $this->db->query($sql);
        $columns = $query->result_array();
        foreach ($columns as $key => $item) {
            if (in_array($item['Field'], array('date', 'stk_code', 'idx_code')) || $item['Field'] == $column) {
                $headers[] = $item['Field'];
            }
        }

        $sql = "SELECT qidx_final.idx_code, REPLACE(qidx_final.date, '-', '/') as date,
                qidx_final.close_tr, qidx_final.close_pr, qidx_final.close_nr
                FROM qidx_final
                ORDER BY qidx_final.idx_code, qidx_final.date";
        $row = $this->db->query($sql)->result_array();
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
        return $data;
    }

    public function updateWidth($table, $header, $data) {
        if ($this->pages != '') {
            $this->db->where('page', $this->pages);
        }
        $this->db->where(array(
            'tables' => $table,
            'headers' => $header
        ));
        $this->db->update($this->table, $data);
    }

    public function getStk($table, $idx_code, $stk_code) {
        $sql = "SELECT * FROM $table
                LEFT JOIN stk_ref ON $table.stk_code = stk_ref.stk_code
                LEFT JOIN stk_prices ON $table.stk_code = stk_prices.stk_code
                WHERE $table.stk_code = '$stk_code'";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        /* foreach($data as $key => $item){
          $j = 0;
          foreach($item as $key2 => $item2){
          if($j >= 2){
          unset($data[$key][$key2]);
          }
          $j++;
          }
          } */
        if ($this->input->get('type') == 'getConfigStk') {
            foreach ($data as $item) {
                foreach ($item as $key => $item2) {
                    if ($key != 'id') {
                        $response['colNames'][] = strtoupper($key);
                        $response['colModel'][] = array(
                            'name' => $key,
                            'index' => $key,
                            'width' => 50,
                        );
                    }
                }
                break;
            }
        }
        //pre($data);die();
        $i = 0;
        if ($this->input->get('type') == 'getStk') {
            $response->page = '';
            $response->total = '';
            $response->records = '';
            if (is_array($data)) {
                foreach ($data as $key => $item) {
                    $response->rows[$i]['id'] = $item['id'];
                    unset($item['id']);
                    foreach ($item as $item2) {
                        $response->rows[$i]['cell'][] = trim($item2);
                    }
                    $i++;
                }
            }
        }
        return $response;
    }

}

?>