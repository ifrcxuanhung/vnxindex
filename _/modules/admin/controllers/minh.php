<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ******************************************************************************************************************* *
 * 	 Author: Minh �?ẹp Trai			 																					 *
 * 	 Controller để test tất cả action			 																					 *
 * * ******************************************************************************************************************* */

class Minh extends Admin {
    public function __construct() {
        parent::__construct();
    }
    
    public function merge_fun(){
        $title = 'TICKER'."\t".'DATE'."\t".'CODE_DATE'."\t".'YEAR'."\t".'FVALUE';
        $path = '\\\LOCAL\INDEXIFRC\IFRCVN\VNDB\METASTOCK\FUNDAMENTAL\\';
        $file_export = $path.'FUNDAMENTAL.txt';
        $create = fopen($file_export, "w");
        fwrite($create, $title);
        fclose($create);
        $files = glob($path . '*.txt');
        foreach($files as $file){
            $filename = basename($file,'.txt');
            $arr_filename = explode('_',$filename);
            if(count($arr_filename) == 4){
                $data_content = file($file);
                $data_header = explode("\t",$data_content[0]);
                unset($data_header[0],$data_header[1]);
                foreach($data_header as $dh_k => $dh_v){
                    $arr_header[$dh_k] = substr(trim($dh_v),-4);
                }
                $count_row = count($arr_header);
                unset($data_content[0]);
                foreach($data_content as $dc){
                    foreach($arr_header as $ah_k => $ah_v){
                        $data_row = explode("\t",$dc);
                        $content_row[] = $data_row[0]."\t".$arr_filename[3]."\t".$data_row[1]."\t".$ah_v."\t".$data_row[$ah_k];
                    }
                }
                $content = implode("\r\n",$content_row);
                $create = fopen($file_export, "a");
                fwrite($create, $content);
                fclose($create);
            }
        }
    }
}