<?php
namespace backend\controllers;

use backend\models\rooms\RoomsModel;
use common\api\models\database\Rooms;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class RoomsController extends Controller {

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
                    'details' => ['get'],
                    'save' => ['post']
                ]
            ]
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    public function actionIndex() {
        return $this->render('index', [
            'rooms' => Rooms::find()->all()
        ]);
    }

    public function actionDetails($id) {
        $model = new RoomsModel();

        $room = Rooms::findOne(['id' => $id]);
        if (!$room)
            return $this->redirect(['rooms/']);

        $model->id = $room->id;
        $model->name_us = $room->name_us;
        $model->name_ge = $room->name_ge;
        $model->name_ru = $room->name_ru;
        $model->description_us = $room->description_us;
        $model->description_ge = $room->description_ge;
        $model->description_ru = $room->description_ru;
        $model->image = $room->image;
        $model->quantity = $room->quantity;
        $model->capacity = $room->capacity;
        $model->is_hostel = $room->is_hostel;
        $model->price = $room->price;
        $model->free_wifi = $room->free_wifi;
        $model->tv = $room->tv;
        $model->air_conditioning = $room->air_conditioning;
        $model->shared_bathroom = $room->shared_bathroom;
        $model->private_bathroom = $room->private_bathroom;
        $model->heating = $room->hairdrayer;
        $model->heating = $room->heating;
        $model->linen = $room->linen;
        $model->shared_kitchenette = $room->shared_kitchenette;
        $model->private_kitchenette = $room->private_kitchenette;
        $model->non_smoking = $room->non_smoking;
        $model->toiletries = $room->toiletries;
        $model->towels = $room->towels;
        $model->slippers = $room->slippers;

        return $this->render('details', [
            'model' => $model
        ]);
    }

    public function actionSave() {
        $model = new RoomsModel();
        if ($model->load(\Yii::$app->request->post()) && $model->save())
            \Yii::$app->session->setFlash('success', 'ოპერაცია წარმატებით შესრულდა');
        else
            \Yii::$app->session->setFlash('error', 'დაფიქსირდა შეცდომა');

        return $this->redirect(['rooms/']);
    }

}