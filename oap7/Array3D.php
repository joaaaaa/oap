<?php


class Array3D
{
    const MIN = 0;
    const MAX = 255;
    protected $arr1 = [];
    protected $arr2 = [];
    protected $length;

    public function __construct($length)
    {
        if(!ctype_digit((string)$length)) {
            throw new InvalidArgumentException('Argument must be an integer');
        }
        if ((int)$length <= 0) {
            throw new InvalidArgumentException('Arguments must be greater than 0');
        }

        $this->length = $length;

        for($i = 0; $i < $length; $i++) {
            $this->arr1[$i] = [];
            $this->arr2[$i] = [];
            for($j = 0; $j < $length; $j++) {
                $this->arr1[$i][$j] = [];
                $this->arr2[$i][$j] = [];
                for($k = 0; $k < $length; $k++) {
                    $this->arr1[$i][$j][$k] = mt_rand(self::MIN, self::MAX);
                    $this->arr2[$i][$j][$k] = mt_rand(self::MIN, self::MAX);
                }
            }
        }
    }

    public function addition() {
        $sumArr = [];

        for($i = 0; $i < $this->length; $i++) {
            $sumArr[$i] = [];
            for($j = 0; $j < $this->length; $j++) {
                $sumArr[$i][$j] = [];
                for($k = 0; $k < $this->length; $k++) {
                    $sumArr[$i][$j][$k] = $this->arr1[$i][$j][$k] + $this->arr2[$i][$j][$k];
                }
            }
        }

        return $sumArr;
    }
    public function subtraction($changeOrder = false) {
        if(!is_bool($changeOrder) ) {
            throw new InvalidArgumentException('Argument must be bool');
        }
        $resArr = [];

        for($i = 0; $i < $this->length; $i++) {
            $resArr[$i] = [];
            for($j = 0; $j < $this->length; $j++) {
                $resArr[$i][$j] = [];
                for($k = 0; $k < $this->length; $k++) {
                    if($changeOrder) {
                        $resArr[$i][$j][$k] = $this->arr1[$i][$j][$k] - $this->arr2[$i][$j][$k];
                    } else {
                        $resArr[$i][$j][$k] = $this->arr2[$i][$j][$k] - $this->arr1[$i][$j][$k];
                    }
                }
            }
        }

        return $resArr;
    }
    public function multiplication($multiplier) {
        if(!is_float($multiplier) && !ctype_digit((string)$multiplier)) {
            throw new InvalidArgumentException('Argument must be a float');
        }
        $resArr1 = [];
        $resArr2 = [];

        for($i = 0; $i < $this->length; $i++) {
            $resArr1[$i] = [];
            $resArr2[$i] = [];
            for($j = 0; $j < $this->length; $j++) {
                $resArr1[$i][$j] = [];
                $resArr2[$i][$j] = [];
                for($k = 0; $k < $this->length; $k++) {
                    $resArr1[$i][$j][$k] = $this->arr1[$i][$j][$k] * $multiplier;
                    $resArr2[$i][$j][$k] = $this->arr2[$i][$j][$k] * $multiplier;
                }
            }
        }

        return Array($resArr1, $resArr2);
    }

    public function compareSum() {
        $elemSum1 = 0;
        $elemSum2 = 0;

        for($i = 0; $i < $this->length; $i++) {
            $resArr[$i] = [];
            for($j = 0; $j < $this->length; $j++) {
                $resArr[$i][$j] = [];
                for($k = 0; $k < $this->length; $k++) {
                    $elemSum1 += $this->arr1[$i][$j][$k];
                    $elemSum2 += $this->arr2[$i][$j][$k];
                }
            }
        }

        if($elemSum1 > $elemSum2) {
            $result = 1;
        } else if($elemSum1 < $elemSum2) {
            $result = 2;
        } else {
            $result = 0;
        }

        return Array($result, $elemSum1, $elemSum2);
    }

    /**
     * @return array
     */
    public function getArr1()
    {
        return $this->arr1;
    }

    /**
     * @return array
     */
    public function getArr2()
    {
        return $this->arr2;
    }
}

