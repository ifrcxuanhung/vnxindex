<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Price_model extends CI_Model {

    public $final_table = 'vndb_prices_final';

    function __construct() {
        parent::__construct();
    }

    public function get_max() {
        $data = $this->db->query("SELECT MAX(DATE) AS DATE FROM $this->final_table")->row_array();
        return $data['DATE'];
    }

    public function listPrice($time = '', $date = '') {
        $max_date = $this->get_max();
        if (!$this->input->post('ticker')) {
            if ($date == '') {
                $date = date('Y-m-d');
                switch ($time) {
                    case 'history': $op = '<';
                        break;
                    case 'today': $op = '';
                        break;
                    default: $op = 'all';
                        break;
                }
                if ($op != 'all') {
                    $this->db->where('date ' . $op, $date);
                } else {
                    $this->db->where('date =', $max_date);
                }
            } else {
                $this->db->where('date', $date);
            }
        } else {
            $this->db->where('ticker', $this->input->post('ticker'));
        }
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        // DB table to use
        $sTable = 'vndb_prices_final';
        //
        $aColumns = array("{$sTable}.id", "{$sTable}.ticker", "{$sTable}.market", "{$sTable}.date", "{$sTable}.shli", "{$sTable}.shou", "{$sTable}.pref", "{$sTable}.pcei", "{$sTable}.pflr", "{$sTable}.popn", "{$sTable}.phgh", "{$sTable}.plow", "{$sTable}.pbase", "{$sTable}.pavg", "{$sTable}.pcls", "{$sTable}.vlm", "{$sTable}.trn", "{$sTable}.last", "{$sTable}.adj_pcls", "{$sTable}.adj_coeff", "{$sTable}.dividend", "{$sTable}.rt", "{$sTable}.rtd", "b.vn_name as name", "b.en_name as name_en");

        $aColumns2 = array('id', 'ticker', 'market', 'date', 'shli', 'shou', 'pref', 'pcei', 'pflr', 'popn', 'phgh', 'plow', 'pbase', 'pavg', 'pcls', 'vlm', 'trn', 'last', 'adj_pcls', 'adj_coeff', 'dividend', 'rt', 'rtd');

        $this->db->join('vndb_company as b', "{$sTable}.ticker = b.code", 'left');
        $this->db->where('b.enddate', '2099-12-31');


        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);

        // Paging
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }

        // Ordering
        if ($iSortCol_0 != '') {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $iSortCol = $this->input->get_post('iSortCol_' . $i, true);
                $bSortable = $this->input->get_post('bSortable_' . intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_' . $i, true);

                if ($bSortable == 'true') {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol)) + 1], $this->db->escape_str($sSortDir));
                }
            }
        } else {
            $this->db->order_by('date', 'desc');
            $this->db->order_by('ticker', 'asc');
        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if (isset($sSearch) && !empty($sSearch)) {
            for ($i = 0; $i < count($aColumns); $i++) {
                $bSearchable = $this->input->get_post('bSearchable_' . $i, true);

                // Individual column filtering
                if (isset($bSearchable) && $bSearchable == 'true') {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
            }
        }

        // Select Data
        $this->db->select('SQL_CALC_FOUND_ROWS ' . str_replace(' , ', ' ', implode(', ', $aColumns)), false);
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

        foreach ($rResult->result_array() as $aRow) {
            $row = array();

            foreach ($aColumns2 as $col) {
                if (!in_array($col, array('id'))) {
                    $value = '';
                    $value = $aRow[$col];
                    if ($col == 'ticker') {
                        $value = '<a class="with-tip" title="' . $aRow['name_en'] . '"  href="' . admin_url() . 'vndb_page/index/' . $value . '">' . $value . '</a>';
                    }

                    if ($col == 'rt' || $col == 'rtd') {
                        if ($value != 0)
                            $value = number_format($value, 6);
                    }

                    if (is_numeric($value)) {
                        $value = normalFormat($value);
                    }
                    $row[] = $value;
                }
            }
            $row[] = '<a href="#" title="Delete" class="with-tip delete" pid="' . $aRow['id'] . '"><img src="' . base_url() . 'assets/templates/backend/images/icons/fugue/cross-circle.png" width="16" height="16"></a>';
            $output['aaData'][] = $row;
            $output['my_id'][] = $aRow['id'];
        }
        return $output;
    }

    public function deleteFinal($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->final_table);
        return TRUE;
    }

}