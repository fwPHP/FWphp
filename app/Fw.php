<?php

namespace app;

class Fw {

    use core\Singleton;

    private function __construct() {
        $this->_loading();
    }

    private function _loading() {
        core\error\Handler::run();
        core\Route::run();
        define('APP', require 'tech' . D . 'app.php');
        $this->_tech();
    }

    private function _tech() {
        require 'tech' . D . 'error.php';
    }

}
