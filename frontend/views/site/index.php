<?php
use frontend\assets\IndexAsset;
use yii\bootstrap\Html;

IndexAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Home');
?>

<div class="row">
    <div class="col-md-4">
        <div class="index-info">
            <h5><?=\Yii::t('contacts', 'Access Map')?></h5>
            <div id="map"></div>
        </div>

        <div class="contact-info">
            <div class="index-info">
                <h5><?=\Yii::t('contacts', 'Address')?>:</h5>
                <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
            </div>

            <div class="index-info">
                <h5><?=\Yii::t('contacts', 'Metro')?>:</h5>
                <div>
                    <?=\Yii::t('contacts', 'Line {0}', ['I'])?>, <?=\Yii::t('contacts', 'Station Marjanishvili')?><br />
                    <?=\Yii::t('contacts', 'Open hours - {0} (6am-12am)', ['06:00-24:00'])?>
                </div>
            </div>

            <div class="index-info">
                <h5><?=\Yii::t('contacts', 'Bus')?>:</h5>
                <div>N122, <?=\Yii::t('contacts', 'Station Tsinamdzghvrishvili')?></div>
            </div>

            <div class="index-info">
                <h5 class="text-capitalize"><?=\Yii::t('contacts', 'How to reach the hotel from airport')?>:</h5>
                <div>
                    - <?=\Yii::t('contacts', 'Hotel-airport shuttle')?> (<?=Html::a(\Yii::t('contacts', 'upon request'), ['/site/services'])?>)<br />
                    - <?=\Yii::t('contacts', 'Taxi')?><br />
                    - <?=\Yii::t('contacts', 'Bus')?>: <?=\Yii::t('contacts', 'Public Transport N{0}, Station Queen Tamar Ave', ['37'])?>
                </div>
            </div>

            <div class="index-info">
                <h5><?=\Yii::t('menu', 'Contacts')?>:</h5>
                <div>
                    <?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>: (+995 32) 221 00 00<br />
                    <?=\Yii::t('contacts', 'Cell')?>: (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Chief manager')?>)<br />
                    <?=\Yii::t('contacts', 'E-mail')?>: <?=\Yii::$app->params['infoEmail']?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 about">
        <div class="index-info">
            <h5 style="margin-bottom: 20px;"><?=\Yii::t('main', 'About Hotel')?></h5>
            <div>
                <?php if (\Yii::$app->language == 'ka-GE'): ?>
                    <p>სასტუმრო "შენი სახლი" მდებარეობს თბილისის უძველეს და უმშვენიერეს რაიონში ჩუღურეთში. ქუჩა ცალმხრივია და მშვიდი.</p>
                    <p>აღმაშენებლის გამზირიდან სასტუმრო მხოლოდ 4 წუთის სავალზეა ფეხით. ეს უძველესი გამზირი გამოირჩევა თავისი დინამიურობით,
                        ტრადიციული რესტორნებით, სუპერმარკეტებით და  მაღაზიებით.</p>
                    <p>მეტრო სადგული მარჯანიშვილი მხოლოდ 700 მეტრით არის დაშორებული სასტუმროდან. თბილისის ცენტრი (რუსთაველის გამზირი) 24 წუთის სავალზეა ფეხით.
                        ცენტრალური რკინიგზის სადგური 13 წუთის სავალზეა ფეხით. რკინიგზის სადგური ასევე აეროპორტის ავტობუსის ბოლო გაჩერებაა</p>
                    <p>სასტუმროში არის: უფასო პარკინგი წინვე (მხოლოდ დაჯავშნით და შესაძლებლობის ფარგლებში). უფასო WiFi, საერთო სამზარეულო მაცივრით, მიკროღუმელით, ელექტროქურით.</p>
                    <p>ყველა ოთახი და მთლიანად სასტუმროს ტერიტორია არა მწეველია, ძალიან წყნარი მდებარეობით. საწოლები არის ფართო და კომფორტული. ზოგ ოთახს აქვს საკუთარი აბაზანა და სამზარეულო.</p>
                    <p>24 საათიანი მიმღები გთავაზობთ ბარგის შენახვას.</p>
                    <p>
                        <b>- შემოსვლა:</b> 14:00 სთ–დან<br />
                        <b>- გასვლა:</b> 12:00 სთ–მდე<br />
                    </p>
                    <p>სასტუმრო "შენი სახლი" გელით!</p>
                <?php elseif(\Yii::$app->language == 'ru-RU'):?>
                    <p>Отель "YourHome" расположен в очаровательном старом районе Чугурети. Улица односторонняя и спокойная.</p>
                    <p>Отель находится всего в 4 минутах ходьбы от проспекта Агмашенебели - старого оживленного бульвара, в котором есть традиционные рестораны, супермаркеты и магазины.
                        Станция метро Марджанишвили находится всего в 700 метрах. Центр Тбилиси (проспект Руставели) находится в 24 минутах ходьбы.
                        Центральный железнодорожный вокзал находится в 13 минутах ходьбы - это также автобусный терминал до аэропорта.</p>
                    <p>Особенности отеля: БесплатныйWi-Fi, общая кухня с холодильником, микроволновой печью и плитой..
                        Бесплатная частная парковка находится прямо напротив отеля (только при бронировании в зависимости от наличия).</p>
                    <p>Все наши номера и территория гостиницы очень спокойные и предназначены для некурящих. Кровати большие и удобные. В некоторых номерах есть отдельная мини-кухня.</p>
                    <p>На стойке регистрации есть камера хранения багажа. Открыто 24/7.</p>
                    <p>
                        <b>- Регистрация заезда:</b> с 14:00 (2:00 PM)<br />
                        <b>- Отъезд:</b> до 12:00 (в полдень)<br />
                    </p>
                    <p>Отель «YourHome» приветствует вас!</p>
                <?php else: ?>
                    <p>Hotel "Your Home" is located in a charming old district Chugureti. The street is one-way and quiet.</p>
                    <p>Hotel is within only 4-minute walk from Aghmashenebeli Avenue - an old lively avenue full of traditional restaurants,
                        supermarkets and shops. Metro Station Marjanishvili is only 700 m away. Tbilisi center (Rustaveli avenue) is within 24-minute walk.
                        Central railway station is within 13-minute walk - this is also the bus terminal to the airport.</p>
                    <p>Hotel features: Free WiFi, shared Kitchenette with Refrigerator, Microwave and Stovetop.
                        Free private parking is just in front of the hotel (only with reservation based on availability).</p>
                    <p>All our rooms and hotel area are non-smoking, very quiet. The beds are large and comfortable. Some of our rooms have the private kitchenette.</p>
                    <p>Front desk offers luggage storage. Open 24/7.</p>
                    <p>
                        <b>- Check-in:</b> From 14:00 (2:00 PM)<br />
                        <b>- Check-out:</b> Until 12:00 (noon)<br />
                    </p>
                    <p>The Hotel "Your Home" welcomes you!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="index-info">
            <h5><?=\Yii::t('main', 'Facilities')?></h5>
            <div>
                - <?=\Yii::t('main', 'Free')?> WiFi<br />
                - <?=\Yii::t('services', 'Free private parking')?> (<?=Html::a(\Yii::t('contacts', 'upon request'), ['site/services'])?>)<br />
                - <?=\Yii::t('services', '24-hour front desk')?><br />
                - <?=\Yii::t('services', 'Luggage storage')?><br />
                - <?=\Yii::t('main', 'Kitchenette')?><br />
                - <?=\Yii::t('services', 'Airport transfer')?> (<?=Html::a(\Yii::t('contacts', 'upon request'), ['site/services'])?>)
            </div>
            <?=Html::a(\Yii::t('main', 'More').'...', ['site/services'], ['class' => 'more'])?>
        </div>
        <div class="index-info">
            <h5><?=\Yii::t('menu', 'Our Tours')?></h5>
            <div>
                <?=Html::img(\Yii::getAlias('@web/img/our_tours.jpg'), [
                    'class' => 'img-rounded img-responsive',
                    'alt' => \Yii::t('menu', 'Our Tours')
                ])?>
                <?=\Yii::t('tours', 'Discover Georgia with us, we organize the different excursions')?>
            </div>
            <?=Html::a(\Yii::t('main', 'More').'...', ['tours/'], ['class' => 'more'])?>
        </div>
    </div>
</div>
