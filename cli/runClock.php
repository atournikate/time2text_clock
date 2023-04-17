<?php
include_once '../Clock_Object.php';

class runClock {
    function run() {

        $testTimes = [
            '13:03',
            '14:08',
            '15:12',
            '16:16',
            '17:21',
            '18:28',
            '7:32',
            '8:36',
            '9:40',
            '10:47',
            '11:54',
            '12:59',
        ];
        $clock = new Clock_Object($testTimes);

        $clock->startClock();
    }
}

$try = new runClock();
$try->run();