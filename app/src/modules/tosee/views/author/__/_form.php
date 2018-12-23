<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\tosee\models\ToseePost */
/* @var $form yii\widgets\ActiveForm */
/* @var $upload app\models\UploadImage */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div style="float: right;">
        <label class="control-label">Выберите дату события</label><br>
        <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'event_at',
            'language' => 'ru',
            //'label' => 'Дата события',
            'dateFormat' => 'yyyy-MM-dd',
        ]);
        ?>
    </div>

    <label for="uploadimage-file" class="cursor-pointer">
        <?= \app\helpers\Helpers::renderImage($model->image, ["class" => "form-line__img", "id" => "avatar"]); ?>
    </label>

    <div class="hidden" id="">

        <?= $form->field($upload, 'file', [
            'template' => '{input}',
            'options' => [
                'tag' => null, // Don't wrap with "form-group" div
            ]
        ])->fileInput()->label("Загрузить фото"); ?>

    </div>

    <br>


    <?= $form->field($post_data, 'title')->label("Заголовок") ?>

    <?= $form->field($post_data, 'sub_header')->label("Подзаголовок") ?>

    <?= $form->field($post_data, 'post_short_desc')->label("Короткое описание")->textarea() ?>

    <?= $form->field($post_data, 'post_desc')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/post', 'Сохранить'), ['class' => 'button button--green']) ?>
    </div>

    <div class="additional-images">
        <?php foreach ($model->images as $image) { ?>
            <?= \app\helpers\Helpers::renderImage($image, ["size" => "215x215", "class" => "add-img"]) ?>
        <?php } ?>
    </div>

    <div id="add-img-hidden"></div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="button button--green button--upload " id="upload">
        <?= $form->field($upload, 'file[]', [
            'template' => '{input}',
            'options' => [
                'id' => 'multiupload',
                'tag' => null, // Don't wrap with "form-group" div
            ]
        ])->fileInput(["class" => "cursor-pointer", 'multiple' => true, 'accept' => 'image/*'])->label(false); ?>
        <span>Добавить изображение</span>
    </div>

    <script>
        $("#upload input[type='file']").on('change', function (event) {
            var $from = $(this).parents("form");
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening

            var ajaxData = new FormData();
            ajaxData.append('<?= Yii:: $app->getRequest()->csrfParam ?>', csrfToken);
            ajaxData.append('action', 'uploadImages');
            $.each($("input[type=file]"), function (i, obj) {
                $.each(obj.files, function (j, file) {
                    ajaxData.append('UploadImage[file][]', file);
                })
            });

            $.ajax({
                type: "POST",
                timeout: 50000,
//                    enctype: 'multipart/form-data',
                url: '<?= \yii\helpers\Url::toRoute(['/author/additional-upload']) ?>',
                data: ajaxData,
//                data: new FormData($from[0]),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    data = JSON.parse(data);
                    if (data.length == 0) return false;

                    for (var key in data) {
                        var file = data[key];
                        var thumb = file.thumbs["215x215"];

                        $(".additional-images").append("<img class='add-img' src='/' " + file.url + "/" + thumb + ">");
                        $("#add-img-hidden").append("<input type='hidden' name='PostToImage[image_id][]' value='" + file.id + "'/>");
                    }

                }
            });
        });
    </script>
    <?php ActiveForm::end(); ?>

</div>