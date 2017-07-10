<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use components\helpers\Helpers;
use modules\tosee\models\common\Post;

/* @var $this yii\web\View */
/* @var $model modules\tosee\models\common\Post */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/post', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">
    <p>
        <? if ($model->status == Post::STATUS_ACTIVE) { ?>
            <?= HTML::a("Заблокировать", ['index', 'status' =>  Post::STATUS_BLOCKED, 'id' => $model->id], ['class' => 'btn btn-danger']); ?>
        <?php } elseif ($model->status == Post::STATUS_ON_MODERATE) { ?>
            <?= HTML::a("Одобрить", ['index', 'status' => Post::STATUS_ACTIVE, 'id' => $model->id], ['class' => 'button button--green']) ?>
            <?= HTML::a("Отклонить", ['index', 'status' => Post::STATUS_NOT_PASS_MODERATE, 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?php } elseif ($model->status == Post::STATUS_NOT_PASS_MODERATE) { ?>
            Отклюнен
        <?php } else { ?>
            Заблокирован
        <?php } ?>
    </p>
    <br/>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'postData.title',
            'postData.sub_header',
            'event_at:date',
            [
                'attribute' => 'image_id',
                'value' => Helpers::renderImage($model->image, ['size' => "350x390"]),
                'label' => 'Изображение',
                'format'=>'raw',
            ],
            'postData.post_short_desc',
            [
                'attribute' => 'postData.post_desc',
                'format'=>'raw',
            ],
            'created_at:datetime',
        ],
    ]) ?>

    <div class="additional-images">
        <?php foreach($model->images as $image){ ?>
            <?= \components\helpers\Helpers::renderImage($image, ["size" => "215x215", "class" => "add-img"]) ?>
        <?php } ?>
    </div>

</div>
