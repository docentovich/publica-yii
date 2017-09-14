<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
//use dektrium\user\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\BackendAsset;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
$bundle = BackendAsset::register($this);

?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="login">
    <div class="login__logo">
        <img src="<?= $bundle->baseUrl; ?>/images/logo.png" class="login__img" alt="" role="presentation"/>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'validateOnBlur' => false,
        'validateOnType' => false,
        'validateOnChange' => false,
        'class' => 'login__center',
    ]) ?>

    <?php /*if ($module->debug): ?>
        <?= $form->field($model, 'login', [
            'inputOptions' => [
                'autofocus' => 'autofocus',
                'class' => 'login__input',
                'tabindex' => '1']])->dropDownList(LoginForm::loginList());
        ?>

    <?php else: */ ?>
    <div class="login__input">
        <?= $form->field($model,
            'login',
            ['inputOptions' => [
                'autofocus' => 'autofocus',
                'class' => 'input',
                'tabindex' => '1',
                'placeholder' => 'Логин',
                "style" => "padding: 12px 0 12px 18px;"

            ]]
        )->label(false);
        ?>
    </div>
    <?php // endif ?>

    <?php /* if ($module->debug): ?>
        <div class="alert alert-warning">
            <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.'); ?>
        </div>
    <?php else: */ ?>
    <div class="login__input">
        <?= $form->field(
            $model,
            'password',
            ['inputOptions' => [
                'class' => 'input',
                'tabindex' => '2',
                'placeholder' => 'Пароль',
                "style" => "padding: 12px 0 12px 18px;"

            ]])
            ->passwordInput()
            ->label(false); ?>
    </div>
    <?php //endif ?>

    <?php //= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>
    <div class="login__button">
        <?= Html::submitButton(
            Yii::t('user', 'Sign in'),
            ['class' => 'button button--green button--center', 'tabindex' => '4']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <div class="login__footer">
    <?php //if ($module->enableConfirmation): ?>

        <?=  Html::a(
                Yii::t('user', 'Forgot password?'),
                ['/user/recovery/request'],
                [
                    'tabindex' => '5',
                    'class' => 'login__footer-a login__footer-a--remember'
                ]
            );
        ?>

    <?php //endif ?>
    <?php //if ($module->enableRegistration): ?>
        <?=  Html::a(
            Yii::t('user', 'Регистрация'),
            ['/user/registration/register'],
            [
                'tabindex' => '5',
                'class' => 'login__footer-a login__footer-a--register'
            ]
        );
        ?>

    <?php //endif ?>
    </div>

    <?= Connect::widget([
        'baseAuthUrl' => ['/user/security/auth'],
    ]) ?>
</div>
