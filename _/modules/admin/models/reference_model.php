<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reference_model extends CI_Model {
	
    public $final_table = 'vndb_reference_final';

    function __construct() {
        parent::__construct();
    }
    /*public function listDivFinalByMoment($time = '', $date = ''){
		// $this->db->select('a.id,a.date,a.ticker,b.vn_name,b.en_name,a.market,b.industry,b.sector,a.ipo,a.ipo_shli,a.ipo_shou,a.ftrd,a.ftrd_cls,a.shli,a.shou');
		// $this->db->from($this->final_table.' as a');
		// $this->db->join('vndb_company as b','a.ticker = b.code','left');
		// $this->db->where('b.enddate','2099-12-31');
        if($date == ''){
            $date = date('Y-m-d');
            switch($time){
				case 'history': $op = '<'; break;
                case 'today': $op = ''; break;
                default: $op = 'all'; break;
            }
            if($op != 'all'){
                $this->db->where('a.date ' . $op, $date);
            }
        }else{
            $this->db->where('a.date', $date);
        }
        return $this->db->get()->result_array();
    }*/
	
	public function listREFAction($time = '', $date = ''){
  //       $this->db->select('a.id,a.date,a.ticker,b.vn_name as name,b.en_name as name_en,a.market,b.industry,b.sector,a.ipo,a.ipo_shli,a.ipo_shou,a.ftrd,a.ftrd_cls,a.shli,a.shou');
		// $this->db->from($this->final_table.' as a');
		// $this->db->join('vndb_company as b','a.ticker = b.code','left');
		// $this->db->where('b.enddate','2099-12-31');
		$sTable = 'vndb_reference_final';
		
        if($date == ''){
            $date = date('Y-m-d');
            switch($time){
				case 'history': $op = '<'; break;
                case 'today': $op = ''; break;
                default: $op = ''; break;
            }
            if($op != 'all'){
                $this->db->where("{$sTable}.date " . $op, $date);
            }
        }else{
            $this->db->where("{$sTable}.date", $date);
        }
        // DB table to use
        

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array("{$sTable}.id","{$sTable}.date","{$sTable}.ticker","b.vn_name as name","b.en_name as name_en","{$sTable}.market","b.idt_code as industry","b.industry as industry_name","b.sector","b.ipo","b.ipo_shares as ipo_shli","b.ipo_shares as ipo_shou","b.ftrd_date as ftrd","b.ftrd_cls","{$sTable}.shli","{$sTable}.shou");
		$aColumns2 = array('id', 'date', 'ticker', 'market', 'industry', 'sector', 'ipo', 'ipo_shli', 'ipo_shou', 'ftrd', 'ftrd_cls', 'shli', 'shou');
        $aColumns_filter = array("{$sTable}.id","{$sTable}.date","{$sTable}.ticker","{$sTable}.market","b.industry","b.idt_code","b.sector","b.ipo","b.ipo_shares","b.ipo_shares","{$sTable}.ftrd","{$sTable}.ftrd_cls","{$sTable}.shli","{$sTable}.shou");

        //
        $this->db->join('vndb_company as b',"{$sTable}.ticker = b.code",'left');
        $this->db->where('b.enddate','2099-12-31');
		
		$this->db->order_by('date','desc');
		$this->db->order_by('ticker','asc');
		

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
        if($this->input->post('action') == 'export'){
            $tmpAllColumns = $this->db->list_fields($sTable);
            foreach($tmpAllColumns as $item){
                $allColumns[] = $sTable . '.' . $item;
            }
            foreach($aColumns_filter as $key => $item){
                if(!in_array($item, $tmpAllColumns)){
                    $allColumns[] = $item;
                }
            }
            unset($item);unset($tmpAllColumns);
            $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $allColumns)), false);
            unset($allColumns);
        }else{
            $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        }
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
                    if($this->input->post('action') != 'export'){
                        if($col == 'ticker'){
                            $value = '<a class="with-tip" title="' . $aRow['name_en'] . '" href="' . admin_url() . 'vndb_page/index/' . $value . '">' . $value . '</a>';
                        }
                        if($col == 'industry'){
                            $value = '<a class="with-tip" title="' . $aRow['industry_name'] . '" href="#" style="color:#333; cursor:text">' . $value . '</a>';
                        }
                        if(is_numeric($value)){
                            $value = normalFormat($value);
                        }
                        $row[] = $value;
                    }else{
                        $row[$col] = $value;
                    }
                }
            }
            if($this->input->post('action') != 'export'){
                $row[] = '<a href="' . admin_url() . 'reference/add/' . $aRow['id'] . '" title="Edit" class="with-tip"><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/pencil.png" width="16" height="16"></a>
                            <a href="#" title="Delete" class="with-tip delete" pid="' . $aRow['id'] . '"><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/cross-circle.png" width="16" height="16"></a>';
            }
            $output['aaData'][] = $row;
        }
        return $output;

    }	
	
	public function getFinalById($id){
        $this->db->where('id', $id);
        return $this->db->get($this->final_table)->row_array();
    }
	public function deleteFinal($id){
        $this->db->where('id', $id);
        $this->db->delete($this->final_table);
        return TRUE;
    }
	public function addFinal($data){
        $this->load->model('download_model', 'mdownload');
        $where = array(
            'ticker' => $data['ticker'],
            'date' => $data['date']
        );
        $this->db->select('en_name');
        $this->db->where('code', $data['ticker']);
        $rows = $this->db->get('vndb_company')->result_array();
        $data['name'] = $rows[0]['en_name'];
        $this->mdownload->update_exc($this->final_table, $data, $where);
         $this->db->insert($this->final_table, $data);
        return TRUE;
    }
}