<?php
/**
 * @var string $content
 */


use app\templates\probank\Asset;
use app\templates\probank\AssetIE9;

$bundle = Asset::register($this);
AssetIE9::register($this);

$baseTemplate = new \app\templates\BaseTemplate($this, $bundle);
?>

<?php \app\widgets\header\Header::begin([
    "project" => yii\helpers\ArrayHelper::getValue(\Yii::$app->params, 'projects.probank.name')
]); ?>
    <div class="overlay" id="service-menu-overlay">
        <div class="service-overlay-wrapper">
            <div id="sidebar-menu" class="is-active">
                <ul class="probank-menu">
                    <li>
                        <?= \yii\helpers\Html::a(
                            \Yii::t('app/probank', 'All'),
                            \yii\helpers\Url::to(['front-specialists/index'])
                        ); ?>
                    </li>

                    <?php foreach (\app\models\Portfolio::getTypesLabels() as $key => $labelEn) { ?>

                        <li>
                            <?= \yii\helpers\Html::a(
                                \Yii::t('app/probank', $labelEn),
                                \yii\helpers\Url::to(['front-specialists/type', 'type' => strtolower( $key )])
                            ); ?>
                        </li>

                    <?php } ?>


                </ul>
            </div>

            <div id="sidebar-calendar">
                <div id="calendar-back"><i class="fas fa-long-arrow-alt-left" id=""></i></div>
                <div class="div-datepicker" data-provide="datepicker"></div>
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