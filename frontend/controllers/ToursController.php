<?php
namespace frontend\controllers;

use common\api\actions\ToursActions;
use common\controllers\YourHomeController;
use yii\web\NotFoundHttpException;

class ToursController extends YourHomeController {

    public function actionIndex() {
        $this->layout = 'tours';
        $this->view->params['tours_durations'] = ToursActions::getToursDurationsNav(); // send data from controller to tours layout
        $this->view->params['header_image'] = 'header_tours.jpg';

        return $this->render('index', [
            'tours' => ToursActions::getTours()
        ]);
    }

    public function actionDetails($id) {
        $tour = ToursActions::getTour($id);
        if (!$tour)
            throw new NotFoundHttpException('Data not found');

        $this->layout = 'tours';
        $this->view->params['tours_durations'] = ToursActions::getToursDurationsNav(); // send data from controller to tours layout
        $this->view->params['header_image'] = 'tours/'.$tour->image_large;

        return $this->render('details', [
            'tour' => $tour
        ]);
    }

}