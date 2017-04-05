<?php

class Mlanguages_model extends CI_Model {

    private $table = 'language';

    // Danh sách ngôn ngữ
    function list_languages() {
        $data = $this->db->get($this->table);
        return $data->result_array();
    }
}
?>
