<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dividends_model extends CI_Model {

    public $table = 'stk_div';
    public $final_table = 'vndb_dividends_final';

    function __construct() {
        parent::__construct();
    }

    public function find($id = '', $exdate = '') {
        if ($exdate != '') {
            $exdate = " AND " . $this->table . ".exdate = '" . $exdate . "'";
        } else {
            $exdate = '';
        }
        if (is_numeric($id) == TRUE) {
            $id = " AND {$this->table}.id = " . $id;
        } else {
            $id = '';
        }
        $sql = "SELECT {$this->table}.id, {$this->table}.exdate, {$this->table}.stk_code, {$this->table}.stk_divnet,
                {$this->table}.stk_divgross, stk_ref.stk_name
                FROM {$this->table},stk_ref
                WHERE {$this->table}.stk_code = stk_ref.stk_code
                ";
        $sql .= $exdate . $id . " ORDER BY {$this->table}.exdate DESC";
        return $this->db->query($sql)->result_array();
    }

    public function findByCode($code){
        if($code != ''){
            $this->db->where('stk_code', $code);
        }
        return $this->db->get('stk_div_histoday')->result_array();
    }

    public function add($data = NULL) {
        //convert date to Y-m-d
        if (isset($data) == TRUE) {
            foreach ($data as $key => $value) {
                if ($key == 'exdate') {
                    $data[$key] = date('Y-m-d', strtotime(trim($value)));
                }
            }
        }
        return $this->db->insert($this->table, $data);
    }

    public function update($data = NULL, $id = NULL) {
        if (!is_numeric($id)) {
            return FALSE;
        }
        //convert date to Y-m-d
        if (isset($data) == TRUE) {
            foreach ($data as $key => $value) {
                if ($key == 'exdate') {
                    $data[$key] = date('Y-m-d', strtotime(trim($value)));
                }
            }
        }
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
        return true;
    }

    public function check_code($key = NULL, $date = NULL, $id = NULL) {
        if ($date != NULL) {
            $date = date('Y-m-d', strtotime(trim($date)));
        }
        if ($id != NULL) {
            if (is_numeric($id) == FALSE) {
                return FALSE;
            } else {
                $this->db->where('id !=', $id);
            }
        }
        $this->db->where('stk_code', $key);
        $this->db->where('exdate', $date);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0)
            return FALSE;
        else
            return TRUE;
    }

    public function loadListStkcode() {
        $sql = "SELECT DISTINCT stk_ref.stk_code, stk_ref.stk_name
                FROM stk_ref;";
        return $this->db->query($sql)->result_array();
    }

    public function listDivFinalByMoment($time = '', $date = ''){
        if($date == ''){
            $date = date('Y-m-d');
            switch($time){
                case 'history': $op = '<'; break;
                case 'future': $op = '>'; break;
                case 'today': $op = ''; break;
                default: $op = '>='; break;
            }
            if($op != 'all'){
                $this->db->where('date_ex ' . $op, $date);
            }
        }else{
            $this->db->where('date_ex', $date);
        }
        

        return $this->db->get($this->final_table)->result_array();
    }

    public function listDivFinalByMoment2($time = '', $date = ''){
        if($date == ''){
            $date = date('Y-m-d');
            switch($time){
                case 'history': $op = '<'; break;
                case 'future': $op = '>'; break;
                case 'today': $op = ''; break;
                default: $op = '>='; break;
            }
            if($op != 'all'){
                $this->db->where('date_ex ' . $op, $date);
            }
        }else{
            $this->db->where('date_ex', $date);
        }
        

        // DB table to use
        $sTable = 'vndb_dividends_final';

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array($sTable . '.id', 'ticker', $sTable . '.market', 'date_ex', 'date_ann', 'date_rec', 'date_pay', 'pay_met', 'pay_yr', 'pay_per', 'dividend', 'en_name');
        $aColumns_filter = array($sTable . '.id', 'ticker', $sTable . '.market', 'date_ex', 'date_ann', 'date_rec', 'date_pay', 'pay_met', 'pay_yr', 'pay_per', 'dividend', 'en_name');
        $aColumns2 = array('id', 'ticker', 'market', 'date_ex', 'date_ann', 'date_rec', 'date_pay', 'pay_met', 'pay_yr', 'pay_per', 'dividend', 'en_name');
        
    
    
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
                    if($time != '' && $time != 'future'){
                        $this->db->order_by('date_ex', 'DESC');
                    }else{
                        $this->db->order_by('date_ex', 'ASC');
                    }
                    $this->db->order_by('ticker', 'ASC');
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
        $this->db->join('vndb_company', "vndb_company.code = {$sTable}.ticker AND vndb_company.enddate = '2099-12-31'", 'left');
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
                if(!in_array($col, array('id', 'en_name'))){
                    $value = '';
                    $value = $aRow[$col];
                    if($col == 'ticker'){
                        $value = '<a class="with-tip" title="' . $aRow['en_name'] . '" href="' . admin_url() . 'vndb_page/index/' . $value . '">' . $value . '</a>';
                    }
                    if(is_numeric($value) && $col != 'pay_yr'){
                        $value = normalFormat($value);
                    }
                    $row[] = $value;
                }
            }
            $row[] = '<a href="' . admin_url() . 'dividends/add/' . $aRow['id'] . '" title="Edit" class="with-tip"><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/pencil.png" width="16" height="16"></a>
                            <a href="#" title="Delete" class="with-tip delete" pid="' . $aRow['id'] . '"><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/cross-circle.png" width="16" height="16"></a>';
            $output['aaData'][] = $row;
            $output['my_id'][] = $aRow['id'];
        }
        return $output;

        // return $this->db->get($this->final_table)->result_array();
    }

    public function countFinalDiv($ticker, $date, $id = ''){
        if(is_numeric($id)){
            $this->db->where('id', $id);
        }
        $this->db->where(array('ticker' => $ticker, 'date_ex' => $date));
        return $this->db->count_all_results($this->final_table);
    }

    public function addFinal($data){
        $this->load->model('download_model', 'mdownload');
        $where = array(
            'ticker' => $data['ticker'],
            'date_ex' => $data['date_ex']
        );
        $this->db->select('en_name');
        $this->db->where('code', $data['ticker']);
        $rows = $this->db->get('vndb_company')->result_array();
        $data['name'] = $rows[0]['en_name'];
        $this->mdownload->update_exc($this->final_table, $data, $where);
        // $this->db->insert($this->final_table, $data);
        return TRUE;
    }

    public function getFinalById($id){
        $this->db->where('id', $id);
        $rows = $this->db->get($this->final_table)->result_array();
        if(empty($rows)){
            $data = array();
        }else{
            $data = $rows[0];
        }
        return $data;
    }

    public function deleteFinal($id){
        $this->db->where('id', $id);
        $this->db->delete($this->final_table);
        return TRUE;
    }

    // public function getFinalById($id){
    //     $this->db->where('id')
    // }
}