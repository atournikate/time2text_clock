<?php
include_once 'lang.json';
error_reporting(E_ERROR);


class Clock_Object {
    private $timeArray;
    private $lang;
    /**
     * CONSTANTS
     */

    //LANGUAGE
    const LANG_DEFAULT      =   'en';
    const LANG_DE           =   'de';
    const LANG_TR           =   'tr';
    const LANG_JP           =   'jp';

    const ROW_NUM          =   10;
    const COL_NUM          =   11;


    public function __construct(string $langSelected = self::LANG_DEFAULT, string|array $time = null) {
        if (!$time) {
            $this->time = date("H:i");
        } else {
            $this->time = $time;
        }
        $this->lang = $langSelected;
    }

    public function getJSON2PHP($lang = null) {
        $json = file_get_contents('lang.json');
        $ret = json_decode($json, true);
        print_r($ret);
    }

    /**
     * TIME TO TEXT FUNCTIONALITY
     */
    /**
     * set timezone - default Zürich
     * @param string $timezone
     * @return bool
     */
    private function setCurrentTimeZone(string $timezone = "Europe/Zurich") {
        return date_default_timezone_set($timezone);
    }

    /**
     * get string time - 24-Hour format
     * @return string
     */
    private function now() {
        $this->setCurrentTimeZone();
        return $this->time;
    }

    /**
     * get the hour (int) from "H:i"
     * @param string $time
     * @return mixed
     */
    private function getHourFromString(string $time) {
        preg_match('/(\d*)(?=:)/', $time, $hour);
        return $hour[0];
    }

    /**
     * get minutes (int) from "H:i"
     * @param string $time
     * @return mixed
     */
    private function getMinutesFromString(string $time) {
        preg_match('/(?<=:)(\d*)/', $time, $minutes );
        return $minutes[0];
    }

    /**
     * get the 12-hour increment (int) from time entered (or current time)
     * @param string|null $time
     * @return float
     */
     private function get12HourIncrement (string $time = null) {
        if (!$time) {
            $time    =   $this->now();
        }
        $hour = $this->getHourFromString($time);
        $ret = $this->convertHourTo12HrIncrement($hour);
        return $ret;
    }

    /**
     * get the minutes rounded down to 5-min intervals (int) from time entered (or current time)
     * @param string|null $time
     * @return float|int|string
     */
    private function get5MinuteInterval (string $time = null) {
        if (!$time) {
            $time        = $this->now();
        }
        $minutes = $this->getMinutesFromString($time);
        $ret = $this->roundDown5MinuteIntervals($minutes);
        return $ret;
    }

    /**
     * mathematically round the minutes down to nearest 5-min interval
     * this will always round down - the clock will never run fast, but may appear to run slow...
     * @param int $minutes
     * @return float|int|string
     */
    private function roundDown5MinuteIntervals(int $minutes) {
        $minuteInterval = 5;
        $minutesFormatted = floor($minutes/$minuteInterval) * $minuteInterval;
        if ($minutesFormatted < 10) {
            return '0' . $minutesFormatted;
        } else {
            return $minutesFormatted;
        }
    }

    /**
     * get 12-hour increment from 24-hour increment
     * @param int $hour
     * @return float|int
     */
    private function convertHourTo12HrIncrement(int $hour) {
        if ($hour <= 12) {
            return $hour;
        } else {
            return (round($hour - 12));
        }
    }

    /**
     * get AM/PM from time entered (or current time)
     * @param string|null $time
     * @return string
     */
    private function getMeridian(string $time = null) {
        if (!$time) {
            $time    =   $this->now();
        }
        $hour = $this->getHourFromString($time);
        if ($hour < 12) {
            $meridian = 'am';
        } else {
            $meridian = 'pm';
        }
        return $meridian;
    }

    /**
     * format time array
     * @return array
     */
    private function formatTime() {
        $arr = $this->timeArray;
        $formattedArr = [];
        foreach ($arr as $element) {
            $hour       =   $this->get12HourIncrement($element);
            $minutes    =   $this->get5MinuteInterval($element);
            $meridian   =   $this->getMeridian($element);
            $formattedArr[] = [$hour, $minutes, $meridian];
        }
        return $formattedArr;
    }

