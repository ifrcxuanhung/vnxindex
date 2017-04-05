<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request_model extends CI_Model {
    public $table = 'send_request';

    function __construct() {
        parent::__construct();
    }

    public function getSendRequest()
    {
        $sql = "select * from send_request";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }



    public function delete($id = "")
    {
        $sql = "delete from send_request where `id_request` = '$id'";
        $this->db->query($sql);
        return TRUE;

    }

}