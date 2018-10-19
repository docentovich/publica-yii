<?php
/**
 * @var \app\dto\PostTransportModel $postModel
 */
?>
<div class="content-wrapper">
    <div class="content">
        <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
        <div class="single-post">
            <div class="post-header"><a href="#">
                    <div class="chevron-left"></div>
                </a><a href="#">
                    <div class="chevron-right"></div>
                </a>
                <div class="title">Концерт в орле</div>
                <div class="sub-title">25.05.05</div>
            </div>
            <div class="post-body">
                <div class="post-description">
                    <?= $postModel->result->postData->postShortDesc; ?>
                </div>
                <div class="post-additional-photos masonry">
                    <div class="grid-sizer"></div>
                    <div class="gutter-sizer"></div>

                    <?php foreach ($postModel->result->images as $image) { ?>
                        <div class="item-photo item-masonry" style="display: none">
                            <a class="item-photo-a" data-fancybox="gallery" href="#modal-0">
                                <?= \yii\helpers\Html::img("/uploads/post/{$image->getFullPathImageSizeOf('500x500')}") ?>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div style="display: none">
            <div class="modal-window" id="modal-0">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="0-info"></i><i
                                    class="icon-comments modal-tab-control" rel="0-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-0-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-0-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-1">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="1-info"></i><i
                                    class="icon-comments modal-tab-control" rel="1-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-1-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-1-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-2">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="2-info"></i><i
                                    class="icon-comments modal-tab-control" rel="2-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-2-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-2-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-3">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="3-info"></i><i
                                    class="icon-comments modal-tab-control" rel="3-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-3-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-3-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-4">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="4-info"></i><i
                                    class="icon-comments modal-tab-control" rel="4-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-4-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-4-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-6">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="6-info"></i><i
                                    class="icon-comments modal-tab-control" rel="6-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-6-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-6-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-7">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="7-info"></i><i
                                    class="icon-comments modal-tab-control" rel="7-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-7-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-7-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-8">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="8-info"></i><i
                                    class="icon-comments modal-tab-control" rel="8-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-8-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-8-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-9">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="9-info"></i><i
                                    class="icon-comments modal-tab-control" rel="9-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-9-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-9-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-10">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="10-info"></i><i
                                    class="icon-comments modal-tab-control" rel="10-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-10-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-10-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-12">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="12-info"></i><i
                                    class="icon-comments modal-tab-control" rel="12-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-12-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-12-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-13">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="13-info"></i><i
                                    class="icon-comments modal-tab-control" rel="13-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-13-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-13-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-14">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="14-info"></i><i
                                    class="icon-comments modal-tab-control" rel="14-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-14-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-14-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-15">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="15-info"></i><i
                                    class="icon-comments modal-tab-control" rel="15-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-15-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-15-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window" id="modal-16">
                <div class="modal-header">
                    <div class="modal-image">
                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                    </div>
                    <div class="modal-controls">
                        <div class="left-controls"><i class="icon-info modal-tab-control" rel="16-info"></i><i
                                    class="icon-comments modal-tab-control" rel="16-comments"></i></div>
                        <div class="right-controls"><i class="icon-like"></i><i class="icon-share"></i><i
                                    class="icon-buy"></i></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-tab" id="tab-16-comments">
                        <div class="modal-likes">
                            <div class="fa fa-heart"></div>
                            <div class="likes-counter">544</div>
                        </div>
                        <div class="modal-comments modal-inner-body">
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-avatar">
                                    <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                </div>
                                <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-tab" style="display: none" id="tab-16-info">
                        <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>