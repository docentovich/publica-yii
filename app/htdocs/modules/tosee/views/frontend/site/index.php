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
                                        ["size" => "350X390", "block" => "event"]
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
                                <?= Helpers::shortDesc($post->postData->post_desc, 15); ?>
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
