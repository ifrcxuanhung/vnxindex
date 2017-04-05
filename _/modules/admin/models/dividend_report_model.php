<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dividend_report_model extends CI_Model {
    public $change;
    function __construct() {
        parent::__construct();
    }

    public function listByDate($date){
        $this->db->where('date_ex', $date);
        $this->db->where('correct', 1);
        return $this->db->get('vndb_dividends_compare')->result_array();
    }

}

