<?php
use api\actions\RoomsActions;
use frontend\assets\RoomsAsset;
use yii\helpers\Html;

RoomsAsset::register($this);

$this->title = 'YourHome :: '.\Yii::t('menu', 'Rooms & Rates');
?>

<?php for($i = 0; $i < 3; $i++): ?>
    <div class="row" style="border: 1px solid #ccc; margin-bottom: 50px;">
        <div class="col-md-5">
            <div class="room-image" style="background: red">
                <?=Html::img(\Yii::getAlias('@web/img/test_images_rooms.jpg'), ['alt' => 'Image'])?>
            </div>
            <div class="room-include">Free Wifi</div>
            <div class="room-include">Free Wifi</div>
            <div class="room-include">Free Wifi</div>
            <div class="room-include">Free Wifi</div>
            <div class="room-include">Free Wifi</div>
            <div class="room-include">Free Wifi</div>
            <div class="room-include">Free Wifi</div>
            <div class="room-include">Free Wifi</div>
        </div>
        <div class="col-md-7">
            <h5 class="room-title">One Bunk Bed in Hostal Mixed Room</h5>
            <div class="room-capacity">Max: 8</div>
            <div class="room-description">
                Note: Everything outside a flex container and inside a flex item is rendered as usual. Flexbox defines how flex items are laid out inside a flex container.
                Flex items are positioned inside a flex container along a flex line. By default there is only one flex line per flex container.
                The following example shows three flex items. They are positioned by default: along the horizontal flex line, from left to right:
            </div>
            <div class="room-capacity">9 E</div>
            <div class="room-capacity">Included 10% VAT</div>

            <div class="room-exclude">Not included</div>
            <div class="room-exclude">* Towlers (extra free)</div>
            <div class="room-exclude" style="margin-bottom: 15px;">* Toiletries (extra free)</div>

            <div class="room-exclude">Flexible rate</div>
            <div class="room-exclude">- Free cancellation before 24h</div>
            <div class="room-exclude">- Payment at the hotel</div>
        </div>
    </div>
<?php endfor; ?>
