<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\tosee\models\ToseePost */

$this->title = Yii::t('app/specialist', 'Создание записи');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/specialist', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-page__h1">
    <h1 class="h1"><?= Html::encode($this->title) ?></h1>
</div>
<div class="">
    <?= $this->render('_form', [
        'model' => $model,
        'upload' => $upload,
        'post_data' => $post_data,
    ]) ?>
</div>

