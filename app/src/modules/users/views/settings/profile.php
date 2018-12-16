<?php

use yii\widgets\ActiveForm;

/**
 * @var \app\models\User $identity
 * @var \app\models\UserForm $user_form
 * @var \app\models\Profile $profile
 */
?>

<div class="profile">
    <?= \app\widgets\UserHeader::widget(); ?>

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
                <?= \app\widgets\Alert::widget(); ?>
            </div>

            <?= $user_active_form->field($user_form, 'username')
                ->label(
                    \Yii::t('app/user', 'Login {sub_level}',
                        ['sub_level' => \Yii::t('app/user', 'sub_level')]
                    )
                ); ?>

            <?= $user_active_form->field($user_form, 'email')
                ->textInput(["type" => "email"]); ?>

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

            <?= $profile_active_form->field($profile, 'phone', ['enableClientValidation' => false])
                ->textInput([
                    'placeholder' => '+7(123)456-78-90',
                    'type' => 'tel',
                ]); ?>

            <?= $profile_active_form->field($profile, 'firstname'); ?>
            <?= $profile_active_form->field($profile, 'sename'); ?>
            <?= $profile_active_form->field($profile, 'lastname'); ?>

            <?= $profile_active_form->field($profile, 'avatarNN')
                ->widget(\ImageAjaxUpload\UploadWidget::className(), [
                    'multiply' => false,
                ])->label(\Yii::t('app/user', 'avatar')); ?>

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
