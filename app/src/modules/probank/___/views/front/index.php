<?php
use yii\helpers\Html;
use app\helpers\Helpers;
if( empty($service->items) ){
    echo "<h1>Нет записей для отображения</h1>";
    return;
}
?>
<div class="events">
    <div class="row">
        <div class="events__events-list">
            <?php foreach ($service->items as $post) { ?>
                <div class="events__event">
                    <!-- event -->
                    <div class="event">
                        <div class="event__image-wrap">
                            <?= Html::a
                                (
                                    Helpers::bgImage
                                    (
                                        $post->image->path,
                                        $post->image->name,
                                        [
                                            "size" => "350x390",
                                            "block" => "event",
                                            "class" => "event__img img-well",
//                                            "extension" => $post->image->extension
                                        ]
                                    ), //передаем html вывода картинки
                                    "/specialist/{$post->id}"
                                );
                            ?>
                            <div class="event__date"><?= Helpers::dateVsDots($post->event_at); ?></div>
                        </div>
                        <div class="event__content">
                            <?= Html::a
                                (
                                    $post->postData->title, //заголовок
                                    "/specialist/{$post->id}",
                                    ["class" => "event__title"]
                                );
                            ?>

                            <div class="event__description">
                                <?= Helpers::cutStringSymbols($post->postData->post_short_desc, 250); ?>
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
<?= \app\widgets\____pagination\Pagination::widget([
   "service" => $service
]);