<?php
/**
 * @var \orders\dto\OrdersTransportModel $orderTransportModel
 * @var \yii\web\View $this
 */
?>
<div class="finish-order">
    <div class="finish-block">
        <label><?= Yii::t('app/orders', 'Rating') ?></label>

        <select id="rate" data-val="<?= $orderTransportModel->result->rate ?>">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <div class="finish-block finish-comment">
        <label><?= Yii::t('app/orders', 'Comment about performer') ?></label>
        <span><?= $orderTransportModel->result->finalMessage ?></span>
    </div>
</div>
