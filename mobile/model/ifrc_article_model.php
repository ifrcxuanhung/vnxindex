<?php
class Ifrc_article_model{
    
    protected $_table = 'ifrc_articles';
    protected $_table_cate = 'category';
    protected $_table_cate_detail = 'category_description';
    protected $_lang;
    private $db;
	//public function __construct(){
//		parent::__construct();
//        
//		$this->db2 = $this->load->database('database', TRUE);
//	}
    public function Ifrc_article_model()
    {
        $this->_lang = $_SESSION['LANG_CURRENT'];
        $this->db2 = new DB();
    }
	public function list_article_cate($cate, $sort_order = '') {
	 //   print_R($cate);exit;  
	    $data = array();
		if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        if($sort_order != ""){
            $sort = $sort_order;
        }else {
            $sort = ' clean_order ASC';
        }
		$sql = "SELECT tempt1.file, tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en' ORDER BY $sort) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                tempt1.lang_code='".$this->_lang."' 
                and tempt2.clean_cat IN ('".$cate."') and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1
                ORDER BY tempt2.rowNumber";
		$data['current'] = $this->db2->selectQuery($sql);
		
		$sql = "SELECT tempt1.file, tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en' ORDER BY $sort) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' 
                 and tempt2.clean_cat IN ('".$cate."') and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1
                ORDER BY tempt2.rowNumber";
    	$data['default'] = $this->db2->selectQuery($sql);
 	
    	if(!empty($data['default'])){
    		$data['current'] = replaceValueNull($data['current'], $data['default']);
    	}
//echo "<pre>";print_r($data);exit;
        return $data;
    }
	
	
	public function list_article_cate_document($cate, $sort_order = '') {
	 //   print_R($cate);exit;  
	    $data = array();
		if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        if($sort_order != ""){
            $sort = $sort_order;
        }else {
            $sort = ' clean_order ASC';
        }
		$sql = "
				SELECT * FROM ifrc_articles
                WHERE lang_code='".$this->_lang."'  
                and clean_cat IN ('".$cate."') and `website` like '%m.vnxindex%' and `status`=1";
              
		$data['current'] = $this->db2->selectQuery($sql);
		
		$sql = "
				SELECT * FROM ifrc_articles
                WHERE lang_code='".$_SESSION['LANG_DEFAULT']."'  
                and clean_cat IN ('".$cate."') and `website` like '%m.vnxindex%' and `status`=1";
    	$data['default'] = $this->db2->selectQuery($sql);
 	
    	if(!empty($data['default'])){
    		$data['current'] = replaceValueNull($data['current'], $data['default']);
    	}
//echo "<pre>";print_r($data);exit;
        return $data;
    }
	public function ifrc_article_intro(){
		if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
	  	$sql = "SELECT * FROM ifrc_articles WHERE clean_cat = 'intro' and website like '%m.vnxindex%' and status = 1 and lang_code = '".$this->_lang."' LIMIT 0,1";
     	$data = $this->db2->selectQuery($sql);
		
        return $data;
	}
    
    
    
    public function getArticleById($art_id)
    {
        if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        //print_r($this->_lang);exit;
            $sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
        tempt1.lang_code='".$this->_lang."' 
        and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.clean_artid = '$art_id' 
        ORDER BY tempt2.rowNumber";
        //print_r($sql);exit;
      
  		$data['current'] = $this->db2->selectQuery($sql);
        	
        	$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
        tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' 
        and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.clean_artid = '$art_id' 
        ORDER BY tempt2.rowNumber";
        
       	$data['default'] = $this->db2->selectQuery($sql);
        
        
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
	
        return $data;
    }
    
