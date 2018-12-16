<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/user', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1 class="h1">Редактирование своих записей</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/post', 'Создать пост'), ['create'], ['class' => 'button button--green']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'postData.title',
            ],
            'postData.sub_header',
            [
                'attribute' => 'event_at',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'event_at',
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['class' => 'form-control'],
                ]),
                'format' => 'html',
                'value' => 'event_at',
            ],
            [
                'attribute' => 'image',
                'format' => 'image',
                'value' => function ($model, $index, $widget) {
                    /** @var \app\modules\tosee\models\PostSearch $model */
                    return $model->imageNN->getUrlImageSizeOf("200x200");
                },
            ],
            [
                'attribute' => 'created_at',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['class' => 'form-control']
                ]),
            ],
            [
                'class' => \yii\grid\ActionColumn::class,
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $icon = Html::tag('i', '', ['class' => "fa fa-pencil"]);
                        return Html::a($icon, $url);
                    },
                    'delete' => function ($url, $model, $key) {
                        $icon = Html::tag('i', '', ['class' => "fa fa-minus-circle"]);
                        return Html::a($icon, $url);
                    },
                ]
            ],
        ],
    ]); ?>
    </div>
</div>
