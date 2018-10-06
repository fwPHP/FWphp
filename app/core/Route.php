<?php

namespace app\core;

class Route {

    use Singleton;

    private function __construct() {
        define('RQ', urldecode(filter_input(5, 'REQUEST_URI')));
        $this->_preg_match();
    }

    private function _preg_match() {
        $pattern = '/^[ \w\-\.\/\?\&\=\:]+$/iu';
        $true = (preg_match('/\/\//', RQ) === (int) 0 and
                preg_match($pattern, RQ) === (int) 1);
        $url = $this->_url();
        $mod = ($url['ext'] and ! $url['route']) ? false : true;
        $end = preg_match('/[\/]$/', $url['route']) === (int) 0;
        $ext = preg_match('/^[a-z]+$/', substr($url['ext'], 1)) === (int) 1;
        $url['error'] = !($true and $mod and $end and $ext);
        define('RE', $url);
    }

    private function _url() {
        $path = parse_url(RQ, PHP_URL_PATH);
        $url['ext'] = strrchr($path, '.');
        $url['route'] = $this->_route($url, $path);
        $exp = explode('/', $url['route']);
        $mod = array_shift($exp);
        $url['mod'] = empty($mod) ? 'main' : $mod;
        $url['sec'] = empty($exp) ? false : array_shift($exp);
        $sub = implode('/', $exp);
        $url['sub'] = empty($sub) ? false : $sub;
        return $url;
    }

    private function _route($url, $path) {
        $str = $url['ext'] ?
                substr($path, 1, - strlen($url['ext'])) : substr($path, 1);
        return empty($str) ? false : $str;
    }

}