    public function getArticleProfile($codeCate = '')
    {
        $lang_default = $_SESSION['LANG_DEFAULT']=='us' ? 'en' :  $_SESSION['LANG_DEFAULT'];
        if($this->_lang=='us') {$this->_lang = 'en';} else { $this->_lang = $_SESSION['LANG_CURRENT'];};
        $sql = "select a.article_id,adesc.title
                from article a JOIN article_description adesc ON a.article_id=adesc.article_id
                JOIN category c ON a.category_id=c.category_id
                where a.category_id = c.category_id
                and c.category_code = '$codeCate'
                and a.sort_order = 0
                limit 1;";
        $art = $this->db2->selectQuery2($sql);
        //print_r($art);exit;
        $data = array('current' => array(), 'default' => array());
        if (isset($art[0]['title']))
        {
                $title = trim($art[0]['title']);
                $sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='".$this->_lang."'  ORDER BY clean_order ASC) as tempt2
            ON tempt1.clean_artid = tempt2.clean_artid
            where  
            tempt1.lang_code='".$this->_lang."' 
            and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.title = '$title' 
            ORDER BY tempt2.rowNumber";
           // print_r($sql);exit;
          
      		$data['current'] = $this->db2->selectQuery($sql);
            	
            	$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='".$lang_default."'  ORDER BY clean_order ASC) as tempt2
            ON tempt1.clean_artid = tempt2.clean_artid
            where  
            tempt1.lang_code='".$lang_default."' 
            and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.title = '$title' 
            ORDER BY tempt2.rowNumber";
            
           	$data['default'] = $this->db2->selectQuery($sql);

