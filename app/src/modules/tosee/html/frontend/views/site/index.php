<?php
/**
 * @var \app\dto\TransportModel $postModel
 */
?>

<div class="content-wrapper">
    <div class="content">
        <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
        <div class="posts masonry">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>

            <?php
            /**
             * @var \app\modules\tosee\models\Post $post
             */
            foreach ($postModel->result as $post): ?>
                <div class="item-post item-masonry" style="display: none">
                    <a href="/post.html">
                        <?=
                        \yii\helpers\Html::a(
                            \yii\helpers\Html::img( "/uploads/post/{$post->image->getImageSizeOf('500x500')}" ),
                            "/post/{$post->id}"); ?>
                        <div class="post-description"><?= $post->getPostDataShortDesc(); ?></div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>