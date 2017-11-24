<?php
namespace backend\controllers;

use backend\models\orders\OrdersModel;
use common\api\actions\OrderActions;
use common\api\actions\RoomsActions;
use common\api\models\database\Countries;
use common\api\models\database\Orders;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OrdersController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'details1' => ['get'],
                    'save' => ['post']
                ]
            ]
        ];
    }

    public function actions() {
        \Yii::$app->language = 'ka-GE';
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    public function actionIndex($status = null, $id = null) {
        $query = Orders::find();
        if ($status)
            $query->andWhere(['status' => $status]);
        if ($id)
            $query->andWhere(['id' => $id]);
        $query->orderBy(['id' => SORT_DESC]);

        $pagination = new Pagination();
        $pagination->totalCount = $query->count();
        $pagination->pageSize = 20;
        $orders = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', [
            'status' => $status,
            'id' => $id,
            'orders' => $orders,
            'pagination' => $pagination
        ]);
    }

    public function actionDetails1($id = null) {
        $formatter = \Yii::$app->formatter;
        $model = new OrdersModel();

        if ($id) {
            $order = Orders::findOne(['id' => $id]);
            if (!$order)
                return $this->redirect(['orders/']);

            $sql = "SELECT [[room_id]], COUNT([[room_id]]) [[quantity]]
                    FROM {{orders_room}}
                    WHERE [[order_id]] = :order_id AND [[status]] = 1
                    GROUP BY [[room_id]]";
            $rows = \YII::$app->db->createCommand($sql, [':order_id' => $id])->queryAll(\PDO::FETCH_OBJ);

            $selected_rooms = [];
            foreach($rows as $row) {
                array_push($selected_rooms, $row->room_id.'-'.$row->quantity);
            }

            $model->id = $order->id;
            $model->rooms = implode(',', $selected_rooms);
            $model->first_name = $order->first_name;
            $model->last_name = $order->last_name;
            $model->email = $order->email;
            $model->country = $order->country_id;
            $model->city = $order->city;
            $model->address = $order->address;
            $model->zip_code = $order->zip_code;
            $model->mobile = $order->mobile;
            $model->comment = $order->comment;
            $model->arrival_time = $order->arrival_time;
            $model->airport_transfer_price_id = $order->airport_transfer_price_id;
            $model->parking_reservation = $order->parking_reservation;
            $model->start_date = $formatter->asDate($order->start_date, 'php:m/d/Y');
            $model->end_date = $formatter->asDate($order->end_date, 'php:m/d/Y');
            $model->status = $order->status;
        } else {
            $model->first_name = 'Admin';
            $model->last_name = 'Admin';
            $model->email = \Yii::$app->params['infoEmail'];
            $model->country = Countries::findOne(['country_code' => 'GE'])->id;
            $model->city = 'Tbilisi';
            $model->address = \Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164']);
            $model->mobile = '000 00 00 00';
        }

        return $this->render('details1', [
            'order_price' => ($id) ? $order->price : '',
            'model' => $model,
            'countries' => Countries::find()->all(),
            'airportTransferPrices' => OrderActions::getAirportTransferPrices(),
            'rooms' => RoomsActions::getAvailableRoomsAll()
        ]);
    }

    public function actionSave() {
        $model = new OrdersModel();

        if ($model->load(\Yii::$app->request->post()) && $model->save() > 0)
            \Yii::$app->session->setFlash('success', 'ოპერაცია წარმატებით შესრულდა');
        else
            \Yii::$app->session->setFlash('error', 'დაფიქსირდა შეცდომა');

        return $this->redirect(['orders/']);
    }




    public function actionDetails($id) {
        $order = Orders::findOne(['id' => $id]);
        if (!$order)
            throw new NotFoundHttpException('Data not found');;

        return $this->render('details', [
            'order' => $order
        ]);
    }

    public function actionCancelOrder($id) {
        $order = Orders::findOne(['id' => $id]);
        if (!$order)
            throw new NotFoundHttpException('Data not found');

        if (OrderActions::removeOrder($id, $order->order_key))
            \Yii::$app->session->setFlash('success', 'ოპერაცია წარმატებით შესრულდა');
        else
            \Yii::$app->session->setFlash('error', 'დაფიქსირდა შეცდომა');

        return $this->redirect(['orders/']);
    }

}