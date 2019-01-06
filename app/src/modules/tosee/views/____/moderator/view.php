<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\Helpers;
use tosee\models\ToseePost;

/* @var $this yii\web\View */
/* @var $model tosee\models\ToseePost */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/post', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">
    <p>
        <?php if ($model->status == ToseePost::STATUS_ACTIVE) { ?>
            <?= HTML::a("Заблокировать", ['index', 'status' =>  ToseePost::STATUS_BLOCKED, 'id' => $model->id], ['class' => 'btn btn-danger']); ?>
        <?php } elseif ($model->status == ToseePost::STATUS_ON_MODERATE) { ?>
            <?= HTML::a("Одобрить", ['index', 'status' => ToseePost::STATUS_ACTIVE, 'id' => $model->id], ['class' => 'button button--green']) ?>
            <?= HTML::a("Отклонить", ['index', 'status' => ToseePost::STATUS_NOT_PASS_MODERATE, 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?php } elseif ($model->status == ToseePost::STATUS_NOT_PASS_MODERATE) { ?>
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
            <?= \app\helpers\Helpers::renderImage($image, ["size" => "215x215", "class" => "add-img"]) ?>
        <?php } ?>
    </div>

</div>
