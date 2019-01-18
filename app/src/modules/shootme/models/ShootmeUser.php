<?php

namespace shootme\models;

use app\models\User;

/** {@inheritdoc} */
class ShootmeUser extends User
{
    public function getPortfolio()
    {
        return $this->hasOne(ShootmePortfolio::class, ['user_id' => 'id'])->inverseOf('user');
    }
}