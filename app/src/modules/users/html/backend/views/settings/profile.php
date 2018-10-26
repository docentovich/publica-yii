<?php

use yii\widgets\ActiveForm;

/**
 * @var \app\models\User $identity
 * @var \app\models\UserForm $user_form
 */
$identity = \Yii::$app->user->identity;

?>

<div class="profile">

    <div class="user-avatar-name">
        <div class="user-name"><?= $identity->profile->fullName; ?></div>
        <div class="user-avatar dark-icon">
            <?php if ($identity->profile->avatar) {
                echo \yii\helpers\Html::img("/uploads/" . $identity->profile->avatar0->getFullPathImageSizeOf('270xR'));
            } else { ?>
                <i class="fa fa-user"></i>
            <?php } ?>
        </div>
    </div>

    <div class="profile-body">

        <?php $form = ActiveForm::begin([
            'id' => 'profile-form',
            'options' => [
                'class' => 'form',
                'enctype' => 'multipart/form-data'
            ],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n
                                <div class=\"form-error\">{error}\n{hint}</div>",
                'options' => [
                    'class' => 'form-row'
                ],
            ],
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
        ]); ?>
        <div class="form-block">
            <h2>Общая информаци *</h2>

            <div class="from-block">
                <?= \app\widgets\alert\Alert::widget(); ?>
            </div>

            <?= $form->field($user_form, 'username')
                ->label(\Yii::t('app/user', 'Login {sub_level}',
                    ['sub_level' => \Yii::t('app/user', 'sub_level')])); ?>

            <?= $form->field($user_form, 'password')->passwordInput(); ?>

            <?= $form->field($user_form, 'password_repeat')->passwordInput(); ?>

        </div>

        <div class="form-block">
            <div class="form-submit-button">
                <?= \yii\helpers\Html::submitButton(Yii::t('app', 'change')) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>


    </div>

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form',
            'enctype' => 'multipart/form-data'
        ],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n
                                <div class=\"form-error\">{error}\n{hint}</div>",
            'options' => [
                'class' => 'form-row'
            ],
        ],
    ]); ?>

    <div class="profile-body">
        <div class="form-block">
            <h2>Служебная информация **</h2>

            <?= $form->field($identity->profile, 'phone')
                ->textInput([
                    'placeholder' => '123-456-78-90',
                    'type' => 'tel',
                    'pattern' => '(\+[0-9]{1,3})?\(?[0-9]{3}\)?-[0-9]{3}-[0-9]{4}'
                ]); ?>
            <?= $form->field($identity->profile, 'public_email')
                ->textInput(["pattern" => "(\+[0-9]{1,3})?\(?[0-9]{3}\)?-[0-9]{3}-[0-9]{4}"]); ?>
            <?= $form->field($identity->profile, 'firstname'); ?>
            <?= $form->field($identity->profile, 'sename'); ?>
            <?= $form->field($identity->profile, 'lastname'); ?>


            <!--            --><? //= \dosamigos\fileupload\FileUpload::widget([
            //                'model' => $identity->profile->avatar0,
            //                'attribute' => 'name',
            //                'url' => "/uploads/{$identity->profile->avatar0->getFullPath()}" ,// your url, this is just for demo purposes,
            //                'options' => ['accept' => 'image/*'],
            //                'clientOptions' => [
            //                    'maxFileSize' => 2000000
            //                ],
            //                'clientEvents' => [
            //                    'fileuploaddone' => 'function(e, data) {
            //                                debugger;
            //                                console.log(e);
            //                                console.log(data);
            //                            }',
            //                    'fileuploadfail' => 'function(e, data) {
            //                                debugger;
            //                                console.log(e);
            //                                console.log(data);
            //                            }',
            //                ],
            //            ]); ?>


            <div class="form-row form--upload" id="upload">
                <label>Загрузить изображение</label>
                <div class="form-avatar trigger-click dark-icon" rel="upload-input">
                    <?= \yii\helpers\Html::img("/uploads/{$identity->profile->avatar0->getFullPathImageSizeOf('100x100')}"); ?>
                </div>

                <?= $form->field(new \app\models\UploadImage(), 'file', [
                    'template' => '{input}',
                    'options' => [
                        'tag' => null, // Don't wrap with "form-group" div
                    ]
                ])->fileInput()->label(false); ?>
            </div>
        </div>
    </div>

    <div class="profile-footer">
        <div class="form-block form-block--grey">
            <div class="footer-line">**</div>
            <div class="footer-line">*</div>
            <div class="footer-line">Условия, Принять, Stuff</div>
        </div>
        <div class="form-block form-control">
            <div class="form-submit-button">
                <?= \yii\helpers\Html::submitButton(Yii::t('app', 'change')) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <script defer>

        setTimeout(function () {

            $('#upload input[type=\'file\']').on('change', function (event) {
                debugger;
                var $from = $(this).parents('form');
                event.stopPropagation(); // Stop stuff happening
                event.preventDefault(); // Totally stop stuff happening

                $.ajax({
                    type: 'POST',
                    timeout: 50000,
//                    enctype: 'multipart/form-data',
                    url: '/admin/avatar-upload',
                    data: new FormData($from[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        debugger;

                        data = JSON.parse(data);
                        if (data.url == undefined) return false;
                        $('#avatar').attr('src', data.url + '/' + data.original);
                        var thumb = data.thumbs['160x200'];
                        $('#upload img').attr('src', data.url + '/' + thumb)

                    }
                });
            });

        }, 1000);

    </script>


</div>
