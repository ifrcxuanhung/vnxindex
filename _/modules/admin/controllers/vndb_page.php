<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  home.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  controller home                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.09.28 (Tung)        New Create      		 */
/* * ****************************************************************** */

class Vndb_page extends Admin {

    public function __construct() {
        parent::__construct();
        $this->load->Model('vndb_page_model', 'mvndb_page');
    }

    public function index() {
        $now = time();
        $idx_code = $this->uri->segment(4);
        $industry = '';
        $data = $this->mvndb_page->getIdx($idx_code);
        foreach($data as $key => $item){
            if(!empty($item)){
                foreach($item as $key2 => $item2){
                    foreach($item2 as $key3 => $item3){
                        if($item3 == ''){
                            $data[$key][$key2][$key3] = '--';
                        }
                    }
                }
            }
        }
        $this->data->ref = $data['vndb_reference_final'];
        $this->data->div = $data['vndb_dividends_final'];
        // pre($this->data->div);die();
        $this->data->cpa = $data['vndb_cpaction_final'];
        // pre($this->data->cpa);die();
        $this->db->select(array('industry', 'en_name', 'ipo', 'ftrd_date AS ftrd', 'ipo_shares'));
        $this->db->where(
            array(
                'code' => $idx_code,
                'enddate' => '2099-12-31'
            )
        );
        $rows = $this->db->get('vndb_company')->result_array();
        if(!empty($rows)){
            foreach($rows[0] as $key => $item){
                $this->data->info[$key] = $item;
            }
        }
        // $this->data->const = count($data['idx_composition']);
        // $this->data->linked = $this->mvndb_page->showLinkedIndex($idx_code);
        $this->data->title = 'VNDB Page';
        $this->template->write('title', 'VNDB Page');
        /* TUAN ANH load control-bar trang stk_page */
        $this->template->write_view('bar', 'bar/bar_index', $this->data);
        /* ------------------------- */
        $this->template->write_view('content', 'vndb_page/vndb_page_index', $this->data);
        $this->template->render();
    }

    public function getMdata(){
        $ticker = $this->input->post('ticker');
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $this->db->where('ticker', $ticker);
        $aColumns = array('id', 'date', 'shares', 'adjclose', 'close', 'divtr', 'divnr', 'adjcoeff', 'cur', 'capi', 'vlm', 'trn', 'rt_pr', 'rt_tr', 'ln_pr', 'ln_tr' , 'velocity');
        
        // DB table to use
        $sTable = 'qidx_mdata_day';
        //
    
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
                }else{
                    $this->db->order_by('date', 'DESC');
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
            
            foreach($aColumns as $col)
            {
                if($col != 'id'){
                    $value = '';
                    $value = $aRow[$col];
                    if(is_numeric($value) && $col != 'yyyymmdd' && $value != 0){
                        if(in_array($col, array('shares', 'close', 'capi', 'vlm', 'trn'))){
                            $value = normalFormat($value);
                        }else{
                            $value = number_format($value, 3);
                        }
                    }
                    $row[] = ($value != '') ? $value : '--';
                    // $row[] = $value;
                }
            }
    
            $output['aaData'][] = $row;
            $output['my_id'][] = $aRow['id'];
        }
    
        $this->output->set_output(json_encode($output));
    }

    public function showSpecs() {
        if ($this->input->is_ajax_request()) {
            $code = $this->input->post('code');
            $response = $this->mvndb_page->findSpecs($code);
            echo json_encode($response);
        }
    }

}