<?php

require_once __DIR__.'./../oap4/DepositCalc.php';
use PHPUnit\Framework\TestCase;

class DepositCalcTest extends TestCase
{
    /**
    * @dataProvider providerCorrect
     */
    public function testCorrect($a, $b,$expect)
    {
        $calc = new DepositCalc($a,$b);
        $this->assertEquals($expect,[$calc->getTotal(),$calc->getProfit(),$calc->getMonthlyProfit()]);
    }

    public function providerCorrect()
    {
        return [
            [1000,12,[1050,50,4.17]],
            [1500,24,[1650,150,6.25]],
            [5000,6,[5125.34,125.34,20.89]]
        ];
    }

    /**
     * @dataProvider providerIncorrect
     */
    public function testIncorrect($a, $b)
    {
        $this->expectException('InvalidArgumentException');
        $calc = new DepositCalc($a,$b);
    }

    public function providerIncorrect()
    {
        return [
            ['jopa',12],
            [5000,'jopa'],
            [0,24],
            [5000,-1]
        ];
    }
}
