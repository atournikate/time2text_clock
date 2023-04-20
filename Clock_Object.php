<?php
error_reporting(E_ERROR);

class Clock_Object {
    /**
     * CONSTANTS
     */

    //LANGUAGE
    const ROOT              = '/Users/kebensteiner/Sites/wall-clock/';

    const LANG_DEFAULT      =   'en';
    const LANG_DE           =   'de';
    const LANG_TR           =   'tr';
    const LANG_JP           =   'jp';

    const ROW_NUM           =   10;
    const COL_NUM           =   11;

    public function __construct( string|array $time = null, string $langSelected = self::LANG_DEFAULT) {
        if (!$time) {
            $this->time = $this->now();
        } else {
            $this->time = $time;
        }
        $this->lang = $langSelected;
        $this->time2text  = $this->getJSON2PHP();
    }

    /**
     * convert json data to array, return array of selected language
     * @return mixed
     */
    private function getJSON2PHP() {
        $lang       = $this->lang;
        $filePath   = self::ROOT . 'lang.json';
        $file       = file_get_contents($filePath);
        $ret        = json_decode($file, true);
        return $ret[$lang];
    }

    /**
     * test CLI Clock
     * @param string $lang
     * @return void
     */
    public function startClock() {
        $time = $this->getFormattedTime();
        /*print_r($time);*/
        $num = count($time);
        for ($i = 0; $i < $num; $i++) {
            $this->getTime2Text($time[$i]);
        }

        exit;
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
        return date("H:i");
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
     * format time string
     * @param $time
     * @return array
     */
    private function formatTimeString($time) {
         $arr        =   [
            //'24hour'    => $this->getHourFromString($time),
            'hour'      => $this->get12HourIncrement($time),
            'minutes'   => $this->get5MinuteInterval($time),
            'meridian'  =>  $this->getMeridian($time)
        ];
        return $arr;
    }

    /**
     * format time array
     * @return array
     */
    private function formatTimeArray($time) {
        $formattedArr = [];
        foreach ($time as $element) {
            if (empty($element)) {
                $element = $this->now();
            }
            $formatted      = $this->formatTimeString($element);
            $formattedArr[] = $formatted;
        }
        return $formattedArr;
    }

    /**
     * get time as formatted array
     * @return array
     */
    private function getFormattedTime() {
        $time = $this->time;
        if (is_string($time)) {
            $formattedTime  = $this->formatTimeString($time);
        } else {
            $formattedTime  = $this->formatTimeArray($time);
        }
        return $formattedTime;
    }

    /**
     * get the text from time elements based on language
     * @param $minutes
     * @param $hour
     * @param $meridian
     * @param string $lang
     * @return void
     */
    private function getTime2Text($time) {
        //get elements from time
        $hour       = $time['hour'];
        $minutes    = $time['minutes'];
        $meridian   = strtoupper($time['meridian']);

        // get json data
        $data       = $this->time2text;
        // get time strings and numbers
        $text       = $data['text'];
        $numbers    = $data['numbers'];

        if ($minutes < 30) {
            $suff = "PAST";
        } else {
            $suff = "TO";
        }

        switch ($minutes) {
            case 00:
                $string = $text['FULL'];
                break;
            case 15:
                $string = $text['QUARTER_PAST'];
                break;
            case 30:
                $string = $text['HALF_PAST'];
                break;
            case 45:
                $string = $text['QUARTER_TO'];
                break;
            default:
                $string = $text['MINUTES_' . $suff];
                break;
        }

        // adjust time after the half hour
        if ($this->lang == self::LANG_DEFAULT) {
            if ($minutes > 30) {
                $hour   += 1;
                $minutes = 60 - $minutes;
            }
        }


        $ret = $this->getTimeString($numbers[$hour], $numbers[intval($minutes)], $string) . " " . $meridian;

        print_r ( $time['hour'] . ":" . $time['minutes'] . ": " . $ret . PHP_EOL);

    }

    private function getTimeString($hour, $minutes, $string) {
        $text = str_replace('{HOUR}', $hour, $string);
        $ret  = str_replace('{MINUTES}', $minutes, $text);
        return strtoupper($ret);
    }
/*
    private function time2TextHour($hourText, $sentence) {
        return preg_replace( '{HOUR}', $hourText, $sentence);
    }

    private function time2TextMinutes($minuteText, $sentence) {
        return preg_replace('{MINUTES}', $minuteText, $sentence);
    }*/


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