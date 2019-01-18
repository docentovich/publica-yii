<?php
/**
 * @var \yii\web\View $this
 * @var \shootme\dto\ShootmeSpecialistsTransportModel $specialistTransportModel
 */

$form = \yii\widgets\ActiveForm::begin([
    'action' => \yii\helpers\Url::to([
        '/orders/orders/order',
        'portfolio_id' => $specialistTransportModel->config->portfolio_id,
        'customer_id' => Yii::$app->user->getId()
    ]),
    'id' => 'mid',
    'options' => ['class' => 'calendar'],
    'method' => 'POST'
]);

echo \DateTimePlanner\widget\DateTimePlanner::widget([
    'id' => 'dtp-order',
    'user_id' => $specialistTransportModel->result->userId
]);

echo \yii\helpers\Html::submitButton(
    Yii::t('app/shootme', 'Order'),
    [
        'class' => 'submit',
        'id' => 'order-submit',
        'style' => 'display: none'
    ]
);

\yii\widgets\ActiveForm::end();

$this->registerJs(
<<<MJS
  $('#dtp-order').on('timeSelected', function(_, time, date){
      if($(this).data('time') && $(this).data('time').length > 0){
          $('#order-submit').show();
      }else{
          $('#order-submit').hide();
      }
  })
MJS
    , \yii\web\View::POS_END
);