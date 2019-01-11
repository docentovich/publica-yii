<?php

namespace DateTimePlanner\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "{{%date_time_planner}}".
 *
 * @property int $id
 * @property string $date
 * @property string $time
 * @property int $user_id
 *
 * @property User $user
 */
class DateTimePlanner extends \app\models\DateTimePlanner
{

}
