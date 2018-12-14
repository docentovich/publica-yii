<?php
/**
 * @var \app\models\Orders[] $orders
 * @var \app\models\Orders[] $sales
 */

foreach ($orders as $order) {
    ?>
    <div>
        <?= \yii\helpers\Html::img(
            (\yii\helpers\ArrayHelper::getValue($order, 'seller.profile.avatarNN') ?? new \app\models\Image())
                ->getUrlImageSizeOf("100x100")
        ); ?>
    </div>
    <div><?= \yii\helpers\ArrayHelper::getValue($order, 'seller.profile.name') ?></div>
<?php } ?>