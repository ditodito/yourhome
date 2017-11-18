<?php
use yii\bootstrap\Alert;
use yii\bootstrap\Html;
use yii\widgets\LinkPager;

$this->title = 'YourHomeHotel :: Admin Page';

$formatter = \Yii::$app->formatter;
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
    <div class="col-md-12 form-group">
        <?=Html::beginForm(['orders/index'], 'get', ['class' => 'form-inline'])?>
            <?=Html::dropDownList('status', $status, [1 => 'აქტიური', 2 => 'გაუქმებული'], ['prompt' => 'სტატუსი', 'class' => 'form-control'])?> &nbsp;
            <?=Html::input('text', 'id', $id, ['placeholder' => \Yii::t('order', 'Reservation number'), 'class' => 'form-control'])?> &nbsp;
            <?=Html::submitButton(\Yii::t('main', 'Search'), ['class' => 'btn btn-primary'])?>
        <?=Html::endForm()?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>N</th>
                        <th><?=\Yii::t('order', 'First name')?></th>
                        <th><?=\Yii::t('order', 'Last name')?></th>
                        <th><?=\Yii::t('contacts', 'E-mail')?></th>
                        <th><?=\Yii::t('order', 'Country')?></th>
                        <th><?=\Yii::t('order', 'City')?></th>
                        <th><?=\Yii::t('contacts', 'Address')?></th>
                        <th><?=\Yii::t('order', 'Mobile')?></th>
                        <th><?=\Yii::t('order', 'Check in')?></th>
                        <th><?=\Yii::t('order', 'Check out')?></th>
                        <th><?=\Yii::t('order', 'Order date')?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($orders as $order): ?>
                    <tr class="<?=($order->status == 1) ? 'active' : 'danger'?>">
                        <td><?=$order->id?></td>
                        <td><?=Html::a($order->first_name, ['orders/details', 'id' => $order->id])?></td>
                        <td><?=$order->last_name?></td>
                        <td><?=$order->email?></td>
                        <td><?=$order->country->country_name?></td>
                        <td><?=$order->city?></td>
                        <td><?=$order->address?></td>
                        <td><?=$order->mobile?></td>
                        <td><?=$formatter->asDate($order->start_date, 'php:d/m/Y')?></td>
                        <td><?=$formatter->asDate($order->end_date, 'php:d/m/Y')?></td>
                        <td><?=$formatter->asDatetime($order->created, 'php:d/m/Y H:i')?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?=LinkPager::widget(['pagination' => $pagination])?>
    </div>
</div>
