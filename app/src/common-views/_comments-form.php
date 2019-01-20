<?php
/**
 * @var $this yii\web\View
 * @var string|int $key
 * @var \app\models\Image $image
 * @var string|int $key
 */
?>
<div class="comments">
    <div class="comment">
        <div class="comment-avatar">
            <?= \Yii::$app->user->identity->profile->avatarNN->getImgSizeOf('40x40') ?>
        </div>
        <div class="comment-description">

            <?php $new_comment = new \app\models\Comments(); ?>
            <?php $comment_form = \yii\widgets\ActiveForm::begin([
                'action' => '/comment',
                'id' => "comment-form-{$image->id}",
                'options' => [
                    'class' => 'form form-ajax comment-form',
                    'onsuccess' => "function(data) {
                                            var comment = $('<div class=\"comment new-comment\" style=\'display: none\'>
                                                            <div class=\"comment-avatar\">
                                                                <img src=\'' + data.comment.author.profile.avatar_url + '\'/>
                                                            </div>
                                                            <div class=\"comment-description\">
                                                                <span>' + data.comment.text + '</span>
                                                            </div>
                                                        </div>');
                                            $('#comments-of-{$image->id}').append(comment);
                                            $('#comments-text-{$image->id}').val('');
                                            comment.slideDown(\"slow\");
                                    }",
                    'onerror' => "function(data) {
                                     }"
                ],
                'enableClientValidation' => true,
            ]); ?>

            <div class="comment-text">
                <?= $comment_form->field($new_comment, 'text')
                    ->textarea(['id' => "comments-text-{$image->id}", 'class' => 'message'])
                    ->label(false); ?>
            </div>

            <?= $comment_form->field($new_comment, 'image_id', [
                'template' => "{input}",
                "options" => ['tag' => false]
            ])
                ->hiddenInput(['value' => $image->id])
                ->label(false); ?>


            <?= \yii\helpers\Html::submitButton(\Yii::t('app/tosee', 'Comment'), ['class' => 'comment-button']); ?>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>

    </div>
</div>