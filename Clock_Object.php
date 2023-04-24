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

    public function __construct( $time = null, string $langSelected = self::LANG_DEFAULT) {
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
     * @return array|string|null
     */
    public function startClock() {
        $time = $this->getFormattedTime();

        $count = count($time);
        if ($count > 3) {
            $ret = [];
            $num = count($time);
            for ($i = 0; $i < $num; $i++) {
               $ret[] = $this->getTime2Text($time[$i]);
            }
        } else {
            $ret = $this->getTime2Text($time);
        }
        return $ret;
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
     * @param $time
     * @return string
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

        $string = $this->getStringSwitchCase($minutes, $text, $suff);

        // adjust time after the half hour
        if ($this->lang == self::LANG_DE) {
            if ($minutes >= 30) {
                $hour   += 1;
                $minutes = 60 - $minutes;
            }
        } elseif ($this->lang == self::LANG_DEFAULT || $this->lang == self::LANG_TR) {
            if ($minutes > 30) {
                $hour   += 1;
                $minutes = 60 - $minutes;
            }
        }

        $ret = $this->getTimeString($numbers[$hour], $numbers[intval($minutes)], $string);

        return $ret;
    }

    /**
     * get string switch case (with language conditional)
     * @param $minutes
     * @param $text
     * @param $suff
     * @return mixed
     */
    private function getStringSwitchCase ($minutes, $text, $suff) {
        $lang = $this->lang;
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

        if ($lang == self::LANG_DE) {
            switch ($minutes) {
                case 25:
                    $string = $text['FIVE_TO_HALF'];
                    break;
                case 35:
                    $string = $text['FIVE_PAST_HALF'];
            }
        }

        return $string;
    }

    /**
     * Replace template with text elements
     * @param $hour
     * @param $minutes
     * @param $string
     * @return string
     */
    private function getTimeString($hour, $minutes, $string) {
        $text  = str_replace('{MINUTES}', $minutes, $string);
        $ret   = str_replace('{HOUR}', $hour, $text);
        return strtoupper($ret);
    }


    /**
     * ELEMENTS - FUNCTIONS
     */

    public function getClockFaceArray() {
        $data = $this->time2text;
        $rows = $data['clockRows'];
        return $rows;
    }

    public function getClockFaceString()
    {
        $arr = $this->getClockFaceArray();
        $string = '';
        foreach ($arr as $row) {
            $string .= $row;
        }
        return $string;
    }

    public function getElementClass() {
        $time = $this->startClock();
        $wordArr = explode(' ', $time);
        $wordArr[] = strtoupper($this->getMeridian());
        $rowString = $this->getClockFaceString();

        $elementArr = str_split($rowString);
        $num = count($wordArr);

        for ($i = 0; $i < $num; $i++) {
            preg_match('/('. $wordArr[$i] . ')/', $rowString, $matches, PREG_OFFSET_CAPTURE);
            $length = strlen($wordArr[$i]);
            $start = $matches[0][1];

            $end = $start + $length;
            for ($j = $start; $j < $end; $j++) {
                foreach ($elementArr as $key => $value) {
                    if ($key == $j) {
                        $elementArr[$key] = [$value, 'active'];
                    }
                }
            }
        }

        return $elementArr;
    }


    /**
     * build table from clockFaceArray
     * @return string
     */
    public function buildClock() {
        $element = $this->getElementClass();

        $table = '<table>';

        foreach ($element as $block) {
            $element = $block[0];
            $class = $block[1];

                if($i % Clock_Object::COL_NUM == 0) {
                    $table .= '<tr><td><div class="block ' . $class . '">' . $element . '</div></td>';
                } else {
                    /*if () {
                        $table .= '<td><div class="block ' . $class . '">' . $element . "'" . '</div></td>';
                    } else {*/
                        $table .= '<td><div class="block ' . $class . '">' . $element . '</div></td>';
                   //}
                }
                $i++;

            // if $i is divisible by 11

        }
        $table .= '</tr></table';
        return $table;
    }

}