<?php

require APPPATH . 'libraries/REST_Controller.php';

class Webservices extends REST_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
		
        $this->load->library('ion_auth');
        $this->load->library('session');
		
    }

    public function index_get() {
		
        $this->load->model('admin/Service_model', 'service_model');
        $this->data['list_service'] = $this->session->userdata('services');
        $this->template->set_template('webservices');
        $this->template->write('title', 'web services');
        $this->template->write_view('content', 'index/list', $this->data);
        $this->template->render();
    }
	function check_user_pass($user,$pass){
		$sql = "SELECT * FROM ims_webservices where user='$user' AND pass = '$pass'";
		$result = $this->db->query($sql)->num_rows();	
		return $result;
	}
	
	 public function table_get($table = '', $type='xml') {
		
        $table = real_escape_string($table);
		$user = $_GET['user'];
		$pass = $_GET['pass'];
		
		//echo "<pre>"; print_r($this->session->all_userdata());exit;
        if ($this->check_user_pass($user,$pass) != 1) {
            $this->session->set_userdata('table', $table);
            $this->session->set_userdata('page', $this->get('page'));
            $this->session->set_userdata('method', $this->get('method'));
            Redirect('webservices/login');
        } else {
            $page = $this->get('page') != '' ? $this->get('page') : $this->session->userdata('page');
			
            if($this->get('method') != '') {
                $method = $this->get('method');
            } elseif($this->session->userdata('method') != '') {
                $method = $this->session->userdata('method');
            } else {
                $method = '';
            }
            if($this->get('code') != '') {
                $code = $this->get('code');
            } else {
                $code = '';
            }
            if(!is_numeric($page) || $page <= 0) {
                $page = 1;
            }
            //$user = $this->session->userdata('webservices');
			
            $data = array();
            if ($table != '' && $table != 'format') {
                if($type =='xml'){
					
                    $result = self::_table_get($user, $table, $page, $method, $code);
					
                    $this->session->set_userdata('method', '');
                    if(is_numeric($result)) {
                        $data[] = array('totalPage' => $result);
                    } else {
                        $data = $result;
                    }
                }else if ($type =='txt'){
                    $result = self::_table_get($user, $table, $page, $method, $code);
                    if(is_numeric($result)) {
                        $data[] = array('totalPage' => $result);
                    } else {
                        $data = $result;
                    }
                }
            }
            if ($data) {
                if($type =='xml'){
                    $this->response($data);
                    unset($data);
                }else if ($type =='txt'){
                    if(!isset($data[0]['totalPage'])){
                        //print 'code'.','.'date'.','.'close'."<BR>";
                       // print_r($data);exit;
                       $htm = "";
                       $title = "";
                       $count=0;
                        foreach ($data[0] as $key=>$value){
                            $count++;
                            $title .= $key;
                             if($count < count($data[0])){
                                $title .= ',';
                             }
                             
                        }
                        foreach($data as $parts)
                        {
                            $count=0;
                            foreach ($parts as $key=>$value){
                                $count++;
                                $htm .= $parts[$key];
                                 if($count < count($parts)){
                                    $htm .=',';
                                 }
                            }
                            $htm .= '<BR>';
                        }
                        print $title.'<BR>'.$htm;
                    }else{
                         print $data[0]['totalPage']."<BR>";
                    }
                    unset($data);                
                }
            } else {
                $this->response(NULL, 404);
            }
        }
    }

    
    
    private function _table_get($user = '', $table = '', $page = '', $method = '', $code ='') {
        $limit = 100;
        $this->db = $this->load->database('', TRUE);
        $data = array();
        if ($table != '' && $table != 'format') {
            // if idx_ref show all
            if($table == 'idx_ref') {
                if($code==''){
                    $sql = "select * from {$table}";
                }else {
                    $sql = "select * from {$table} where idx_code = '{$code}'";
                }
                if($method == 'get_total_pages') {
                    $data = ceil($this->db->query($sql)->num_rows()/$limit);
                } else {
                    $data = $this->db->query($sql.' limit '.(($page-1)*$limit).','.(($page)*$limit))->result_array();
                }
            } else {
                $fields = array();
                $sql = "select iwf.fields, iwf.key
                        from ims_webservices_field iwf
                        where iwf.account = '{$user}'
                        and iwf.table = '{$table}'
                        and iwf.active = 1";
				
                $fields = $this->db->query($sql)->result_array();
				
                if (count($fields) > 0) {
                    $field = "`";
                    $key = "";
                    foreach ($fields as $keyFields => $valueFields) {                    	
                        $field .= $valueFields['fields'] . "`,`";
                        if ($valueFields['key']==1)
                        $key = "`".$valueFields['fields']."`";
                    }
                    $field = substr($field, 0, -2);

                    $indexes = array();
                    $sql = "select iwi.index, iwi.provider
                            from ims_webservices_index iwi
                            where iwi.account = '{$user}'";
                    $indexes = $this->db->query($sql)->result_array();
					
                    if (count($indexes) > 0) {
                        $index = '';
                        $provider = '';
                        foreach ($indexes as $keyIndexes => $valueIndexes) {
                            $index .= "'{$valueIndexes['index']}',";
                            $provider .= $valueIndexes['provider'];
                        }
                        $index = rtrim($index, ',');
	                    	if(trim($provider) == '' && trim($index)!='') {
                                $sql = "select {$field} from {$table} where $key in ($index)";
                            } else {
                                 if($table == 'idx_day') {
                                    $sql = "select {$field} from {$table} where provider='".trim($provider)."'";
                                }
                                else {
                                    $sql = "select {$field} from {$table} ";
                                }
                            }
                            if(trim($code) == '') {
                                $sql .= "";
                            } else {
                                $sql .= " and code ='{$code}'";
                            }
                        if($method == 'get_total_pages') {
                            $data = ceil($this->db->query($sql)->num_rows()/$limit);
                        } else {
                            $sql .= strpos($field, 'date') === false ? '' : ' order by `date` desc';
							
		
                            $data = $this->db->query($sql.' limit '.(($page-1)*$limit).','.(($page)*$limit))->result_array();
                        }
                    }
					
                    unset($indexes);
                }
            }
        }
        return $data;
    }

}
