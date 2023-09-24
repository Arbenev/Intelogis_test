<?php

namespace app\models\Intelogis\Company;

class Banat extends BaseCompany
{

    protected function coefficientCalc($from, $to, $weight)
    {
        return 1.2;
    }

    protected function dateCalc($from, $to)
    {
        return date("Y-m-d", time() + self::SECONDS_PER_DAY * 5);
    }

    protected function periodCalc($from, $to, $weight)
    {
        return 3;
    }

    protected function priceCalc($from, $to, $weight)
    {
        return 200;
    }
}
