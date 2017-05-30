<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use templates\main\backend\BackendAsset;
use app\components\Header;

$bundle = BackendAsset::register($this);
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="pageload no-js">
    <?php $this->beginBody() ?>
    <? echo \components\widgets\header\Header::widget(["logo" => "publica"]); ?>


    <div class="row-eq-height-sm">
        <?php require_once "parts/header.php"; ?>

        <!-- content -->
        <div class="col-sm-10 col-xs-12 no-padding row-eq-height-sm">
            <div class="content">
                <div class="content__content-inner">
                    <div class="content-page">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
        <!--/ content -->

    </div>

    <?php require_once "parts/footer.php"; ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>