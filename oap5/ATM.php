<?php
mb_internal_encoding('UTF-8');

class ATM
{
    const CURRENCY  = array('Долларов США','Доллар США','Доллара США','Доллара США','Доллара США');
    const THOUSANDS = array('тысяч', 'одна тысяча', 'две тысячи','три тысячи');
    const HUNDREDS  = array('','сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
    const TENS      = array('','','двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
    const UNITS     = array('ноль','один','два','три','четыре','пять','шесть','семь','восемь','девять','десять','одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать','шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');

    private $string;

    public function __construct($amount)
    {
        if (!ctype_digit((string)$amount)) {
            throw new InvalidArgumentException('Argument must be an integer');
        }
        if ((int)$amount < 0 || (int)$amount >= 9999) {
            throw new InvalidArgumentException('Arguments must be greater than 0 and less  or equals 9999');
        }

        $thousands = intdiv($amount,1000);
        $hundreds = intdiv(($amount-$thousands*1000),100);
        $tens = intdiv(($amount-$thousands*1000 - $hundreds*100),10);
        $units = $amount-$thousands*1000 - $hundreds*100 - $tens*10;
        $string = '';

        if ($thousands > 0) {
            if ($thousands <= 2) {
                $string .= self::THOUSANDS[$thousands] . ' ';
            } else {
                $string .= self::UNITS[$thousands] . ' ' . self::THOUSANDS[0] . ' ';
            }
        }

        if ($hundreds > 0) {
            $string .= self::HUNDREDS[$hundreds] . ' ';
        }

        if ($tens < 2) {
            if ($tens == 0) {
                if ($amount == 0) {
                    $string .= self::UNITS[0] . ' ';
                } else
                {
                    $string .= self::UNITS[$units] . ' ';
                }
            } else {
                $string .= self::UNITS[$tens*10+$units] . ' ';
            }
        } else {
            $string .= self::TENS[$tens] . ' ';
            if ($units > 0) {
                $string .= self::UNITS[$units] . ' ';
            }
        }

        if ($tens > 2 || $tens < 1)
        {
            if ($units <=4) {
                $string .= self::CURRENCY[$units];
            } else {
                $string .= self::CURRENCY[0];
            }
        } else {
            $string .= self::CURRENCY[0];
        }

        $this->string = $string;

    }

    public function getString()
    {
        return $this->string;
    }

}

