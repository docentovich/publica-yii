<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \modules\tosee\models\common\Post;

/* @var $this yii\web\View */
/* @var $searchModel modules\tosee\models\common\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/post', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="float: right">
    <?= Html::a(Yii::t('app/post', 'На модерации'), ['index'], ['class' => 'btn btn-link']) ?>
</div>
<div style="float: right">
    <?= Html::a(Yii::t('app/post', 'Все'), ['all'], ['class' => 'btn btn-link']) ?>
</div>
<div class="post-index">

    <h1 class="h1">Редактирование своих записей</h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('app/post', 'Создать пост'), ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
            'postDataTitle',
            'postData.post_short_desc',
            'event_at',
//            'post_category_id',
            [
                'attribute' => 'image_id',
                'label' => 'Изображение',
                'format' => 'image',
                'value' => function ($model, $index, $widget) {
                    return \components\helpers\Helpers::getImageSrc($model->image, ["size" => "200x200"]);
                }
            ],

//            'image_id',
            // 'status',
            'created_at',
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {

                    ob_start(); ?>
                    <? if ($model->status == Post::STATUS_ACTIVE) { ?>
                        <?= HTML::a("Заблокировать", ['index', 'status' =>  Post::STATUS_BLOCKED, 'id' => $model->id], ['class' => 'btn btn-danger']); ?>
                    <?php } elseif ($model->status == Post::STATUS_ON_MODERATE) { ?>
                        <?= HTML::a("Одобрить", ['index', 'status' => Post::STATUS_ACTIVE, 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                        <?= HTML::a("Отклонить", ['index', 'status' => Post::STATUS_NOT_PASS_MODERATE, 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
                    <?php } elseif ($model->status == Post::STATUS_NOT_PASS_MODERATE) { ?>
                        Отклюнен
                    <?php } else { ?>
                        Заблокирован
                    <?php } ?>
                    <?php return ob_get_clean();

                }
            ],
            [
                'class' => \yii\grid\ActionColumn::className(),
                'template' => '{view}',
                // you may configure additional properties here
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
