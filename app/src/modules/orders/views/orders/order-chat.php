<?php
/**
 * @var \yii\web\View $this
 * @var \orders\dto\OrdersTransportModel $orderTransportModel
 */

use app\models\DateTimePlanner;

?>
<div class="single-member order">
    <div class="member-header order-header">
        <div class="title"><?= $orderTransportModel->result->seller->profileNN->fullName; ?></div>
        <div class="sub-title"><?= \Yii::t('app/probank', $orderTransportModel->result->portfolio->typeEn); ?></div>
        <div class="order-header-avatars">
            <?= \app\widgets\bgimg\BackgroundImage::widget([
                'image' => $orderTransportModel->result->customer->profileNN->avatarNN,
                'size' => [80, 80],
                'wrapper_size' => null,
                'options' => ['class' => 'flex-el avatar']
            ]); ?>
            <i class="flex-el icon-exchange2" aria-hidden="true"></i>
            <?= \app\widgets\bgimg\BackgroundImage::widget([
                'image' => $orderTransportModel->result->seller->profileNN->avatarNN,
                'size' => [80, 80],
                'wrapper_size' => null,
                'options' => ['class' => 'flex-el avatar']
            ]); ?>
        </div>
        <div class="order-geo-time">
            <div class="order-geo-time-inner">
                <div class="flex-el">
                    <i class="icon-geo"></i>
                    <span><?= \Yii::t('app/cities', $orderTransportModel->result->seller->city->label); ?></span>
                </div>
                <div class="flex-el">
                    <i class="icon-clock"></i>
                    <span><?= implode(' ', array_map(function ($dtp) {
                                /** @var DateTimePlanner $dtp */
                                return $dtp->time;
                            }, $orderTransportModel->result->dateTimePlanner)
                        ) ?></span>
                </div>
            </div>
        </div>
    </div>
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
            <a class="finish-order-control" href="/finish-order.html"
               id="finish-order-control-yes">Да</a>
            <button class="finish-order-control" id="finish-order-control-no">Нет</button>
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
