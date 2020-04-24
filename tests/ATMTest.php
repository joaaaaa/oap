<?php

require_once __DIR__.'./../oap5/ATM.php';

class ATMTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerCorrect
     */
    public function testCorrect($a,$expect)
{
    $atm = new ATM($a);
    $this->assertEquals($expect,$atm->getString());
}

    public function providerCorrect()
{
    return [
        [64, 'шестьдесят четыре Доллара США'],
        [2347, 'две тысячи триста сорок семь Долларов США'],
        [6713,'шесть тысяч семьсот тринадцать Долларов США'],
        [6013,'шесть тысяч тринадцать Долларов США'],
        [613,'шестьсот тринадцать Долларов США'],
        [128, 'сто двадцать восемь Долларов США'],
        [15, 'пятнадцать Долларов США'],
        [0, 'ноль Долларов США']
    ];
}

    /**
     * @dataProvider providerIncorrect
     */
    public function testIncorrect($a)
{
    $this->expectException('InvalidArgumentException');
    $atm = new ATM($a);
}

    public function providerIncorrect()
{
    return [
        ['jopa'],
        [-1],
        [10000]
    ];
}
}
