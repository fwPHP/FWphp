<?php

namespace app\core\error;

class Exception extends \Exception {

    public function __construct(string $message = "", int $code = 404) {
        parent::__construct($message, $code);
    }

}
