<?php
class Helpers_Validation{

    public $_report;
    public $_mess;

    public function check_empty($text,$err=""){
        if(trim($text) == NULL){
            $this->_mess[]= $err;
            return true;
        }
    }

    public function check_regex($regex,$text,$err=""){
        if(!eregi($regex,$text)){
            $this->_mess[]=$err;
            return true;
        }
    }

    public function check_email($text,$err=""){
        if(!eregi("^[a-zA-Z]{1}[a-zA-Z0-9\.\_\-]+\@[a-zA-Z0-9]+\.[a-zA-Z\.]{2,}$",$text)){
            $this->_mess[]=$err;
            return true;
        }
    }

    public function check_url($text,$err=""){
        if(!eregi("^((http|https|ftp)://)?(www\.)?[a-zA-Z0-9.-]{3,}\.[a-zA-Z]{2,6}[a-zA-Z0-9.\=\&\?\/-]*$",$text)){
            $this->_mess[]=$err;
            return true;
        }
    }

    public function check_unmatches($text1,$text2,$err=""){
        if($text1 == $text2){
            $this->_mess[]=$err;
            return true;
        }
    }

    public function check_matches($text1,$text2,$err=""){
        if($text1 != $text2){
            $this->_mess[]=$err;
            return true;
        }
    }

    public function check_minlen($text,$length,$err=""){
        if($text == NULL || strlen($text) < $length){
            $this->_mess[] = $err;
            return true;
        }
    }

    public function check_len($text,$minlen,$maxlen,$err=""){
        if(strlen($text) < $minlen || strlen($text) > $maxlen){
            $this->_mess[] = $err;
            return true;
        }
    }

    public function check_maxlen($text,$length,$err=""){
        if(strlen($text) > $length){
            $this->_mess[]=$err;
            return true;
        }
    }

    public function compare_date($text1,$text2,$err=""){
        if(strtotime($text1) > strtotime($text2)){
            $this->_mess=$err;
            return true;
        }
    }

    public function compare_number($num1,$num2,$err=""){
        if($num1 > $num2){
            $this->_mess=$err;
            return true;
        }
    }

    public function valid(){
        if($this->_mess == NULL){
            $this->_report=false;
        }
        else{
            $this->_report=true;
        }
        return $this->_report;
    }
}
?>