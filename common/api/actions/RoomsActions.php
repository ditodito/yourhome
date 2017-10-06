<?php
namespace common\api\actions;

use common\api\models\database\Rooms;
use common\api\models\response\IdNamePair;
use common\api\models\response\RoomsAvailableRow;
use common\api\models\response\RoomsRow;

class RoomsActions {

    public static function getRoomsTitle() {
        $rows = Rooms::find()->all();
        $result = [];

        foreach($rows as $row) {
            switch(\Yii::$app->language) {
                case 'ka-GE':
                    $name = $row['name_ge'];
                    break;
                case 'ru-RU':
                    $name = $row['name_ru'];
                    break;
                default:
                    $name = $row['name_us'];
            }
            $result[] = new IdNamePair($row['id'], $name);
        }

        return $result;

    }

    public static function getRooms() {
        $rows = Rooms::find()->all();
        $result = [];

        foreach($rows as $row) {
            $result[] = new RoomsRow($row);
        }

        return $result;
    }

    public static function getAvailableRooms($start_date, $end_date) {
        $sql = "SELECT * FROM (
                    SELECT {{r}}.[[id]], {{r}}.[[name_us]], {{r}}.[[name_ge]], {{r}}.[[name_ru]], {{r}}.[[capacity]], {{r}}.[[price]],
                    ({{r}}.[[capacity]] - IFNULL((
                      SELECT SUM([[capacity]])
                      FROM {{orders}}
                      WHERE [[room_id]] = {{r}}.[[id]] AND [[status]] = 1
                        AND (([[start_date]] <= :start_date AND [[end_date]] >= :start_date)
                        OR ([[start_date]] <= :end_date AND [[end_date]] >= :end_date))
                    ), 0))
                    [[available_rooms]]
                    FROM {{rooms}} {{r}}
                ) {{t}} WHERE {{t}}.[[available_rooms]] > 0";
        $rows = \Yii::$app->db->createCommand($sql, [':start_date' => $start_date, ':end_date' => $end_date])->queryAll();
        $result = [];

        foreach($rows as $row) {
            $result[] = new RoomsAvailableRow($row);
        }

        return $result;
    }

}