<?php
include_once '../Clock_Object.php';

class runClock {
    function run() {

        $testTimes = [
            '11:03',
            '23:08',
            '11:12',
            '23:16',
            '11:21',
            '23:28',
            '11:32',
            '23:36',
            '11:40',
            '23:47',
            '11:54',
            '23:59',
        ];
        $clock = new Clock_Object($testTimes);
        $clock->startClock();
        $clock->startClock(Clock_Object::LANG_DE);
    }
}

$try = new runClock();
$try->run();