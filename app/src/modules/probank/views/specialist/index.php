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
         * @var \app\modules\tosee\models\ToseePost $post
         */
        ?>
        <div class="item-specialist item-masonry" style="display: none; <?= (count($postModel->result) < 2) ? 'width: 100%;' : '' ?> ">
                <?=
                \yii\helpers\Html::a(
                    \yii\helpers\Html::img($post->imageNN->getUrlImageSizeOf('450xR')),
                    "/specialist/{$post->id}"); ?>
                <div class="specialist-description"><?= $post->postData->sub_header; ?></div>
        </div>
    <?php endforeach; ?>

</div>