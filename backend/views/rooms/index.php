<?php
use yii\bootstrap\Alert;
use yii\bootstrap\Html;
use yii\widgets\LinkPager;

$this->title = 'YourHomeHotel :: Admin Page';
?>

<?php if (\Yii::$app->session->hasFlash('success')): ?>
    <?=Alert::widget([
        'options' => [
            'class' => 'alert alert-success',
        ],
        'body' => \Yii::$app->session->getFlash('success'),
    ])?>
<?php endif; ?>
<?php if (\Yii::$app->session->hasFlash('error')): ?>
    <?=Alert::widget([
        'options' => [
            'class' => 'alert alert-danger',
        ],
        'body' => \Yii::$app->session->getFlash('error'),
    ])?>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover" style="margin-bottom: 0;">
                <thead>
                <tr>
                    <th>N</th>
                    <th><?=\Yii::t('order', 'First name')?></th>
                    <th><?=\Yii::t('order', 'Quantity')?></th>
                    <th><?=\Yii::t('order', 'Capacity')?></th>
                    <th><?=\Yii::t('order', 'Price')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($rooms as $room): ?>
                    <?php
                    switch(\Yii::$app->language) {
                        case 'ka-GE':
                            $room_name = $room->name_ge;
                            break;
                        case 'ru-RU':
                            $room_name = $room->name_ru;
                            break;
                        default:
                            $room_name = $room->name_us;
                    }
                    ?>
                    <tr>
                        <td><?=$room->id?></td>
                        <td><?=Html::a($room_name, ['rooms/details', 'id' => $room->id])?></td>
                        <td><?=$room->quantity?></td>
                        <td><?=$room->capacity?></td>
                        <td><?=$room->price?> GEL</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>