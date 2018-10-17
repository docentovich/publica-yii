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
                            \app\helpers\Helpers::image(
                                'post/' . $post->image->patch,
                                $post->image->name,
                                [
                                    "size" => "550x614",
                                    "block" => "event",
                                    "class" => "event__img img-well",
                                ]), //передаем html вывода картинки
                                "/post/{$post->id}"
                        ); ?>
                        <div class="post-description"><?= $post->getPostDataShortDesc(); ?></div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>