<?php
/**
 * @var string $content
 */

$bundle = \app\assets\Asset::register($this);

$baseTemplate = new \app\templates\BaseTemplate($this, $bundle);
?>
<?php \app\widgets\header\Header::begin([
    "project" => \app\widgets\header\Header::PROJECT_PUBLICA
]); ?>
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
        <div class="content">
            <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
            <?= $content ?>
        </div>
    </div>

<?= $baseTemplate->end(); ?>