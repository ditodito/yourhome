<?php
use yii\bootstrap\Html;
?>

<div class="row">
    <div class="col-md-12">
        <?php if ($status == 1): ?>
            შეკვეთა წარმატებით დაემატა
        <?php elseif ($status == 2): ?>
            შეკვეთა ვერ დაემატა
        <?php elseif ($status == 3): ?>
            თქვენი შეკვეთა გაუქმებულია
        <?php elseif ($status == 4): ?>
            შეკვეთის გაუქმება ვერ მოხეხდა
        <?php endif; ?>
        <p><?=Html::a('gadasvla mtavar gverdze', ['site/'])?></p>
    </div>
</div>