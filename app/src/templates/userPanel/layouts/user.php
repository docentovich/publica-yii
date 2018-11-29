<?php
/**
 * @var string $content
 */

use yii\helpers\Html;

$bundle = \app\assets\Asset::register($this);
$baseTemplate = new \app\templates\BaseTemplate($this, $bundle);
?>
<?php \app\widgets\header\Header::begin([
    "project" => \app\widgets\header\Header::PROJECT_PUBLICA
]); ?>
    <div class="overlay overlay--user-panel" id="service-menu-overlay">
        <div class="service-overlay-wrapper">
            <ul class="user-panel-menu">
                <?php if (\Yii::$app->user->can('comments')) { ?>
                    <li><?= Html::a("Мои комментарии", Yii::$app->homeUrl . "/my/comments"); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('orders')) { ?>
                    <li><?= Html::a("Мои заказы", Yii::$app->homeUrl . "/my/orders"); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('calendar')) { ?>
                    <li><?= Html::a("Мой календарь", Yii::$app->homeUrl . "/my/calendar"); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('rating')) { ?>
                    <li><?= Html::a("Мой рейтинг", Yii::$app->homeUrl . "/my/rating"); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('author')) { ?>
                    <li><?= Html::a("Журналист", Yii::$app->homeUrl . "/roles/journalist"); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('model')) { ?>
                    <li><?= Html::a("Модель", Yii::$app->homeUrl . "/roles/model"); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('photograph')) { ?>
                    <li><?= Html::a("Фотораф", Yii::$app->homeUrl . "/roles/photographer"); ?></li>
                <?php } ?>
            </ul>
            <?= Html::a(
                "<span>Обратная связь</span><span class=\"small\">(сообщение в администрацию сайта)</span>",
                "mailto:tomail@mail.ru",
                ["class" => "feedback"]
            );
            ?>
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