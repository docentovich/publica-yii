<?php
use yii\helpers\Html;
?>
<?= \app\widgets\Alert::widget(); ?>
<div class="who">
    <div class="who-stay-simple">
        <?= Html::a(
            Yii::t('app/user', 'Stay plain gray'),
            ['/'],
            ['class' => 'stay-simple-text']
        ) ?>
        <span class="stay-simple-or">
            <?= Yii::t('app/user', 'or...'); ?>
        </span>
    </div>
    <div class="who-can-be">
        <div class="who-become"><?= Yii::t('app/user', 'To be'); ?></div>
        <div class="who-can-be-item">
            <div class="who-can-be-title">
                <?= Html::a(
                    Yii::t('app/user', 'A journalist'),
                    ['', 'role' => 'author']
                ) ?>
            </div>
            <div class="who-can-be-description">
                <?= Yii::t('app/user', 'journalist description') ?>
            </div>
        </div>
        <div class="who-can-be-item">
            <div class="who-can-be-title">
                <?= Html::a(
                    Yii::t('app/user', 'Photographer'),
                    ['', 'role' => 'photograph']
                ) ?>
            </div>
            <div class="who-can-be-description">
                <?= Yii::t('app/user', 'Photographer description') ?>
            </div>
        </div>
        <div class="who-can-be-item">
            <div class="who-can-be-title">
                <?= Html::a(
                    Yii::t('app/user', 'Model'),
                    ['', 'role' => 'model']
                ) ?>
            </div>
            <div class="who-can-be-description">
                <?= Yii::t('app/user', 'Model description') ?>
            </div>
        </div>
    </div>
</div>