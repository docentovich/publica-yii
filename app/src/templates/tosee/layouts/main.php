<?php
/**
 * @var string $content
 */

use app\assets\Asset;
use app\assets\AssetIE9;

$bundle = Asset::register($this);
AssetIE9::register($this);

$baseTemplate = new \app\templates\BaseTemplate($this, $bundle);
?>

    <?php \app\widgets\header\Header::begin(["project" => "tosee"]); ?>
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

    <div class="content-wrapper">
        <div class="content">
            <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
            <?= $content; ?>
        </div>
    </div>
<?= $baseTemplate->end(); ?>