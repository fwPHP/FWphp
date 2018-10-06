<?php

namespace app\core\error;

class Handler {

    use \app\core\Singleton;

    private static $type, $message, $file, $line;

    private function __construct() {
        define('ROOT', $this->_root());
        define('DB', ROOT . 'dat' . D);
        define('LOG', DB . 'log' . D);
        error_reporting(-1);
        ini_set('display_startup_errors', 0);
        ini_set('display_errors', 0);
        set_error_handler([$this, 'error']);
        ob_start();
        register_shutdown_function([$this, 'fatal']);
        set_exception_handler([$this, 'exception']);
    }

    private function _root() {
        $str = str_replace('\\', D, __NAMESPACE__);
        return substr(__DIR__, 0, - strlen(strrchr(__DIR__, $str)));
    }

    public function error($type, $message, $file, $line) {
        $errors = $this->_errors($type);
        self::$type = $errors[$type];
        self::$message = $message;
        self::$file = $file;
        self::$line = $line;
        $this->_view();
        return true;
    }

    public function fatal() {
        $e = error_get_last();
        if (!empty($e) and $e['type'] &
                (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            ob_end_clean();
            $errors = $this->_errors($e['type']);
            self::$type = $errors[$e['type']];
            self::$message = $e['message'];
            self::$file = $e['file'];
            self::$line = $e['line'];
            $this->_view();
        } else {
            ob_end_flush();
        }
    }

    public function exception(\Exception $e) {
        self::$type = 'E_EXCEPTION';
        self::$message = $e->getMessage();
        self::$file = $e->getFile();
        self::$line = $e->getLine();
        $this->_view($e->getCode());
    }

    private function _errors($type) {
        if (error_reporting() & $type) {
            return [
                E_ERROR => 'E_ERROR',
                E_WARNING => 'E_WARNING',
                E_PARSE => 'E_PARSE',
                E_NOTICE => 'E_NOTICE',
                E_CORE_ERROR => 'E_CORE_ERROR',
                E_CORE_WARNING => 'E_CORE_WARNING',
                E_COMPILE_ERROR => 'E_COMPILE_ERROR',
                E_COMPILE_WARNING => 'E_COMPILE_WARNING',
                E_USER_ERROR => 'E_USER_ERROR',
                E_USER_WARNING => 'E_USER_WARNING',
                E_USER_NOTICE => 'E_USER_NOTICE',
                E_STRICT => 'E_STRICT',
                E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
                E_DEPRECATED => 'E_DEPRECATED',
                E_USER_DEPRECATED => 'E_USER_DEPRECATED',
            ];
        }
    }

    private function _view($code = 500) {
        http_response_code($code);
        if (APP['debug']) {
            require 'debug.php';
        } else {
            require 'public.php';
        }
        exit;
    }

}
