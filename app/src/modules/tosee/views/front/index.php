<?php
/**
 * @var \app\dto\PostTransportModel $postModel
 */
?>

<div class="posts masonry">
    <?php if(count($postModel->result) < 2) { ?>
        <div class="grid-sizer" style="width: 100%"></div>
    <?php } else { ?>
        <div class="grid-sizer"></div>
    <?php } ?>
    <div class="gutter-sizer"></div>

    <?php

    foreach ($postModel->result as $post):
        /**
         * @var \app\modules\tosee\models\Post $post
         */
        ?>
        <div class="item-post item-masonry" style="display: none; <?= (count($postModel->result) < 2) ? 'width: 100%;' : '' ?> ">
                <?=
                \yii\helpers\Html::a(
                    \yii\helpers\Html::img($post->imageNN->relativeUploadPath),
                    "/post/{$post->id}"); ?>
                <div class="post-description"><?= $post->postData->sub_header; ?></div>
        </div>
    <?php endforeach; ?>

</div>