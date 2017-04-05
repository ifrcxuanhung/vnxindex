<?php
if (!function_exists('replaceValueNull')) {

    function replaceValueNull($curent, $default, $data = '') {
        if (empty($curent)) {
            return $default;
        }
        if (is_object($curent) == TRUE) {
            $curent = get_object_vars($curent);
        }
        if (is_object($default) == TRUE) {
            $default = get_object_vars($default);
        }
        foreach ($curent as $k => $v) {
            if (is_array($v) == FALSE && is_object($v) == FALSE) {
                if (strip_tags($v) == '') {
                    $v = $default[$k];
                }
            } else {
                if (isset($curent[$k]) && isset($default[$k])) {
                    $v = replaceValueNull($curent[$k], $default[$k]);
                }
            }
            $data[$k] = $v;
        }
        return $data;
    }
}

if (!function_exists('setting')) {

    function setting() {
        $db = new DB();
        $sql = "select * from setting";
        $set = $db->selectQuery($sql);
        foreach ($set as $value) {
            $setting[$value['key']] = $value['value'];
        }
        return $setting;
    }

}
if (!function_exists('utf8_convert_title')) {

    function utf8_convert_title($str, $dau = '') {
        $search = array(
            '#(à|á|?|?|ã|â|?|?|?|?|?|a|?|?|?|?|?)#',
            '#(è|é|?|?|?|ê|?|?|?|?|?)#',
            '#(ì|í|?|?|i)#',
            '#(ò|ó|?|?|õ|ô|?|?|?|?|?|o|?|?|?|?|?)#',
            '#(ù|ú|?|?|u|u|?|?|?|?|?)#',
            '#(?|ý|?|?|?)#',
            '#(d)#',
            '#(À|Á|?|?|Ã|Â|?|?|?|?|?|A|?|?|?|?|?)#',
            '#(È|É|?|?|?|Ê|?|?|?|?|?)#',
            '#(Ì|Í|?|?|I)#',
            '#(Ò|Ó|?|?|Õ|Ô|?|?|?|?|?|O|?|?|?|?|?)#',
            '#(Ù|Ú|?|?|U|U|?|?|?|?|?)#',
            '#(?|Ý|?|?|?)#',
            '#(Ð)#',
            '#(039|&quot;)#',
            "/[^a-zA-Z0-9\-\_]/");
        $replace = array('a', 'e', 'i', 'o', 'u', 'y', 'd', 'A', 'E', 'I', 'O', 'U', 'Y', 'D', '', '-');
        $str = preg_replace($search, $replace, $str);
        $str = preg_replace('/(-)+/', $dau, $str);
        return strtolower($str);
    }

}
if (!function_exists('real_escape_string')) {
    function real_escape_string($str)
    {
        $search=array("\\","\0","\n","\r","\x1a","'",'"');
        $replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
        return str_replace($search,$replace,$str);
    }
}

if (!function_exists('utf8_convert_url')) {

    function utf8_convert_url($str, $dau = '-') {
        $search = array(
            '#(à|á|?|?|ã|â|?|?|?|?|?|a|?|?|?|?|?)#',
            '#(è|é|?|?|?|ê|?|?|?|?|?)#',
            '#(ì|í|?|?|i)#',
            '#(ò|ó|?|?|õ|ô|?|?|?|?|?|o|?|?|?|?|?)#',
            '#(ù|ú|?|?|u|u|?|?|?|?|?)#',
            '#(?|ý|?|?|?)#',
            '#(d)#',
            '#(À|Á|?|?|Ã|Â|?|?|?|?|?|A|?|?|?|?|?)#',
            '#(È|É|?|?|?|Ê|?|?|?|?|?)#',
            '#(Ì|Í|?|?|I)#',
            '#(Ò|Ó|?|?|Õ|Ô|?|?|?|?|?|O|?|?|?|?|?)#',
            '#(Ù|Ú|?|?|U|U|?|?|?|?|?)#',
            '#(?|Ý|?|?|?)#',
            '#(Ð)#',
            '#(039|&quot;)#',
            "/[^a-zA-Z0-9\-\_]/");
        $replace = array('a', 'e', 'i', 'o', 'u', 'y', 'd', 'A', 'E', 'I', 'O', 'U', 'Y', 'D', '', '-');
        $str = preg_replace($search, $replace, $str);
        $str = preg_replace('/(-)+/', $dau, $str);
        return $str;
    }

}
if (!function_exists('get_between')) {
    function get_between ($text, $start, $end) { 
        $mid_url = ""; 
        $pos_s = strpos($text, $start); 
        $pos_e = strpos($text, $end); 
        for ( $i=$pos_s+strlen($start) ; ( ( $i < ($pos_e)) && $i < strlen($text) ) ; $i++ ) { 
            $mid_url .= $text[$i]; 
        }
        return $mid_url;
    }
}

if (!function_exists('replace_string_between')) {
    function replace_string_between($text, $tagOne, $tagTwo, $replacement) {
        $startTagPos = strpos($text, $tagOne);
        $endTagPos = strpos($text, $tagTwo);
        $tagLength = $endTagPos - $startTagPos + 1;
        return substr_replace($text, $replacement, $startTagPos, $tagLength);
    }
}

