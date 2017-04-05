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

class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addNewsLetter($data) {
        //$email['email'] = $data;
        $datenow = date("Y-m-d H:i:s");
        $arraydata = array(
                        'email' => $data,
                        'time' => $datenow
        );
        $this->db->where('email',$data);
        $rows = $this->db->get('newsletters')->result_array();
        if(count($rows) == 0)
        {
            return $this->db->insert('newsletters', $arraydata);
        }
        else
        {
            return;
        }
        
    }

    public function getSampleCode($where = array()) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->select(array('SHORTNAME', 'CODE'));
        $this->db->where('VNXI',1);
        $rows = $this->db->get('idx_sample')->result_array();
        $data = array();
        if (!empty($rows)) {
            foreach ($rows as $key => $row) {
                $data[$row['CODE']] = $row['SHORTNAME'];
                unset($rows[$key]);
            }
        }
        return $data;
    }

    public function getClose($code) {
        $this->db->where('codeifrc', $code);
        $this->db->select(array('adjclose', 'date'));
        $this->db->order_by('date', 'ASC');
        $rows = $this->db->get('efrc_indvn_stats')->result_array();
        //echo $this->db->last_query();
        $data = array();
        if (!empty($rows)) {
            foreach ($rows as $key => $item) {
                $data[$key][] = strtotime("+1 day", strtotime($item['date'])) * 1000;
				//$data[$key][] = strtotime($item['DATE']) * 1000;
                $data[$key][] = $item['adjclose'] * 1;
            }
        }
        return $data;
    }
    public function getClose_backup($code) {
        $this->db->where('code', $code);
        $this->db->select(array('close', 'date'));
        $this->db->order_by('date', 'ASC');
        $rows = $this->db->get('idx_month')->result_array();
       // echo $this->db->last_query();
        $data = array();
        if (!empty($rows)) {
            foreach ($rows as $key => $item) {
                $data[$key][] = strtotime("+1 day", strtotime($item['date'])) * 1000;
                //$data[$key][] = strtotime($item['DATE']) * 1000;
                $data[$key][] = $item['close'] * 1;
            }
        }
        return $data;
    }
	public function getCloseEnd() {
        $this->db->select('date');
		$this->db->order_by('date','DESC');
		$this->db->limit(1);
        $rows = $this->db->get('efrc_indvn_stats')->row_array();
        return $rows;
    }
    public function getCloseStock($code) {
        $this->db->where('ticker', $code);
        $this->db->select(array('CLOSE', 'DATE'));
        $this->db->order_by('DATE', 'ASC');
        $rows = $this->db->get('stk_month_chart')->result_array();
        $data = array();

        if (!empty($rows)) {
            foreach ($rows as $key => $item) {
                $data[$key][] = strtotime("+1 day", strtotime($item['DATE'])) * 1000;
                $data[$key][] = $item['CLOSE'] * 1;
            }
        }
        return $data;
        

    }
    public function getClose2($code,$frequency) {
        $this->db->where('CODE', $code);
        $this->db->select(array('CLOSE', 'DATE'));
        $this->db->order_by('DATE', 'ASC');
        $rows = $this->db->get('idx_'.$frequency)->result_array();
        $data = array();
        if (!empty($rows)) {
            foreach ($rows as $key => $item) {
                $data[$key]['date'] = strtotime("+1 day", strtotime($item['DATE'])) * 1000;
                $data[$key]['value'] = $item['CLOSE'] * 1;
            }
        }
        return $data;
    }

}
