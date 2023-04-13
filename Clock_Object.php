<?php
error_reporting(E_ERROR);

class Clock_Object {

    const CLOCK_TEXT_EN = 'ITLISAKAMPMACQUARTERDCTWENTYFIVEXHALFSTENFTOPASTERUNINEONESIXTHREEFOURFIVETWOEIGHTELEVENSEVENTWELVETENSEOCLOCK';

    /*const CLOCK_TEXT_DE = 'ESKISTAFÜNFZEHNZWANZIGDREIVIERTELVORFUNKNACHHALBAELFÜNFEINSXAMZWEIDREIPMJVIERSECHSNLACHTSIEBENZWÖLFZEHNEUNKUHR';*/

    /*
     * TIME - FUNCTIONS
     */

    public function now() {
        $this->setCurrentTimeZone();
        return date("h:i a");
    }

    function setCurrentTimeZone($timezone = "Europe/Zurich") {
        return date_default_timezone_set($timezone);
    }

    public function roundDown5MinuteInterval($minuteInterval = 5) {
        $now = strtotime($this->now());
        return date('i', floor($now / ($minuteInterval * 60)) * ($minuteInterval * 60));
    }

    function get12HourIncrement() {
        $this->setCurrentTime();
        return date("h");
    }

    function get24HoursIncrement() {
        $this->setCurrentTime();
        return date("H");
    }

    function getMinutes() {
        $this->setCurrentTime();
        return date("i");
    }

    function getDayNight() {
        $this->setCurrentTime();
        return date("a");
    }

    /*
     * ELEMENTS - FUNCTIONS
     */

    public function getClockFaceArray($stringSet = self::CLOCK_TEXT_EN) {
        $arr = str_split($stringSet);
        return $arr;
    }

    /*
     *
     */
    public function getElementBlocks() {
        $arr = $this->getClockFaceArray();
        $elements = [];
        foreach ($arr as $element) {
            $block = '<div class="block ">';
            $block .= $element;
            $block .= '</div>';
            $element[] = $block;
        }
        return $elements;
    }

    public function renderClockFace() {
        //get blocks and create 10 rows of 11 blocks
    }

    public function setBlockActive() {
        //set block class as active
    }

    public function isBlockActive() {
        //bool check if block class is marked as active
    }

    public function resetBlock() {
        //block is active, remove 'active' from class
    }

    public function getMinutesTime2Text( $formattedTime ) {
        //switch case for
    }

    function startClock() {
        //print_r($this->roundDown5MinuteInterval());
        print_r($this->getClockFaceArray());
    }

}