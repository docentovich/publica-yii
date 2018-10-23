<?php
/**
 * @var string $content
 */

$bundle = \app\assets\BackendAsset::register($this);

$this->beginPage(); ?>
    <html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= \yii\helpers\Html::csrfMetaTags() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?= \yii\helpers\Html::encode($this->title) ?></title>
        <!-- CDN-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
              integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
              crossorigin="anonymous"/>
        <!-- --CDN---->
        <?php $this->head() ?>
    </head>
    <body class="pageload">
    <?php $this->beginBody() ?>

    <?php \app\widgets\header\Header::begin(["project" => "tosee"]); ?>
    <div class="overlay overlay--user-panel" id="service-menu-overlay">
        <div class="service-overlay-wrapper">
            <ul class="user-panel-menu">
                <li><a href="/profile.html">Профиль</a></li>
                <li><a href="/my/comments.html">Мои комментарии</a></li>
                <li><a href="/my/orders.html">Мои заказы</a></li>
                <li><a href="/my/calendar.html">Мой календарь</a></li>
                <li><a href="/my/rating.html">Мой рейтинг</a></li>
                <li><a href="/roles/journalist.html">Журналист</a></li>
                <li><a href="/roles/model.html">Модель</a></li>
                <li><a href="/roles/photographer.html">Фотораф</a></li>
            </ul>
            <a class="feedback" href="#"><span>Обратная связь</span><span
                        class="small">(сообщение в администрацию сайта)</span></a>
        </div>
    </div>
    <?php \app\widgets\header\Header::end(); ?>

    <div class="content-wrapper">
        <div class="content"><?= $content ?>?</div>
    </div>
    <!-- CDN-->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <!-- --CDN---->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>