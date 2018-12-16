<?php

namespace app\widgets;

use app\models\User;
use yii\base\Widget;

class UserHeader extends Widget
{
    public function init()
    {

    }


    public function run()
    {
        $user = \Yii::$app->user->identity ?? new User();
        ?>
        <div class="user-avatar-name">
            <div class="user-name"><?= $user->profileNN->fullName; ?></div>
            <div class="user-avatar dark-icon">
                <?php if ($user->profileNN->avatar) {
                    echo \yii\helpers\Html::img("/uploads/" . $user->profileNN->avatar0->getPathImageSizeOf('Rx270'));
                } else { ?>
                    <i class="fa fa-user"></i>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}