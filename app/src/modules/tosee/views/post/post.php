<?php
/**
 * @var \app\modules\tosee\dto\PostTransportModel $postModel
 * @var $this yii\web\View
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

    <?php foreach ($postModel->result->additionalImages as $key => $image) {
        include '_modal-window.php';
    } ?>

</div>
