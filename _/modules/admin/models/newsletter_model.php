<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsletter_model extends CI_Model {
    public $table = 'newsletters';

    function __construct() {
        parent::__construct();
    }

    public function getEmailReceiveNews()
    {
        $sql = "select * from newsletters";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
    
    public function change_status($id_email, $status)
    {
        if($status == "Disable")
        {
            $sql = "Update newsletters set active = 1 where id = $id_email";
        }
        else
        {
            $sql = "Update newsletters set active = 0 where id = $id_email";
        }
        $this->db->query($sql);
        $status = ($status == "Enable") ? "Disable" : "Enable";
        return $status;
    }
    
    public function getOneEmailNewsLetter($id = null)
    {
        $sql = "select * from newsletters where id = $id";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
    
    public function edit($arrNewsletter, $id)
    {
        $this->db->trans_begin();
        $this->db->update($this->table, $arrNewsletter['newsletter'], array('id' => $id));


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
        }
        return TRUE;
    }
    
    public function delete($id = "")
    {
        $sql = "delete from newsletters where `id` = '$id'";
        $this->db->query($sql);
        return TRUE;
        /*
        
        $this->db->trans_begin();

        //$this->db->delete($this->table, array('article_id' => $id));
        $this->db->delete($this->newsletters, array('id' => $id));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
        }
        return TRUE;
        */
    }
    
    public function synchronization()
    {

        $sql = "SELECT n.email, n.`time`, u.first_name, u.last_name, u.phone ";
        $sql.= "FROM newsletters n LEFT JOIN `user` u ON n.id = u.id ";
        $sql.= "WHERE n.active = 1";

        $list_email = $this->db->query($sql)->result_array();

        //return($list_email);exit;
        $connect = mysql_connect($this->db->hostname_db_mail, $this->db->username_db_mail, $this->db->password_db_mail) or die (mysql_error());
    	mysql_select_db($this->db->database_db_mail,$connect) or die (mysql_error());
    	mysql_query('set names utf8');
        $nameGroup = $this->db->name_group_mail;
        $sql = "select * from `group` where `group_name` = '". $nameGroup ."'";
        $rs = mysql_query($sql);
        $r = mysql_fetch_assoc($rs);
        
        if(empty($r))
        {
            $sql = "Insert into `group`(`group_name`, `public`, `category_name`, `type`) Values ('$nameGroup', 1, '', 0)";
            mysql_query($sql, $connect);
            $idGroup = mysql_insert_id();
        }
        else
        {
            $idGroup = $r['group_id'];
        }

        for($i=0; $i<count($list_email); $i++)
        {
            $email = $list_email[$i]['email'];
            $first_name = $list_email[$i]['first_name'];
            $last_name = $list_email[$i]['last_name'];
            $time = $list_email[$i]['time'];
            $phone = $list_email[$i]['phone'];
            
            $sql = "select * from member where `email` = '". $email ."'";
            $rs = mysql_query($sql, $connect);
            $r = mysql_fetch_assoc($rs);
            if(empty($r))
            {
                $sql = "insert into member(`first_name`, `last_name`, `email`, `join_date`, `civilite`) values('$first_name', '$last_name', '$email', '$time', 'Mlle')";
                mysql_query($sql, $connect);
                $idMember = mysql_insert_id();
                
                $sql = "insert into member_group(`member_id`, `group_id`) values ('$idMember', '$idGroup')";
                mysql_query($sql, $connect);
                
                for($j=1; $j<=3; $j++)
                {
                    $sql = "insert into member_field_value(`member_id`, `member_field_id`, `value`) values ('$idMember', $j, '')";
                    mysql_query($sql, $connect);
                }
                $sql = "insert into member_field_value(`member_id`, `member_field_id`, `value`) values ('$idMember', 4, '$phone')";
                mysql_query($sql, $connect);
            }
			else
			{
				$member_id = $r['member_id'];
				$sql = "select 1 as 'aaa' from member_group where member_id = '$member_id' and group_id = '$idGroup'";
				$rs = mysql_query($sql, $connect);
				$r = mysql_fetch_assoc($rs);
				if($r['aaa'] != 1)
				{
					$sql = "insert into member_group(`member_id`, `group_id`) values ('$member_id', '$idGroup')";
					mysql_query($sql, $connect);
				}
			}
        }
        return true;

    }

}