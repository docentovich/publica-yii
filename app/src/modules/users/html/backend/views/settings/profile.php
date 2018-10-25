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
//            'enableClientValidation' => false,
        ]); ?>
        <div class="form-block">
            <h2>Общая информаци *</h2>

            <?= $form->field($user_form, 'username')
                    ->label(\Yii::t('app/user', 'Login {sub_level}',
                        ['sub_level' => \Yii::t('app/user', 'sub_level')])); ?>

            <?= $form->field($user_form, 'password')->passwordInput(); ?>

            <?= $form->field($user_form, 'password_repeat')->passwordInput(); ?>

        </div>

        <div class="form-block form-control">
            <div class="form-submit-button">
                <?= \yii\helpers\Html::submitButton(Yii::t('app', 'change')) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>


    </div>

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
    ]); ?>

    <div class="profile-body">
        <div class="form-block">
            <h2>Служебная информация **</h2>

            <?= $form->field($identity->profile, 'phone')->passwordInput(); ?>

            <div class="form-row">
                <label>Телефон</label>
                <input type="tel" placeholder="123-456-78-90"
                       pattern="(\+[0-9]{1,3})?\(?[0-9]{3}\)?-[0-9]{3}-[0-9]{4}"/>
            </div>
            <div class="form-row">
                <label>e-mail</label>
                <input type="email" pattern="^.+@.+\.\S{2,6}$"/>
            </div>
            <div class="form-row">
                <label>Фамилия, Имя, Отчество</label>
                <input type="text"/>
            </div>
            <div class="form-row">
                <label>Серия, номер паспорта</label>
                <input type="text" placeholder="XXXX-XXXXXX" data-inputmask="'mask': '9999 999999'"/>
            </div>
            <div class="form-row form--upload">
                <label>Загрузить изображение</label>
                <div class="form-avatar trigger-click dark-icon" rel="upload-input"><i
                            class="fa fa-user"></i>
                </div>
                <input type="file" name="pic" accept="image/*" style="display: none" id="upload-input"/>
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
