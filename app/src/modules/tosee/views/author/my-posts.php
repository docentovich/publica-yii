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
                    return $model->image->getUrlImageSizeOf("200x200");
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
                'class' => \yii\grid\ActionColumn::className(),
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $icon = Html::tag('span', '', ['class' => "fas fa-pen"]);
                        return Html::a($icon, $url);
                    },
                    'delete' => function ($url, $model, $key) {
                        $icon = Html::tag('span', '', ['class' => "fas fa-minus-circle"]);
                        return Html::a($icon, $url);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
