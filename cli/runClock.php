<?php
include_once '../Clock_Object.php';

class runClock {
    function run() {

        $testTimes = [
            '23:03',
            '23:08',
            '23:12',
            '23:16',
            '23:21',
            '23:28',
            '23:32',
            '23:36',
            '23:40',
            '23:47',
            '23:54',
            '23:59',
        ];
        $clock = new Clock_Object($testTimes);

        $clock->startClock();
        $clock->startClock(Clock_Object::LANG_DE);
    }
}

$try = new runClock();
$try->run();