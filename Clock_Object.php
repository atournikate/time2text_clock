<?php
error_reporting(E_ERROR);

class Clock_Object {
    private $timeArray;

    const LANG_DEFAULT     =   'en';
    const LANG_DE          =   'de';

    const ROW_NUM          =   10;
    const COL_NUM          =   11;

    public $timeStringArray = [
        Clock_Object::LANG_DEFAULT  => [
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
        Clock_Object::LANG_DE       => [
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
                'zwanzig nach',
                'halb',
                'zwanzig vor',
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
    public function getClockFaceArray($lang = Clock_Object::LANG_DEFAULT) {
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
            if($i % Clock_Object::COL_NUM == 0) {
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
            $formattedArr[] = [$hour, $minutes];
        }
        return $formattedArr;
    }

    /**
     * @param $formattedTime
     * @return void
     */
    private function getTime2Text($minutes, $hour, $lang = Clock_Object::LANG_DEFAULT) {
        $timeArrayMinutes   = $this->timeStringArray[$lang]['minutes'];
        $timeArrayHour      = $this->timeStringArray[$lang]['hour'];

        $hour = $hour - 1;
        if ( $hour < 0 ) {
            $hour == 11;
        }
        if ( $hour > 11) {
            $hour == 0;
        }

        if ($lang == self::LANG_DE) {
            if ($minutes >= 30) {
                $hour += 1;
            }
        } elseif ($lang == self::LANG_DEFAULT) {
            if ($minutes > 30) {
                $hour += 1;
            }
        }

        switch ($minutes) {
            case 0:
                $ret = $timeArrayHour[$hour] . " " . $timeArrayMinutes[0];
                return  $ret;
                break;
            case 5:
                $ret = $timeArrayMinutes[1] . " " . $timeArrayHour[$hour];
                return $ret;
                break;
            case 10:
                $ret = $timeArrayMinutes[2] . " " . $timeArrayHour[$hour];
                return $ret;
                break;
            case 15:
                $ret = $timeArrayMinutes[3] . " " . $timeArrayHour[$hour];
                return $ret;
                break;
            case 20:
                $ret = $timeArrayMinutes[4] . " " . $timeArrayHour[$hour];
                return $ret;
                break;
            case 25:
                $ret = $timeArrayMinutes[5] . " " . $timeArrayHour[$hour];
                return $ret;
                break;
            case 30:
                if ($lang == self::LANG_DE) {
                    $ret = $timeArrayMinutes[6] . " " . $timeArrayHour[$hour];
                } else {
                    $ret = $timeArrayMinutes[6] . " " . $timeArrayHour[$hour];
                }
                return $ret;
                break;
            case 35:
                if ($lang == self::LANG_DE) {
                    $ret = $timeArrayMinutes[7] . " " . $timeArrayHour[$hour];
                } else {
                    $ret = $timeArrayMinutes[7] . " " . $timeArrayHour[$hour];
                }
                return $ret;
                break;
            case 40:
                if ($lang == self::LANG_DE) {
                    $ret = $timeArrayMinutes[8] . " " . $timeArrayHour[$hour];
                } else {
                    $ret = $timeArrayMinutes[8] . " " . $timeArrayHour[$hour];
                }
                return $ret;
                break;
            case 45:
                if ($lang == self::LANG_DE) {
                    $ret = $timeArrayMinutes[9] . " " . $timeArrayHour[$hour];
                } else {
                    $ret = $timeArrayMinutes[9] . " " . $timeArrayHour[$hour];
                }
                return $ret;
                break;
            case 50:
                if ($lang == self::LANG_DE) {
                    $ret = $timeArrayMinutes[10] . " " . $timeArrayHour[$hour];
                } else {
                    $ret = $timeArrayMinutes[10] . " " . $timeArrayHour[$hour];
                }
                return $ret;
                break;
            case 55:
                if ($lang == self::LANG_DE) {
                    $ret = $timeArrayMinutes[11] . " " . $timeArrayHour[$hour];
                } else {
                    $ret = $timeArrayMinutes[11] . " " . $timeArrayHour[$hour];
                }
                return $ret;
                break;
            default:
                return "Kate did something wrong here";
                break;
        }
    }



    public function startClock($lang = self::LANG_DEFAULT) {
        //print_r($this->formatTime());
        $formattedArr = $this->formatTime();
        $num = count($formattedArr);
        for ($i = 0; $i < $num; $i++) {
            $hour       = $formattedArr[$i][0];
            $minutes    = $formattedArr[$i][1];
            $text = $this->getTime2Text($minutes, $hour, $lang);

            print_r(strtoupper($lang) . " - " . $hour . " - " . $minutes . " - " . " $text \n");

        }


        
    }

    /**
     * May no longer be needed
     */

    /**
     * @param $minuteInterval
     * @return string
     */
    private function defunctRoundDown($minuteInterval = 5) {
        $now = strtotime($this->now());
        return date('i', floor($now / ($minuteInterval * 60)) * ($minuteInterval * 60));
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
    private function setCurrentTimeZone( $timezone = "Europe/Zurich") {
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


}