<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Portfolio */
/* @var $form ActiveForm */
?>
<div class="specialist-portfolio">

    <?php $form = ActiveForm::begin([
        'id' => 'model-form',
        'options' => [
            'class' => 'form',
            'enctype' => 'multipart/form-data'
        ],
        'fieldConfig' => [
            'template' => "<div class=\"form-row\">
                            {label}\n{input}\n
                            <div class=\"form-error\">{error}\n{hint}</div>
                            </div>",
            'options' => [
                'class' => 'form-row'
            ],
        ],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]); ?>
    <div class="form-block">
        <?= $form->field($model, 'about')->textarea() ?>
        <?= $form->field($model, 'price') ?>


        <?= $form->field($model, 'mainPhotoNN')
            ->widget(\ImageAjaxUpload\UploadWidget::class, [
                'multiply' => false,
                'options' => ['class' => 'MS250x250']
            ])->label(\Yii::t('app/probank', 'Main photo')); ?>

        <?= $form->field($model, 'additionalImagesNN')
            ->widget(\ImageAjaxUpload\UploadWidget::class, [
                'relativePathAttribute' => 'relativeUploadPathOrNull',
                'multiply' => true,
                'options' => ['class' => 'MS100'],
                'instance' => 1
            ])->label(\Yii::t('app/probank', 'Additional photos')); ?>

    </div>

    <div class="form-block">
        <div class="form-submit-button">
            <?= Html::submitButton(Yii::t('app/probank', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- specialist-portfolio -->
