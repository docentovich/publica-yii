<?php

namespace probank\models;

use app\models\User;

/** {@inheritdoc} */
class ProbankUser extends User
{
    public function getPortfolio()
    {
        return $this->hasOne(ProbankPortfolio::class, ['user_id' => 'id'])->inverseOf('user');
    }
}