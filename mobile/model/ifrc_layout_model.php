<?php

Class Ifrc_layout_Model{
    
    protected $_table = 'ifrc_laytout';
    private $db;
	//public function __construct(){
//		parent::__construct();
//        
//		$this->db2 = $this->load->database('database', TRUE);
//	}
    public function Ifrc_layout_Model()
    {
        $this->_lang = $_SESSION['LANG_CURRENT'];
        $this->db2 = new DB();
    }
	
	public function getListBlockHome($website,$table='',$category='') {
		if($table!='') $table =" AND table='{$table}'";
		if($category!='') $category =" AND category='{$category}'";
		$sql = "SELECT *
                FROM ifrc_layout 
                WHERE  
                 `website` like '%{$website}%' $table $category
				ORDER BY `order_website` asc
                ";
		 return $this->db2->selectQuery($sql);
	}

}