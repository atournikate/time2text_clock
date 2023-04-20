<?php
include_once '../Clock_Object.php';

class runClock {
    function run() {
        $testTimes = [
            '',
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
        $clock = new Clock_Object();
        print_r($clock->startClock());

 /*       $clockDE = new Clock_Object($testTimes, Clock_Object::LANG_DE);
        $clockDE->startClock();*/

/*        $clockTR = new Clock_Object($testTimes, Clock_Object::LANG_TR);
        $clockTR->startClock();*/

/*        $clockJP = new Clock_Object($testTimes, Clock_Object::LANG_JP);
        $clockJP->startClock();*/

    }
}

$try = new runClock();
$try->run();