<?php
/**
 * May no longer be needed
 */


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
/*if (($word == preg_match("((five)(?=\sto)|(five)(?=\spast))")) && $minutes == 5) {
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
}*/

/*private function getEnglishGrammar($word, $minutes, $hour) {
    $time2Text = $this->time2Text;

    $timeString = $this->startClock();
    $five   = $time2Text['numbers'][5];
    $ten      = $time2Text['numbers'][10];

    if ($word == $five){
        if ($minutes == 5 && strpos($timeString, $five, 0)) {
            $pattern = '(?<=TWENTY)FIVE';
        }
        if ($hour == 5 && strpos($timeString, $five, -7)) {
            $pattern = '((?<!TWENTY)FIVE)';
        }
    } elseif ($word == $ten) {
        if ($minutes == 10 && strpos($timeString, $ten, 0)) {
            $pos = strpos($timeString, $ten);
            if ($pos !== false) {
                $timeString = substr_replace($timeString, '', strlen($ten));
            }
            $pattern = '((?<!TWELVE)TEN)';
        }
        if ($hour == 10 && strpos($timeString, $ten, -7)) {
            $pos2 = strpos($timeString, $ten);
            if ($pos2 !== false) {
                $timeString = substr_replace($timeString, '', strlen($ten));
            }
            $pattern = '(?<=TWELVE)TEN';

        }
    } elseif ($word == 'A') {
        $pattern = '((?<=PM)A)';
    } else {
        $pattern = '(' . $word . ')';
    }

    return $pattern;
}*/

/**
 * @param $minuteInterval
 * @return string
 */
/*private function defunctRoundDown($minuteInterval = 5) {
    $now = strtotime($this->now());
    return date('i', floor($now / ($minuteInterval * 60)) * ($minuteInterval * 60));
}*/
/**
 * @return string
 */
/*private function get12HourIncrement() {
    $this->setCurrentTimeZone();
    return date("h");
}*/

/**
 * @return string
 */
/*private function get24HoursIncrement() {
    $this->setCurrentTimeZone();
    return date("H");
}*/
/**
 * @return string
 */
/*private function getMinutes() {
    $this->setCurrentTime();
    return date("i");
}*/
/**
 * @return string
 */
/*private function getDayNight() {
    $this->setCurrentTime();
    return date("a");
}*/

/*    public $timeStringArray = [
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
        Clock_Object::LANG_TR       =>  [],
        Clock_Object::LANG_JP       =>  [],
    ];

    public $elementArray = [
        Clock_Object::LANG_DEFAULT => [
                [
                    'IT',
                    'class'     => 'always'
                ],
                [
                    'L',
                    'class'     => ''
                ],
                [
                    'IS',
                    'class'     => 'always'
                ],
                [
                    'AK',
                    'class'     => ''
                ],
                [
                    'AM',
                    'class'     => 'meridian'
                ],
                [
                    'PM',
                    'class'     => 'meridian'
                ],
                [
                    'A',
                    'class'     => 'minutes'
                ],
                [
                    'C',
                    'class'     => ''
                ],
                [
                    'QUARTER',
                    'class'     => 'minutes'
                ],
                [
                    'DC',
                    'class'     => ''
                ],
                [
                    'TWENTY',
                    'class'     => 'minutes'
                ],
                [
                    'FIVE',
                    'class'     => 'minutes'
                ],
                [
                    'X',
                    'class'     => ''
                ],
                [
                    'HALF',
                    'class'     => 'minutes'
                ],
                [
                    'S',
                    'class'     => ''
                ],
                [
                    'TEN',
                    'class'     => 'minutes'
                ],
                [
                    'F',
                    'class'     => ''
                ],
                [
                    'TO',
                    'class'     => 'minutes'
                ],
                [
                    'PAST',
                    'class'     => 'minutes'
                ],
                [
                    'ERU',
                    'class'     => ''
                ],
                [
                    'NINE',
                    'class'     => 'hour'
                ],
                [
                    'ONE',
                    'class'     => 'hour'
                ],
                [
                    'SIX',
                    'class'     => 'hour'
                ],
                [
                    'THREE',
                    'class'     => 'hour'
                ],
                [
                    'FOUR',
                    'class'     => 'hour'
                ],
                [
                    'FIVE',
                    'class'     => 'hour'
                ],
                [
                    'TWO',
                    'class'     => 'hour'
                ],
                [
                    'EIGHT',
                    'class'     => 'hour'
                ],
                [
                    'ELEVEN',
                    'class'     => 'hour'
                ],
                [
                    'SEVEN',
                    'class'     => 'hour'
                ],
                [
                    'TWELVE',
                    'class'     => 'hour'
                ],
                [
                    'TEN',
                    'class'     => 'hour'
                ],
                [
                    'SE',
                    'class'     => ''
                ],
                [
                    'O',
                    'class'     => 'hour'
                ],
                [
                    'CLOCK',
                    'class'     => 'hour'
                ],

        ],
    ];*/


/**
 * get the hour index based on hour and language
 * @param $hour
 * @param $minutes
 * @param $lang
 * @return int
 */
/*private function getHourIndex($hour, $minutes, $lang) {
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
}*/

/**
 * get minute index based on minutes entered
 * note: minutes must have already been converted to a 5-minute increment
 * @param $minutes
 * @return float|int
 */
/*private function getMinuteIndex($minutes) {
    return $minutes / 5;
}*/
/**
 * get words and filler for clock as array
 * @param $stringSet
 * @return array
 */
/*public function getClockFaceArray() {
    $lang = $this->lang;
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
}*/


/**
 * build table from clockFaceArray
 * @return string
 */
/*public function buildClock($lang = Clock_Object::LANG_DEFAULT) {
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
}*/

/*public function getElementClassJA() {
    $time = $this->startClock();
    $time .= $this->getMeridian($time);
    print_r($time);
    $wordArr = mb_str_split($time);
    $rowString = $this->getClockFaceString();

    if (!mb_check_encoding($rowString, "UTF-8")) {
        $rowString = mb_convert_encoding($rowString, "UTF-8","Shift-JIS, EUC-JP, JIS, SJIS, JIS-ms, eucJP-win, SJIS-win, ISO-2022-JP,       ISO-2022-JP-MS, SJIS-mac, SJIS-Mobile#DOCOMO, SJIS-Mobile#KDDI, SJIS-Mobile#SOFTBANK, UTF-8-Mobile#DOCOMO, UTF-8-Mobile#KDDI-A, UTF-8-Mobile#KDDI-B, UTF-8-Mobile#SOFTBANK, ISO-2022-JP-MOBILE#KDDI");
    }
    print_r($rowString);
    $elementArr = mb_str_split($rowString);
    print_r($elementArr);
    return $elementArr;
}*/