<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document_model extends CI_Model {

    public function load_data($path, $table){
        //$base_url = str_replace('/','//',$path);
        $this->db->query("TRUNCATE TABLE $table");
        $this->db->query("LOAD DATA LOCAL INFILE '{$path}' INTO TABLE $table FIELDS TERMINATED BY  '\t' IGNORE 1 LINES ()");
    }
    
    public function get_filename($id){
        $this->db->select('pdf');
        $this->db->from('vfdb_documents_papers');
        $this->db->where('id',$id);
        return $this->db->get()->row_array();
    }
    
    public function get_data($id,$table){
        $this->db->where('id', $id);
        $rows = $this->db->get($table)->result_array();
        if(empty($rows)){
            $data = array();
        }else{
            $data = $rows[0];
        }
        return $data;
    }
    
    public function edit($data,$id,$table){
        $this->db->where("id",$id);
        $this->db->update($table,$data);
    }
    
    public function delete($id,$table){
        $this->db->where('id', $id);
        $this->db->delete($table);
        return TRUE;
    }
}
