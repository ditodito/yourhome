<?php
?>

<div class="row">
    <div class="col-md-3">
        <div style="background-color: #a7d47b; padding: 10px;">
            Your price summary
            <div style="margin-top: 10px; font-weight: bold;">
                Price <span style="float: right;">GEL <?=$price?></span>
            </div>
        </div>
        <div style="background-color: #e8f4dc; margin-bottom: 40px; padding: 10px;">
            <div style="margin-bottom: 20px; font-weight: bold;">
                18 % VAT <span style="float: right;">Included</span>
            </div>
            <div>Free cancellation 24h before arrival *</div>
            <div>Payment at the hotel</div>
        </div>
        <div style="border: 1px solid #e8f4dc; padding: 10px; font-weight: bold;">
            <p>
                Check In:<br />
                - From 14:00 (PM 2:00)
            </p>
            <p>
                Check Out:<br />
                - Until 12:00 (noon)
            </p>
        </div>
    </div>

    <div class="col-md-9">
        <h4 style="margin-top: 0;">Availability</h4>
        <div style="background-color: #e8f4dc; padding: 30px; display: flex; width: 100%; font-weight: bold;">
            <div style="width: 25%;">
                <span class="small">Check In Date:</span><br />
                <span style="color: #8bc652;" class=""><?=$check_in?></span>
            </div>
            <div style="width: 25%;">
                <span class="small">Check Out Date:</span><br />
                <span style="color: #8bc652"><?=$check_out?></span>
            </div>
            <div style="width: 25%;">
                (<?=$days?>-night stay)
            </div>
            <div style="width: 25%;">4</div>
        </div>

        <table class="table" style="margin-top: 30px;">
            <thead>
                <tr style="background-color: #aed786">
                    <th style="border-bottom: 5px solid #fff;">Room type</th>
                    <th style="background-color: #8bc652;border-bottom: 5px solid #fff;">Price</th>
                    <th style="border-bottom: 5px solid #fff;">Select rooms</th>
                    <th style="border-bottom: 5px solid #fff;">Confirm</th>
                </tr>
            </thead>
            <?php foreach($available_rooms as $room): ?>
                <tbody>
                    <tr style="background-color: #e8f4dc;">
                        <td style="border-bottom: 3px solid #fff;"><?=$room->name_us?></td>
                        <td style="border-bottom: 3px solid #fff; border-right: 1px solid #8bc652; border-left: 1px solid #8bc652;"><?=$room->price?></td>
                        <td style="border-bottom: 3px solid #fff;"><?=$room->id?></td>
                        <td style="border-bottom: 3px solid #fff;"><?=$room->available_rooms?></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</div>