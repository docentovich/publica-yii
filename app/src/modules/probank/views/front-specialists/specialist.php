<?php
/**
 * @var \app\dto\SpecialistsTransportModel $specialistTransportModel
 * @var $this yii\web\View
 */

?>

<div class="single-post">
    <div class="post-header">
        <a href="<?= $specialistTransportModel->prevLink; ?>">
            <div class="chevron-left"></div>
        </a>

        <a href="<?= $specialistTransportModel->nextLink; ?>">
            <div class="chevron-right"></div>
        </a>

        <div class="title"><?= $specialistTransportModel->result->postData->title; ?></div>
        <div class="sub-title"><?= $specialistTransportModel->result->event_at; ?></div>
    </div>
    <div class="post-body">
        <div class="post-description">
            <?= $specialistTransportModel->result->postData->post_desc; ?>
        </div>
        <div class="post-additional-photos masonry">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>


            <?php foreach ($specialistTransportModel->result->additionalImages as $key => $image) {
                /** @var \app\models\Image $image */
                ?>
                <div class="item-photo item-masonry" style="display: none">
                    <a class="item-photo-a" data-fancybox="gallery" href="#modal-<?= $key ?>">
                        <?= \app\widgets\pictures\Picture::widget([
                            "src" => $image->getUrlImageSizeOf('390xR'),
                            "points" => [
                                "sm, md, lg" => "450xR",
                            ]
                        ]) ?>
                    </a>
                </div>
            <?php } ?>


        </div>
    </div>
</div>
<div style="display: none">

    <?php foreach ($specialistTransportModel->result->additionalImages as $key => $image) {
        include '_modal-window.php';
    } ?>

</div>
