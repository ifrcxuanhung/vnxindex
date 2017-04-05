<?php

function __autoload($name) {

    $a = explode('_', strtolower($name));
    switch ($a[0]) {
        case 'models':
            require('modules/' . $a[1] . '/models/' . $a[2] . '.php');
            break;
    }
}

function load_module($name, $file) {
    require('modules/' . $name . '/controllers/' . $file . '.php');
}

function get_id_from_url($get) {
    $arr = explode('-', $get);
    return $arr[0];
}

function load_view($module, $file, $data = "") {
    require("modules/$module/views/$file.php");
}

function load_template($file, $data = "") {
    require("templates/html/$file.php");
}

function pre($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function makeAlias($str) {
    $string = array("î", "®", "’", "`", "~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "+", "=", "[", "]", "{", "}", "|", "\\", ":", ";", "'", "\"", ",", "<", ".", ">", "/", "?", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à", " ");
    $replace = array("i", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "a", "", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a", "-");
    return strtolower(str_replace($string, $replace, $str));
}

function Redirect($url) {
    ob_end_clean();
    header("location: $url");
}

function base_url() {
    return WEBSITE_URL;
}

function showBlock($nameBlock, $data = '') {
    require ('modules/blocks/controllers/block.php');
}

function Loadhelper($name) {
    $path = 'Helpers';
    for ($i = 0; $i < 5; $i++) {
        if (is_dir($path)) {
            break;
        }
        $path = '../' . $path;
    }
    require_once ($path . "/" . $name . ".php");
}

function check_zero($number) {
    if ($number == "" || $number == "-") {
        return "-";
    }
    if ($number == 0) {
        return '0.00';
    }
    return number_format($number, 2, '.', ',');
}

function remove_emty_array($array) {
    if ($array) {
        foreach ($array as $key => $value) {
            if (is_null($value) || $value == "") {
                unset($array[$key]);
            }
        }
    }
    return $array;
}

function image_cache() {
    return base_url() . 'Public/cache/';
}

function image_url() {
    return base_url() . 'Public/';
}

function img($url, $w = 0, $h = 0) {
    $type = substr($url, -4);
    $url = substr($url, 0, -4);
    $url.='sizew-' . $w . 'andh-' . $h . $type;
    return base_url() . 'Public/cache/' . $url;
}