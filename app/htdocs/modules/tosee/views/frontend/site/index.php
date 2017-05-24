<?php
use \yii\helpers\Html;
use \components\helpers\Helpers;

?>
<div class="events">
    <div class="row">
        <div class="events__events-list">
            <?php foreach ($posts as $post) { ?>
                <div class="events__event">
                    <!-- event -->
                    <div class="event">
                        <div class="event__image-wrap">
                            <?= Html::a
                                (
                                    Helpers::bgImage
                                    (
                                        $post->image->patch,
                                        $post->image->name,
                                        ["size" => "350X390", "block" => "event", "class" => "event__img img-well"]
                                    ), //передаем html вывода картинки
                                    "/tosee/post/{$post->id}"
                                );
                            ?>
                            <div class="event__date"><?= date("d.m.y", $post->event_at); ?></div>
                        </div>
                        <div class="event__content">
                            <?= Html::a
                                (
                                    $post->postData->title, //заголовок
                                    "/tosee/post/{$post->id}",
                                    ["class" => "event__title"]
                                );
                            ?>

                            <div class="event__description">
                                <?= Helpers::cutStringSimbols($post->postData->post_desc, 250); ?>
                            </div>
                        </div>
                    </div>
                    <!--/ event -->
                </div>
            <? } ?>
        </div>
    </div>
</div>
<!--/ events -->


<div class="row">
    <div class="col-xs-24">
        <!-- pagination -->
        <div class="pagination">
            <div class="pagination__item">
                <!-- pagination-item -->
                <a href="" class="pagination-item pagination-item_disabled"><</a>
                <!--/ pagination-item -->
            </div>
            <div class="pagination__item">
                <!-- pagination-item -->
                <a href="" class="pagination-item pagination-item_disabled pagination-item_active">1</a>
                <!--/ pagination-item -->
            </div>
            <div class="pagination__item">
                <!-- pagination-item -->
                <a href="/past/2.html" class="pagination-item">2</a>
                <!--/ pagination-item -->
            </div>
            <div class="pagination__item">
                <!-- pagination-item -->
                <a href="/past/3.html" class="pagination-item">3</a>
                <!--/ pagination-item -->
            </div>
            <div class="pagination__item">
                <!-- pagination-item -->
                <a href="/past/4.html" class="pagination-item">4</a>
                <!--/ pagination-item -->
            </div>
            <div class="pagination__item">
                <!-- pagination-item -->
                <a href="/past/5.html" class="pagination-item">5</a>
                <!--/ pagination-item -->
            </div>
            <div class="pagination__dots">...
            </div>
            <div class="pagination__item">
                <!-- pagination-item -->
                <a href="/past/2.html" class="pagination-item">></a>
                <!--/ pagination-item -->
            </div>
        </div>
        <!--/ pagination -->
    </div>
</div>