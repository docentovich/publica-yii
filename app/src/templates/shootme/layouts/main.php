<?php
/**
 * @var string $content
 */

use app\templates\shootme\Asset;
use app\templates\shootme\AssetIE9;

$bundle = Asset::register($this);
AssetIE9::register($this);

$baseTemplate = new \app\templates\BaseTemplate($this, $bundle);
?>

<?php \app\widgets\header\Header::begin([
    "project" => yii\helpers\ArrayHelper::getValue(\Yii::$app->params, 'projects.shootme.name')
]); ?>
    <div class="overlay" id="service-menu-overlay">
        <div class="service-overlay-wrapper">
            <div id="sidebar-menu" class="is-active">
                <ul class="shootme-menu">
                    <li>
                        <?= \yii\helpers\Html::a(
                            \Yii::t('app/shootme', 'What will be'),
                            \yii\helpers\Url::to('/')
                        ); ?>
                    </li>
                    <li>
                        <?= \yii\helpers\Html::a(
                            \Yii::t('app/shootme', 'What was'),
                            \yii\helpers\Url::to('/past')
                        ); ?>
                    </li>
                    <li>
                        <span id="calendar-href"><?= \Yii::t('app', 'Calendar') ?></span>
                    </li>
                </ul>
            </div>

            <div id="sidebar-calendar">
                <div id="calendar-back"><i class="fa fa-long-arrow-left" id=""></i></div>
                <div class="datepicker-wrapper" data-provide="datepicker"></div>
            </div>
        </div>
    </div>
<?php \app\widgets\header\Header::end(); ?>

    <div class="content-wrapper">
        <div class="content">
            <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
            <?= $content; ?>
        </div>
    </div>
<?= $baseTemplate->end(); ?>