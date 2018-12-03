<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 * @var dektrium\user\Module $module
 * @var \app\modules\users\dto\UserTransportModel $transport_model
 */

$this->title = Yii::t('app/user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="profile">

    <div class="profile-body">

        <?php $user_active_form = ActiveForm::begin([
            'action' => '',
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
            <h2>Регистрация</h2>

            <div class="from-block">
                <?= \app\widgets\Alert::widget(); ?>
            </div>

            <?= $user_active_form->field($transport_model->config->user_form_model, 'email') ?>

            <?= $user_active_form->field($transport_model->config->user_form_model, 'username')
                ->label(
                    \Yii::t('app/user', 'Login {sub_level}',
                        ['sub_level' => \Yii::t('app/user', 'sub_level')]
                    )
                ); ?>

            <?= $user_active_form->field($transport_model->configQuery->config->user_form_model, 'password')->passwordInput(); ?>

            <?= $user_active_form->field($transport_model->configQuery->config->user_form_model, 'password_repeat')->passwordInput(); ?>

        </div>

        <div class="form-block">
            <div class="form-submit-button">
                <?= \yii\helpers\Html::submitButton(Yii::t('app', 'register')) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>


    </div>

</div>