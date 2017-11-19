<?php
use yii\bootstrap\Alert;
use yii\bootstrap\Html;

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
    <?php foreach($tours as $tour): ?>
        <div class="col-md-3 col-sm-4">
            <?=Html::img('@frontend_web/img/tours/'.$tour->image, [
                'class' => 'img-responsive img-rounded',
                'style' => 'width: 100%; height: 160px',
                'alt' => $tour->title
            ])?>
            <p class="text-center"><?=Html::a($tour->title, ['tours/details', 'id' => $tour->id])?></p>
        </div>
    <?php endforeach; ?>
</div>

