<?php

class Vfdb_user_model extends CI_Model{

	protected $_table = 'user';

	public function __construct(){
		parent::__construct();
	}

	public function add($data){
		if($this->db->insert($this->_table, $data)){
			return TRUE;
		}
		return FALSE;
	}

	public function check_user_exist($id, $email){
		if($id != ''){
			$this->db->where('id <>', $id);
		}
		$this->db->where('email', $email);
		$count = $this->db->count_all_results($this->_table);
		if($count != 0){
			return TRUE;
		}
		return FALSE;
	}
	
	public function getInfoUserById($user_id)
    {
        $sql = "SELECT u.id, u.username, u.email, u.created_on, u.first_name, u.last_name, u.phone, u.image, u.date_birth, u.address, u.website, ui.nationality, ui.university, ui.profile_position, ui.profile, ui.experience, ui.specialities ";
        $sql.= "FROM `user` u, user_infomation ui WHERE u.id = ui.user_id AND u.id = $user_id";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
}