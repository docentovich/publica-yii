<?php
/**
 * @var \shootme\dto\ShootmeSpecialistsTransportModel $specialistTransportModel
 * @var $this yii\web\View
 */
?>

<div class="single-member">
    <div class="member-header">
        <a href="<?= $specialistTransportModel->prevLink; ?>">
            <div class="chevron-left"></div>
        </a>

        <a href="<?= $specialistTransportModel->nextLink; ?>">
            <div class="chevron-right"></div>
        </a>

        <div class="title"><?= $specialistTransportModel->result->user->profile->fullName; ?></div>
        <div class="sub-title"><?= \Yii::t('app/shootme', $specialistTransportModel->result->typeEn); ?></div>
    </div>
    <div class="member-body">

        <div class="member-characteristics">
            <div class="member-base-image">
                <?= \app\widgets\bgimg\BackgroundImage::widget([
                    'image' => $specialistTransportModel->result->mainPhotoNN,
                    'size' => '200x200',
                    'options' => ['class' => 'image-inner']

                ]); ?>
                <?php if (\Yii::$app->user->can('user')
                    && ($specialistTransportModel->result->userId !== Yii::$app->user->getId())) { ?>
                    <?= \yii\helpers\Html::a(
                        Yii::t('app', 'Order'),
                        [
                            '/orders/orders/order',
                            'portfolio_id' => $specialistTransportModel->config->portfolio_id,
                            'customer_id' => Yii::$app->user->getId()
                        ],
                        ['class' => 'green-button']
                    ); ?>
                <?php } ?>
            </div>
            <div class="member-numbers">
                <div class="member-numbers-rows">
                    <i class="fa fa-rub"></i>
                    <span><?= $specialistTransportModel->result->price ?></span>
                </div>
                <div class="member-numbers-rows">
                    <?= \yii\helpers\Html::a(
                        "<i class=\"fa fa-star-half-o\"></i>
                                <span>{$specialistTransportModel->result->rating}</span>",
                        ['front/orders', 'user_id' => $specialistTransportModel->result->user->id]
                    ); ?>
                </div>
                <div class="member-numbers-rows">
                    <i class="fa fa-shopping-basket"></i>
                    <span><?= $specialistTransportModel->result->ordersCount; ?></span>
                </div>
            </div>
        </div>


        <div class="member-description">
            <?= $specialistTransportModel->result->about; ?>
        </div>
        <div class="member-additional-photos masonry">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>


            <?php foreach ($specialistTransportModel->result->additionalImages as $key => $image) {
                /** @var \app\models\Image $image */
                ?>
                <div class="item-photo item-masonry" style="display: none">
                    <a class="item-photo-a" data-fancybox="gallery" href="#modal-<?= $key ?>">
                        <?= \app\widgets\pictures\Picture::widget([
                            "src" => $image->getUrlImageSizeOf('390xR'),
                            "points" => [
                                "sm, md, lg" => "450xR",
                            ]
                        ]) ?>
                    </a>
                </div>
            <?php } ?>


        </div>
    </div>
</div>
<div style="display: none">

    <?php foreach ($specialistTransportModel->result->additionalImages as $key => $image) {
        include '_modal-window.php';
    } ?>

</div>