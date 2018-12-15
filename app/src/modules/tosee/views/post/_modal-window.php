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
            <?= \app\widgets\Picture::widget([
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
                <i class="icon-share"></i>
                <i class="icon-buy"></i>
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
                                <?= \yii\helpers\Html::img($comment->author->profile->avatarNN->getUrlImageSizeOf('40x40')) ?>
                            </div>
                            <div class="comment-description">
                                <strong><?= $comment->title ?></strong>
                                <span><?= $comment->text ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if (\Yii::$app->user->can('user')) {
                    $this->render('_comments-form', ['image' => $image]);
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