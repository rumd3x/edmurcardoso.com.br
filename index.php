<?php
require __DIR__.'/vendor/autoload.php';
use EasyRest\System\Core;

$core = new Core();
$core->prepare()->start();
