<?php
/**
 * @var \app\dto\SpecialistsTransportModel $specialistTransportModel
 */
?>

<div class="posts masonry">
    <?php if(count($specialistTransportModel->result) < 2) { ?>
        <div class="grid-sizer" style="width: 100%"></div>
    <?php } else { ?>
        <div class="grid-sizer"></div>
    <?php } ?>
    <div class="gutter-sizer"></div>

    <?php

    foreach ($specialistTransportModel->result as $specialist):
        /**
         * @var \app\models\Portfolio $specialist
         */
        ?>
        <div class="item-post item-masonry" style="display: none; <?= (count($specialistTransportModel->result) < 2) ? 'width: 100%;' : '' ?> ">
                <?=
                \yii\helpers\Html::a(
                    $specialist->mainPhotoNN->getImgSizeOf('450xR'),
                    "/specialist/{$specialist->id}"); ?>
                <div class="post-description"><?= $specialist->user->profileNN->fullName; ?></div>
        </div>
    <?php endforeach; ?>

</div>