<?php

namespace app\controllers;

use yii\web\Controller;

class PriceController extends Controller
{

    const SECONDS_PER_DAY = 60 * 60 * 24;

    public function actionIndex()
    {
        $from = \Yii::$app->request->getBodyParam('from');
        $to = \Yii::$app->request->getBodyParam('to');
        $weight = \Yii::$app->request->getBodyParam('weight');
        $fast = \Yii::$app->request->getQueryParam('fast') !== null;
        $body = [
            'from' => $from,
            'to' => $to,
            'weight' => $weight,
        ];
        $company = \Yii::$app->request->getQueryParam('company');
        $companies = $this->getCompanies();
        if ($company) {
            if (isset($companies[$company])) {
                $ret = [$this->askCompany($companies[$company], $body, $fast)];
            } else {
                throw \Exception('Company does not exist');
            }
        } else {
            $ret = [];
            foreach ($companies as $company) {
                $ret[] = $this->askCompany($company, $body, $fast);
            }
        }
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $response->getHeaders()->set('Content-Type', 'application/json');
        echo json_encode($ret);
        \Yii::$app->end();
    }

    protected function getCompanies()
    {
        return \Yii::$app->params['delivers'];
    }

    protected function askCompany($company, $body, $fast)
    {
        $url = $company['url'] . ($fast ? '?fast' : '');
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($body),
        ];
        $sender = curl_init($url);
        curl_setopt_array($sender, $options);
        $result = curl_exec($sender);
        $data = json_decode($result);
        $returnValue = [
            'company' => $company['name'],
            'price' => isset($data->price) ? $data->price : $data->coefficient * \Yii::$app->params['deliveryBasePrice'],
            'date' => isset($data->date) ? $data->date : date('Y-m-d', time() + $data->period * self::SECONDS_PER_DAY),
            'error' => $data->error,
        ];
        return $returnValue;
    }
}
