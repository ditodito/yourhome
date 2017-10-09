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
            $sd = $model->start_date;
            $ed = $model->end_date;
            $start = new DateTime($sd);
            $end = new DateTime($ed);

            return $this->render('step1', [
                'check_in' => date_format($start, 'D, M d, Y'),
                'check_out' => date_format($end, 'D, M d, Y'),
                'days' => $end->diff($start)->format("%a"),
                'start_date' => $model->start_date,
                'end_date' => $model->end_date,
                'available_rooms' => RoomsActions::getAvailableRooms($sd, $ed)
            ]);
        }

        return $this->redirect(['order/index']);
    }

    public function actionStep2() {
        $model = new OrderStep2();

        $model->start_date = \Yii::$app->request->post('start_date');
        $model->end_date = \Yii::$app->request->post('end_date');
        $room_ids = \Yii::$app->request->post('room_ids');
        $capacities = \Yii::$app->request->post('capacities');

        foreach($capacities as $key => $capacity) {
            if ($capacity == 0)
                continue;
            $model->room_ids .= $room_ids[$key] . ",";
            $model->capacities .= $capacity . ",";
        }

        return $this->render('step2', [
            'model' => $model
        ]);
    }

    public function actionFinish() {
        $model = new OrderStep2();
        if ($model->load(\Yii::$app->request->post()) && $model->saveOrder()) {
            return 'yes';
        } else {
            return 'no';
        }

    }

}