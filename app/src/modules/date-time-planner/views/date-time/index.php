<?php
/** @var \yii\web\View $this */
$form = \yii\widgets\ActiveForm::begin([
    'action' => \yii\helpers\Url::to(['/planner/date-time-api/save']),
    'options' => ['class' => 'calendar form-ajax', 'id' => 'planner-form']
]);

echo $form->field($model, 'time')
    ->widget(\DateTimePlanner\widget\DateTimePlanner::class, ['id' => 'mid', 'date_attribute' => 'date'])
    ->label('');

echo \yii\helpers\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submit', 'id' => 'submit', 'style' => 'display:none']);

\yii\widgets\ActiveForm::end();

$this->registerJs(
<<<MJS
  $('#mid').on('timeSelected', function(_, time, date){
      var a = $(this).data('time');
      if($(this).data('time') && $(this).data('time').length > 0){
          $('#submit').show();
      }else{
          $('#submit').hide();
      }
  })
MJS
    , \yii\web\View::POS_END
);

$this->registerJs(
<<<MJS
  $('#planner-form').on('ajax:success', function(_, time){
    $('#mid').trigger('dateSelected');
  })
MJS
, \yii\web\View::POS_END
);
