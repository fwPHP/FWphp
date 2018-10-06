<?php

namespace app\core;

trait Singleton {

    private static $run;

    public static function run() {
        if (self::$run !== null) {
            return self::$run;
        }
        return self::$run = new self;
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

}
