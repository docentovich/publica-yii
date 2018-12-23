<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\tosee\models\ToseePost */

$this->title = Yii::t('app/specialist', 'Редактирование записи: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/specialist', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/specialist', 'Update');
?>
<div class="specialist-update">

    <h1><?= Html::encode($model->postData->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'upload' => $upload,
        'post_data' => $post_data,
    ]) ?>

</div>
