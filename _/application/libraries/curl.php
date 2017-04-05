<?php

class curl {

    var $channel;

    function curl() {
        $this->channel = curl_init();
        // you might want the headers for http codes
        curl_setopt($this->channel, CURLOPT_HEADER, true);
        // you may need to set the http useragent for curl to operate as
        curl_setopt($this->channel, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        // you wanna follow stuff like meta and location headers
        curl_setopt($this->channel, CURLOPT_FOLLOWLOCATION, 0);
        // you want all the data back to test it for errors
        curl_setopt($this->channel, CURLOPT_RETURNTRANSFER, 0);
        // probably unecessary, but cookies may be needed to
        curl_setopt($this->channel, CURLOPT_COOKIEJAR, 'cookie.txt');
        // as above
        curl_setopt($this->channel, CURLOPT_COOKIEFILE, 'cookie.txt');
    }

    function makeRequest($method, $url, $vars, $timeout = '') {
        $this->channel = curl_init();
// if the $vars are in an array then turn them into a usable string
        if (is_array($vars)):
            $vars = implode('&', $vars);
        endif;

        //set timeout
        if ($timeout != '') {
            curl_setopt($this->channel, CURLOPT_TIMEOUT, $timeout);
        }

        // setup the url to post / get from / to
        curl_setopt($this->channel, CURLOPT_URL, $url);
        // the actual post bit
        if (strtolower($method) == 'post') :
            curl_setopt($this->channel, CURLOPT_POST, true);
            curl_setopt($this->channel, CURLOPT_POSTFIELDS, $vars);
        endif;
        // return data
        return curl_exec($this->channel);
    }

    function getStatus($url) {
        $this->channel = curl_init();
        curl_setopt($this->channel, CURLOPT_URL, $url);
        curl_setopt($this->channel, CURLOPT_NOBODY, TRUE);
        curl_exec($this->channel);
        return curl_getinfo($this->channel, CURLINFO_HTTP_CODE);
    }

}