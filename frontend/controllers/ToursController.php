<?php
namespace frontend\controllers;

use common\api\actions\ToursActions;
use common\controllers\YourHomeController;
use yii\web\NotFoundHttpException;

class ToursController extends YourHomeController {

    public function actionIndex() {
        $this->layout = 'tours';
        $this->view->params['tours_durations'] = ToursActions::getToursDurationsNav(); // send data from controller to tours layout

        return $this->render('index', [
            'tours' => ToursActions::getTours()
        ]);
    }

    public function actionDetails($id) {
        $this->layout = 'tours';
        $this->view->params['tours_durations'] = ToursActions::getToursDurationsNav(); // send data from controller to tours layout

        $tour = ToursActions::getTour($id);
        if (!$tour) {
            throw new NotFoundHttpException('Data not found');
        }

        return $this->render('details', [
            'tour' => $tour
        ]);
    }

}