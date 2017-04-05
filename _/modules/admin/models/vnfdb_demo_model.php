<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vnfdb_demo_model extends CI_Model {

    public $final_table = 'vndb_documentation';

    function __construct() {
        parent::__construct();

    }

    public function listDocument(){
        // DB table to use
        $sTable = $this->final_table;

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('title', 'authors', 'journal', 'reference', 'date');
        $aColumns_filter = array('title', 'authors', 'journal', 'reference', 'date');
        $aColumns2 = array('title', 'authors', 'journal', 'reference', 'date');
    
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
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
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
                    $a_filter[] =$aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($sSearch) . '%\'';
                }
            }
            if(!empty($a_filter)){
                $this->db->where('(' . implode(' OR ', $a_filter) . ')', NULL, false);
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
            $row = array();
            $row[] = '<input type="checkbox" name="check_title">';
            foreach($aColumns2 as $col)
            {
                $value = '';
                $value = $aRow[$col];
                $row[] = $value;
            }
            $row[] = '<ul style="text-align: center;" class="keywords">
                        <li class="green-keyword">
                            <a href="javascript:void(0)" title="pdf" class="with-tip">PDF</a>
                        </li>
                        <li class="red_fx_keyword">
                            <a href="javascript:void(0)" title="link" class="with-tip">Link</a>
                        </li>
                        <li class="green-keyword">
                           <a href="javascript:void(0)" title="link" class="with-tip">Abstract</a>
                        </li>
                    </ul>';
            $html = '<div class="rating">';
            $rand = mt_rand(1, 5);
            for ($i=1;$i <= 5; $i++) {
                if($i < $rand){
                    $html .= '<span id="'.$i.'"><img src="' . base_url() . 'assets/templates/backend/images/icons/star-off.png" width="16" height="16"></span>';
                }else{
                    $html .= '<span id="'.$i.'"><img src="' . base_url() . 'assets/templates/backend/images/icons/star-on.png" width="16" height="16"></span>';
                }
            }
            $html .= '</div>';
            $row[] = $html;
            $output['aaData'][] = $row;
        }
        return $output;
    }

    public function autocomplete($step){
        if($step == 1){
            $data_result =  $this->db->get($this->final_table)->result_array();
            foreach($data_result as $rs){
                $title[] = $rs['title'];
            }
        }elseif($step == 3){
            $data_result =  $this->db->get('vnfdb_methodogy_test')->result_array();
            foreach($data_result as $rs){
                $title[] = $rs['topic'];
            }
        }
        
        return $title;
    }

    public function listTest(){
        // DB table to use
        $sTable = 'vnfdb_methodogy_test';

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('topic', 'category', 'test','type','date', 'action', 'difficulty');
        $aColumns_filter = array('topic', 'category', 'test','type','date', 'action', 'difficulty');
        $aColumns2 = array('topic', 'category', 'test','type','date', 'action', 'difficulty');
    
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
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
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
                    $a_filter[] =$aColumns_filter[$i] . ' LIKE \'%' . $this->db->escape_like_str($sSearch) . '%\'';
                }
            }
            if(!empty($a_filter)){
                $this->db->where('(' . implode(' OR ', $a_filter) . ')', NULL, false);
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
            $row = array();
            $row[] = '<input type="checkbox" name="check_title">';
            foreach($aColumns2 as $col)
            {
                $value = '';
                $value = $aRow[$col];
                if($col == 'action'){
                    $value = '<ul style="text-align: center;" class="keywords">
                        <li class="green-keyword">
                            <a href="'.admin_url(). 'tests" title="Description" class="with-tip" target="_blank">Description</a>
                        </li>
                        <li class="red_fx_keyword">
                            <a href="javascript:void(0)" title="Test" class="with-tip">Test</a>
                        </li>
                    </ul>';
                }
                if($col == 'difficulty'){
                    $html = '<div class="rating" style="direction:ltr">';
                    for ($i=1; $i <= 5; $i++) { 
                        if($i <= $value){
                            $html .= '<span id="'.$i.'"><img src="' . base_url() . 'assets/templates/backend/images/icons/star-on.png" width="16" height="16"></span>';
                        }else{
                            $html .= '<span id="'.$i.'"><img src="' . base_url() . 'assets/templates/backend/images/icons/star-off.png" width="16" height="16"></span>';
                        }
                    }
                    $html .= '</div>';
                    $value = $html;
                }
                $row[] = $value;
            }
            $output['aaData'][] = $row;
        }
        return $output;
    }
}
