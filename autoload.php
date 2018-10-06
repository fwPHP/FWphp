<?php

spl_autoload_register(function($class) {
    require __DIR__ . D . str_replace('\\', D, $class) . '.php';
}, true);
