<?php

function Loadview($url, $data = '') {
    require ("Views/$url.php");
}

function Loadlayout($file, $data = '') {
    if (is_file('Layouts/' . $file))
        require ('Layouts/' . $file);
}

function __autoload($name) {
    $arr = explode("_", $name);
    if (is_dir($arr[0])) {
        require_once ($arr[0] . "/" . $arr[1] . ".php");
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

function Redirect($url) {
    ob_end_clean();
    header("location: $url");
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

function viewarr($arr) {
    echo '<!-- ';
    print_r($arr);
    echo ' -->';
}

function pre($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function base_url() {
    return WEBSITE_URL;
}

function replaceQuote($str) {
    $string = array("\"", "'");
    $replace = array('', '');
    return str_replace($string, $replace, $str);
}

function _substr($str, $length, $minword = 3) {
    $sub = '';
    $len = 0;

    foreach (explode(' ', $str) as $word) {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);

        if (strlen($word) > $minword && strlen($sub) >= $length) {
            break;
        }
    }
    echo $sub;
    // $sub . (($len < strlen($str)) ? '...' : '');
}

function showBlock($nameBlock, $data = '') {
    require ('../modules/blocks/controllers/block.php');
}

function image_cache() {
    return base_url() . 'Public/cache/';
}

function image_url() {
    return base_url() . 'Public/';
}

function img($url = "", $w = 0, $h = 0) {
    $type = substr($url, -4);
    $url = substr($url, 0, -4);
    $url.='sizew-' . $w . 'andh-' . $h . $type;
    return '../Public/cache/' . $url;
}
?>

