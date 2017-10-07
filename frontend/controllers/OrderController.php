<?php
namespace frontend\controllers;

use common\api\actions\RoomsActions;
use common\api\models\database\Rooms;
use common\controllers\YourHomeController;
use DateTime;
use frontend\models\OrderForm;
use frontend\models\OrderStep2;

class OrderController extends YourHomeController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionStep1() {
        $model = new OrderForm();
         if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $sd = $model->start_date;//'2017-10-13';//'10/03/2017';
            $ed = $model->end_date;//'2017-10-14';//'10/5/2017';
            //$start = new DateTime($sd);
            //$end = new DateTime($ed);
            $start = new DateTime($sd);
            $end = new DateTime($ed);
            $diff_days = $end->diff($start)->format("%a");

            return $this->render('step1', [
                //'price' => Rooms::findOne(/*$model->room_id*/1)->price * $diff_days,
                'check_in' => date_format($start, 'D, M d, Y'),
                'check_out' => date_format($end, 'D, M d, Y'),
                'days' => $diff_days,
                'start_date' => $model->start_date,
                'end_date' => $model->end_date,
                'available_rooms' => RoomsActions::getAvailableRooms($sd, $ed)//['1' => 'room1', '2' => 'room2', '3' => 'room3']
            ]);
        }
        return $this->redirect(['order/index']);
    }

    public function actionStep2() {
        $model = new OrderStep2();
        /*$start_date = \Yii::$app->request->post('start_date');
        $end_date = \Yii::$app->request->post('end_date');

        $rooms_ids = \Yii::$app->request->post('rooms_ids');//;
        $quantities = \Yii::$app->request->post('quantities');
        $response = [];
        $response['start_date'] = $start_date;
        $response['end_date'] = $end_date;
        foreach($quantities as $key => $quantity) {
            if ($quantity == 0)
                continue;
            $response['room_ids'][] = $rooms_ids[$key];
            $response['quantities'][] = $quantity;
        }

        \Yii::error($response);*/
        $model->start_date = 'sd';//\Yii::$app->request->post('start_date');
        $model->end_date = 'ed';//\Yii::$app->request->post('end_date');
        $model->room_id = '17';
        $model->quantity = '3';

        return $this->render('step2', [
            'model' => $model
        ]);
    }

}