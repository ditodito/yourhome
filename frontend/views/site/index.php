<?php
use frontend\assets\IndexAsset;
use yii\bootstrap\Html;

IndexAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Home');
?>

<div class="row">
    <div class="col-md-4 form-group">
        <h4 class="title"><?=\Yii::t('contacts', 'Access Map')?></h4>
        <div id="map"></div>

        <div class="contact-info">
            <h4 class="title"><?=\Yii::t('contacts', 'Address')?>:</h4>
            <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', [95, 0164])?></div>

            <h4 class="title"><?=\Yii::t('contacts', 'Metro')?>:</h4>
            <div><?=\Yii::t('contacts', 'Line I, Station Marjanishvili. Open hours - 06:00-24:00 (6am-12am)')?></div>

            <h4 class="title"><?=\Yii::t('contacts', 'Bus')?>:</h4>
            <div>N122, <?=\Yii::t('contacts', 'Station Tsinamdzghvrishvili')?></div>

            <h4 class="title"><?=\Yii::t('contacts', 'Tel')?>:</h4>
            <div>(+995 55) 58 48 08</div>

            <h4 class="title"><?=\Yii::t('contacts', 'E-mail')?>:</h4>
            <div>yourhometbilisi@yahoo.com</div>
        </div>
    </div>
    <div class="col-md-5 form-group about">
        <h4 class="title"><?=\Yii::t('main', 'About Hotel')?></h4>

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
                supermarkets and shops. Metro Station Marjanishvili is only 700 m away. Tbilisi center (Rustaveliavenue) is within 24-minute walk.
                Central railway station is within 13-minute walk - this is also the bus terminal to the airport.</p>
            <p>Hotel features: Free WiFi, shared Kitchenette with Refrigerator, Microwave and Stovetop.
                Free private parking is just in front of the hotel (only with reservation based on availability).</p>
            <p>All our rooms and hotel area are non-smoking,very quiet. The beds are large and comfortable. Some of our rooms have the private kitchenette.</p>
            <p>Front desk offers luggage storage. Open 24/7.</p>
            <p>
                <b>- Check In:</b> From 14:00 (2:00 PM)<br />
                <b>- Check Out:</b> From 14:00 (2:00 PM)<br />
            </p>
            <p>The Hotel "Your Home" welcomes you!</p>
        <?php endif; ?>
    </div>
    <div class="col-md-3 form-group">
        <h4 class="title"><?=\Yii::t('main', 'Facilities')?></h4>
        <div><?=\Yii::t('main', 'Free')?> WiFi</div>
        <div><?=\Yii::t('services', 'Free private parking')?></div>
        <div><?=\Yii::t('services', '24-hour front desk')?></div>
        <div><?=\Yii::t('services', 'Luggage storage')?></div>
        <div><?=\Yii::t('main', 'Kitchenette')?></div>
        <div><?=\Yii::t('services', 'Airport transfer(upon request)')?></div>
        <div class="more"><?=Html::a(\Yii::t('main', 'more').'...', ['/site/services'])?></div>

        <h4 class="title" style="margin-top: 20px;"><?=\Yii::t('menu', 'Our Tours')?></h4>
        <div><?=\Yii::t('tours', 'Discover Georgia with us, we organize the different excursions')?></div>
        <div class="more"><?=Html::a(\Yii::t('main', 'more').'...', ['/more'])?></div>
    </div>
</div>
