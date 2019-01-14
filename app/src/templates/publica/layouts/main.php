<?php
/**
 * @var string $content
 */

use app\templates\publica\Asset;
use app\templates\publica\AssetIE9;

$bundle = Asset::register($this);
AssetIE9::register($this);

$baseTemplate = new \app\templates\BaseTemplate($this, $bundle);
?>

<?php \app\widgets\header\Header::begin([
    "project" => yii\helpers\ArrayHelper::getValue(\Yii::$app->params, 'projects.publica.name')
]); ?>
<?php \app\widgets\header\Header::end(); ?>

    <div class="content-wrapper">
        <div class="content">
            <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
            <div class="portals">
                <div class="portal">
                    <?= \yii\helpers\Html::a(
                            \yii\helpers\Html::img($bundle->baseUrl . '/images/logo-base/tosee.svg'),
                            \yii\helpers\ArrayHelper::getValue(\Yii::$app->params, 'projects.tosee.url')
                    ) ?>
                </div>
                <div class="portal">
                    <?= \yii\helpers\Html::a(
                        \yii\helpers\Html::img($bundle->baseUrl . '/images/logo-base/probank.svg'),
                        \yii\helpers\ArrayHelper::getValue(\Yii::$app->params, 'projects.probank.url')
                    ) ?>
                </div>
                <div class="portal">
                    <?= \yii\helpers\Html::a(
                        \yii\helpers\Html::img($bundle->baseUrl . '/images/logo-base/shootme.svg'),
                        \yii\helpers\ArrayHelper::getValue(\Yii::$app->params, 'projects.shootme.url')
                    ) ?>
                </div>
            </div>
        </div>
    </div>
<?= $baseTemplate->end(); ?>