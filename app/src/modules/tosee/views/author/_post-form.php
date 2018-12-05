<?php
/**
 * @var \app\modules\tosee\models\Post $post
 */


use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'id' => 'post-form',
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
        <?= $form->field($post->postData0, 'title') ?>

        <?= $form->field($post, 'event_at')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'ru-RU',
            'dateFormat' => 'yyyy-MM-dd',
        ]) ?>


        <?= $form->field($post, 'city_id')->dropDownList(\app\models\City::asArray()) ?>

        <?= $form->field($post->image0, 'relativeUploadPath')
            ->widget(\ImageAjaxUpload\UploadWidget::className(), [
                'multiply' => false,
                'options' => ['class' => 'MS250x250']
            ]); ?>

        <?= $form->field($post->postData0, 'post_short_desc') ?>

        <?= $form->field($post->postData0, 'post_desc')->textarea() ?>

        <?= $form->field($post->additionalImages0, 'relativeUploadPathOrNull')
            ->widget(\ImageAjaxUpload\UploadWidget::className(), [
                'multiply' => true,
                'options' => ['class' => 'MS100'],
                'instance' => 1
            ])->label(''); ?>
    </div>
    <div class="form-block form-control">
        <div class="form-row">
            <div class="form-submit-button">
                <?= \yii\helpers\Html::submitButton(Yii::t('app', 'send to moderate')) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>