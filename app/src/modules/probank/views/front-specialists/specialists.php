<?php
/**
 * @var \app\dto\ProbankSpecialistsTransportModel $specialistTransportModel
 */
?>

<div class="members masonry">
    <?php if (count($specialistTransportModel->result) < 2) { ?>
        <div class="grid-sizer" style="width: 100%"></div>
    <?php } else { ?>
        <div class="grid-sizer"></div>
    <?php } ?>
    <div class="gutter-sizer"></div>

    <?php

    /**
     * @param \app\models\Portfolio $specialist
     * @return string
     */
    function specialistHrefInner($specialist)
    {
        ob_start();
        echo $specialist->mainPhotoNN->getImgSizeOf('450xR');
        ?>
        <span class="member-description">
            <span class="member-name"><?= $specialist->user->profile->firstname ?></span>
            <span class="member-type"><?= \Yii::t('app/probank', $specialist->typeEn); ?></span>
        </span>
        <?php
        return ob_get_clean();
    }

    foreach ($specialistTransportModel->result as $specialist):
        ?>
        <div class="item-member item-masonry"
             style="display: none; <?= (count($specialistTransportModel->result) < 2) ? 'width: 100%;' : '' ?> ">
            <?= \yii\helpers\Html::a(specialistHrefInner($specialist), "/specialist/{$specialist->id}"); ?>
        </div>
    <?php endforeach; ?>

</div>