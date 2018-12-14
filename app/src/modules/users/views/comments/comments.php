<?php
/** @var \app\models\Comments[] $comments */
foreach ($comments as $comment){
    ?>
    <?= $comment->author->username; ?>
    <?= \yii\helpers\Html::img($comment->author->profile->avatarNN->getUrlImageSizeOf('100x100')); ?>
    <?= $comment->text; ?>
<?php } ?>