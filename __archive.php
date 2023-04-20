<?php
/**
 * May no longer be needed
 */

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
