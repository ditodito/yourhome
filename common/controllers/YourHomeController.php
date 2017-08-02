<?php
namespace common\controllers;

use yii\web\Controller;

class YourHomeController extends Controller {

    public function beforeAction($action) {
        if (\Yii::$app->session->has('lang'))
            \Yii::$app->language = \Yii::$app->session->get('lang');
        else
            \Yii::$app->language = 'en-US';
        return parent::beforeAction($action);
    }

}