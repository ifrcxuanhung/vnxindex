<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  slide_model.php                       */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  model slide                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.09.28 (Tung)        New Create      */
/* * ****************************************************************** */

class Vnfdb_home_model extends CI_Model{
    protected $_vnfdb_home = 'vnfdb_home';

    public function __construct(){
        parent::__construct();
    }

    public function getIdxHome() {
        $data = '';
        $sql = "SELECT {$this->_vnfdb_home}.`level2`, {$this->_vnfdb_home}.`category`, {$this->_vnfdb_home}.`data`, {$this->_vnfdb_home}.`records`, {$this->_vnfdb_home}.`from`
                FROM {$this->_vnfdb_home}
                ORDER BY {$this->_vnfdb_home}.`level1` ASC, {$this->_vnfdb_home}.`level2` ASC";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
}