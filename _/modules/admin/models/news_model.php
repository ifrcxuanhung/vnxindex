<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_model extends CI_Model {

    public $final_table = 'vndb_news_day_final';

    function __construct() {
        parent::__construct();
    }

    public function listNewsByFilter($data_value){
        // DB table to use
        $sTable = $this->final_table;

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('id', 'ticker', 'market', 'date_ann', 'new_type','evname', 'content');
        $aColumns_filter = array('id', 'ticker', 'market', 'date_ann', 'new_type', 'evname', 'content');
        $aColumns2 = array('id', 'ticker', 'market', 'date_ann', 'new_type', 'evname', 'content');

        if($data_value != ''){
            $arr_dv = explode(',',$data_value);
            if(count($arr_dv) > 1){
                $this->db->where_in('new_type',$arr_dv);
                $sql_where = "new_type in ('".implode("','",$arr_dv)."')";
            }else{
                $this->db->where('new_type',$data_value);
                $sql_where = "new_type ='".$data_value."'";
            }
        }
    
        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if($iSortCol_0 != '')
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol)) + 1], $this->db->escape_str($sSortDir));
                }
            }
        }else{
            $this->db->order_by('date_ann', 'DESC');
            $this->db->order_by('ticker', 'ASC');
        }
        
        /* 
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if(isset($sSearch) && !empty($sSearch))
        {
            $a_filter = array();
            for($i=0; $i<count($aColumns_filter); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $arr_search = explode(',',$sSearch);
                    $a_filter = array();
                    foreach($arr_search as $value_search){
                        $value_search = trim($value_search);
                        if($value_search == ''){
                            continue;
                        }else{
                            $row = $this->db->query('SELECT COUNT(*) as count_row FROM '.$sTable.' WHERE '.$sql_where.' AND '.$aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($value_search) . '%\'')->row_array();
                            if($row['count_row'] != 0){
                                $a_filter[] = $aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($value_search) . '%\'';
                            }
                        }
                    }
                    if(!empty($a_filter)){
                        $a_filter_final[] = implode(' AND ', $a_filter);
                    }
                }
            }
            if(!empty($a_filter_final)){
                $this->db->where('((' . implode(') OR (', $a_filter_final) . '))', NULL, false);
            }
        }
        
        // Select Data
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->db->get($sTable);
    
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all($sTable);
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );

        
        foreach($rResult->result_array() as $aRow)
        {
            unset($aRow['id']);
            $row = array();
            foreach($aColumns2 as $col)
            {
                if(!in_array($col, array('id'))){
                    $value = '';
                    $value = $aRow[$col];
                    if($col == 'content'){
                        $value = substr(strip_tags(html_entity_decode($aRow['content'])), 0, 70) . '...<a header="' . $aRow['ticker'] . ':' . $aRow['date_ann'] . '" href="javascript:void(0)" content="' . $aRow['content'] . '" class="view-more">view more</a>';
                    }
                    if(is_numeric($value) && $col != 'pay_yr'){
                        $value = normalFormat($value);
                    }
                    $row[] = $value;
                }
            }
            $output['aaData'][] = $row;
        }
        return $output;

        // return $this->db->get($this->final_table)->result_array();
    }
    
    public function get_data_type(){
        $sql = "SELECT DISTINCT  NEW_TYPE FROM ".$this->final_table." WHERE NEW_TYPE <> '' ORDER BY NEW_TYPE ASC";
        return $this->db->query($sql)->result_array();
    }
}