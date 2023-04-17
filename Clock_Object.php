<?php
error_reporting(E_ERROR);

class Clock_Object {
    private $timeArray;

    const LANG_DEFAULT     =   'en';
    const LANG_DE          =   'de';

    const ROW_NUM          =   10;
    const COL_NUM          =   11;

    private $timeStringArray = [
        self::LANG_DEFAULT  => [
            'hour'          => [
                'one',
                'two',
                'three',
                'four',
                'five',
                'six',
                'seven',
                'eight',
                'nine',
                'ten',
                'eleven',
                'twelve'
            ],
            'minutes'       => [
                "o'clock",
                'five past',
                'ten past',
                'a quarter past',
                'twenty past',
                'twenty five past',
                'half past',
                'twenty five to',
                'twenty to',
                'a quarter to',
                'ten to',
                'five to'
            ]
        ],
        self::LANG_DE       => [
            'hour'          => [
                'eins',
                'zwei',
                'drei',
                'vier',
                'fünf',
                'sechs',
                'sieben',
                'acht',
                'neun',
                'zehn',
                'elf',
                'zwölf'
            ],
            'minutes'       => [
                'uhr',
                'fünf nach',
                'zehn nach',
                'viertel nach',
                'zwanzig nach',
                'halb',
                'zwanzig vor',
                'viertel vor',
                'zehn vor',
                'fünf vor'
            ]
        ],
    ];

    public function __construct(array $timeArray) {
        $this->timeArray = $timeArray;
    }

    /**
     * get words and filler for clock as array
     * @param $stringSet
     * @return array
     */
    public function getClockFaceArray($lang = self::LANG_DEFAULT) {
        $stringValue = '';
        foreach ($this->timeArray as $element) {
            $stringValue .= $element[0];
        }
        $arr = str_split($stringValue);
        return $arr;
    }

    /**
     * build table from clockFaceArray
     * @return string
     */
    public function buildClock() {
        $arr = $this->getClockFaceArray();

        $table = '<table>';
        $lang = '';
        if (!$lang) {
            $lang   = 'en';
        }
        $length = count($arr);
        $i = 0;

        foreach ($arr as $key => $block) {
            $id = $key;
            $element =  $block;

            // if $i is divisible by 11
            if($i % self::COL_NUM == 0) {
                $table .= '<tr><td><div class="block ">' . $element . '</div></td>';
            } else {
                if ($lang == 'en' && $key == 104) {
                    $table .= '<td><div class="block ">' . $element . "'" . '</div></td>';
                } else {
                    $table .= '<td><div class="block ">' . $element . '</div></td>';
                }

            }
            $i++;
        }
        $table .= '</tr></table';
        return $table;
    }

    /**
     * get string time formatted
     * @return string
     */
    private function now() {
        $this->setCurrentTimeZone();
        return date("h:i a");
    }

    /**
     * set timezone - default Zürich
     * @param string $timezone
     * @return bool
     */
    private function setCurrentTimeZone(string $timezone = "Europe/Zurich") {
        return date_default_timezone_set($timezone);
    }

    /**
     * @return string
     */
    private function get12HourIncrement() {
        $this->setCurrentTime();
        return date("h");
    }

    /**
     * @return string
     */
    private function get24HoursIncrement() {
        $this->setCurrentTime();
        return date("H");
    }

    /**
     * @return string
     */
    private function getMinutes() {
        $this->setCurrentTime();
        return date("i");
    }

    /**
     * @return string
     */
    private function getDayNight() {
        $this->setCurrentTime();
        return date("a");
    }

    private function getHourFromString($string) {
        preg_match('/(\d*)(?=:)/', $string, $hour);
        return $hour[0];
    }

    private function getMinutesFromString($string) {
        preg_match('/(?<=:)(\d*)/', $string, $minutes );
        return $minutes[0];
    }

    /*
     * ELEMENTS - FUNCTIONS
     */

    /**
     * @return void
     */
    private function setBlockActive() {
        //set block class as active
    }

    /**
     * @return void
     */
    private function isBlockActive() {
        //bool check if block class is marked as active
    }

    /**
     * @return void
     */
    private function resetBlock() {
        //block is active, remove 'active' from class
    }

    /**
     * @param $formattedTime
     * @return void
     */
    private function getMinutesTime2Text($formattedTime ) {
        //switch case for minutes
    }

    /**
     * @param $formattedTime
     * @return void
     */
    private function getHourTime2Text ($formattedTime) {

    }

    private function roundDown5MinuteIntervals($minutes) {
        $minuteInterval = 5;
        $minutesFormatted = floor($minutes/$minuteInterval) * $minuteInterval;
        if ($minutesFormatted < 10) {
            return '0' . $minutesFormatted;
        } else {
            return $minutesFormatted;
        }
    }

    private function convertHourTo12HrIncrement($hour) {
        if (intval($hour) <= 12) {
            return $hour;
        } else {
            return (round(intval($hour) - 12));
        }
    }

    private function formatTime() {
        $arr = $this->timeArray;
        $formattedArr = [];
        foreach ($arr as $element) {
            $hourRaw    =   $this->getHourFromString($element);
            $minutesRaw =   $this->getMinutesFromString($element);
            $hour       =   $this->convertHourTo12HrIncrement($hourRaw);
            $minutes    =   $this->roundDown5MinuteIntervals($minutesRaw);
            $formattedArr[] = "$hour:$minutes";
        }
        return $formattedArr;
    }



    public function startClock() {
        print_r($this->formatTime());
    }


    /**
     * @param $minuteInterval
     * @return string
     */
    private function defunctRoundDown($minuteInterval = 5) {
        $now = strtotime($this->now());
        return date('i', floor($now / ($minuteInterval * 60)) * ($minuteInterval * 60));
    }


}