            if ($data['current'] || empty($data['current']))
            {
                $data['current'] = replaceValueNull($data['current'], $data['default']);
            }
        }
        return $data;
    }
    
    public function getArticleByTitle($title)
    {
        if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        //print_r($this->_lang);exit;
            $sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
        tempt1.lang_code='".$this->_lang."' 
        and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.title like '%$title%' 
        ORDER BY tempt2.rowNumber";
       // print_r($sql);exit;
      
  		$data['current'] = $this->db2->selectQuery($sql);
        	
        	$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
        tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' 
        and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.title like '$title' 
        ORDER BY tempt2.rowNumber";
        
       	$data['default'] = $this->db2->selectQuery($sql);
        
        
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
	
        return $data;
    }
    
    public function getArticleByTitleAndCate($title, $cate)
    {
        if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        //print_r($this->_lang);exit;
            $sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
        tempt1.lang_code='".$this->_lang."'  AND tempt1.clean_cat = '$cate' 
        and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.title like '%$title%' 
        ORDER BY tempt2.rowNumber";
       // print_r($sql);exit;
      
  		$data['current'] = $this->db2->selectQuery($sql);
        	
        	$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
        tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' AND tempt1.clean_cat = '$cate' 
        and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.title like '$title' 
        ORDER BY tempt2.rowNumber";
        
       	$data['default'] = $this->db2->selectQuery($sql);
        
        
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
	
        return $data;
    }
    
    public function getArticleRelative($cate, $art_id)
    {
        //$lang = $this->session->userdata_m.vnxindex('curent_language');
        //$lang = $lang['code'];

       // $_SESSION['LANG_DEFAULT'] = $this->session->userdata_m.vnxindex('default_language');
        //$_SESSION['LANG_DEFAULT'] = $$_SESSION['LANG_DEFAULT']['code'];
        if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
       	$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
         tempt1.lang_code='".$this->_lang."' 
         and tempt2.clean_cat IN ('".$cate."') and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.clean_artid != '$art_id' 
        ORDER BY tempt2.rowNumber";
        	  if($row = $this->db2->selectQuery($sql)){
        			$data['current'] = $row->result_array();
        		}
        		$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
         tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' 
         and tempt2.clean_cat IN ('".$cate."') and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1 AND tempt1.clean_artid != '$art_id' 
        ORDER BY tempt2.rowNumber";
        	if($row = $this->db2->selectQuery($sql)){
        		$data['default'] = $row->result_array();
        	}
        
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
        return $data;
    }
	
	public function ifrc_articles_news(){

		$sql_set = "SELECT value FROM setting WHERE `layout` = 'home' AND `key` = 'new' LIMIT 0,1";
		$set = $this->db->selectQuery($sql_set)->row_array();
		if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
		$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY date_creation ) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='".$this->_lang."' 
                 and tempt2.clean_cat = 'news' and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1
                ORDER BY tempt2.rowNumber
                DESC LIMIT 0,".$set['value']."
                ";



             if($row = $this->db2->selectQuery($sql)){
            			$data['current'] = $row->result_array();
            		}
            		$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY date_creation DESC ) as tempt2
            ON tempt1.clean_artid = tempt2.clean_artid
            where  
             tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' 
             and tempt2.clean_cat = 'news' and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1
            ORDER BY tempt2.rowNumber
            LIMIT 0,".$set['value']."
            ";
             
            	if($row = $this->db2->selectQuery($sql)){
            		$data['default'] = $row->result_array();
            	}
            	if(!empty($data['default'])){
            		$data['current'] = replaceValueNull($data['current'], $data['default']);
            	}
            
                    return $data;
            		
    }
	public function ifrc_article_detail($id){
	    if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
		$sql = "SELECT * FROM ifrc_articles WHERE clean_artid = $id and lang_code = '".$this->_lang."'";	
	
		$data['current'] = $this->db2->selectQuery($sql);
		
		$sql = "SELECT * FROM ifrc_articles WHERE clean_artid = $id and lang_code = '".$_SESSION['LANG_DEFAULT']."'";
	
		$data['default'] = $this->db2->selectQuery($sql);
		
		if(!empty($data['default'])){
			$data['current'] = replaceValueNull($data['current'], $data['default']);
		}
		
        return $data;
	}
	
	
	
	public function ifrc_get_by_category($id,$sort_order){
	    if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
		$sql = "SELECT clean_cat FROM ifrc_articles WHERE clean_artid= $id";
		$data = $this->db2->selectQuery($sql);

		if(isset($data['clean_cat'])){
			 $result['content'] = $this->get_article_by_cate_code($data['clean_cat'],$sort_order);
		}
		$result['cat']= $data['clean_cat'];
		
		return $result;
	}
	public function GetBetween($var1="",$var2="",$pool){
		$temp1 = strpos($pool,$var1)+strlen($var1);
		$result = substr($pool,$temp1,strlen($pool));
		$dd=strpos($result,$var2);
		if($dd == 0){
		$dd = strlen($result);
		}
		
		return substr($result,0,$dd);
	}
	public function list_article_cate_document_1($cate, $query = '') {
	 //   print_R($cate);exit;  
	    $data = array();
		if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        if($query != ""){
			$where = $this->GetBetween("where", "order by", $query);
			$arr = explode('order by', $query);
			$sort = str_replace(";","",$arr[1]);
        }else {
            $sort = ' clean_order asc';
        }
		$sql = "
				SELECT * FROM ifrc_articles as  tempt1
                WHERE lang_code='".$this->_lang."'  
                and $where";
              
		$data['current'] = $this->db2->selectQuery($sql);
		
		$sql = "
				SELECT * FROM ifrc_articles as  tempt1
                WHERE lang_code='".$_SESSION['LANG_DEFAULT']."'  
                and $where";
    	$data['default'] = $this->db2->selectQuery($sql);
 	
    	if(!empty($data['default'])){
    		$data['current'] = replaceValueNull($data['current'], $data['default']);
    	}
//echo "<pre>";print_r($data);exit;
        return $data;
    }
	public function get_article_by_cate_code_1($code,$where='',$sort=' clean_order asc',$limit=''){
	    if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
		if($limit!='') $str_limit =" LIMIT {$limit}";
		else $str_limit ='';
	
        $data = '';
        // $sql = 'SELECT * FROM ifrc_articles s WHERE s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $this->_lang . '" ORDER BY clean_order';
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order 
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where  lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='{$this->_lang}'  
				 AND $where
                ORDER BY tempt2.rowNumber {$str_limit}";
        $data['current'] = $this->db2->selectQuery($sql);
       
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order 
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' AND
				 $where
                ORDER BY tempt2.rowNumber {$str_limit}";
        //$sql = 'SELECT * FROM ifrc_articles s WHERE  s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $_SESSION['LANG_DEFAULT'] . '" ORDER BY clean_order';
        $data['default'] = $this->db2->selectQuery($sql);
       // print_R($sql);exit;
       // print_R($_SESSION['LANG_DEFAULT']);exit;
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
		 //echo "<pre>";print_r($data);exit;
        return $data;
    }
	public function get_article_by_cate_code($code,$sort_order,$limit=''){
	    if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        if($sort_order != ""){
            $sort = $sort_order;
        }else {
            $sort = ' clean_order asc';
        }
		if($limit!='') $str_limit =" LIMIT {$limit}";
		else $str_limit ='';
	
        $data = '';
        // $sql = 'SELECT * FROM ifrc_articles s WHERE s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $this->_lang . '" ORDER BY clean_order';
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order 
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where  lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='{$this->_lang}' 
				 and tempt2.clean_cat = '{$code}' and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1
                ORDER BY tempt2.rowNumber {$str_limit}";
       
        $data['current'] = $this->db2->selectQuery($sql);
       
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order 
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' 
				 and tempt2.clean_cat = '{$code}' and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1
                ORDER BY tempt2.rowNumber {$str_limit}";
        //$sql = 'SELECT * FROM ifrc_articles s WHERE  s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $_SESSION['LANG_DEFAULT'] . '" ORDER BY clean_order';
        

        $data['default'] = $this->db2->selectQuery($sql);
        
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
		 //echo "<pre>";print_r($data);exit;
        return $data;
    }
    
    public function get_article_by_scate_code($cat,$code,$sort_order,$limit=''){
        if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
		if($sort_order != ""){
            $sort = $sort_order;
        }else {
            $sort = ' clean_order asc';
        }
	    if($limit!='') $str_limit =" LIMIT {$limit}";
		else $str_limit ='';
        if($code!=''){
            $where_code = " and tempt2.clean_scat = '{$code}'";}else{ $where_code = '';}
        $data = '';
        // $sql = 'SELECT * FROM ifrc_articles s WHERE s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $this->_lang . '" ORDER BY clean_order';
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order, tempt2.clean_scat
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where  lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='{$this->_lang}' 
				 $where_code and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1
				 and tempt2.clean_cat='{$cat}'
                ORDER BY tempt2.rowNumber {$str_limit}";
       
        $data['current'] = $this->db2->selectQuery($sql);
        
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order, tempt2.clean_scat
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' 
				 $where_code and tempt2.`website` like '%m.vnxindex%' and tempt2.`status`=1
				  and tempt2.clean_cat='{$cat}'
                ORDER BY tempt2.rowNumber {$str_limit}";
        //$sql = 'SELECT * FROM ifrc_articles s WHERE  s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $_SESSION['LANG_DEFAULT'] . '" ORDER BY clean_order';
        $data['default'] = $this->db2->selectQuery($sql);
      
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
		 //echo "<pre>";print_r($data);exit;
        return $data;
    }
    
    function list_category_code($parentCode) {
        if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        $data = '';
        // $sql = 'SELECT * FROM ifrc_articles s WHERE s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $this->_lang . '" ORDER BY clean_order';
        $sql = "SELECT tempt1.clean_cat,tempt1.clean_scat 
                FROM ifrc_articles as tempt1 
                where  
                 tempt1.lang_code='{$this->_lang}' 
				 and tempt1.clean_cat = '{$parentCode}' and tempt1.`website` like '%m.vnxindex%' and tempt1.`status`=1
                ";
       
       
       $data['current'] = $this->db2->selectQuery($sql);
        
        $sql = "SELECT tempt1.clean_cat, tempt1.clean_scat
                FROM ifrc_articles as tempt1 
                where  
                 tempt1.lang_code='".$_SESSION['LANG_DEFAULT']."' 
				 and tempt1.clean_cat = '{$parentCode}' and tempt1.`website` like '%m.vnxindex%' and tempt1.`status`=1
                ";
				
        //$sql = 'SELECT * FROM ifrc_articles s WHERE  s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $_SESSION['LANG_DEFAULT'] . '" ORDER BY clean_order';
        //print_r($sql);
    
        $data['default'] = $this->db2->selectQuery($sql);
        
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
		 //echo "<pre>";print_r($data);exit;
        return $data;
    }
    
    function list_category_code_groupby($parentCode) {
        if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        $data = '';
        // $sql = 'SELECT * FROM ifrc_articles s WHERE s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $this->_lang . '" ORDER BY clean_order';
        $sql = "SELECT tempt1.clean_cat,tempt1.clean_scat 
                FROM ifrc_articles as tempt1 
                where  
                 tempt1.lang_code='{$this->_lang}' 
				 and tempt1.clean_cat = '{$parentCode}' and tempt1.`website` like '%m.vnxindex%' and tempt1.`status`=1
                 GROUP BY tempt1.clean_scat";
       
       
       $data['current'] = $this->db2->selectQuery($sql);
        
       $sql = "SELECT tempt1.clean_cat, tempt1.clean_scat
                FROM ifrc_articles as tempt1 
                where  
                 tempt1.lang_code='{$this->_lang}' 
				 and tempt1.clean_cat = '{$parentCode}' and tempt1.`website` like '%m.vnxindex%' and tempt1.`status`=1
                 GROUP BY tempt1.clean_scat";
				
        //$sql = 'SELECT * FROM ifrc_articles s WHERE  s.`website` like "%m.vnxindex%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $_SESSION['LANG_DEFAULT'] . '" ORDER BY clean_order';
       // print_r($sql);
    
        $data['default'] = $this->db2->selectQuery($sql);
        
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
		 //echo "<pre>";print_r($data);exit;
        return $data;
    }
    
    public function count_article_cate1($parentCate)
    {
        if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
        $listcodeCate = $this->list_category_code_groupby($parentCate);
        //print_R($listcodeCate);exit;
        $cate = '';
        foreach ($listcodeCate['current'] as $key => $value)
        {
            $cate .= "'".$value['clean_scat']."',";
        }
        $sql = 'SELECT count(*) as sum FROM ifrc_articles 
        
                WHERE 
                    clean_scat in (' . substr($cate,0,-1) . ') 
                AND 
                    clean_cat = "'.$parentCate.'" AND lang_code = "'.$this->_lang.'" and `website` like "%m.vnxindex%" AND `status`=1';
        $data = $this->db2->selectQuery($sql);
       // print_R($data);exit;
        return isset($data[0]['sum']) ? $data[0]['sum'] :0;
    }
	
    public function count_article_scate($scodeCate,$cate='')
    {
        if($this->_lang=='us') $this->_lang = 'en';
        if($_SESSION['LANG_DEFAULT']=='us') $_SESSION['LANG_DEFAULT'] = 'en';
       // $listcodeCate = $this->list_category_code_groupby($codeCate);
        //print_R($listcodeCate);exit;
        $sql = 'SELECT count(*) as sum FROM ifrc_articles 
        
                WHERE 
                    clean_scat = "'.$scodeCate.'" and clean_cat="'.$cate.'" and `website` like "%m.vnxindex%" AND lang_code = "' .  $this->_lang . '" AND `status`=1';
        $data = $this->db2->selectQuery($sql);
       // print_R($data);exit;
        return $data[0]['sum'];
    }
    
    public function getArticleByTitleReturnId($title = '')
    {
        $id = "";
        $array = array();
        $sql = "select clean_artid, title, clean_cat
                from ifrc_articles;";
        $listTitle = $this->db2->selectQuery($sql);
        foreach($listTitle as $item) {
            if($title == utf8_convert_url(strtolower($item['title']))) {
                $array['id'] = $item['clean_artid'];
                $array['title'] = $item['title'];
                $array['clean_cat'] = $item['clean_cat'];
                break;
            }
        }
        unset($listTitle);
        return $array;
    }

}