    /**
     * get the hour index based on hour and language
     * @param $hour
     * @param $minutes
     * @param $lang
     * @return int
     */
    private function getHourIndex($hour, $minutes, $lang) {
        $index = $hour - 1;

        if ($lang == self::LANG_DE) {
            if ($minutes >= 30) {
                $index += 1;
            }
        } elseif ($lang == self::LANG_DEFAULT) {
            if ($minutes > 30) {
                $index += 1;
            }
        }

        if ( $index < 0 ) {
            $index == 11;
        }
        if ( $index > 11) {
            $index == 0;
        }
        return $index;
    }

    /**
     * get minute index based on minutes entered
     * note: minutes must have already been converted to a 5-minute increment
     * @param $minutes
     * @return float|int
     */
    private function getMinuteIndex($minutes) {
        return $minutes / 5;
    }

    /**
     * get the text from time elements based on language
     * @param $minutes
     * @param $hour
     * @param $meridian
     * @param string $lang
     * @return void
     */
    private function getTime2Text($minutes, $hour, $meridian, $lang = Clock_Object::LANG_DEFAULT) {
        $timeStringArray    =   $this->timeStringArray[$lang];
        $hourIndex          =   $this->getHourIndex($hour, $minutes, $lang);
        $minuteIndex        =   $this->getMinuteIndex($minutes);

        $textHour           =   $timeStringArray['hour'];
        $textMinutes        =   $timeStringArray['minutes'];
        $textPre            =   $timeStringArray['pre'];

        if ($minutes != 00) {
            $textSuffix     =   '';
        } else {
            $textSuffix     =   $timeStringArray['suffix'];
        }

        return $textPre . " " . $textMinutes[$minuteIndex] . " " . $textHour[$hourIndex] . " " . $textSuffix . " " . $meridian;
    }

    /**
     * print out formatted results of times in timeArray
     * @param string $lang
     * @return void
     */
    public function startClock(string $lang = self::LANG_DEFAULT) {
        $formattedArr = $this->formatTime();
        $num = count($formattedArr);
        for ($i = 0; $i < $num; $i++) {
            $hour       = $formattedArr[$i][0];
            $minutes    = $formattedArr[$i][1];
            $meridian   = $formattedArr[$i][2];
            $text = $this->getTime2Text($minutes, $hour, $meridian, $lang);

            print_r(strtoupper($lang) . " " . $hour . ":" . $minutes . " - " . "$text" . PHP_EOL );
        }
    }

    /**
     * ELEMENTS - FUNCTIONS
     */

    private function setBlockActive() {
        if (!$this->isBlockActive()) {
            echo 'active';
        } else {
            echo '';
        }
    }
    private function isBlockActive() {

    }

    private function checkTime2Text($time = null) {
        if (!$time) {
            $time = $this->now();
        }

    }
    private function resetBlock() {
        //block is active, remove 'active' from class
    }

    /**
     * get words and filler for clock as array
     * @param $stringSet
     * @return array
     */
    public function getClockFaceArray($lang = Clock_Object::LANG_DEFAULT) {
        $stringValue    = '';
        $classArr       = [];
        foreach ($this->elementArray[$lang] as $element) {
            $length     = strlen($element[0]);
            for ($j = 0; $j < $length; $j++) {
                $classArr[] = $element['class'];
            }
            $stringValue .= $element[0];
        }
        $letterArr = str_split($stringValue);
        $num = count($letterArr);
        $newArr = [];
        for ($i = 0; $i < $num; $i++) {
            $newArr[] = [$letterArr[$i], $classArr[$i]];
        }
        return $newArr;
    }

    private function getClockText() {

    }

    /**
     * build table from clockFaceArray
     * @return string
     */
    public function buildClock($lang = Clock_Object::LANG_DEFAULT) {
        $arr = $this->getClockFaceArray($lang);

        $table = '<table>';


        $length = count($arr);
        $i = 0;

        foreach ($arr as $key => $block) {
            $id         =   $key;
            $element    =   $block[0];
            $class      =   $block[1];

            // if $i is divisible by 11
            if($i % Clock_Object::COL_NUM == 0) {
                $table .= '<tr><td><div class="block ' . $class . '">' . $element . '</div></td>';
            } else {
                if ($lang == 'en' && $key == 104) {
                    $table .= '<td><div class="block ' . $class . '">' . $element . "'" . '</div></td>';
                } else {
                    $table .= '<td><div class="block ' . $class . '">' . $element . '</div></td>';
                }
            }
            $i++;
        }
        $table .= '</tr></table';
        return $table;
    }

}