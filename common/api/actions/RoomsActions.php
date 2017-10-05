<?php
namespace common\api\actions;

use common\api\models\database\Rooms;
use common\api\models\response\IdNamePair;
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
        //print_r($start_date);
        $sql = "SELECT * FROM (
                    SELECT {{r}}.[[id]], {{r}}.[[name_us]], {{r}}.[[name_ge]], {{r}}.[[name_ru]], {{r}}.[[price]],
                    ({{r}}.[[capacity]] - IFNULL((SELECT SUM([[capacity]]) FROM {{orders}} WHERE [[room_id]] = {{r}}.[[id]]), 0)) [[available_rooms]]
                    /*({{r}}.[[capacity]] - [[capacity1]]) [[capacity2]]*/
                    FROM {{rooms}} {{r}}
                    WHERE {{r}}.[[id]] NOT IN (0
                     /* SELECT {{o}}.[[room_id]] FROM {{orders}} {{o}} WHERE {{o}}.[[start_date]] < :start_date
                        AND {{o}}.[[end_date]] > :start_date AND {{o}}.[[status]] = 1*/
                        /*AND ({{r}}.[[capacity]] - {{o}}.[[capacity]]) = 0*/
                    )
                ) {{t}} WHERE {{t}}.[[available_rooms]] > 0";

        /*$sql = "SELECT {{r}}.[[name_us]], {{r}}.[[name_ge]], {{r}}.[[name_ru]], {{r}}.[[price]], {{o}}.[[id]],
                  ({{r}}.[[capacity]] - IFNULL({{o}}.[[capacity]], 0)) AS [[capacity]]
                FROM {{rooms}} {{r}}
                LEFT JOIN {{orders}} {{o}} ON {{o}}.[[room_id]] = {{r}}.[[id]]
                  AND (({{o}}.[[start_date]] < :start_date AND {{o}}.[[end_date]] > :start_date)
                  OR ({{o}}.[[end_date]] > :end_date AND {{o}}.[[start_date]] < :end_date))
                  AND {{o}}.[[status]] = 1
                WHERE ({{r}}.[[capacity]] - IFNULL({{o}}.[[capacity]], 0)) > 0
                GROUP BY {{r}}.[[id]]
                ";*/

        $rows = \Yii::$app->db->createCommand($sql, [':start_date' => $start_date, ':end_date' => $end_date])->queryAll(\PDO::FETCH_OBJ);
        return $rows;
    }

}