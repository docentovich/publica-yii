<?php
use yii\helpers\Html;
?>
<?= \app\widgets\alert\Alert::widget(); ?>
<div class="who">
    <div class="who-header">
        <div class="who-avatar dark-icon"><i class="fa fa-user"></i></div>
        <div class="who-description">
            <h2><?= Yii::t('user', 'who to be') ?></h2>
            <h3><?= Yii::t('user', 'Nickname') ?></h3>
        </div>
    </div>
    <div class="who-stay-simple">
        <?= Html::a(
            Yii::t('user', 'Stay plain gray'),
            ['/'],
            ['class' => 'stay-simple-text']
        ) ?>
        <span class="stay-simple-or">
            <?= Yii::t('user', 'or...'); ?>
        </span>
    </div>
    <div class="who-can-be">
        <div class="who-become"><?= Yii::t('user', 'To be'); ?></div>
        <div class="who-can-be-item">
            <div class="who-can-be-title">
                <?= Html::a(
                    Yii::t('user', 'A journalist'),
                    ['', 'role' => 'author']
                ) ?>
            </div>
            <div class="who-can-be-description">
                <?= Yii::t('user', 'journalist description') ?>
            </div>
        </div>
        <div class="who-can-be-item">
            <div class="who-can-be-title">
                <?= Html::a(
                    Yii::t('user', 'Photographer'),
                    ['', 'role' => 'photograph']
                ) ?>
            </div>
            <div class="who-can-be-description">
                <?= Yii::t('user', 'Photographer description') ?>
            </div>
        </div>
        <div class="who-can-be-item">
            <div class="who-can-be-title">
                <?= Html::a(
                    Yii::t('user', 'Model'),
                    ['', 'role' => 'model']
                ) ?>
            </div>
            <div class="who-can-be-description">
                <?= Yii::t('user', 'Model description') ?>
            </div>
        </div>
    </div>
</div>