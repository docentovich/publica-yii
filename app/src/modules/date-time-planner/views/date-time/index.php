<?php
/** @var \yii\web\View $this */

$form = \yii\widgets\ActiveForm::begin();

echo $form->field($model, 'time')
    ->widget(\DateTimePlanner\widget\DateTimePlanner::class, ['id' => 'mid']);

\yii\widgets\ActiveForm::end();

$this->registerJs(
<<<MJS
  $('#mid').on('timeSelected', function(_, time){
    debugger;
  })  
MJS
    , \yii\web\View::POS_END
);
