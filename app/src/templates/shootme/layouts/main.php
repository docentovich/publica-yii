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
<?php \app\widgets\header\Header::end(); ?>

    <div class="content-wrapper">
        <div class="content">
            <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
            <?= $content; ?>
        </div>
    </div>
<?= $baseTemplate->end(); ?>