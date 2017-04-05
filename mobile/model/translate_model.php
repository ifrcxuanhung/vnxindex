<?php

Class Translate_Model {

    private $db;
    protected $_table_translate = 'translate';

    public function Translate_Model()
    {
        $this->db = new DB();
    }

    function getTranslate($keyWord = '')
    {
        if($_SESSION['LANG_CURRENT'] == 'en') { $_SESSION['LANG_CURRENT'] = 'us';};
        if($_SESSION['LANG_DEFAULT'] == 'en') { $_SESSION['LANG_DEFAULT'] == 'us';};
        $sql = "select translate from {$this->_table_translate} where word = '{$keyWord}' and lang_code = '{$_SESSION['LANG_CURRENT']}' limit 1;";
        
        $data['current'] = $this->db->selectQuery2($sql);
        $sql = "select translate from {$this->_table_translate} where word = '{$keyWord}' and lang_code = '{$_SESSION['LANG_DEFAULT']}' limit 1;";
        $data['default'] = $this->db->selectQuery2($sql);
		$data = replaceValueNull($data['current'], $data['default']);
        return ((isset($data[0]["translate"]) && $data[0]["translate"]!='') ?  $data[0]["translate"] : $keyWord);
    }

}
