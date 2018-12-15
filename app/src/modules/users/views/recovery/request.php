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

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\RecoveryForm $model
 */

$this->title = Yii::t('app/user', 'Recover your password');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login">
    <div class="login-form">
        <?php $form = ActiveForm::begin([
            'id' => 'password-recovery-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
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
        ]); ?>

        <div class="panel-heading">
            <h3 style="color: #fff"><?= Html::encode($this->title) ?></h3>
        </div>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true])
            ->input('email', ['placeholder' => Yii::t('app/user', "Enter Your Email")])
            ->label('') ?>

        <div class="form-row" style="margin-top: 25px;">
            <?= Html::submitButton(Yii::t('app/user', 'Continue'), ['class' => 'submit']) ?><br>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
