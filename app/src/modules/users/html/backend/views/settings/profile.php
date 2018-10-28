<?php

use yii\widgets\ActiveForm;

/**
 * @var \app\models\User $identity
 * @var \app\models\UserForm $user_form
 */
$identity = \Yii::$app->user->identity;
$profile = $identity->profile;
$profile->scenario = \app\models\Profile::SCENARIO_UPDATE;
?>

<div class="profile">

    <div class="user-avatar-name">
        <div class="user-name"><?= $identity->profile->fullName; ?></div>
        <div class="user-avatar dark-icon">
            <?php if ($identity->profile->avatar) {
                echo \yii\helpers\Html::img("/uploads/" . $identity->profile->avatar0->getPathImageSizeOf('270xR'));
            } else { ?>
                <i class="fa fa-user"></i>
            <?php } ?>
        </div>
    </div>

    <div class="profile-body">

        <?php $user_active_form = ActiveForm::begin([
            'action' => '/admin/save-user',
            'id' => 'user-form',
            'options' => [
                'class' => 'form',
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

            <?= $user_active_form->field($user_form, 'username')
                ->label(
                    \Yii::t('app/user', 'Login {sub_level}',
                        ['sub_level' => \Yii::t('app/user', 'sub_level')]
                    )
                ); ?>

            <?= $user_active_form->field($user_form, 'password')->passwordInput(); ?>

            <?= $user_active_form->field($user_form, 'password_repeat')->passwordInput(); ?>

        </div>

        <div class="form-block">
            <div class="form-submit-button">
                <?= \yii\helpers\Html::submitButton(Yii::t('app', 'change')) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>


    </div>

    <?php $profile_active_form = ActiveForm::begin([
        'action' => '/admin/save-profile',
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
    ]);

    ?>

    <div class="profile-body">
        <div class="form-block">
            <h2>Служебная информация **</h2>

            <?= $profile_active_form->field($profile, 'phone')
                ->textInput([
                    'placeholder' => '123-456-78-90',
                    'type' => 'tel',
                    'pattern' => '(\+[0-9]{1,3})?\(?[0-9]{3}\)?-[0-9]{3}-[0-9]{4}'
                ]); ?>
            <?= $profile_active_form->field($profile, 'public_email')
                ->textInput(["type" => "email"]); ?>
            <?= $profile_active_form->field($profile, 'firstname'); ?>
            <?= $profile_active_form->field($profile, 'sename'); ?>
            <?= $profile_active_form->field($profile, 'lastname'); ?>

            <?= \ImageAjaxUpload\UploadWidget::widget(
                [
                    'activeForm' => $profile_active_form,
                    'model' => $identity->profile->avatar0 ?? new \app\models\Image(['scenario' => \app\models\Image::SCENARIO_LOAD_FILE]),
                    'attribute' => 'relativeUploadPath',
//                    'action' => '/admin/profile/upload-avatar',
                    'multiply' => false,
//                    'onUploadFinished' => 'function() { $(\'#waiting\').hide(); }',
//                    'onUploadStart' => 'function() { $(\'#waiting\').show(); }'
                ]
            ); ?>

            <div class="form-row form--upload" id="upload">
                <label>Загрузить изображение</label>
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

</div>
