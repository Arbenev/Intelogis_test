<?php

namespace app\models\Intelogis\Company;

use \yii\base\Model;

abstract class BaseCompany extends Model
{

    const SECONDS_PER_DAY = 60 * 60 * 24;

    public function getPrice($from, $to, $weight, $fast = false)
    {
        if ($fast) {
            return [
                'price' => $this->priceCalc($from, $to, $weight),
                'period' => $this->periodCalc($from, $to, $weight),
                'error' => 0,
            ];
        } else {
            return [
                'coefficient' => $this->coefficientCalc($from, $to, $weight),
                'date' => $this->dateCalc($from, $to),
                'error' => 0,
            ];
        }
    }

    abstract protected function priceCalc($from, $to, $weight);

    abstract protected function coefficientCalc($from, $to, $weight);

    abstract protected function periodCalc($from, $to, $weight);

    abstract protected function dateCalc($from, $to);
}
