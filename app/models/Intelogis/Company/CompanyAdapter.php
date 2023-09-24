<?php

namespace app\models\Intelogis\Company;

class CompanyAdapter
{

    public function getPrice(string $company, $from, $to, $weight, $fast = false)
    {
        $companyClassName = __NAMESPACE__ . '\\' . ucfirst($company);
        if (class_exists($companyClassName)) {
            $companyObject = new $companyClassName();
            /*
             * @var $companyObject BaseCompany
             */
            return $companyObject->getPrice($from, $to, $weight, $fast);
        } else {
            throw new \yii\base\Exception('Company is not valid');
        }
    }
}
