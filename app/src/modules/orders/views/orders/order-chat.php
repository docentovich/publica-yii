<?php
/**
 * @var \yii\web\View $this
 * @var \orders\dto\OrdersTransportModel $orderTransportModel
 */

use app\models\DateTimePlanner;

?>
<div class="single-member order">
    <?= $this->render('_order-header', compact('orderTransportModel')); ?>
    <div class="member-body order-body">
        <div class="order-body-inner">

            <div id="messages" class="comments">
                <?php foreach ($orderTransportModel->result->orderMessages as $message) {
                    ?>
                    <div class="comment">
                        <div class="comment-avatar"><?= $message->owner->profileNN->avatarNN->getImgSizeOf('100x100'); ?></div>
                        <div class="comment-description">
                            <strong><?= $message->owner->username; ?></strong>&nbsp;
                            <span><?= $message->message; ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php $form = \yii\widgets\ActiveForm::begin([
                'action' => ['/orders/orders/send-message', 'order_id' => $orderTransportModel->result->id],
                'options' => ['class' => 'form form-ajax', 'id' => 'form-message']
            ]);
            echo $form->field(($orderMessage = new \src\models\OrdersMessages()), 'message')
                ->textarea(['class' => 'message', 'id' => 'message-text'])
                ->label('');
            echo \yii\helpers\Html::submitButton(
                Yii::t('app/orders', 'Send message'),
                ['class' => 'green-button']
            );
            \yii\widgets\ActiveForm::end();
            ?>
        </div>
    </div>
    <div class="bottom-bar"><span id="finish-order-toggle">Завершить заказ</span></div>
    <div id="finish-order"><span>Завершить заказ?</span>
        <div class="finish-order-control-row">
            <?= \yii\helpers\Html::a(
                    \Yii::t('app', 'Yes'),
                    ['/orders/orders/finish', 'order_id' => $orderTransportModel->result->id],
                    ['class' => 'finish-order-control', 'id' => 'finish-order-control-yes']
            ); ?>
            <?= \yii\helpers\Html::button(
                \Yii::t('app', 'No'),
                ['class' => 'finish-order-control', 'id' => 'finish-order-control-no']
            ) ?>

        </div>
    </div>
</div>

<?php
$this->registerJs(
<<<JS
    $('#form-message').on('ajax:success', function(_, data) {
         var message = $('<div class=\"comment\" style=\'display: none\'>' +
                          '<div class=\"comment-avatar\">' +
                             '<img src=\'' + data.owner.profile.avatar_url + '\'/>' +
                          '</div>' +
                          '<div class=\"comment-description\">' +
                              '<strong>' + data.owner.username + '</strong>&nbsp;' +
                              '<span>' + data.message + '</span>' +
                          '</div>' +
                        '</div>');
         $('#messages').append(message);
         $('#message-text').val('');
         message.slideDown("slow");
    });
JS
, \yii\web\View::POS_END
);
