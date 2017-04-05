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

