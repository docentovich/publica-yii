<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\tosee\models\common\Post */

$this->title = Yii::t('app/post', 'Update {modelClass}: ', [
    'modelClass' => 'Post',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/post', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/post', 'Update');
?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
