<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Update_report extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->template->write_view('content', 'update_report/index', $this->data);
        $this->template->render();
    }

    public function upload() {
        if ($_SERVER["SERVER_NAME"] == "local" || strpos($_SERVER["SERVER_NAME"], "local.") !== false) {
            $path = "\\\Ifrccloud\WORKS\IFRCDATA\RESEARCH\REPORT\\";
        } else {
            $path = "assets/data_upload_indexes/";
        }
        $result = self::import_data_by_headers($path.$_POST['table'].".txt", $_POST['table'], $_POST['empty'], "rs_report");
        if($result == 1) {
            echo "Successful!";
        } else {
            echo "Error!";
        }
        exit();
    }

    public function import_data_by_headers($file = "", $table = "", $empty = 0, $type_data = "") {
        if (is_file($file)) {
            if($empty == 1) {
                $this->db->truncate($table);
            }
            $columns = $this->db->list_fields($table);
            $f = fopen($file, "r");
            $data = "";
            $data_tmp = "";
            $headers = "";
            $i = 0;
            while ($data_tmp = fgetcsv($f, 0, "\t")) {
                $arr_check = array_filter($data_tmp);
                if (empty($arr_check)) {
                    continue;
                }
                unset($arr_check);
                $i++;
                if ($i == 1) {
                    $headers = $data_tmp;
                    continue;
                }
                foreach ($headers as $key => $header) {
                    $header = trim(strtolower($header));
                    if (in_array($header, $columns)) {
                        $data[$i - 1][$header] = @$data_tmp[$key];
                    }
                }
            }
            unset($data_tmp);
            unset($i);

            if($type_data == 'rs_report') {
                $import_data = array();
                foreach($data as $item) {
                    $import_data[$item['category'].$item['period'].$item['type']][] = $item;
                }
                unset($data);

                foreach ($import_data as $keyImport => $valueImport) {
                    $sql = "delete from {$table} where concat(category,period,type)='{$keyImport}';";
                    $this->db->query($sql);
                    foreach ($valueImport as $subKeyImport => $subValueImport) {
                        $valueImport[$subKeyImport] = array_filter($valueImport[$subKeyImport], "RemoveFalseButNotZero");
                        $err = $this->db->insert($table, $valueImport[$subKeyImport]);
                        if (!$err) {
                            return 0;
                            exit();
                        }
                    }
                }
                unset($import_data);
            } else {
                foreach ($data as $key => $value) {
                    $data[$key] = array_filter($data[$key], "RemoveFalseButNotZero");
                    $err = $this->db->insert($table, $data[$key]);
                    if (!$err) {
                        return 0;
                        exit();
                    }
                }
                unset($data);
            }
        } else {
            return 0;
            exit();
        }
        return 1;
        exit();
    }

}