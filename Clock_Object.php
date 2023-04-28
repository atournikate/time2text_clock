<?php
error_reporting(E_ERROR);

class Clock_Object {
    private $time2Text;
    /**
     * CONSTANTS
     */

    //LANGUAGE
    const ROOT              = '/Users/kebensteiner/Sites/wall-clock/';

    const LANG_DEFAULT      =   'en';
    const LANG_DE           =   'de';
    const LANG_TR           =   'tr';
    const LANG_JA           =   'ja';

    const ROW_NUM           =   10;
    const COL_NUM           =   11;

    public function __construct( $time = null, string $langSelected = self::LANG_DEFAULT) {
        if (!$time) {
            $this->time = $this->now();
        } else {
            $this->time = $time;
        }
        $this->lang = $langSelected;
        //$this->time2Text  = $this->getTime2TextArray();
        $this->time2Text = $this->getJSON2PHP();
    }

    /*private function getTime2TextArray() {
        $time2Text =[
            'en' => [
                'text' => [
                    'FULL' => 'IT IS {HOUR} OCLOCK',
                    'MINUTES_PAST' => 'IT IS {MINUTES} PAST {HOUR}',
                    'HALF_PAST' => 'IT IS HALF PAST {HOUR}',
                    'QUARTER_PAST' => 'IT IS A QUARTER PAST {HOUR}',
                    'QUARTER_TO' => 'IT IS A QUARTER TO {HOUR}',
                    'MINUTES_TO' => 'IT IS {MINUTES} TO {HOUR}',
                ],
                'numbers' => [
                    '0' => 'TWELVE',
                    '1' => 'ONE',
                    '2' => 'TWO',
                    '3' => 'THREE',
                    '4' => 'FOUR',
                    '5' => 'FIVE',
                    '6' => 'SIX',
                    '7' => 'SEVEN',
                    '8' => 'EIGHT',
                    '9' => 'NINE',
                    '10' => 'TEN',
                    '11' => 'ELEVEN',
                    '12' => 'TWELVE',
                    '20' => 'TWENTY',
                    '25' => 'TWENTYFIVE',
                ],
                'clockRows' => [
                    '1' => 'ITLISJKAMPM',
                    '2' => 'ACQUARTERDC',
                    '3' => 'TWENTYFIVEX',
                    '4' => 'HALFSTENFTO',
                    '5' => 'PASTERUNINE',
                    '6' => 'ONESIXTHREE',
                    '7' => 'FOURFIVETWO',
                    '8' => 'EIGHTELEVEN',
                    '9' => 'SEVENTWELVE',
                    '10' => 'TENSEOCLOCK'
                ]
            ],
            'de' => [
                'text' => [
                    'FULL' => 'ES IST {HOUR} UHR',
                    'MINUTES_PAST' => 'ES IST {MINUTES} NACH {HOUR}',
                    'FIVE_TO_HALF' => 'ES IST FÜNF VOR HALB {HOUR}',
                    'HALF_PAST' => 'ES IST HALB {HOUR}',
                    'FIVE_PAST_HALF'    => 'ES IST FÜNF NACH HALB {HOUR}',
                    'QUARTER_PAST' => 'ES IST VIERTEL NACH {HOUR}',
                    'QUARTER_TO' => 'ES IST VIERTEL VOR {HOUR}',
                    'MINUTES_TO' => 'ES IST {MINUTES} VOR {HOUR}',
                ],
                'numbers' => [
                    '0' => 'ZWÖLF',
                    '1' => 'EINS',
                    '2' => 'ZWEI',
                    '3' => 'DREI',
                    '4' => 'VIER',
                    '5' => 'FÜNF',
                    '6' => 'SECHS',
                    '7' => 'SIEBEN',
                    '8' => 'ACHT',
                    '9' => 'NEUN',
                    '10' => 'ZEHN',
                    '11' => 'ELF',
                    '12' => 'ZWÖLF',
                    '20' => 'ZWANZIG'
                ],
                'clockRows' => [
                    '1' => 'ESKISTAFÜNF',
                    '2' => 'ZEHNZWANZIG',
                    '3' => 'DREIVIERTEL',
                    '4' => 'VORLSNKNACH',
                    '5' => 'HALBAELFÜNF',
                    '6' => 'EINSXAMZWEI',
                    '7' => 'DREIPMJVIER',
                    '8' => 'SECHSNLACHT',
                    '9' => 'SIEBENZWÖLF',
                    '10' => 'ZEHNEUNKUHR'
                ]
            ],
            'tr' => [
                'text' => [
                    'FULL' => 'SAAT {HOUR}',
                    'MINUTES_PAST' => 'SAAT {HOUR} {MINUTES} GEÇIYOR',
                    'HALF_PAST' => 'SAAT {HOUR} BUÇUKIT',
                    'QUARTER_PAST' => 'SAAT {HOUR} ÇEYREK GEÇIYOR',
                    'QUARTER_TO' => 'SAAT {HOUR} ÇEYREK VAR',
                    'MINUTES_TO' => 'SAAT {HOUR} {MINUTES} VAR',
                ],
                'numbers' => [
                    '0' => 'ON IKI',
                    '1' => 'BIR',
                    '2' => 'IKI',
                    '3' => 'ÜÇ',
                    '4' => 'DÖRT',
                    '5' => 'BEŞ',
                    '6' => 'ALTI',
                    '7' => 'YEDI',
                    '8' => 'SEKIZ',
                    '9' => 'DOKUZ',
                    '10' => 'ON',
                    '11' => 'ON BIR',
                    '12' => 'ON IKI',
                    '20' => 'YIRMI',
                    '25' => 'YIRMI BEŞ'
                ],
                'clockRows' => [
                    '1' => 'SAATXSABAHD',
                    '2' => 'AKŞAMNONJKL',
                    '3' => 'BIRUIKIYÜÇI',
                    '4' => 'DÖRTABEŞDIG',
                    '5' => 'ALTIVYEDIEF',
                    '6' => 'SEKIZHDOKUZ',
                    '7' => 'YIRMIPBEŞUD',
                    '8' => 'ZONYÇEYREKS',
                    '9' => 'VARMGBUÇUKL',
                    '10' => 'GEÇIYORCTBO'
                ]
            ],
            'ja' => [
                'text' => [
                    'FULL' => '今は{HOUR}時です',
                    'MINUTES_PAST' => '今は{HOUR}時{MINUTES}分です',
                    'HALF_PAST' => '今は{HOUR}時半です',
                    'QUARTER_PAST' => '今は{HOUR}時{MINUTES}分です',
                    'QUARTER_TO' => '今は{HOUR}時{MINUTES}分です',
                    'MINUTES_TO' => '今は{HOUR}時{MINUTES}分です',
                ],
                'numbers' => [
                    '0' => 'ON IKI',
                    '1' => '一',
                    '2' => '二',
                    '3' => '三',
                    '4' => '四',
                    '5' => '五',
                    '6' => '六',
                    '7' => '七',
                    '8' => '八',
                    '9' => '九',
                    '10' => '十',
                    '11' => '十一',
                    '12' => '十二',
                    '15' => '十五',
                    '20' => '二十',
                    '25' => '二十五',
                    '35' => '三十五',
                    '40' => '四十',
                    '45' => '四十五',
                    '50' => '五十',
                    '55' => '五十五'
                ],
                'clockRows' => [
                    '1' => '今花鳥風月は✿水に流す',
                    '2' => '十一二三四五六七八九時',
                    '3' => '一二三四五和陰陽平和十',
                    '4' => '一二三四五六七八九歌分',
                    '5' => '✿月に遠くおぼゆる藤の',
                    '6' => '色香かな✿光陰矢の如し',
                    '7' => '明日は明日の風が吹く✿',
                    '8' => '七転び八起き✿因果応報',
                    '9' => '涙午朝午夜✿急がば回れ',
                    '10' => '自業自得✿起死回生です'
                ]
            ]
        ];
        $lang = $this->lang;
        return $time2Text[$lang];
    }*/

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
        if ($count > 4) {
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
        } elseif ($hour >= 24) {
            $hour = 0;
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
    private function getMeridian(string $hour) {
        $lang = $this->lang;

        if ($hour < 12 || $hour == 24) {
            if ($lang == self::LANG_JA) {
                $meridian = '午朝';
            } else {
            $meridian = ' AM';
            }
        } else {
            if ($lang == self::LANG_JA) {
                $meridian = '午夜';
            } else {
            $meridian = ' PM';
            }
        }
        return $meridian;
    }

    /**
     * format time string
     * @param $time
     * @return array
     */
    private function formatTimeString($time) {
        $lang       = $this->lang;
        $hour       = $this->getHourFromString($time);
        $minutes    = $this->get5MinuteInterval($time);

        // adjust time after the half hour
        if ($lang == self::LANG_DE) {
            if ($minutes >= 30) {
                $hour   += 1;
                $minutesAdjusted = 60 - $minutes;
            }
        } elseif ($this->lang == self::LANG_DEFAULT || $this->lang == self::LANG_TR) {
            if ($minutes > 30) {
                $hour   += 1;
                $minutesAdjusted = 60 - $minutes;

            }
        }

        $hourAdjusted = $this->convertHourTo12HrIncrement($hour);
        $meridian = $this->getMeridian($hour);

        $arr        =   [
             'hour'                 =>  $hourAdjusted,
             'minutes'              =>  $minutes,
             'minutes_adjusted'     =>  $minutesAdjusted,
             'meridian'             =>  $meridian
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
        $meridian   = $time['meridian'];
        $minutesAdjusted    = $time['minutes_adjusted'];

        // get json data
        $data       = $this->time2Text;

        // get time strings and numbers
        $text       = $data['text'];
        $numbers    = $data['numbers'];


        $string = $this->getStringSwitchCase($minutes, $text);


        if ($minutes <= 30) {
        $ret = $this->getTimeString($numbers[$hour], $numbers[intval($minutes)], $meridian, $string);
        } else {
            $ret = $this->getTimeString($numbers[$hour], $numbers[intval($minutesAdjusted)], $meridian, $string);
        }

        return $ret;
    }

    /**
     * get string switch case (with language conditional)
     * @param $minutes
     * @param $text
     * @param $suff
     * @return mixed
     */
    private function getStringSwitchCase ($minutes, $text) {
        $lang = $this->lang;
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
    private function getTimeString($hour, $minutes, $meridian, $string) {
        $text  = str_replace('{MINUTES}', $minutes, $string);
        $ret   = str_replace('{HOUR}', $hour, $text);
        $ret  .=  $meridian;
        return $ret;
    }

    /**
     * ELEMENTS - FUNCTIONS
     */

    public function getClockFaceArray() {
        $data = $this->time2Text;
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
        $wordArr = explode( ' ', $time);

        $rowString = $this->getClockFaceString();
        $elementArr = str_split($rowString);
        $keys = array_keys($elementArr);

        $num = count($wordArr);

        for ($i = 0; $i < $num; $i++) {
            $lang = $this->lang;
            $now = $this->getFormattedTime();
            $minutes = $now['minutes_adjusted'];
            $hour = $now['hour'];

            $word = $wordArr[$i];

            $pattern = $this->getStringPattern($word);

            preg_match($pattern, $rowString, $matches, PREG_OFFSET_CAPTURE);

            $matchWord = $matches[0][0];
            $matchKey  = $matches[0][1];

            $length = strlen($wordArr[$i]);
            $start = $matchKey;
            $end = $start + $length;

            for ($j = $start; $j < $end; $j++) {
                foreach ($elementArr as $key => $value) {
                    if ($key == $j) {
                        //print_r("At $key : " . $value);
                        $elementArr[$key] = [$value, 'active'];
                    }
                }
               /* foreach ($elementArr as $key => $value) {
                    if ($key == $j) {
                        $elementArr[$key] = [$value, 'active'];
                    }
                }*/
            }
        }


        return $elementArr;
    }

    private function getStringPattern($word) {
        $lang = $this->lang;
        $now = $this->getFormattedTime();
        $minutes = $now['minutes_adjusted'];
        $hour = $now['hour'];

        switch ($lang) {
            case self::LANG_DEFAULT:
                if (($word == preg_match("((five)(?=\sto)|(five)(?=\spast))")) && $minutes == 5) {
                    $pattern = '(?<=TWENTY)FIVE';
                } elseif (($word == preg_match('((?<=to\s)five|(?<=past\s)five)')) && $hour == 5) {
                    $pattern = '((?<!TWENTY)FIVE)';
                } elseif ($word == 'A') {
                    $pattern = '((?<=PM)A)';
                } elseif ($word == 'TEN' && $minutes == 10) {
                    $pattern = '((?<!TWELVE)TEN)';
                } elseif ($word == 'TEN' && $hour == 10) {
                    $pattern = '((?<=TWELVE)TEN)';
                } else {
                    $pattern = '(' . $word . ')';
                }
                return $pattern;
            break;
        }

    }


    /**
     * build table from clockFaceArray
     * @return string
     */
    public function buildClock() {
        $elementClass = $this->getElementClass();

        $table = '<table>';

        foreach ($elementClass as $block) {
            if (is_array($block)) {
                $element = $block[0];
                $class = $block[1];
            } else {
                $element = $block;
                $class = '';
            }

            if($i % Clock_Object::COL_NUM == 0) {
                $table .= '<tr><td><div class="block ' . $class . '">' . $element . '</div></td>';
            } else {
                    $table .= '<td><div class="block ' . $class . '">' . $element . '</div></td>';

            }
            $i++;



        }
        $table .= '</tr></table>';
        return $table;
    }

}