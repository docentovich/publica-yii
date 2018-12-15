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
                    <li><?= Html::a(
                            \Yii::t('app/user', 'My comments'),
                            ["/my/comments"]); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('orders')) { ?>
                    <li><?= Html::a(
                            \Yii::t('app/user', 'My orders'),
                            ["/my/orders"]); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('calendar')) { ?>
                    <li><?= Html::a(
                            \Yii::t('app/user', 'My calendar'),
                            ["/my/calendar"]); ?></li>
                <?php } ?>
<!--                --><?php //if (\Yii::$app->user->can('rating')) { ?>
<!--                    <li>--><?//= Html::a(
//                            \Yii::t('app/user', 'Rate'),
//                            ["/my/rating"]); ?><!--</li>-->
<!--                --><?php //} ?>
                <?php if (\Yii::$app->user->can('author')) { ?>
                    <li><?= Html::a(
                            \Yii::t('app/user', 'Journalist'),
                            ["/tosee/author/index"]); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('model')) { ?>
                    <li><?= Html::a(
                            \Yii::t('app/user', 'Model'),
                            ["/probank/model/index"]); ?></li>
                <?php } ?>
                <?php if (\Yii::$app->user->can('photograph')) { ?>
                    <li><?= Html::a(
                            \Yii::t('app/user', 'Photographer'),
                            ["/probank/photographer/index"]); ?></li>
                <?php } ?>
            </ul>
            <?= Html::a(
                "<span>" . \Yii::t('app/user', 'Feedback') . "</span>
                      <span class=\"small\">(" . \Yii::t('app/user', 'message to the site administration') . ")</span>",
                "mailto:tomail@mail.ru",
                ["class" => "feedback"]
            );
            ?>
        </div>
    </div>
<?php \app\widgets\header\Header::end(); ?>

    <div class="content-wrapper">
        <div class="content">
            <?= \app\widgets\Alert::widget(['position' => 'top']); ?>
            <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
            <?= $content ?>
        </div>
    </div>

<?= $baseTemplate->end(); ?>