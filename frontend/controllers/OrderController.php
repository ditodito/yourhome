<?php
namespace frontend\controllers;

use common\api\actions\OrderActions;
use common\api\actions\RoomsActions;
use common\api\models\database\Rooms;
use common\api\models\response\RoomServiceRow;
use common\api\models\response\RoomsWithServicesRow;
use common\controllers\YourHomeController;
use frontend\models\OrderForm;
use frontend\models\OrderStep2;

class OrderController extends YourHomeController {

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
                'model' => $model
            ]);
        }

        return $this->redirect(['site/']);
    }

    public function actionStep2() {
        if (\Yii::$app->request->post()) {
            $start_date = strtotime(\Yii::$app->request->post('start_date'));
            $end_date = strtotime(\Yii::$app->request->post('end_date'));
            $rooms = \Yii::$app->request->post('rooms');

            $total_days = floor(($end_date - $start_date) / 86400);
            $room_price = 0;
            $final_rooms = [];
            $selected_rooms = [];

            foreach($rooms as $room) {
                $params = explode('-', $room);
                $room_id = $params[0];
                $quantity = $params[1];

                if ($room_id == 0)
                    continue;

                $r = Rooms::findOne(['id' => $room_id]);
                if (!$r)
                    continue;

                $room_price += $r->price * $quantity * $total_days;
                $final_rooms[] = $room;

                for($i = 0; $i < $quantity; $i++) {
                    switch(\Yii::$app->language) {
                        case 'ka-GE':
                            $name = $r['name_ge'];
                            break;
                        case 'ru-RU':
                            $name = $r['name_ru'];
                            break;
                        default:
                            $name = $r['name_us'];
                    }

                    $rws = new RoomsWithServicesRow($room_id, $name);
                    foreach($r->services as $service) {
                        switch(\Yii::$app->language) {
                            case 'ka-GE':
                                $service_name = $service['name_ge'];
                                break;
                            case 'ru-RU':
                                $service_name = $service['name_ru'];
                                break;
                            default:
                                $service_name = $service['name_us'];
                        }

                        $service = new RoomServiceRow($service['id'], $service_name, $service['price'], $service['per_night']);
                        $rws->setService($service);
                    }
                    $selected_rooms[] = $rws;
                }
            }

            $model = new OrderStep2();
            $model->start_date = date('Y-m-d', $start_date);
            $model->end_date = date('Y-m-d', $end_date);
            $model->rooms = implode(',', $final_rooms);

            return $this->render('step2', [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_days' => $total_days,
                'room_price' => $room_price,
                'selectedRooms' => $selected_rooms,
                'model' => $model,
                'airportTransferPrices' => OrderActions::getAirportTransferPrices()
            ]);
        }

        return $this->redirect(['site/']);
    }

    public function actionFinish() {
        $model = new OrderStep2();

        if ($model->load(\Yii::$app->request->post())) {
            $reservation_number = $model->saveOrder();
            if ($reservation_number > 0)
                return $this->redirect(['order/result', 'status' => 1, 'reservation_number' => $reservation_number, 'email' => $model->email]);
            else
                return $this->redirect(['order/result', 'status' => 2]);
        }

        return $this->redirect(['site/']);
    }

    public function actionRemoveOrder($id, $order_key) {
        $reservation_number = OrderActions::removeOrder($id, $order_key);
        if ($reservation_number > 0)
            return $this->redirect(['order/result', 'status' => 3, 'reservation_number' => $reservation_number]);
        else
            return $this->redirect(['order/result', 'status' => 4]);
    }

    public function actionRemoveOrderRoom($id, $order_key) {
        $reservation_number = OrderActions::removeOrderRoom($id, $order_key);
        if ($reservation_number > 0)
            return $this->redirect(['order/result', 'status' => 3, 'reservation_number' => $reservation_number]);
        else
            return $this->redirect(['order/result', 'status' => 4]);
    }

    public function actionResult($status, $reservation_number = null, $email = null) {
        return $this->render('result', [
            'status' => $status,
            'reservation_number' => $reservation_number,
            'email' => $email
        ]);
    }

}