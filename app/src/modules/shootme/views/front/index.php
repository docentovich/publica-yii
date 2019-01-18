<?php
/**
 * @var $this \yii\web\View
 * @var $cities \app\models\City[]
 */
$form = \yii\widgets\ActiveForm::begin(['id' => 'filter']);
?>
    <form method="post" action="/" id="filter">
<?= \yii\helpers\Html::input('hidden', 'filter', 'submit'); ?>

    <div class="shootme-filter-content">
        <div class="shootme-filter-main">
            <span class="header">Зказ фотографа</span>
            <div class="shootme-filter-control" id="where-control" data-rel="where">
                <i class="icon-geo"></i>
                <span>Где</span>
                <?= \yii\helpers\Html::input('hidden', 'city', '', ['class' => 'shootme-inputs', 'id' => 'where-input']); ?>
            </div>
            <div class="shootme-filter-control" id="when-control" data-rel="when">
                <i class="icon-clock"></i>
                <span>Когда</span>
                <?= \yii\helpers\Html::input('hidden', 'time', '', ['class' => 'shootme-inputs', 'id' => 'time-input']); ?>
                <?= \yii\helpers\Html::input('hidden', 'date', '', ['class' => 'shootme-inputs', 'id' => 'date-input']); ?>

            </div>
        </div>
    </div>
    <div class="shootme-filter-overlay" id="when">
        <i class="fa fa-long-arrow-left back-button"></i>

        <?= DateTimePlanner\widget\DateTimePlanner::widget(['id' => 'date-time-picker', 'is_single_time' => true]); ?>
    </div>
    <div class="shootme-filter-overlay" id="where">
        <i class="fa fa-long-arrow-left back-button"></i>
        <ul id="cities">
            <?php foreach ($cities as $city) {
                $label = \Yii::t('app/cities', $city->label);
                echo "<li data-city-name=\"{$city->id}\" data-city-label=\"{$label}\">{$label}</li>";
            }
            ?>
        </ul>
    </div>
<?php
\yii\widgets\ActiveForm::end();
$js = <<<JS
    (function ($) {
        $(document).on('complete:select-filter', function () {
            $('#filter').submit();
        });
    })(jQuery);
JS;

$this->registerJs(sprintf($js, yii\helpers\Url::to(['/project/site/members'])), \yii\web\View::POS_END)
?>