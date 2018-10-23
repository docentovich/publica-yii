<?php

use yii\helpers\Html;
use app\assets\BackendAsset;

$bundle = BackendAsset::register($this);
?>
<?php $this->beginPage(); ?>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- CDN-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
              integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
              crossorigin="anonymous"/>
        <!-- --CDN---->
        <?php $this->head() ?>
    </head>
    <body class="pageload">
    <?php $this->beginBody() ?>

    <?php \app\widgets\header\Header::begin(["bundle" => $bundle]); ?>
    <div class="overlay" id="service-menu-overlay">
        <div class="service-overlay-wrapper">
            <ul class="tosee-menu">
                <li>Что было?</li>
                <li>Что будет?</li>
                <li>Календарь</li>
            </ul>
        </div>
    </div>
    <?php \app\widgets\header\Header::end(); ?>

    <div class="content">
        <div class="login">
            <div class="login-form">
                <?= $content ?>
            </div>
        </div>
    </div>
    <!-- CDN-->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js" integrity="sha256-tW5LzEC7QjhG0CiAvxlseMTs2qJS7u3DRPauDjFJ3zo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.ru.min.js" integrity="sha256-iGDUwn2IPSzlnLlVeCe3M4ZIxQxjUoDYdEO6oBZw/Go=" crossorigin="anonymous"></script>
    <!-- --CDN---->
    <!-- --CDN---->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>