<?php
namespace frontend\controllers;

use common\api\actions\RoomsActions;
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
            $start = new DateTime($model->start_date);
            $end = new DateTime($model->end_date);

            return $this->render('step1', [
                'order_form' => $model,
                'check_in' => date_format($start, 'D, M d, Y'),
                'check_out' => date_format($end, 'D, M d, Y'),
                'days' => $end->diff($start)->format("%a"),
                'start_date' => date_format($start, 'Y-m-d'),
                'end_date' => date_format($end, 'Y-m-d'),
                'available_rooms' => RoomsActions::getAvailableRooms(date_format($start, 'Y-m-d'), date_format($end, 'Y-m-d'))
            ]);
        }

        return $this->redirect(['site/']);
    }

    public function actionStep2() {
        $model = new OrderStep2();

        $start = strtotime('10/18/2017'); // new DateTime('10/18/2017'); //\Yii::$app->request->post('start_date');
        $end = strtotime('10/19/2017'); // \Yii::$app->request->post('end_date');

        $model->start_date = date('Y-m-d', $start);
        $model->end_date = date('Y-m-d', $end);
        $room_ids = \Yii::$app->request->post('room_ids');
        $capacities = \Yii::$app->request->post('capacities');

        $capacities = [1,3,4];
        $room_ids = [1,2,3];
        foreach($capacities as $key => $capacity) {
            if ($capacity == 0)
                continue;
            $model->room_ids .= $room_ids[$key] . ",";
            $model->capacities .= $capacity . ",";
        }

        return $this->render('step2', [
            'start_date' => $start,
            'end_date' => $end,
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