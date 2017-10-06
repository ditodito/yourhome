<?php
namespace frontend\controllers;

use common\api\actions\RoomsActions;
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
            $sd = $model->start_date;//'2017-10-13';//'10/03/2017';
            $ed = $model->end_date;//'2017-10-14';//'10/5/2017';
            //$start = new DateTime($sd);
            //$end = new DateTime($ed);
            $start = new DateTime($sd);
            $end = new DateTime($ed);
            $diff_days = $end->diff($start)->format("%a");

            return $this->render('step1', [
                'price' => Rooms::findOne(/*$model->room_id*/1)->price * $diff_days,
                'check_in' => date_format($start, 'D, M d, Y'),
                'check_out' => date_format($end, 'D, M d, Y'),
                'days' => $diff_days,
                'available_rooms' => RoomsActions::getAvailableRooms($sd, $ed)//['1' => 'room1', '2' => 'room2', '3' => 'room3']
            ]);
        }
        return $this->redirect(['order/index']);
    }

}