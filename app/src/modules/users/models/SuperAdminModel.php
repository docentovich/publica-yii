<?php

namespace app\modules\users\models;

use yii\db\ActiveRecord;

abstract class SuperAdminModel extends ActiveRecord
{
    abstract public function approve();
    abstract public function ban();
    abstract public function deleteItem();
    abstract public function messages();
}