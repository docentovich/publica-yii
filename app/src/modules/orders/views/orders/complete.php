<?php
/**
 * @var \orders\dto\OrdersTransportModel $orderTransportModel
 * @var \yii\web\View $this
 */
?>
<div class="single-member order">
    <?= $this->render('_order-header', compact('orderTransportModel')); ?>
    <?php
    if (\Yii::$app->user->can(
        'manageOrder',
        ['order_id' => $orderTransportModel->config->order_id])
    ) {
        echo $this->render('_complete-manage', compact('orderTransportModel'));
    }else{
        echo $this->render('_complete-not-manage', compact('orderTransportModel'));
    }
    ?>
</div>
