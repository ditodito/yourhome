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
            $start = strtotime(\Yii::$app->request->post('start_date'));
            $end = strtotime(\Yii::$app->request->post('end_date'));
            $rooms = \Yii::$app->request->post('rooms');
            $quantities = \Yii::$app->request->post('quantities');

            $total_days = floor(($end - $start) / 86400);
            $room_price = 0;
            $final_rooms = [];
            $final_quantities = [];
            $selected_rooms = [];

            foreach ($quantities as $key => $quantity) {
                if ($quantity <= 0)
                    continue;

                $room = Rooms::findOne(['id' => $rooms[$key]]);
                if (!$room)
                    continue;

                $room_price += $room->price * $quantity;

                $final_rooms[] = $rooms[$key];
                $final_quantities[] = $quantity;

                if ($room->is_hostel) {
                    $selected_rooms[] = RoomsActions::getRoomsTitleById($rooms[$key]);
                } else {
                    for ($i = 0; $i < $quantity; $i++) {
                        $selected_rooms[] = RoomsActions::getRoomsTitleById($rooms[$key]);
                    }
                }
            }

            $model = new OrderStep2();
            $model->start_date = date('Y-m-d', $start);
            $model->end_date = date('Y-m-d', $end);
            $model->rooms = implode(',', $final_rooms);
            $model->quantities = implode(',', $final_quantities);

            return $this->render('step2', [
                'start_date' => $start,
                'end_date' => $end,
                'total_days' => $total_days,
                'room_price' => $room_price * $total_days,
                'selectedRooms' => $selected_rooms,
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