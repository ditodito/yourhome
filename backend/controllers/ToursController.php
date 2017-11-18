<?php
namespace backend\controllers;

use backend\models\tours\ToursModel;
use common\api\actions\ToursActions;
use common\api\models\database\Tours;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ToursController extends Controller {

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

    public function actionIndex() {
        return $this->render('index', [
            'tours' => ToursActions::getTours()
        ]);
    }

    public function actionDetails($id) {
        $model = new ToursModel();

        $tour = Tours::findOne(['id' => $id]);
        if (!$tour)
            throw new NotFoundHttpException('Data not found');

        $model->id = $tour->id;
        $model->duration_id = $tour->duration_id;
        $model->title_us = $tour->title_us;
        $model->title_ge = $tour->title_ge;
        $model->title_ru = $tour->title_ru;
        $model->text_us = $tour->text_us;
        $model->text_ge = $tour->text_ge;
        $model->text_ru = $tour->text_ru;
        $model->image = $tour->image;

        return $this->render('details', [
            'model' => $model,
            'durations' => ToursActions::getToursDurations()
        ]);
    }

    public function actionSave() {
        $model = new ToursModel();
        if ($model->load(\Yii::$app->request->post()) && $model->save())
            \Yii::$app->session->setFlash('success', 'ოპერაცია წარმატებით შესრულდა');
        else
            \Yii::$app->session->setFlash('error', 'დაფიქსირდა შეცდომა');

        return $this->redirect(['tours/']);
    }

}