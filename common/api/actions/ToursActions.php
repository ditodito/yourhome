<?php
namespace common\api\actions;

use common\api\models\database\Tours;
use common\api\models\database\ToursDurations;
use common\api\models\response\IdNamePair;
use common\api\models\response\ToursDetailsRow;
use common\api\models\response\ToursDurationsNavRows;
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
            $tour = new ToursRow($row['id'], $title, $row['image'], $row['image_large']);
            $tour->setDuration(\Yii::t('tours', $row->duration->name));
            $result[] = $tour;
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

        return new ToursDetailsRow($row['id'], $title, $text, $row['image'], $row['image_large']);
    }

    public static function getToursDurations() {
        $rows = ToursDurations::find()->all();
        $result = [];

        foreach($rows as $row) {
            $duration = new IdNamePair($row['id'], \Yii::t('tours', $row['name']));
            $result[] = $duration;
        }

        return $result;
    }

    public static function getToursDurationsNav() {
        $result = [];

        $durations = ToursDurations::find()->all();
        if (!$durations)
            return $result;

        foreach($durations as $duration) {
            $tours = [];

            foreach($duration->tours as $tour) {
                switch(\Yii::$app->language) {
                    case 'ka-GE':
                        $tour_name = $tour->title_ge;
                        break;
                    case 'ru-RU':
                        $tour_name = $tour->title_ru;
                        break;
                    default:
                        $tour_name = $tour->title_us;
                }
                $idn = new ToursRow($tour->id, $tour_name, $tour->image, $tour->image, $tour->image_large);
                $tours[] = $idn;
            }

            $tdnr = new ToursDurationsNavRows($duration['id'], \Yii::t('tours', $duration['name']), $tours);
            $result[] = $tdnr;
        }

        return $result;
    }

}