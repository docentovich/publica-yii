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
 */

$this->title = Yii::t('user', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="content-page__h1">
    <div class="h1">Профиль</div>
</div>
<div class="content-page__inner">
    <?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>


    <?php $form = ActiveForm::begin([
        'id' => 'profile-form',
        'options' => ['class' => 'form'],
        'fieldConfig' => [
            'template' => "<div class=\"col-sm-3 col-xs-12\">{label}</div>\n<div class=\"col-sm-9 col-xs-12\"><div class=\"\">{input}</div></div>\n<div class=\"clearfix\"></div><div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div><div class=\"clearfix\"></div>",
            'labelOptions' => ['class' => 'form-line__label'],
//                            'inputOptions' =>  ['class' => 'form-line__text']
        ],
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'validateOnBlur' => false,
    ]); ?>
    <div class="form__form-block">


        <?= $form->field($model_profile, 'name') ?>

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
                <?= \components\helpers\Helpers::renderImage($model_profile->image, ["class" => "form-line__img"]); ?>

                <div class="button button--grey" id="upload">
                <?= FileUpload::widget([
                    'useDefaultButton' => false,
                    'model' => $upload,
                    'attribute' => 'file',
                    'url' => ['/user/avatar', 'id' => $model_profile->user->id], // your url, this is just for demo purposes,
                    'options' => [
                        'accept' => 'image/*',
                    ],
                    'clientOptions' => [
                        'maxFileSize' => 2000000,
                        "class" => "btn-waning"
                    ],
                    'clientEvents' => [
                        'fileuploaddone' => 'function(e, data) {
                        consloe.log(e, data);
                                location.reload();
                            }',
                        'fileuploadfail' => 'function(e, data) {

                            }',
                    ],
                ]); ?>
                </div>
                <script>
                    $("#upload").on('click', function(){
                        $("#upload").trigger("click");
                    });
                </script>
            </div>
        </div>

    </div>


    <? /* $form->field($model_profile, 'public_email')->label('email'); ?>

                        <?/* $form->field($model_profile, 'website') ?>

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

    <?= $form->field($model_profile, 'bio')->textarea() ?>

</div>

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

<?php ActiveForm::end(); ?>






