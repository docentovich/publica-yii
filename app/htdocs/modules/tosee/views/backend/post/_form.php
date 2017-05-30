<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\tosee\models\common\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= FileUpload::widget([
        'model' => $upload,
        'attribute' => 'file',
        'url' => ['/upload/postimage', 'id' => $model_profile->user->id],
        'options' => ['accept' => 'image/*'],
        'clientOptions' => [
            'maxFileSize' => 2000000,
            "class" => "btn-waning"
//                                'data-url' => '/image-upload',
        ],
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                location.reload();
                            }',
            'fileuploadfail' => 'function(e, data) {

                            }',
        ],
    ]); ?>



    <?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'event_at',
        'language' => 'en',
        'label' => 'Дата события',
        'dateFormat' => 'yyyy-mm-dd',
    ]);
    ?>


    <? //$form->field($model, 'periodfrom') ?>


    <?= FileUpload::widget([
        'model' => $upload,
        'attribute' => 'file',
        'url' => ['/upload/postimage', 'id' => $model_profile->user->id],
        'options' => ['accept' => 'image/*'],
        'clientOptions' => [
            'maxFileSize' => 2000000,
            "class" => "btn-waning"
//                                'data-url' => '/image-upload',
        ],
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                location.reload();
                            }',
            'fileuploadfail' => 'function(e, data) {

                            }',
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/post', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<!--    --><?php //foreach($model->images as $image) {
//        echo Helper\
//    }?>

</div>
