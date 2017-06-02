<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\tosee\models\common\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*']); ?>
    <sript>
        $("input[name='image']").on('change', function(event){
            var $self = $(this);
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening

            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/admin/site/upload-main',
                data: new FormData(this),
                crossDomain: "true",
                success: function (data) {
                    alert('success');
                    return false;
                }
            });
        });
    </sript>

    <? /* FileUpload::widget([
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
    ]);*/ ?>



    <?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'event_at',
        'language' => 'en',
        'label' => 'Дата события',
        'dateFormat' => 'yyyy-mm-dd',
    ]);
    ?>


    <? //$form->field($model, 'periodfrom') ?>


    <? /* FileUpload::widget([
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
    ]);*/ ?>


    <?= $form->field($model, 'images')->fileInput(['multiple' => true, 'accept' => 'image/*']); ?>
    <sript>
        $("input[name='image']").on('change', function(event){
            var $self = $(this);
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening

            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/admin/site/upload-additional',
                data: new FormData(this),
                crossDomain: "true",
                success: function (data) {
                    alert('success');
                    return false;
                }
            });
        });
    </sript>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/post', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <!--    --><?php //foreach($model->images as $image) {
    //        echo Helper\
    //    }?>

</div>
