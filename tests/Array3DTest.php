<?php

require_once __DIR__.'./../oap7/Array3D.php';

class Array3DTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerSize
     */
    public function testSize($a)
    {
        $arr = new Array3D($a);
        $check = isset($arr->getArr1()[$a-1][$a-1][$a-1],$arr->getArr2()[$a-1][$a-1][$a-1]) && !(isset($arr->getArr1()[$a],$arr->getArr1()[$a-1][$a],$arr->getArr1()[$a-1][$a-1][$a],$arr->getArr2()[$a],$arr->getArr2()[$a-1][$a],$arr->getArr2()[$a-1][$a-1][$a]));
        $this->assertEquals(true,$check);
    }

    /**
     * @dataProvider providerSize
     */
    public function testAddition($a)
    {
        $arr = new Array3D($a);
        $result = $arr->addition();
        for($i = 0; $i < $a; $i++) {
            for($j = 0; $j < $a; $j++) {
                for($k = 0; $k < $a; $k++) {
                    $this->assertEquals(true,($result[$i][$j][$k] === $arr->getArr1()[$i][$j][$k] + $arr->getArr2()[$i][$j][$k]));
                }
            }
        }
    }
    /**
     * @dataProvider providerSize
     */
    public function testSubstraction($a)
    {
        $arr = new Array3D($a);
        $result = $arr->subtraction();
        $reverse = $arr->subtraction(true);
        for($i = 0; $i < $a; $i++) {
            for($j = 0; $j < $a; $j++) {
                for($k = 0; $k < $a; $k++) {
                    $this->assertEquals(true,($result[$i][$j][$k] === $arr->getArr2()[$i][$j][$k] - $arr->getArr1()[$i][$j][$k]) && ($reverse[$i][$j][$k] === $arr->getArr1()[$i][$j][$k] - $arr->getArr2()[$i][$j][$k]));
                }
            }
        }
    }
    public function testSubstractionEception(){
        $this->expectException('InvalidArgumentException');
        $arr = new Array3D(3);
        $arr->subtraction('not a bool');
    }
    public function providerSize(){
        return [[1],[2],[3],[4],[5]];
    }
    /**
     * @dataProvider providerSize
     */
    public function testMultiplication($a)
    {
        $arr = new Array3D($a);
        $result = $arr->multiplication($a);
        for($i = 0; $i < $a; $i++) {
            for($j = 0; $j < $a; $j++) {
                for($k = 0; $k < $a; $k++) {
                    $this->assertEquals(true,($result[0][$i][$j][$k] === $arr->getArr1()[$i][$j][$k]*$a) && ($result[1][$i][$j][$k] === $arr->getArr2()[$i][$j][$k]*$a));
                }
            }
        }
    }
    /**
     * @dataProvider providerLarge
     */
    public function testCompare($a)
    {
        $arr = new Array3D($a);
        $result1 = 0;
        $result2 = 0;
        for($i = 0; $i < $a; $i++) {
            for($j = 0; $j < $a; $j++) {
                for($k = 0; $k < $a; $k++) {
                    $result1 += $arr->getArr1()[$i][$j][$k];
                    $result2 += $arr->getArr2()[$i][$j][$k];
                }
            }
        }
        if($result1 > $result2) {
            $result = 1;
        } else if($result1 < $result2) {
            $result = 2;
        } else {
            $result = 0;
        }
        $this->assertEquals([$result,$result1,$result2],$arr->compareSum());
    }
    public function providerLarge()
    {
        $numberOfTests = 100;

        $data = array();

        for ($i = 0; $i < $numberOfTests; $i++) {
            $data[] = array(mt_rand(1, 2), mt_rand(1, 2), mt_rand(1, 2));
        }

        return $data;
    }
    public function testMultiplicationException()
    {
        $this->expectException('InvalidArgumentException');
        $arr = new Array3D(3);
        $result = $arr->multiplication('float');
    }
    /**
     * @dataProvider providerSizeException
     */
    public function testSizeException($a)
    {
        $this->expectException('InvalidArgumentException');
        $arr = new Array3D($a);
    }

    public function providerSizeException(){
        return [[0],['twelve']];
    }
}
