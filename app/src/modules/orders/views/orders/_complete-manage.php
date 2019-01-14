<?php
/**
 * @var \orders\dto\OrdersTransportModel $orderTransportModel
 * @var \yii\web\View $this
 */

$form = \yii\widgets\ActiveForm::begin([
    'options' => ['class' => 'form', 'id' => 'form-message']
]);
?>
    <div class="finish-order">
        <div class="finish-block">
            <label><?= Yii::t('app/orders', 'Rate from 0-5 points') ?></label>

            <select id="rate-manage" data-val="<?= $orderTransportModel->result->rate ?>">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <?= $form->field($orderTransportModel->result, 'rate')
                ->hiddenInput(['id' => 'rate-manage-input'])
                ->label('') ?>
        </div>
        <div class="finish-block finish-comment">
            <?= $form->field($orderTransportModel->result, 'final_message')
                ->textarea(['class' => 'message'])
                ->label(Yii::t('app/orders', 'Comment about partner')); ?>
        </div>

        <?= \yii\helpers\Html::submitButton(
            Yii::t('app/orders', 'Send message'),
            ['class' => 'green-button', 'name' => 'send_form']
        ); ?>
    </div>
<?php \yii\widgets\ActiveForm::end(); ?>

<?php
$this->registerJs(
    <<<JS
    (function($) {
        $('#rate-manage').on('rate:select', function(event, value) {
          $('#rate-manage-input').val(value);
        });
    })(jQuery);
JS
    , \yii\web\View::POS_END);
