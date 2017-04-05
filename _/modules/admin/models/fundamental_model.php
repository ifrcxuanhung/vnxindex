<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fundamental_model extends CI_Model {

    public $final_table = 'vndb_fundamental';

    function __construct() {
        parent::__construct();
    }

    public function listFAction(){	
		
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
	$sTable = 'vndb_fundamental';
    $sTable_2 = 'ref_code_field';
		 
        $aColumns = array("{$sTable}.id", "{$sTable}.ticker",  "{$sTable}.date", "{$sTable}.code_data", "{$sTable}.year", "{$sTable}.fvalue","{$sTable_2}.name_en");
		
	$aColumns2 = array('id', 'ticker', 'date', 'code_data', 'year', 'fvalue');
    
        $this->db->join($sTable_2,"{$sTable}.code_data = {$sTable_2}.code",'left');

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
                    if($col == 'ticker'){
                        $value = '<a class="" title=""  href="' . admin_url() . 'vndb_page/index/' . $value . '">' . $value . '</a>';
                    }
                    if($col == 'code_data'){
                        $value = '<a class="with-tip" title="' . $aRow['name_en'] . '"  href="#">' . $value . '</a>';
                    }
                    if(is_numeric($value)){
                        $value = normalFormat($value);
                    }
                    $row[] = $value;
                }
            }
            $row[] = '<a href="' . admin_url() . 'fundamental/edit/id/' . $aRow['id'] . '" title="Edit" class="with-tip"><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/pencil.png" width="16" height="16"></a>
                            <a href="#" title="Delete" class="with-tip delete" pid="' . $aRow['id'] . '"><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/cross-circle.png" width="16" height="16"></a>';
            $output['aaData'][] = $row;
			$output['my_id'][] = $aRow['id'];
        }
        return $output;

    }
    
    public function get_data($id){
        $this->db->where('id',$id);
        return $this->db->get($this->final_table)->row_array();
    }
    
    public function edit($data,$id){
        $this->db->where('id',$id);
        $this->db->update($this->final_table,$data);
    }
    
    public function deleteFinal($id){
        $this->db->where('id', $id);
        $this->db->delete($this->final_table);
        return TRUE;
    }
}