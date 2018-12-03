<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Asset;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('app/user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
$bundle = Asset::register($this);
?>
<div class="login">
    <div class="login-form">
        <?= \app\widgets\Alert::widget(); ?>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
        ]) ?>

        <div class="form-row">
            <?= $form->field($model, 'login',
                ['inputOptions' => [
                    'autofocus' => 'autofocus',
                    'tabindex' => '1',
                    'placeholder' => 'Логин',
                ]]
            )->label(false);
            ?>
        </div>

        <div class="form-row">
            <?= $form->field($model, 'password',
                ['inputOptions' => [
                    'tabindex' => '2',
                    'placeholder' => 'Пароль',
                ]])
                ->passwordInput()
                ->label(false); ?>
        </div>


        <div class="form-row form-button">
            <?= Html::submitButton(
                "<i class=\"icon-enter\"></i><span>" . Yii::t('app/user', 'Sign in') . "</span>"
            ) ?>
        </div>

        <div class="form-row form-links">
            <?= Html::a(
                Yii::t('app/user', 'Регистрация'),
                ['/user/registration/register']
            );
            ?>

            <?= Html::a(
                Yii::t('app/user', 'Forgot password?'),
                ['/user/recovery/request']
            );
            ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>