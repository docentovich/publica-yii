<?php
/**
 * @var \tosee\dto\PostTransportModel $postModel
 */
?>

<div class="posts masonry">
    <?php if (count($postModel->result) < 2) { ?>
        <div class="grid-sizer" style="width: 100%"></div>
    <?php } else { ?>
        <div class="grid-sizer"></div>
    <?php } ?>
    <div class="gutter-sizer"></div>

    <?php

    foreach ($postModel->result as $post):
        /**
         * @var \tosee\models\ToseePost $post
         */
        ?>
        <div class="item-post item-masonry"
             style="display: none; <?= (count($postModel->result) < 2) ? 'width: 100%;' : '' ?> ">
            <?= \yii\helpers\Html::a(
                \yii\helpers\Html::img($post->imageNN->getUrlImageSizeOf('450xR')),
                \yii\helpers\ArrayHelper::merge(
                    ['front-post/post', 'id' => $post->id],
                    ['config' => $postModel->config->toArray()]
                )); ?>
            <div class="post-description"><?= $post->postData->sub_header; ?></div>
        </div>
    <?php endforeach; ?>

</div>