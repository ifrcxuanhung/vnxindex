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
        $sql = "select translate from {$this->_table_translate} where word = '{$keyWord}' and lang_code = '{$_SESSION['LANG_CURRENT']}' limit 1;";
        $result = $this->db->selectQuery($sql);
        if (isset($result[0]['translate']))
        {
            if ($result[0]['translate'] == '')
            {
                unset($result);
                $sql = "select translate from {$this->_table_translate} where word = '{$keyWord}' and lang_code = '{$_SESSION['LANG_DEFAULT']}' limit 1;";
                $result = $this->db->selectQuery($sql);
            }
        }
        return isset($result[0]['translate']) ? $result[0]['translate'] : $keyWord;
    }

}
