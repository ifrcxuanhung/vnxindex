<?php

class Mtranslates_model extends CI_Model {

    private $table = 'translates';
    static $num=0;
    function get_translates($words, $code_lang = "") {
        if($code_lang == '')
            $code_lang = $_SESSION['lang'];
        $data = $this->select($this->table, "words = '$words' and code_lang = '$code_lang'");
        //viewarr($data);
        if (is_array($data) and count($data) > 0 and  $data[0]['translates'] != ''){
            return html_entity_decode($data[0]['translates']);
        } else {
            return $words;
        }
    }
}
?>
