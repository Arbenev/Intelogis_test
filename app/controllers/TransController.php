<?php

namespace app\controllers;

use yii\web\Controller;

class TransController extends Controller
{

    public function actionIndex()
    {
        $bodyJson = file_get_contents('php://input');
        $body = json_decode($bodyJson);
        if (!isset($body->from) || !isset($body->to) || !isset($body->weight)) {
//            throw \Exception('Wrong data');
        }
        $from = $body->from ?? 0;
        $to = $body->to ?? 0;
        $weight = $body->weight ?? 0;
        $fast = \Yii::$app->request->getQueryParam('fast') !== null;
        $adapter = new \app\models\Intelogis\Company\CompanyAdapter();
        $price = $adapter->getPrice(\Yii::$app->request->getQueryParam('company'), $from, $to, $weight, $fast);
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $response->getHeaders()->set('Content-Type', 'application/json');
        echo json_encode($price);
        \Yii::$app->end();
    }
}
