<?php
/**
 * @var \app\modules\tosee\dto\PostTransportModel $postModel
 */

use yii\widgets\Pjax;

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
                        <i data-likes="<?= $image->likes ?>"
                           data-image-id="<?= $image->id ?>"
                           class="icon-like
                                <?= (!empty($image->myLike)) ? 'my-like' : ''; ?>
                                <?= (\Yii::$app->user->can('user')) ? 'like-action' : ''; ?>"></i>
                        <i class="icon-share"></i>
                        <i class="icon-buy"></i>
                        <button class="button" data-sharer="somesharer" data-width="800" data-height="600"
                                data-title="Checkout Sharer.js!" data-url="https://ellisonleao.github.io/sharer.js/">
                            Share!
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
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

                    <!--Comment-->
                    <div class="modal-inner-body">

                        <div class="comments" id="comments-of-<?= $image->id ?>">
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
                        </div>

                        <?php if (\Yii::$app->user->can('user')) { ?>
                            <div class="comment-form">
                                <?php $new_comment = new \app\models\Comments(); ?>
                                <?php $comment_form = \yii\widgets\ActiveForm::begin([
                                    'action' => '/comment',
                                    'id' => "comment-form-{$image->id}",
                                    'options' => [
                                        'class' => 'form form-ajax',
                                        'onsuccess' => "function(data) {
                                            var comment = $('<div class=\"comment new-comment\" style=\'display: none\'>
                                                            <div class=\"comment-avatar\">
                                                                <img src=\'' + data.comment.user.profile.avatar_url + '\'/>
                                                            </div>
                                                            <div class=\"comment-description\">
                                                                <span>' + data.comment.text + '</span>
                                                            </div>
                                                        </div>');
                                            $('#comments-of-{$image->id}').append(comment);
                                            $('#comments-text-{$image->id}').val('');
                                            comment.slideDown(\"slow\");
                                    }",
                                        'onerror' => "function(data) {
                                     }"
                                    ],
                                    'enableClientValidation' => true,
                                ]); ?>
                                <div class="comment-text">
                                    <?= $comment_form->field($new_comment, 'text')
                                        ->textarea(['id' => "comments-text-{$image->id}"])
                                        ->label(false); ?>
                                </div>

                                <?= $comment_form->field($new_comment, 'image_id', [
                                    'template' => "{input}",
                                    "options" => ['tag' => false]
                                ])
                                    ->hiddenInput(['value' => $image->id])
                                    ->label(false); ?>


                                <?= \yii\helpers\Html::submitButton(\Yii::t('app/tosee', 'Comment')); ?>
                                <?php \yii\widgets\ActiveForm::end(); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!--// Comment-->

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
