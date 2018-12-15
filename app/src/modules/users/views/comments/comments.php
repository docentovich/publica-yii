<?php
/** @var \app\models\Comments[] $comments */
?>
<div class="comments">
    <?php foreach ($comments as $comment) {
        ?>
        <div class="comment">
            <div class="avatar">
                <?= \yii\helpers\Html::img($comment->author->profile->avatarNN->getUrlImageSizeOf('100x100')); ?>
            </div>
            <div class="text">
                <div class="name">
                    <?= $comment->author->username; ?>
                </div>
                <?= $comment->text; ?>
            </div>
        </div>
    <?php } ?>
</div>