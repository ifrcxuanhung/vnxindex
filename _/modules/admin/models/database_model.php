<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Database_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getStructure(){
        return $this->db->get('database_structure')->result_array();
    }

    public function getIndex(){
        return $this->db->get('database_index')->result_array();
    }

}