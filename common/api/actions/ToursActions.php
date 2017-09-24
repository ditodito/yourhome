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
            switch(\Yii::$app->language) {
                case 'ka-GE':
                    $title = $row['title_ge'];
                    break;
                case 'ru-RU':
                    $title = $row['title_ru'];
                    break;
                default:
                    $title = $row['title_us'];
            }
            $result[] = new ToursRow($row['id'], $title, $row['image']);
        }

        return $result;
    }

    public static function getTour($id) {
        $row = Tours::findOne(['id' => $id]);
        if (!$row)
            return null;

        switch(\Yii::$app->language) {
            case 'ka-GE':
                $title = $row['title_ge'];
                $text = $row['text_ge'];
                break;
            case 'ru-RU':
                $title = $row['title_ru'];
                $text = $row['text_ru'];
                break;
            default:
                $title = $row['title_us'];
                $text = $row['text_us'];
        }

        return new ToursDetailsRow($row['id'], $title, $text, $row['image']);
    }

}