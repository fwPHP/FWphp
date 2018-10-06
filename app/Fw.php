<?php

namespace app;

class Fw {

    use core\Singleton;

    private function __construct() {
        core\Route::run();
        var_dump(RQ, RE);
    }

}
