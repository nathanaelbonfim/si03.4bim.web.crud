<?php
require_once __DIR__ . '/bootstrap.php';

use PHPhademic\Lib\Debug;
use PHPhademic\Lib\Env;

Debug::dd(Env::get('NAME', 'John Doe'));