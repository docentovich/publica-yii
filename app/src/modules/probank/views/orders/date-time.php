<?php
/**
 * @var \yii\web\View $this
 * @var \probank\dto\OrdersTransportModel $specialistTransportModel
 */

$form = \yii\widgets\ActiveForm::begin([
    'action' => \yii\helpers\Url::to([
        '/orders/orders/start',
        'sellers_portfolio_id' => $specialistTransportModel->result->id,
        'customer_id' => Yii::$app->user->getId()
    ]),
    'id' => 'mid',
    'options' => ['class' => 'calendar'],
    'method' => 'GET'
]);

echo \DateTimePlanner\widget\DateTimePlanner::widget([
    'id' => 'dtp-order',
    'user_id' => $specialistTransportModel->result->userId
]);

echo \yii\helpers\Html::submitButton(
    Yii::t('app/probank', 'Order'),
    [
        'class' => 'submit',
        'id' => 'submit',
        'style' => 'display: none'
    ]
);

\yii\widgets\ActiveForm::end();

$this->registerJs(
<<<MJS
  $('#dtp-order').on('timeSelected', function(_, time, date){
      if($(this).data('time') && $(this).data('time').length > 0){
          $('#submit').show();
      }else{
          $('#submit').hide();
      }
  })
MJS
    , \yii\web\View::POS_END
);