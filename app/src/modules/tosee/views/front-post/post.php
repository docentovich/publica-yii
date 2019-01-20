<?php
/**
 * @var \tosee\dto\PostTransportModel $postModel
 * @var $this yii\web\View
 */

/**
 * @param \app\models\Post|null $post
 * @param string $linkClass
 * @return string
 */
$chevronLink = function ($post, $linkClass) use ($postModel)
{
    $tag = \yii\helpers\Html::tag('span', '', ['class' => $linkClass]);
    if ($post !== null) {
        return \yii\helpers\Html::a(
            $tag, \yii\helpers\ArrayHelper::merge(
            ['front-post/post', 'id' => $post->id],
            ['config' => $postModel->config->configFromQueryParams->toArray()]
        ));
    } else {
        return $tag;
    }
}

?>

<div class="single-post">
    <div class="post-header">

        <?= $chevronLink($postModel->prevPost, 'chevron-left'); ?>
        <?= $chevronLink($postModel->nextPost, 'chevron-right'); ?>

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

    <?php foreach ($postModel->result->additionalImages as $key => $image) {
        include \Yii::getAlias('@common-views') . '/_modal-window.php';
    } ?>

</div>
