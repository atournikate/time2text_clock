<?php
include_once '../Clock_Object.php';

class runClock {
    function run() {
        $clock = new Clock_Object();

        $clock->startClock();
    }
}

$try = new runClock();
$try->run();