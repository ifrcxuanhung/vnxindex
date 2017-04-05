<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Research_model extends CI_Model{

	public function __construct(){
		parent::__construct();
        $this->_lang = $this->session->userdata('curent_language');
        $this->_langDF = $this->session->userdata('default_language');
	}

	public function getResearchByIdUser($user_id, $category_code = "", $status = 1) {
	   
        $sql = "SELECT r.research_id, r.category_id, r.status, r.sort_order, r.image, r.viewed, r.date_added, r.date_modified, r.poster_id, r.user_id, r.editer_id, r.url, r.time_start, r.time_end, r.file_url, rd.title, rd.job_position, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword , rc.category_code, rc.parent_id ";
        $sql.= "FROM research r, research_description rd, research_category rc ";
        $sql.= "WHERE r.research_id = rd.research_id AND r.category_id = rc.category_id AND rd.lang_code = '". $this->_lang['code'] ."' AND r.user_id = $user_id AND r.status = $status AND rc.category_code = '$category_code'";
       
        $sql1 = "SELECT r.research_id, r.category_id, r.status, r.sort_order, r.image, r.viewed, r.date_added, r.date_modified, r.poster_id, r.user_id, r.editer_id, r.url, r.time_start, r.time_end, r.file_url,  rd.title, rd.job_position, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword , rc.category_code, rc.parent_id ";
        $sql1.= "FROM research r, research_description rd, research_category rc ";
        $sql1.= "WHERE r.research_id = rd.research_id AND r.category_id = rc.category_id AND rd.lang_code = '". $this->_langDF['code'] ."' AND r.user_id = $user_id AND r.status = $status AND rc.category_code = '$category_code'";
        
        $data['current'] = $this->db->query($sql)->result_array();
        $data['default'] = $this->db->query($sql1)->result_array();
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
        return $data;
    }
    
    public function getAllResearchByIdUser($user_id)
    {
        /*
        $sql = "SELECT r.research_id, r.category_id, r.status, r.sort_order, r.image, r.viewed, r.date_added, r.date_modified, r.poster_id, r.user_id, r.editer_id, r.url, r.time_start, r.time_end, r.file_url, rd.title, rd.job_position, rd.author, rd.journal_conference, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword , rc.category_code, rc.parent_id ";
        $sql.= "FROM research r, research_description rd, research_category rc ";
        $sql.= "WHERE r.research_id = rd.research_id AND r.category_id = rc.category_id AND rd.lang_code = '". $this->_lang['code'] ."' ORDER BY sort_order DESC";
        */
        $sql = "SELECT r.research_id, r.category_id, r.status, r.sort_order, r.image, r.viewed, r.date_added, r.date_modified, r.poster_id, r.user_id, r.editer_id, r.url, r.time_start, r.time_end, r.file_url, rd.title, rd.job_position, rd.author, rd.journal_conference, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword ";
        $sql.= "FROM research r, research_description rd ";
        $sql.= "WHERE r.research_id = rd.research_id AND r.user_id = $user_id  AND rd.lang_code = '". $this->_lang['code'] ."' ORDER BY sort_order DESC";
       
        $sql1 = "SELECT r.research_id, r.category_id, r.status, r.sort_order, r.image, r.viewed, r.date_added, r.date_modified, r.poster_id, r.user_id, r.editer_id, r.url, r.time_start, r.time_end, r.file_url, rd.title, rd.job_position, rd.author, rd.journal_conference, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword ";
        $sql1.= "FROM research r, research_description rd ";
        $sql1.= "WHERE r.research_id = rd.research_id AND r.user_id = $user_id AND rd.lang_code = '". $this->_langDF['code'] ."' ORDER BY sort_order DESC";
        
        $data['current'] = $this->db->query($sql)->result_array();
        $data['default'] = $this->db->query($sql1)->result_array();
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
        return $data;
    }
    
    public function getAllCategoryResearch()
    {
        $sql = "SELECT rc.category_id, rc.category_code, rc.image, rc.parent_id, rc.sort_order, rc.`status`, rc.date_added, rc.date_modified, rcd.name, rcd.description, rcd.meta_description, rcd.meta_keyword ";
        $sql.= "FROM research_category rc, research_category_description rcd ";
        $sql.= "WHERE rc.category_id = rcd.category_id AND rcd.lang_code = '". $this->_lang['code'] ."' AND rc.status = 1";
        
        $sql1 = "SELECT rc.category_id, rc.category_code, rc.image, rc.parent_id, rc.sort_order, rc.`status`, rc.date_added, rc.date_modified, rcd.name, rcd.description, rcd.meta_description, rcd.meta_keyword ";
        $sql1.= "FROM research_category rc, research_category_description rcd ";
        $sql1.= "WHERE rc.category_id = rcd.category_id AND rcd.lang_code = '". $this->_langDF['code'] ."' AND rc.status = 1";
        
        $data['current'] = $this->db->query($sql)->result_array();
        $data['default'] = $this->db->query($sql1)->result_array();
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
        return $data;
    }
    
    public function add_research($data)
    {
        //print_r($data);
        $this->db->insert('research', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    
    public function add_research_des($data)
    {
        $this->db->insert('research_description', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
        }
        return TRUE;
    }
    
    public function update_research($research_id, $data)
    {
        $this->db->where('research_id', $research_id);
        $this->db->update('research', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
        }
        return TRUE;
    }
    
    public function update_research_des($research_id, $lang_code, $data)
    {
        $this->db->where('research_id', $research_id);
        $this->db->where('lang_code', $lang_code);
        $this->db->update('research_description', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
        }
        return TRUE;
    }
    
    public function delete_research($research_id)
    {
        $this->db->delete('research', array('research_id' => $research_id));
        $this->db->delete('research_description', array('research_id' => $research_id));
    }
    
    public function getOneResearchById($research_id)
    {
        $sql = "SELECT r.research_id, r.category_id, r.`status`, r.sort_order, r.image, r.date_added, r.date_modified, r.user_id, r.time_start, r.time_end, r.file_url, rd.lang_code, rd.title, rd.job_position, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword, rd.author, rd.journal_conference ";
        $sql.= "FROM research r, research_description rd ";
        $sql.= "WHERE r.research_id = rd.research_id AND r.research_id = $research_id";
        
        $data = $this->db->query($sql)->result_array();
        $i = 0;
        foreach($data as $research)
        {
            if($i == 0)
            {
                $result['research_id'] = $research['research_id']; 
                $result['category_id'] = $research['category_id']; 
                $result['status'] = $research['status']; 
                $result['sort_order'] = $research['sort_order']; 
                $result['image'] = $research['image']; 
                $result['date_added'] = $research['date_added']; 
                $result['date_modified'] = $research['date_modified']; 
                $result['user_id'] = $research['user_id']; 
                $result['time_start'] = $research['time_start']; 
                $result['time_end'] = $research['time_end']; 
                $result['file_url'] = $research['file_url']; 
            }
                
                unset($research['research_id']);
                unset($research['category_id']);
                unset($research['status']);
                unset($research['sort_order']);
                unset($research['image']);
                unset($research['date_added']);
                unset($research['date_modified']);
                unset($research['user_id']);
                unset($research['time_start']);
                unset($research['time_end']);
                unset($research['file_url']);
                $lang_code = $research['lang_code'];
                unset($research['lang_code']);
                
            $result['more'][$lang_code] = $research;
            $i++;
        }
        return $result;
    }
    
    public function getAllResearch()
    {
        /*
        $sql = "SELECT u.*, ui.* ";
        $sql.= "FROM `user` u, `user_group` ug, user_infomation ui ";
        $sql.= "WHERE u.id = ug.user_id AND ui.user_id = u.id AND ug.group_id = 18 ";
        */
        $sql = "SELECT u.*, ui.* 
                FROM user_group ug,`user` u LEFT JOIN user_infomation ui ON u.id = ui.user_id
                WHERE u.id = ug.user_id AND ug.group_id = 18";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
    
    
    public function getPost($research_id)
    {
        $sql = "SELECT r.research_id, r.category_id, r.image, r.viewed, r.`date_added`, r.`date_modified`, r.`user_id`, r.time_start, r.time_end, r.file_url, rd.title, rd.job_position, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword ";
        $sql.= "FROM research r, research_description rd ";
        $sql.= "WHERE r.research_id = rd.research_id AND r.research_id = '$research_id' AND rd.lang_code = '". $this->_lang['code'] ."'";
        
        $sql1 = "SELECT r.research_id, r.category_id, r.image, r.viewed, r.`date_added`, r.`date_modified`, r.`user_id`, r.time_start, r.time_end, r.file_url, rd.title, rd.job_position, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword ";
        $sql1.= "FROM research r, research_description rd ";
        $sql1.= "WHERE r.research_id = rd.research_id AND r.research_id = '$research_id' AND rd.lang_code = '". $this->_langDF['code'] ."'";
    
        $data['current'] = $this->db->query($sql)->result_array();
        $data['default'] = $this->db->query($sql1)->result_array();
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
        return $data;
    }
    
    public function getRelatedPost($user_id, $research_id)
    {
        $sql = "SELECT r.research_id, r.category_id, r.image, r.viewed, r.`date_added`, r.`date_modified`, r.`user_id`, rd.title, rd.job_position, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword ";
        $sql.= "FROM research r, research_description rd ";
        $sql.= "WHERE r.research_id = rd.research_id AND rd.lang_code = '". $this->_lang['code'] ."' AND user_id = '$user_id' AND r.research_id != '$research_id' LIMIT 0,5";
        
        $sql1 = "SELECT r.research_id, r.category_id, r.image, r.viewed, r.`date_added`, r.`date_modified`, r.`user_id`, rd.title, rd.job_position, rd.description, rd.long_description, rd.meta_description, rd.meta_keyword ";
        $sql1.= "FROM research r, research_description rd ";
        $sql1.= "WHERE r.research_id = rd.research_id AND rd.lang_code = '". $this->_langDF['code'] ."' AND user_id = '$user_id' AND r.research_id != '$research_id' LIMIT 0,5";
        
        $data['current'] = $this->db->query($sql)->result_array();
        $data['default'] = $this->db->query($sql1)->result_array();
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
        return $data;
    }
    

    public function getAllInfomationUser($user_id)
    {
        $sql = "SELECT u.id, u.username, u.email, u.created_on, u.first_name, u.last_name, u.phone, u.image, u.date_birth, u.address, u.website, ui.nationality, ui.university, ui.profile_position, ui.profile, ui.experience, ui.specialities ";
        $sql.= "FROM `user` u LEFT JOIN user_infomation ui ON u.id = ui.user_id ";
        $sql.= "WHERE u.id = '$user_id'";
        
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
    
    public function update_user($user_id, $data)
    {
        $this->db->where('id', $user_id);
        $this->db->update('user', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
        }
        return TRUE;
    }
    
    public function update_user_infomation($user_id, $data)
    {
        $sql = "select user_id from user_infomation where user_id = $user_id";
        $result = $this->db->query($sql)->result_array();
        
        if(empty($result))
        {
            $data['user_id'] = $user_id;
            $this->db->insert('user_infomation', $data);
        }
        else
        {
            $this->db->where('user_id', $user_id);
            $this->db->update('user_infomation', $data);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
        }
        return TRUE;
    }
   
}