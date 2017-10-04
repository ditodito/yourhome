<?php
namespace frontend\controllers;

use common\api\models\database\Rooms;
use common\controllers\YourHomeController;
use DateTime;
use frontend\models\OrderForm;

class OrderController extends YourHomeController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionStep1() {
        $model = new OrderForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $start = new DateTime($model->start_date);
            $end = new DateTime($model->end_date);
            $diff_days = $end->diff($start)->format("%a");
            return $this->render('step1', [
                'dif' => $diff_days,
                'price' => Rooms::findOne($model->room_id)->price * $diff_days,
                'available_rooms' => ['1' => 'room1', '2' => 'room2', '3' => 'room3']
            ]);
        }
        return $this->redirect(['order/index']);
    }

}