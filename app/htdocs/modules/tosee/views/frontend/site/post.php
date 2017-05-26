<?php
/**
 * Вид поста
 */

use \components\helpers\Helpers;

?>

<!-- single-event -->
<div class="single-event">
    <div class="single-event__inner">
        <?= Helpers::bgImage(
            $post->image->patch,
            $post->image->name,
            [
                'class' => "single-event__img img-well",
                "size" => "860x516",
            ]
        );
        ?>
<!--        <div style="background-image: url(/images/people/dep1.jpg)" class="">-->
        <div class="single-event__content">
            <h1 class="single-event__h1"><?= $post->postData->sub_header; ?></h1>

            <div class="single-event__desc"><?= $post->postData->post_desc; ?></div>
            <div class="single-event__image-gal">
                <!-- image-gal -->
                <div class="image-gal">

                    <?php foreach ($post->postImages as $image) {
//                        var_dump($image);
                        ?>
                        <a href="#bs-modal0" data-fancybox="images" class="image-gal__a">
                            <?= Helpers::bgImage(
                                    $image->patch,
                                    $image->name,
                                    [
                                        'class' => "image-gal__image",
                                        "size" => "215x215",
                                    ]
                                );
                            ?>
<!--                            <span style="background-image: url(/images/people/baba.jpg)"-->
<!--                                  class="image-gal__image"></span>-->
                        </a>
                        <div style="display: none">
                            <!-- modal -->
                            <div id="bs-modal0" class="modal">
                                <div class="modal__to-left"><</div>
                                <div class="modal__to-right">></div>

                                <!--                            860x516-->
                                <img src="/images/people/baba.jpg" class="modal__image" alt="" role="presentation"/>

                                <div class="modal__content container-fluid">
                                    <div class="modal__line1">
                                        <div class="modal__title">Название картинки - alt картинки
                                        </div>
                                        <div class="modal__likes">
                                            <div class="modal__counter">456
                                            </div>
                                            <div class="modal__hart"><i
                                                    class="modal__i sprite-img sp-sprite sp-sprite__hart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal__line2">
                                        <div
                                            class="modal__line2-group modal__line2-group_h1 modal__line2-group_opacity">
                                            <div class="modal__text">H1 поста, к которому принадлежит фото
                                            </div>
                                        </div>
                                        <div class="modal__line2-group modal__line2-group_opacity">
                                            <div class="modal__text hidden-sm hidden-xs">Мне нравиться
                                            </div>
                                            <div class="modal__ico"><i
                                                    class="modal__i sprite-img sp-sprite sp-sprite__like hidden-xs"></i><i
                                                    class="modal__i sprite-img sp-sprite sp-sprite__likeSm visible-xs"></i>
                                            </div>
                                        </div>
                                        <div class="modal__line2-group modal__line2-group_opacity">
                                            <div class="modal__text hidden-sm hidden-xs">Купить
                                            </div>
                                            <div class="modal__ico"><i
                                                    class="modal__i sprite-img sp-sprite sp-sprite__by hidden-xs"></i><i
                                                    class="modal__i sprite-img sp-sprite sp-sprite__bySm visible-xs"></i>
                                            </div>
                                        </div>
                                        <div class="modal__line2-group modal__line2-group_social">
                                            <div class="modal__text hidden-sm hidden-xs">Поделиться
                                            </div>
                                            <div class="modal__ico"><i
                                                    class="modal__i sprite-img sp-sprite sp-sprite__fb"></i>
                                            </div>
                                            <div class="modal__ico"><i
                                                    class="modal__i sprite-img sp-sprite sp-sprite__vk"></i>
                                            </div>
                                            <div class="modal__ico"><i
                                                    class="modal__i sprite-img sp-sprite sp-sprite__inst"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ modal -->
                        </div>
                    <?php } ?>


                </div>
                <!--/ image-gal -->
            </div>
        </div>
    </div>
</div>
<!--/ single-event -->
