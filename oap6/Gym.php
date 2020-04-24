<?php


class Gym
{
    const MIN_AGE = 16;
    const MAX_AGE = 100;

    protected $clients;


    public function __construct()
    {
        $this->clients = array();
    }

    public function addClient($age) {
        if (!ctype_digit((string)$age)) {
            throw new \InvalidArgumentException('Age must be a digit');
        }
        if ($age < self::MIN_AGE || $age > self::MAX_AGE) {
            throw new \InvalidArgumentException('Age must be between ' . self::MIN_AGE . ' and ' . self::MAX_AGE . '.');
        }
        $this->clients[] = $age;
        return true;
    }

    public function getOldest()
    {
        if (count($this->clients) === 0) {
            return false;
        }
        return max($this->clients);
    }

    public function getYoungest()
    {
        if (count($this->clients) === 0) {
            return false;
        }
        return min($this->clients);
    }

    public function getAverage()
    {
        if (count($this->clients) === 0) {
            return false;
        }
        return array_sum($this->clients)/count($this->clients);
    }
}
