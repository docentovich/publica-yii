<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<table class="users-table">
    <tr>
        <th>Имя</th>
        <th>Юзер</th>
        <th>Автор</th>

        <?php if (Yii::$app->user->can("administrator")) { ?>
            <th>Модератор</th>
        <?php } ?>
    </tr>
    <?php foreach ($users->items as $user) {
        ?>
        <tr>
            <td>
                <?= $user->username . "<Br>" . $user->email ?>
            </td>
            <td>
                <?php if (Yii::$app->authManager->getAssignment("user", $user->id) === NULL) {
                    $form = ActiveForm::begin(); ?>
                    <input type="hidden" name="id[<?=$user->id?>]" value="user"/>
                    <input type="submit" name="setrule" class="button button--green" value="задать"/>
                    <?php ActiveForm::end();
                }else { ?>
                    <button class="btn btn-link" >Задано!</button>
                <?php } ?>
            </td>
            <td>
                <?php if (Yii::$app->authManager->getAssignment("author", $user->id) === NULL) {
                    $form = ActiveForm::begin(); ?>
                    <input type="hidden" name="id[<?=$user->id?>]" value="author"/>
                    <input type="submit" name="setrule" class="button button--green" value="задать"/>
                    <?php ActiveForm::end();
                }else { ?>
                    <button class="btn btn-link" >Задано!</button>
                <?php } ?>
            </td>

            <?php if (Yii::$app->user->can("administrator")) { ?>
                <td>
                    <?php if (Yii::$app->authManager->getAssignment("moderator", $user->id) === NULL) {
                        $form = ActiveForm::begin(); ?>
                        <input type="hidden" name="id[<?=$user->id?>]" value="moderator"/>
                        <input type="submit" name="setrule" class="button button--green" value="задать"/>
                        <?php ActiveForm::end();
                    }else { ?>
                        <button class="btn btn-link" >Задано!</button>
                    <?php } ?>
                </td>
            <?php } ?>

        </tr>
    <?php } ?>
</table>