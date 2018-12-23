<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\tosee\models\ToseePostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/specialist', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialist-index">

    <h1 class="h1">Редактирование своих записей</h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/specialist', 'Создать пост'), ['create'], ['class' => 'button button--green']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                 'attribute' =>  'postDataTitle',
                 'label'    => 'Заголовок',
            ],
            'postData.post_short_desc',
            'event_at',
            [
                'attribute' => 'image_id',
                'label'    => 'Изображение',
                'format' => 'image',
                'value'     => function ($model, $index, $widget) {
                              return \app\helpers\Helpers::getImageSrc($model->image, ["size" => "200x200"]);
                }
            ],
             'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
