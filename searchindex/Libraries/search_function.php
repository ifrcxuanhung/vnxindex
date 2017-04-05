<?php

function __autoload($name) {

    $a = explode('_', strtolower($name));
    if (isset($a[2])) {
        switch ($a[0]) {
            case 'models':
                require('Models/models/' . $a[2] . '.php');
                //require('/Models/' . $a[2] . '.php');
                break;
        }
    } else {
        $arr = explode("_", $name);
        if (is_dir($arr[0])) {
		
            //require_once ('Libraries/' . $arr[0] . "/" . $arr[1] . ".php");
            require_once ('Libraries/' . $arr[1] . ".php");
        } else {
            $path = $arr[0];
            for ($i = 0; $i < 5; $i++) {
                $path = '../' . $path;
                if (is_dir($path)) {
                    break;
                }
            }
            require_once ($path . "/" . $arr[1] . ".php");
        }
    }
}

function load_module($name, $file) {
    require('../modules/' . $name . '/controllers/' . $file . '.php');
}

function get_id_from_url($get) {
    $arr = explode('-', $get);
    return $arr[0];
}

function load_view($module, $file, $data="") {
    require("../modules/$module/views/$file.php");
}

function load_template($file, $data="") {
    require("../templates/html/$file.php");
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

function showBlock($nameBlock, $data = '') {
    require ('../modules/blocks/controllers/block.php');
}

function Loadhelper($name) {
    $path = "Helpers/{$name}.php";
    require_once ($path);
}