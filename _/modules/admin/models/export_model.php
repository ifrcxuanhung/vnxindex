<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getData($table, $ids, $exceptions){
    	$headers = $this->db->list_fields($table);
        foreach($headers as $key => $item){
            $headers[$key] = strtolower($item);
        }
        $a_ids = explode(',', $ids);
        $sql = '(CASE id';
        foreach($a_ids as $key => $item){
            $sql .= ' WHEN ' . $item . ' THEN ' . $key;
        }
        $sql .= ' END) AS tmp_order';
    	$ids = '(' . $ids . ')';
        $headers[] = $sql;
        if(!empty($exceptions)){
            if(is_array($exceptions)){
                foreach($exceptions as $item){
                    $key = array_search($item, $headers);
                    unset($headers[$key]);
                }
            }else{
                $key = array_search($exceptions, $headers);
                unset($headers[$key]);
            }
        }
        $this->db->select($headers);
        array_pop($headers);
    	$this->db->where('id IN ', $ids, false);
        $this->db->order_by('tmp_order', 'ASC');
    	$rows = $this->db->get($table)->result_array();
        foreach($rows as $k => $i){
            foreach($i as $k2 => $i2){
                if($k2 == 'id' || $k2 == 'tmp_order'){
                    unset($rows[$k][$k2]);
                }
            }
        }
    	$data = '';
    	$header[0] = $headers;
    	if(!empty($rows)){
    		$data = array_merge($header, $rows);
    	}
    	return $data;
    }

    function getData2($table, $where, $order, $exceptions, $limit = array()){
        $headers = $this->db->list_fields($table);
        foreach($headers as $key => $item){
            $headers[$key] = strtolower($item);
        }

        if(!empty($limit)){
            $this->db->limit($limit[1], $limit[0]);
        }

        if(!empty($exceptions)){
            if(is_array($exceptions)){
                foreach($exceptions as $item){
                    if($key = array_search($item, $headers)){
                        unset($headers[$key]);
                    }
                }
                if(in_array(current($headers), $exceptions)){
                    array_shift($headers);
                }
            }else{
                if($key = array_search($exceptions, $headers)){
                    unset($headers[$key]);
                }
                if(current($headers) == $exceptions){
                    array_shift($headers);
                }
            }
        }
        if(!empty($where)){
            foreach($where as $item){
                if(count($item) != 2){
                    $item['expr2'] = str_replace('_date_now', date('Y-m-d'), $item['expr2']);
                    $a_where = array(                    
                        $item['expr1'] . ' ' . $item['op'] => $item['expr2']
                    );
                }else{
                    $sSearch = $item['sSearch'];
                    $aColumns_filter = $item['headers'];
                }
            }
            $this->db->where($a_where);

            if(isset($sSearch)){
                $a_filter = array();
                for($i=0; $i<count($aColumns_filter); $i++){
                    // Individual column filtering
                    $a_filter[] =$aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($sSearch) . '%\'';
                }
                if(!empty($a_filter)){
                    $this->db->where('(' . implode(' OR ', $a_filter) . ')', NULL, false);
                }
            }
        }
        if(!empty($order)){
            foreach($order as $item){
                $this->db->order_by($item['value'], $item['type']);
            }
        }
        $this->db->select($headers);
        $rows = $this->db->get($table)->result_array();
        $data = '';
        $header[0] = $headers;
        if(!empty($rows)){
            $data = array_merge($header, $rows);
        }
        return $data;
    }

    function getData3($table, $where, $order, $exceptions, $limit = array()){
        if(!empty($limit)){
            $this->db->limit($limit[1], $limit[0]);
        }

        if(!empty($exceptions)){
            if(is_array($exceptions)){
                foreach($exceptions as $item){
                    if($key = array_search($item, $headers)){
                        unset($headers[$key]);
                    }
                }
                if(in_array(current($headers), $exceptions)){
                    array_shift($headers);
                }
            }else{
                if($key = array_search($exceptions, $headers)){
                    unset($headers[$key]);
                }
                if(current($headers) == $exceptions){
                    array_shift($headers);
                }
            }
        }
        if(!empty($where)){
            $data_filter = array();
            foreach($where as $item){
                if(count($item) != 2){
                    $item['expr2'] = str_replace('_date_now', date('Y-m-d'), $item['expr2']);
                    $a_where[$item['expr1'] . ' ' . $item['op']] = $item['expr2'];
                    $data_filter[] = $item['expr1'];
                }else{
                    $sSearch = $item['sSearch'];
                    $aColumns_filter = $item['headers'];
                }
            }
            $this->db->where($a_where);

            if(isset($sSearch)){
                $a_filter = array();
                for($i=0; $i<count($aColumns_filter); $i++){
                    // Individual column filtering
                    $a_filter[] =$aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($sSearch) . '%\'';
                }
                if(!empty($a_filter)){
                    $this->db->where('(' . implode(' OR ', $a_filter) . ')', NULL, false);
                }
            }
        }
        if(!empty($order)){
            foreach($order as $item){
                $this->db->order_by($item['value'], $item['type']);
            }
        }
        $this->db->select("date, CONCAT(".$data_filter[0].", '/', ".$data_filter[1].") as currency, close", FALSE);
        $rows = $this->db->get($table)->result_array();
        $data = '';
        $header[0] = 'date' . chr(9) . 'currency' . chr(9) .'close' . PHP_EOL;
        if(!empty($rows)){
            $data = array_merge($header, $rows);
        }
        return $data;
    }

    public function countItems($table, $where){
        if(!empty($where)){
            foreach($where as $item){
                if(count($item) != 2){
                    $item['expr2'] = str_replace('_date_now', date('Y-m-d'), $item['expr2']);
                    $a_where = array(                    
                        $item['expr1'] . ' ' . $item['op'] => $item['expr2']
                    );
                }else{
                    $sSearch = $item['sSearch'];
                    $aColumns_filter = $item['headers'];
                }
            }
            $this->db->where($a_where);

            if(isset($sSearch)){
                $a_filter = array();
                for($i=0; $i<count($aColumns_filter); $i++){
                    // Individual column filtering
                    $a_filter[] =$aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($sSearch) . '%\'';
                }
                if(!empty($a_filter)){
                    $this->db->where('(' . implode(' OR ', $a_filter) . ')', NULL, false);
                }
            }
            $this->db->where($a_where);
        }
        return $this->db->count_all_results($table);
    }

    public function countItems2($table, $where){
        if(!empty($where)){
            foreach($where as $item){
                if(count($item) != 2){
                    $a_where[$item['expr1'] . ' ' . $item['op']] =  $item['expr2'];
                }else{
                    $sSearch = $item['sSearch'];
                    $aColumns_filter = $item['headers'];
                }
            }
            $this->db->where($a_where);
            if(isset($sSearch)){
                $a_filter = array();
                for($i=0; $i<count($aColumns_filter); $i++){
                    // Individual column filtering
                    $a_filter[] =$aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($sSearch) . '%\'';
                }
                if(!empty($a_filter)){
                    $this->db->where('(' . implode(' OR ', $a_filter) . ')', NULL, false);
                }
            }
            $this->db->where($a_where);
        }
        return $this->db->count_all_results($table);
    }

    public function countItems3($table, $where){
        if(!empty($where)){
            foreach($where as $item){
                if(count($item) != 2){
                    $a_where[$item['expr1'] . ' ' . $item['op']] =  $item['expr2'];
                    $this->db->where($a_where);
                }else{
                    $sSearch = $item['sSearch'];
                    $aColumns_filter = $item['headers'];
                }
            }
            if(isset($sSearch)){
                $a_filter = array();
                for($i=0; $i<count($aColumns_filter); $i++){
                    // Individual column filtering
                    $a_filter[] =$aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($sSearch) . '%\'';
                }
                if(!empty($a_filter)){
                    $this->db->where('(' . implode(' OR ', $a_filter) . ')', NULL, false);
                }
            }
        }
        return $this->db->count_all_results($table);
    }

    function getData4($table, $where, $order, $exceptions, $limit = array()){
        if(!empty($limit)){
            $this->db->limit($limit[1], $limit[0]);
        }

        if(!empty($exceptions)){
            if(is_array($exceptions)){
                foreach($exceptions as $item){
                    if($key = array_search($item, $headers)){
                        unset($headers[$key]);
                    }
                }
                if(in_array(current($headers), $exceptions)){
                    array_shift($headers);
                }
            }else{
                if($key = array_search($exceptions, $headers)){
                    unset($headers[$key]);
                }
                if(current($headers) == $exceptions){
                    array_shift($headers);
                }
            }
        }
        if(!empty($where)){
            $data_filter = array();
            foreach($where as $item){
                if(count($item) != 2){
                    $a_where[$item['expr1'] . ' ' . $item['op']] = $item['expr2'];
                    //$data_filter[] = $item['expr1'];
                    $this->db->where($a_where);
                }else{
                    $sSearch = $item['sSearch'];
                    $aColumns_filter = $item['headers'];
                }
            }

            if(isset($sSearch)){
                $a_filter = array();
                for($i=0; $i<count($aColumns_filter); $i++){
                    // Individual column filtering
                    $a_filter[] =$aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($sSearch) . '%\'';
                }
                if(!empty($a_filter)){
                    $this->db->where('(' . implode(' OR ', $a_filter) . ')', NULL, false);
                }
            }
        }
        if(!empty($order)){
            foreach($order as $item){
                $this->db->order_by($item['value'], $item['type']);
            }
        }
        $this->db->select();
        $rows = $this->db->get($table)->result_array();
        $data = '';
        $header[0] = 'title' . chr(9) . 'authors' . chr(9) .'journal' . chr(9) . 'reference' . chr(9). 'date' . PHP_EOL;
        if(!empty($rows)){
            $data = array_merge($header, $rows);
        }
        return $data;
    }
}
