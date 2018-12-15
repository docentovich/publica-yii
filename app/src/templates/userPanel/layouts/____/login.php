<?php

use app\assets\Asset;
$bundle = Asset::register($this);

$baseTemplate = new \app\templates\BaseTemplate($this, $bundle);
?>

<?php \app\widgets\header\Header::begin(["project" => "publica"]); ?>
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
        <?= $content ?>
    </div>
</div>

<?= $baseTemplate->end(); ?>