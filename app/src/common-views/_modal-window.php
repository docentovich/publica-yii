<?php
/**
 * @var $this yii\web\View
 * @var string|int $key
 * @var \app\models\Image $image
 * @var string|int $key
 */
?>
<div class="modal-window" id="modal-<?= $key ?>">
    <!-- Modal heading-->
    <div class="modal-header">

        <!--Image-->
        <div class="modal-image">
            <?= \app\widgets\pictures\Picture::widget([
                "src" => $image->getUrlImageSizeOf('768x500'),
                "points" => [
                    "sm, md" => "1200x500",
                    "lg" => "1500x500",
                ],
                "lazyLoadFn" => true
            ]) ?>
        </div>
        <!--// Image-->

        <!--Tabs-controls-->
        <div class="modal-controls">
            <div class="left-controls">
                <i class="icon-comments modal-tab-control is-active" rel="<?= $key ?>-comments"></i>
                <i class="icon-info modal-tab-control" rel="<?= $key ?>-info"></i>
            </div>
            <div class="right-controls">
                <i data-likes="<?= $image->likes ?>"
                   data-image-id="<?= $image->id ?>"
                   class="icon-like3
                                <?= (!empty($image->myLike)) ? 'my-like' : ''; ?>
                                <?= (\Yii::$app->user->can('user')) ? 'like-action' : ''; ?>"></i>
                <i class="share-button icon-share"
                   data-share-title="<?=$image->alt?>"
                   data-share-image="<?=$image->getUrlImageSizeOf(null)?>"></i>
            </div>
        </div>
        <!--// Tabs-controls-->


    </div>
    <!--// Modal heading-->


    <div class="modal-body">
        <!-- Comments tab -->
        <div class="modal-tab modal-comments" id="tab-<?= $key ?>-comments">
            <div data-likes="<?= $image->likes ?>"
                 data-image-id="<?= $image->id ?>"
                 class="modal-likes
                            <?= (!empty($image->myLike)) ? 'my-like' : ''; ?>
                            <?= (\Yii::$app->user->can('user')) ? 'like-action' : ''; ?>">
                <div class="fa fa-heart"></div>
                <div class="likes-counter">
                    <?= $image->likes; ?>
                </div>
            </div>

            <!--Comments -->
            <div class="modal-inner-body">

                <div class="comments" id="comments-of-<?= $image->id ?>">
                    <?php foreach ($image->comments as $comment) { ?>
                        <div class="comment">
                            <div class="comment-avatar">
                                <?= $comment->author->profile->avatarNN->getImgSizeOf('40x40') ?>
                            </div>
                            <div class="comment-description">
                                <strong><?= $comment->title ?></strong>
                                <span><?= $comment->text ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if (\Yii::$app->user->can('user')) {
                    include \Yii::getAlias('@common-views') . "/_comments-form.php";
                } ?>
            </div>
            <!--// Comment-->

        </div>
        <!--// Comments-tab-->

        <!--Info-tab-->
        <div class="modal-tab modal-info" style="display: none" id="tab-<?= $key ?>-info">
            <div class=" modal-inner-body">
                <?= $image->desc ?>
            </div>
        </div>
        <!--// Info-tab-->
    </div>
</div>