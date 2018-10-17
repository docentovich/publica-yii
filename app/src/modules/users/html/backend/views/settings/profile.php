<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use borales\extensions\phoneInput\PhoneInput;
use dosamigos\fileupload\FileUpload;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model_profile
 * @var dektrium\user\models\Settings $model_settings
 * @var \common\models\UploadImage $upload
 */

$this->title = Yii::t('user', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="content-page__h1">
    <div class="h1">Профиль</div>
</div>
<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<div class="content-page__inner">


    <?php $form = ActiveForm::begin([
        'id' => 'profile-form',
        'options' => [
            'class' => 'form',
            'enctype' => 'multipart/form-data'
        ],
        'fieldConfig' => [
            'template' => "<div class=\"col-sm-3 col-xs-12\">{label}</div>\n<div class=\"col-sm-9 col-xs-12\"><div class=\"\">{input}</div></div>\n<div class=\"clearfix\"></div><div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div><div class=\"clearfix\"></div>",
            'labelOptions' => ['class' => 'form-line__label'],
        ],
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'validateOnBlur' => false,
    ]); ?>
    <div class="form__form-block">


        <?= $form->field($model_profile, 'name')->label("Имя") ?>

        <?= $form->field($model_profile, 'sename')->label("Фамилия") ?>

        <?= $form->field($model_profile, 'lastname')->label("Отчество") ?>

        <?= $form->field($model_profile, 'phone')->label("Телефон")->widget(PhoneInput::className(), [
            'jsOptions' => [
                'preferredCountries' => ['ru'],
            ]
        ]); ?>

        <div class="form-group ">
            <div class="col-sm-3 col-xs-12"></div>
            <div class="col-sm-9 col-xs-12">
                <div class="form-line__text">
                    <div class="form-line__inline">
                        <label for="uploadimage-file" class="cursor-pointer">
                            <?= \app\helpers\Helpers::renderImage($model_profile->image, ["class" => "form-line__img", "id" => "avatar", "size" => "160x200"]); ?>
                        </label>

                        <div class="button button--grey button--upload hidden" id="upload">

                            <?= $form->field($upload, 'file', [
                                'template' => '{input}',
                                'options' => [
                                    'tag' => null, // Don't wrap with "form-group" div
                                ]
                            ])->fileInput()->label(false); ?>

                        </div>



                    </div>
                </div>
            </div>
        </div>

        <script>
            $("#upload input[type='file']").on('change', function (event) {
                var $from = $(this).parents("form");
                event.stopPropagation(); // Stop stuff happening
                event.preventDefault(); // Totally stop stuff happening

                $.ajax({
                    type: "POST",
                    timeout: 50000,
//                    enctype: 'multipart/form-data',
                    url: '/admin/avatar-upload',
                    data: new FormData($from[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.url == undefined) return false;
                        $("#avatar").attr("src", data.url + "/" + data.original);
                        var thumb = data.thumbs["160x200"];
                        $(".userpan__img").attr("src", data.url + "/" + thumb)

                    }
                });
            });
        </script>

    </div>


    <?php /* $form->field($model_profile, 'public_email')->label('email'); ?>

                        <?php$form->field($model_profile, 'website') ?>

                        <?= $form->field($model_profile, 'location') */ ?>

    <?php /*$form
                        ->field($model_profile, 'timezone')
                        ->dropDownList(
                            ArrayHelper::map(
                                Timezone::getAll(),
                                'timezone',
                                'name'
                            )
                        );*/ ?>

    <?php /*$form
                        ->field($model_profile, 'gravatar_email')
                        ->hint(Html::a(Yii::t('user', 'Change your avatar at Gravatar.com'), 'http://gravatar.com')) */ ?>

    <?= $form->field($model_profile, 'bio')->textarea()->label("О себе"); ?>


    <div class="form__form-block">

        <div class="col-sm-3 col-xs-12">
            <div class="form-line__label">
            </div>
        </div>

        <div class="col-sm-9 col-xs-12">
            <div class="form-line__text" style="margin-bottom: 30px;">
                <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'button button--green']) ?>
                <br>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin([
        'id' => 'account-form',
        'options' => ['class' => 'form'],
        'fieldConfig' => [
            'template' => "<div class=\"col-sm-3 col-xs-12\">{label}</div>\n<div class=\"col-sm-9 col-xs-12\"><div class=\"\">{input}</div></div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div><div class=\"clearfix\"></div>",
            'labelOptions' => ['class' => 'form-line__label'],
//                            'inputOptions' =>  ['class' => 'form-line__text']
        ],
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]); ?>

    <div class="form__form-block">

        <?= $form->field($model_settings, 'email') ?>

        <?= $form->field($model_settings, 'username')->label(Yii::t("user", "Псевдоним")); ?>
    </div>

    <div class="form__form-block">

        <?= $form->field($model_settings, 'new_password')->passwordInput() ?>

        <?= $form->field($model_settings, 'current_password')->passwordInput() ?>
    </div>

    <div class="form__form-block">

        <div class="col-sm-3 col-xs-12">
            <div class="form-line__label">
            </div>
        </div>

        <div class="col-sm-9 col-xs-12">
            <div class="form-line__text">
                <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'button button--green']) ?>
                <br>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>






