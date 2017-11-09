<?php
use yii\bootstrap\Html;
?>

<div class="row">
    <div class="col-md-12">
        <?php if ($status == 1): ?>
            Yes
        <?php else: ?>
            no
        <?php endif; ?>
        <p><?=Html::a('gadasvla mtavar gverdze', ['site/'])?></p>
    </div>
</div>