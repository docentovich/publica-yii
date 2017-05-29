<?php
use \yii\helpers\Html;
use \components\helpers\Helpers;
if( empty($posts) ){
    echo "Нет постов для отображения";
    return;
}
?>
<div class="events">
    <div class="row">
        <div class="events__events-list">
            <?php foreach ($posts->result as $post) { ?>
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
                                    "/post/{$post->id}"
                                );
                            ?>
                            <div class="event__date"><?= Helpers::dateVsDots($post->event_at); ?></div>
                        </div>
                        <div class="event__content">
                            <?= Html::a
                                (
                                    $post->postData->title, //заголовок
                                    "/post/{$post->id}",
                                    ["class" => "event__title"]
                                );
                            ?>

                            <div class="event__description">
                                <?= Helpers::cutStringSimbols($post->postData->post_short_desc, 250); ?>
                            </div>
                        </div>
                    </div>
                    <!--/ event -->
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!--/ events -->
<?= \modules\tosee\widgets\pagination\Pagination::widget([
   "total_items"    => $posts->count,
   "items_limit"    => \modules\tosee\controllers\frontend\SiteController::$_limit_per_page,
   "current_page"   => $current_page,
   "url"            => $url
]);