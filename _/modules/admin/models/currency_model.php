<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Currency_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
    }
    /*     * ***********************************************************************************************************
     * Name         ： vietnam - international - ifrc
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ： 
     *              ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： New  2013.16.14 (PhanMinh)
     * *************************************************************************************************************** */
    //  public function listCurrency(){
    //     $sSortDir = $this->input->get_post('sSortDir_0', true);
        
        
    //     /* Array of database columns which should be read and sent back to DataTables. Use a space where
    //      * you want to insert a non-database field (for example a counter or static image)
    //      */
    //      $sTable = 'vndb_currency_final';
         
    //     $aColumns = array("{$sTable}.date", "{$sTable}.code", "{$sTable}.yyyymmdd", "{$sTable}.popn", "{$sTable}.pcls", "{$sTable}.phgh", "{$sTable}.plow");
        
    //     $aColumns2 = array('date', 'code', 'yyyymmdd', 'popn', 'pcls', 'phgh', 'plow');
        
    //     // DB table to use
    
    //     $iDisplayStart = $this->input->get_post('iDisplayStart', true);
    //     $iDisplayLength = $this->input->get_post('iDisplayLength', true);
    //     $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
    //     $iSortingCols = $this->input->get_post('iSortingCols', true);
    //     $sSearch = $this->input->get_post('sSearch', true);
    //     $sEcho = $this->input->get_post('sEcho', true);
    
    //     // Paging
    //     if(isset($iDisplayStart) && $iDisplayLength != '-1')
    //     {
    //         $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
    //     }
        
    //     // Ordering
    //     if(isset($iSortCol_0))
    //     {
    //         for($i=0; $i<intval($iSortingCols); $i++)
    //         {
    //             $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
    //             $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
    //             $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
    //             if($bSortable == 'true')
    //             {
    //                 $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol)) + 1], $this->db->escape_str($sSortDir));
    //             }
    //         }
    //     }
        
    //     /* 
    //      * Filtering
    //      * NOTE this does not match the built-in DataTables filtering which does it
    //      * word by word on any field. It's possible to do here, but concerned about efficiency
    //      * on very large tables, and MySQL's regex functionality is very limited
    //      */
    //     if(isset($sSearch) && !empty($sSearch))
    //     {
    //         for($i=0; $i<count($aColumns); $i++)
    //         {
    //             $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
    //             // Individual column filtering
    //             if(isset($bSearchable) && $bSearchable == 'true')
    //             {
    //                 $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
    //             }
    //         }
    //     }
        
    //     // Select Data
    //     $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
    //     $rResult = $this->db->get($sTable);
    
    //     // Data set length after filtering
    //     $this->db->select('FOUND_ROWS() AS found_rows');
    //     $iFilteredTotal = $this->db->get()->row()->found_rows;
    
    //     // Total data set length
    //     $iTotal = $this->db->count_all($sTable);
    
    //     // Output
    //     $output = array(
    //         'sEcho' => intval($sEcho),
    //         'iTotalRecords' => $iTotal,
    //         'iTotalDisplayRecords' => $iFilteredTotal,
    //         'aaData' => array()
    //     );
        
    //     foreach($rResult->result_array() as $aRow)
    //     {
    //         $row = array();
            
    //         foreach($aColumns2 as $col)
    //         {
    //             if(!in_array($col, array('id'))){
    //                 $value = '';
    //                 $value = $aRow[$col];
    //                 if($col != 'yyyymmdd'){
    //                     if(is_numeric($value)){
    //                         $value = normalFormat($value);
    //                     }
    //                 }
    //                 $row[] = $value;
    //             }
    //         }
    //         $row[] = '<a href="#" title="Edit" class="with-tip"><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/pencil.png" width="16" height="16"></a>
    //                   <a href="#" title="Delete" class="with-tip delete" pid=""><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/cross-circle.png" width="16" height="16"></a>';
    //         $output['aaData'][] = $row;
    //         //$output['my_id'][] = $aRow['id'];
    //     }
    //     return $output;
    // }
    public function listCurr(){
        $sSortDir = $this->input->get_post('sSortDir_0', true);
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
         $sTable = 'vndb_currency_ref';
         
        $aColumns = array("{$sTable}.curr_code", "{$sTable}.curr_name", "{$sTable}.domain", "{$sTable}.country", "{$sTable}.compare");
        
        $aColumns2 = array('curr_code','curr_name','domain','country','compare');
        
        // DB table to use
    
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
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol)) + 1], $this->db->escape_str($sSortDir));
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
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
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
            
            foreach($aColumns2 as $col)
            {
                if(!in_array($col, array('id'))){
                    $value = '';
                    $value = $aRow[$col];
                    if($col == 'curr_code'){
                        $value = '<a href="JavaScript: void(0)" class="getNameCurrency" id="'.$aRow["curr_code"].'/'.$aRow["compare"].'">' . $value . '</a>';
                    }
                    if(is_numeric($value)){
                        $value = normalFormat($value);
                    }
                    $row[] = $value;
                }
            }
            $output['aaData'][] = $row;
            //$output['my_id'][] = $aRow['id'];
        }
        return $output;

    }
    public function get_data_by_table($sTable = ""){

        $sSortDir = $this->input->get_post('sSortDir_0', true);

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        switch ($sTable) {
            case 'vndb_currency_day':
                $aColumns = array("{$sTable}.date", "{$sTable}.code", "{$sTable}.yyyymmdd", "{$sTable}.close");
                $aColumns2 = array('date', 'code', 'yyyymmdd', 'close');
                break;
            case 'vndb_currency_month':
                $aColumns = array("{$sTable}.date", "{$sTable}.code", "{$sTable}.yyyymm", "{$sTable}.close");
                $aColumns2 = array('date', 'code', 'yyyymm', 'close');
                break;
            case 'vndb_currency_year':
                $aColumns = array("{$sTable}.date", "{$sTable}.code", "{$sTable}.yyyy", "{$sTable}.close");
                $aColumns2 = array('date', 'code', 'yyyy', 'close');
                break;
        }
        // DB table to use
    
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
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol)) + 1], $this->db->escape_str($sSortDir));
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
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
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
            foreach($aColumns2 as $col)
            {
                if(!in_array($col, array('id'))){
                    $value = '';
                    $value = $aRow[$col];
                    if($col == 'code'){
                        $value = '<a href="JavaScript: void(0)" id="'.$value.'" class="currency-detail '.$sTable.'">'.$value.'</a>';
                    }
                    if(is_numeric($value)){
                        $value = normalFormat($value);
                    }
                    $row[] = $value;
                }
            }
            $row[] = '<a href="#" title="Edit" class="with-tip"><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/pencil.png" width="16" height="16"></a>
                      <a href="#" title="Delete" class="with-tip delete" pid=""><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/cross-circle.png" width="16" height="16"></a>';
            $output['aaData'][] = $row;
            //$output['my_id'][] = $aRow['id'];
        }
        return $output;
    }
}