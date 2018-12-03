<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var dektrium\user\models\User   $user
 * @var dektrium\user\models\Token  $token
 */
?>
<?= Yii::t('app/user', 'Hello') ?>,

<?= Yii::t('app/user', 'Thank you for signing up on {0}', Yii::$app->name) ?>.
<?= Yii::t('app/user', 'In order to complete your registration, please click the link below') ?>.

<?= $token->url ?>

<?= Yii::t('app/user', 'If you cannot click the link, please try pasting the text into your browser') ?>.

<?= Yii::t('app/user', 'If you did not make this request you can ignore this email') ?>.
