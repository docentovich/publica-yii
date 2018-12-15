<?php
/**
 * @var \app\models\Orders[] $orders
 * @var \app\models\Orders[] $sales
 */
?>
<div class="orders">
    <?php
    $counter = 0;
    foreach ($orders as $order) {
        $counter ++;
        ?>
        <div class="order">
            <div class="counter"><?= $counter; ?></div>
            <div class="avatar">
                <?= \yii\helpers\Html::img(
                    (\yii\helpers\ArrayHelper::getValue($order, 'seller.profile.avatarNN') ?? new \app\models\Image())
                        ->getUrlImageSizeOf("100x100")
                ); ?>
            </div>
            <div class="exchange"><i class="fa fa-exchange"></i></div>
            <div class="avatar">
                <?= \yii\helpers\Html::img(
                    (\yii\helpers\ArrayHelper::getValue($order, 'customer.profile.avatarNN') ?? new \app\models\Image())
                        ->getUrlImageSizeOf("100x100")
                ); ?>
            </div>
            <div class="raiting">
                <i class="fa fa-star-o"></i>
                <?=$order->rate;?>
            </div>
        </div>
    <?php } ?>
</div>
