<?php

const D = DIRECTORY_SEPARATOR;
const DOC = __DIR__ . D;
require DOC . '..' . D . 'autoload.php';
app\Fw::run();
