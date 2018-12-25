<?php
/**
 * @var $this yii\web\View
 * @var string|int $key
 * @var \app\models\Image $image
 * @var string|int $key
 */
?>
<div class="modal-window" id="modal-<?= $key ?>">
    <div class="fancybox-navigation"><button data-fancybox-prev="" class="fancybox-button fancybox-button--arrow_left" title="Previous"><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.38-2.68 2.72H19v1.94H8.6z"></path></svg></div></button><button data-fancybox-next="" class="fancybox-button fancybox-button--arrow_right" title="Next" disabled=""><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.4 12.97l-2.68 2.72 1.34 1.38L19 12l-4.94-5.07-1.34 1.38 2.68 2.72H5v1.94z"></path></svg></div></button></div>
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
                <i class="icon-info modal-tab-control is-active" rel="<?= $key ?>-info"></i>
                <i class="icon-comments modal-tab-control" rel="<?= $key ?>-comments"></i>
            </div>
            <div class="right-controls">
                <i data-likes="<?= $image->likes ?>"
                   data-image-id="<?= $image->id ?>"
                   class="icon-like
                                <?= (!empty($image->myLike)) ? 'my-like' : ''; ?>
                                <?= (\Yii::$app->user->can('user')) ? 'like-action' : ''; ?>"></i>
                <i class="share-button"
                   data-share-title="<?=$image->alt?>"
                   data-share-image="<?=$image->getUrlImageSizeOf(null)?>"></i>
            </div>
        </div>
        <!--// Tabs-controls-->


    </div>
    <!--// Modal heading-->


    <div class="modal-body">
        <!-- Comments tab -->
        <div class="modal-tab modal-comments" style="display: none" id="tab-<?= $key ?>-comments">
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
                    include "_comments-form.php";
                } ?>
            </div>
            <!--// Comment-->

        </div>
        <!--// Comments-tab-->

        <!--Info-tab-->
        <div class="modal-tab modal-info" id="tab-<?= $key ?>-info">
            <div class=" modal-inner-body">
                <?= $image->desc ?>
            </div>
        </div>
        <!--// Info-tab-->
    </div>
</div>