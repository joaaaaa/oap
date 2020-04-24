<?php

require_once __DIR__.'./../oap6/Gym.php';

class GymTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerCorrect
     */
    public function testCorrect($a,$b,$c,$expect)
    {
        $gym = new Gym();
        $gym->addClient($a);
        $gym->addClient($b);
        $gym->addClient($c);
        $this->assertEquals($expect,[$gym->getOldest(),$gym->getYoungest(),$gym->getAverage()]);
    }

    public function providerCorrect()
    {
        return [
            [18,20,19,[20,18,19]],
            [18,26,25,[26,18,23]]
        ];
    }

    public function testNull()
    {
        $gym = new Gym();
        $this->assertEquals(false,($gym->getOldest() || $gym->getYoungest() || $gym->getAverage()));
    }

    /**
     * @dataProvider providerIncorrect
     */
    public function testIncorrect($a)
    {
        $this->ExpectException('InvalidArgumentException');
        $gym = new Gym();
        $gym->addClient($a);
    }

    public function providerIncorrect()
    {
        return [
            ['jopa'],
            [14]
        ];
    }
}
