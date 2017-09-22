<?php
namespace common\api\actions;

use common\api\models\database\Tours;
use common\api\models\response\ToursDetailsRow;
use common\api\models\response\ToursRow;

class ToursActions {

    public static function getTours() {
        $rows = Tours::find()->all();
        $result = [];

        foreach($rows as $row) {
            $result[] = new ToursRow($row['id'], $row['title_'.\Yii::$app->language], $row['image']);
        }

        return $result;
    }

    public static function getTour($id) {
        $row = Tours::findOne(['id' => $id]);
        if (!$row)
            return null;
        return new ToursDetailsRow($row['id'], $row['title_'.\Yii::$app->language], $row['text_'.\Yii::$app->language], $row['image']);
    }

}