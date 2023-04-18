<?php
error_reporting(E_ERROR);

class Clock_Object extends DateTime {
    private $timeArray;

    const LANG_DEFAULT     =   'en';
    const LANG_DE          =   'de';

    const ROW_NUM          =   10;
    const COL_NUM          =   11;

    public $timeStringArray = [
        Clock_Object::LANG_DEFAULT  => [
            'pre'           => 'it is',
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
                '',
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
            ],
            'suffix'        => 'o clock'
        ],
        Clock_Object::LANG_DE       => [
            'pre'           => 'es ist',
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
                '',
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
            ],
            'suffix'        => 'uhr'
        ],
    ];

    public function __construct(array $timeArray) {
        $this->timeArray = $timeArray;
    }

    /**
     * TIME TO TEXT FUNCTIONALITY
     */
    /**
     * set timezone - default Zürich
     * @param string $timezone
     * @return bool
     */
    private function setCurrentTimeZone( $timezone = "Europe/Zurich") {
        return date_default_timezone_set($timezone);
    }

    /**
     * get string time formatted
     * @return string
     */
    private function now() {
        $this->setCurrentTimeZone();
        return date("H:i");
    }

    private function getHourFromString($string) {
        preg_match('/(\d*)(?=:)/', $string, $hour);
        return $hour[0];
    }

    private function getMinutesFromString($string) {
        preg_match('/(?<=:)(\d*)/', $string, $minutes );
        return $minutes[0];
    }

    /**
     * @param $formattedTime
     * @return void
     */
    private function getHourTime2Text ($time = null) {
        if (!$time) {
            $time    =   $this->now();
        }
        $hour = $this->getHourFromString($time);
        $ret = $this->convertHourTo12HrIncrement($hour);
        return $ret;
    }

    private function getMinutesTime2Text ($time = null) {
        if (!$time) {
            $time        = $this->now();
        }
        $minutes = $this->getMinutesFromString($time);
        $ret = $this->roundDown5MinuteIntervals($minutes);
        return $ret;
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

    private function getMeridian($time = null) {
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

    private function formatTime() {
        $arr = $this->timeArray;
        $formattedArr = [];
        foreach ($arr as $element) {
            $hour       =   $this->getHourTime2Text($element);
            $minutes    =   $this->getMinutesTime2Text($element);
            $meridian   =   $this->getMeridian($element);
            $formattedArr[] = [$hour, $minutes, $meridian];
        }
        return $formattedArr;
    }

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

    private function getMinuteIndex($minutes) {
        return $minutes / 5;
    }

    /**
     * @param $formattedTime
     * @return void
     */
    private function getTime2Text($minutes, $hour, $meridian, $lang = Clock_Object::LANG_DEFAULT) {
        $timeStringArray    =   $this->timeStringArray[$lang];
        $hourIndex          =   $this->getHourIndex($hour, $minutes, $lang);
        $minuteIndex        =   $this->getMinuteIndex($minutes);

        $textHour           =   $timeStringArray['hour'];
        $textMinutes        =   $timeStringArray['minutes'];
        $textPre            =   $timeStringArray['pre'];
        $textSuffix         =   $timeStringArray['suffix'];

        switch ($minutes) {
            case 0:
                return  $textPre . " " . $textHour[$hourIndex] . " " . $textMinutes[$minuteIndex] . " " . $textSuffix . " " . $meridian;
                break;
            default:
                return $textPre . " " . $textMinutes[$minuteIndex] . " " . $textHour[$hourIndex] . " " . $textSuffix . " " . $meridian;
                break;
        }
    }

    public function startClock($lang = self::LANG_DEFAULT) {
        $formattedArr = $this->formatTime();
        $num = count($formattedArr);
        for ($i = 0; $i < $num; $i++) {
            $hour       = $formattedArr[$i][0];
            $minutes    = $formattedArr[$i][1];
            $meridian   = $formattedArr[$i][2];
            $text = $this->getTime2Text($minutes, $hour, $meridian, $lang);

            print_r(strtoupper($lang) . " - " . $hour . " - " . $minutes . " - " . " $text \n");
        }
    }



    /**
     * ELEMENTS - FUNCTIONS
     */
    private function setBlockActive() {
        //set block class as active
    }
    private function isBlockActive() {
        //bool check if block class is marked as active
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

}