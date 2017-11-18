<?php
namespace backend\controllers;

use common\api\actions\OrderActions;
use common\api\models\database\Orders;
use yii\data\Pagination;
use yii\filters\AccessControl;
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
                ],
            ]
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
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
            throw new NotFoundHttpException('Data not found');;

        if (OrderActions::removeOrder($id, $order->order_key))
            \Yii::$app->session->setFlash('success', 'ოპერაცია წარმატებით შესრულდა');
        else
            \Yii::$app->session->setFlash('error', 'დაფიქსირდა შეცდომა');

        return $this->redirect(['orders/']);
    }

}