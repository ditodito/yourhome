<?php
namespace frontend\controllers;

use common\api\actions\OrderActions;
use common\api\actions\RoomsActions;
use common\api\models\database\Rooms;
use common\controllers\YourHomeController;
use DateTime;
use frontend\models\OrderForm;
use frontend\models\OrderStep2;
use yii\filters\AccessControl;

class OrderController extends YourHomeController {

    /*public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['step1', 'step2'],
                'rules' => [
                    [
                        'allow' => false,
                        'verbs' => ['POST']
                    ]
                ],
            ],
        ];
    }*/

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionStep1() {
        $model = new OrderForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $start_date = strtotime($model->start_date);
            $end_date = strtotime($model->end_date);

            return $this->render('step1', [
                'total_days' => floor(($end_date - $start_date) / 86400),
                'start_date' => $start_date,
                'end_date' => $end_date,
                'available_rooms' => RoomsActions::getAvailableRooms(date('Y-m-d', $start_date), date('Y-m-d', $end_date)),
                'order_form' => $model
            ]);
        }

        return $this->redirect(['/site/']);
    }

    public function actionStep2() {
        if (\Yii::$app->request->post()) {
            $start = strtotime(\Yii::$app->request->post('start_date')); // strtotime('10/19/2017');
            $end = strtotime(\Yii::$app->request->post('end_date')); // strtotime('10/21/2017');
            $room_ids = \Yii::$app->request->post('room_ids'); // [2, 3];
            $capacities = \Yii::$app->request->post('capacities'); // [2,6];

            $room_price = 0;
            $total_days = floor(($end - $start) / 86400);

            $model = new OrderStep2();
            $model->start_date = date('Y-m-d', $start);
            $model->end_date = date('Y-m-d', $end);

            foreach ($capacities as $key => $capacity) {
                if ($capacity == 0)
                    continue;

                $room = Rooms::findOne(['id' => $room_ids[$key]]);
                if (!$room)
                    continue;

                $room_price += $room->price * $capacity;
                $model->room_ids .= $room_ids[$key] . ',';
                $model->capacities .= $capacity . ',';
            }

            return $this->render('step2', [
                'start_date' => $start,
                'end_date' => $end,
                'room_price' => $room_price * $total_days,
                'days' => $total_days,
                'model' => $model,
                'airportTransferPrices' => OrderActions::getAirportTransferPrices()
            ]);
        }

        return $this->redirect(['/site/']);
    }

    public function actionFinish() {
        $model = new OrderStep2();

        if ($model->load(\Yii::$app->request->post()) && $model->saveOrder()) {
            return "y";///return $this->redirect(['/order/success']);
        } else {
            return 'no';
        }

        return $this->redirect(['/site/']);
    }

}