<?php

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

echo $this->render('/_alert', ['module' => Yii::$app->getModule('user')]); ?>

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
        "<i class=\"icon-enter\"></i><span>" . Yii::t('user', 'Sign in') . "</span>"
    ) ?>
</div>

<div class="form-row form-links">
    <?= Html::a(
        Yii::t('user', 'Регистрация'),
        ['/user/registration/register']
    );
    ?>

    <?= Html::a(
        Yii::t('user', 'Forgot password?'),
        ['/user/recovery/request']
    );
    ?>
</div>
<?php ActiveForm::end(); ?>

<!---->
<? //= Connect::widget([
//    'baseAuthUrl' => ['/user/security/auth'],
//]) ?>
