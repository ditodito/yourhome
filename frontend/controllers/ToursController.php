<?php
namespace frontend\controllers;

use common\api\actions\ToursActions;
use common\controllers\YourHomeController;
use yii\web\NotFoundHttpException;

class ToursController extends YourHomeController {

    public function actionIndex() {
        $this->layout = 'side';

        return $this->render('index', [
            'tours' => ToursActions::getTours()
        ]);
    }

    public function actionDetails($id) {
        $this->layout = 'side';

        $tour = ToursActions::getTour($id);
        if (!$tour) {
            throw new NotFoundHttpException('Data not found');
        }

        return $this->render('details', [
            'tour' => $tour
        ]);
    }

}