<?php

namespace app\models\Intelogis\Company;

class Dhl extends BaseCompany
{

    protected function coefficientCalc($from, $to, $weight)
    {
        return 2;
    }

    protected function dateCalc($from, $to)
    {
        return date("Y-m-d", time() + self::SECONDS_PER_DAY * 7);
    }

    protected function periodCalc($from, $to, $weight)
    {
        return 5;
    }

    protected function priceCalc($from, $to, $weight)
    {
        return 300;
    }
}
