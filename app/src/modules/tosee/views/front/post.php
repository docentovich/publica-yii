<?php
/**
 * @var \app\modules\tosee\dto\PostTransportModel $postModel
 */
?>

<div class="single-post">
    <div class="post-header">
        <a href="<?= $postModel->prevLink; ?>">
            <div class="chevron-left"></div>
        </a>

        <a href="<?= $postModel->nextLink; ?>">
            <div class="chevron-right"></div>
        </a>

        <div class="title"><?= $postModel->result->postData->title; ?></div>
        <div class="sub-title"><?= $postModel->result->event_at; ?></div>
    </div>
    <div class="post-body">
        <div class="post-description">
            <?= $postModel->result->postData->post_desc; ?>
        </div>
        <div class="post-additional-photos masonry">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>

            <?php foreach ($postModel->result->additionalImages as $key => $image) {
                /** @var \app\models\Image $image */
                ?>
                <div class="item-photo item-masonry" style="display: none">
                    <a class="item-photo-a" data-fancybox="gallery" href="#modal-<?= $key ?>">
                        <?= \app\widgets\Picture::widget([
                            "src" => $image->getUrlImageSizeOf('200xR'),
                            "points" => [
                                "sm, md" => "280xR",
                                "lg" => "390xR",
                            ]
                        ]) ?>
                    </a>
                </div>

            <?php } ?>

        </div>
    </div>
</div>
<div style="display: none">

    <?php foreach ($postModel->result->additionalImages as $key => $image) { ?>
        <div class="modal-window" id="modal-<?= $key ?>">
            <div class="modal-header">
                <div class="modal-image">
                    <?= \app\widgets\Picture::widget([
                        "src" => $image->getUrlImageSizeOf('768x500'),
                        "points" => [
                            "sm, md" => "1200x500",
                            "lg" => "1500x500",
                        ],
                        "lazyLoadFn" => true
                    ]) ?>

                </div>
                <div class="modal-controls">
                    <div class="left-controls">
                        <i class="icon-info modal-tab-control is-active" rel="<?= $key ?>-info"></i>
                        <i class="icon-comments modal-tab-control" rel="<?= $key ?>-comments"></i>
                    </div>
                    <div class="right-controls">
                        <i class="icon-like"></i>
                        <i class="icon-share"></i>
                        <i class="icon-buy"></i>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-tab modal-comments" style="display: none" id="tab-<?= $key ?>-comments">
                    <div class="modal-likes">
                        <div class="fa fa-heart"></div>
                        <div class="likes-counter"><?= $image->likes ?></div>
                    </div>
                    <div class="modal-inner-body">
                        <?php foreach ($image->comments as $comment) { ?>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img($comment->user->profile->avatarNN->getUrlImageSizeOf('40x40')) ?>
                                </div>
                                <div class="comment-description">
                                    <strong><?= $comment->title ?></strong>
                                    <span><?= $comment->text ?></span>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="comment"></div>

                    </div>
                </div>
                <div class="modal-tab modal-info" id="tab-<?= $key ?>-info">
                    <div class=" modal-inner-body">
                        <?= $image->desc ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
