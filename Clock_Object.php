<?php
error_reporting(E_ERROR);

/**
 *
 */
class Clock_Object {

     const CLOCK_TEXT_EN = 'ITLISAKAMPMACQUARTERDCTWENTYFIVEXHALFSTENFTOPASTERUNINEONESIXTHREEFOURFIVETWOEIGHTELEVENSEVENTWELVETENSEOCLOCK';

    /*const CLOCK_TEXT_DE = 'ESKISTAFÜNFZEHNZWANZIGDREIVIERTELVORFUNKNACHHALBAELFÜNFEINSXAMZWEIDREIPMJVIERSECHSNLACHTSIEBENZWÖLFZEHNEUNKUHR';*/

    public function getTimeArray($lang = 'en') {
        $blockArray = [];
        $blockArray['en'] = [
            'elementArr'    =>  str_split(self::CLOCK_TEXT_EN),
        ];
    }

    /**
     * get string time formatted
     * @return string
     */
    public function now() {
        $this->setCurrentTimeZone();
        return date("h:i a");
    }

    /**
     * set timezone - default Zürich
     * @param string $timezone
     * @return bool
     */
    function setCurrentTimeZone(string $timezone = "Europe/Zurich") {
        return date_default_timezone_set($timezone);
    }

    /**
     * @param $minuteInterval
     * @return string
     */
    public function roundDown5MinuteInterval($minuteInterval = 5) {
        $now = strtotime($this->now());
        return date('i', floor($now / ($minuteInterval * 60)) * ($minuteInterval * 60));
    }

    /**
     * @return string
     */
    function get12HourIncrement() {
        $this->setCurrentTime();
        return date("h");
    }

    /**
     * @return string
     */
    function get24HoursIncrement() {
        $this->setCurrentTime();
        return date("H");
    }

    /**
     * @return string
     */
    function getMinutes() {
        $this->setCurrentTime();
        return date("i");
    }

    /**
     * @return string
     */
    function getDayNight() {
        $this->setCurrentTime();
        return date("a");
    }

    /*
     * ELEMENTS - FUNCTIONS
     */

    /**
     * @param $stringSet
     * @return array
     */
    public function getClockFaceArray($stringSet = self::CLOCK_TEXT_EN) {
        $arr = str_split($stringSet);
        return $arr;
    }


    /**
     * @return array
     */
    public function getFormattedBlocks($arr) {
        $elements = [];
        foreach ($arr as $element) {
            $block = '<div class="block ">';
            $block .= $element;
            $block .= '</div>';
            $element[] = $block;
        }
        return $elements;
    }

    /**
     * @return void
     */
    public function renderClockFace() {
        //get blocks and create 10 rows of 11 blocks
    }

    /**
     * @return void
     */
    public function setBlockActive() {
        //set block class as active
    }

    /**
     * @return void
     */
    public function isBlockActive() {
        //bool check if block class is marked as active
    }

    /**
     * @return void
     */
    public function resetBlock() {
        //block is active, remove 'active' from class
    }

    /**
     * @param $formattedTime
     * @return void
     */
    public function getMinutesTime2Text($formattedTime ) {
        //switch case for minutes
    }

    /**
     * @param $formattedTime
     * @return void
     */
    public function getHourTime2Text ($formattedTime) {

    }

    /**
     * @return void
     */
    function startClock() {
        //print_r($this->roundDown5MinuteInterval());
        print_r($this->getClockFaceArray());
    }

}