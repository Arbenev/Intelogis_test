<?php

namespace app\models\Intelogis\Company;

class Rpost extends BaseCompany
{

    protected function coefficientCalc($from, $to, $weight)
    {
        return 1;
    }

    protected function dateCalc($from, $to)
    {
        return date("Y-m-d", time() + self::SECONDS_PER_DAY * 15);
    }

    protected function periodCalc($from, $to, $weight)
    {
        return 10;
    }

    protected function priceCalc($from, $to, $weight)
    {
        return 100;
    }
}
