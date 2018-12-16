<?php
/** @var \app\models\Comments[] $comments */
?>
<div class="comments">
    <?php foreach ($comments as $comment) {
        ?>
        <div class="comment">
            <div class="avatar">
                <?= $comment->author->profile->avatarNN->getImgSizeOf('100x100'); ?>
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