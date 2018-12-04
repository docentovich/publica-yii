<?php
/**
 * @var \app\modules\tosee\models\Post $model
 * @var \app\modules\tosee\models\PostData $post_data
 */


use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
//    'action' => '/admin/save-user',
    'id' => 'user-form',
    'options' => [
        'class' => 'form',
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
        <?= $form->field($post_data, 'title') ?>

<!--        <div class="form-row">-->
<!--            <label class="control-label">Lfnf</label><br>-->
<!--            --><?//= $form->field(\yii\jui\DatePicker::widget([
//                'model' => $model,
//                'attribute' => 'event_at',
//                'language' => 'ru-RU',
//                'dateFormat' => 'yyyy-MM-dd',
//            ]);
//            ?>
<!--        </div>-->


        <?= $form->field($model, 'event_at')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'ru-RU',
            'dateFormat' => 'yyyy-MM-dd',
        ])  ?>


        <?= $form->field($post_data, 'title') ?>

        <?= $form->field($model, 'city_id')->dropDownList(\app\models\City::asArray()) ?>

        <div class="form-row">
            <label>Место (город)</label>
            <input type="text"/>
        </div>
        <div class="form-row form--upload">
            <label>Заглавное фото</label>
            <div class="form-avatar trigger-click dark-icon" rel="upload-input"><i class="fa fa-user"></i></div>
            <input type="file" name="pic" accept="image/*" style="display: none" id="upload-input"/>
        </div>
        <div class="form-row">
            <label>Введение</label>
            <input type="text"/>
        </div>
        <div class="form-row">
            <label>Текст</label>
            <textarea></textarea>
        </div>
        <div class="form-row">
            <label>Фотоглерея</label>
            <div class="form-photo-gallery">
                <div class="form-photo-gallery-item"><img src="/images/avatars/2.jpg"/></div>
                <div class="form-photo-gallery-item"><img src="https://dummyimage.com/1000x400/000/fff"/></div>
                <div class="form-photo-gallery-item"><img src="/images/avatars/5.jpg"/></div>
                <div class="form-photo-gallery-item"><img src="/images/avatars/2.jpg"/></div>
                <div class="form-photo-gallery-item"><img src="/images/avatars/2.jpg"/></div>
                <div class="form-photo-gallery-item"><img src="https://dummyimage.com/1000x400/000/fff"/></div>
                <div class="form-photo-gallery-item"><img src="/images/avatars/5.jpg"/></div>
                <div class="form-photo-gallery-item"><img src="/images/avatars/2.jpg"/></div>
            </div>
        </div>
    </div>
    <div class="form-block form-control">
        <div class="form-row">
            <div class="form-submit-button">
                <button>Отправить на модерацию</button>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>