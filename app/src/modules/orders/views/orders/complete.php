<?php
/**
 * @var \orders\dto\OrdersTransportModel $orderTransportModel
 * @var \yii\web\View $this
 */
if (\Yii::$app->user->can('manageOrder', ['order_id' => $config->order_id])) {
    $this->render('_complete-manage', compact('orderTransportModel'));
}else{
    $this->render('_complete-not-manage', compact('orderTransportModel'));
}