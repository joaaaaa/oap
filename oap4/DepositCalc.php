<?php


class DepositCalc
{
    const INTEREST_RATE = 0.05;
    public $daysBetween;
    public $daysPerYear;
    private $amount;
    private $months;

    public function __construct($amount,$months)
    {
        if (!ctype_digit((string)$amount) || !ctype_digit((string)$months)) {
            throw new \InvalidArgumentException('Arguments must be an integer');
        }
        if (((int)$amount <= 0) || ((int)$months <= 0)) {
            throw new \InvalidArgumentException('Arguments must be greater than 0');
        }
        $this->amount = $amount;
        $this->months = $months;
        $today = new DateTime();

        $final = (new DateTime())->add((new DateInterval("P{$months}M")));
        $this->daysBetween = $final->diff($today)->format('%a');

        $year = (new DateTime())->add((new DateInterval('P12M')));
        $this->daysPerYear = ($year->diff($today)->format('%a'));
    }

    public function getTotal()
    {
        return round($this->amount + $this->amount * (self::INTEREST_RATE*$this->daysBetween/$this->daysPerYear),2);
    }

    public function getProfit()
    {
        return  round($this->amount * (self::INTEREST_RATE*$this->daysBetween/$this->daysPerYear),2);
    }

    public function getMonthlyProfit() {
        return  round($this->amount * (self::INTEREST_RATE*$this->daysBetween/$this->daysPerYear)/$this->months,2);
    }
}
