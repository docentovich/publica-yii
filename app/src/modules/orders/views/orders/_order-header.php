<?php
/**
 * @var \orders\dto\OrdersTransportModel $orderTransportModel
 * @var \yii\web\View $this
 */
?>
<div class="member-header order-header">
    <div class="title"><?= $orderTransportModel->result->seller->profileNN->fullName; ?></div>
    <div class="sub-title"><?= \Yii::t('app/probank', $orderTransportModel->result->portfolio->typeEn); ?></div>
    <div class="order-header-avatars">
        <?= \app\widgets\bgimg\BackgroundImage::widget([
            'image' => $orderTransportModel->result->customer->profileNN->avatarWhiteNN,
            'size' => [80, 80],
            'wrapper_size' => null,
            'options' => ['class' => 'flex-el avatar']
        ]); ?>
        <i class="flex-el icon-exchange2" aria-hidden="true"></i>
        <?= \app\widgets\bgimg\BackgroundImage::widget([
            'image' => $orderTransportModel->result->seller->profileNN->avatarWhiteNN,
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
                <span>
                    <?php
                    $dateTimePlanner = $orderTransportModel->result->dateTimePlanner;
                    array_splice($dateTimePlanner, 2);
                    echo implode(', ', array_map(function ($dtp) {
                            /** @var DateTimePlanner $dtp */
                            return $dtp->time;
                        }, $dateTimePlanner)
                    );
                    if(count($orderTransportModel->result->dateTimePlanner) > 2){
                        echo ' ...';
                    }
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>