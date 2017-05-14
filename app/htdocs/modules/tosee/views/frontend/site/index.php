<?php
use \yii\helpers\Html;
use \components\helpers\Helpers;
var_dump($posts);
?>
<div class="events">
    <div class="row">
        <div class="events__events-list">
            <? foreach($posts as $post){
                ?>
                <div class="events__event"><!-- event -->
                <div class="event">
                    <div class="event__image-wrap">
                        <?= Html::a(
                            Helpers::bgImage($post->src, ["size" => "350X390", "block" => "event", "user_id" => $post->user_id]), //передаем html вывода картинки
                            "/tosee/post/{$post->id}"
                        ); ?>
                        <div class="event__date"><?= date("d.m.y", $post->event_at);?></div>
                    </div>
                    <div class="event__content">
                        <?= Html::a(
                            $post->title, //заголовок
                            "/tosee/post/{$post->id}",
                            ["class" => "event__title"]
                        ); ?>


                        <div class="event__description"><?= Helpers::shortDesc($post->post_desc, 15); ?></div>
                    </div>
                </div><!--/ event -->
            </div>
            <? } ?>
        </div>
    </div>
</div><!--/ events -->
