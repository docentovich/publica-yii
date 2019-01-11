<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%date_time_planner}}".
 *
 * @property int $id
 * @property string $date
 * @property string $time
 * @property int $user_id
 * @property int $order_id
 * @property User|null $user
 */
class DateTimePlanner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%date_time_planner}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'time', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['time'], 'string'],
            [['user_id'], 'integer'],
            [['date', 'time', 'user_id'], 'unique', 'targetAttribute' => ['date', 'time', 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/probank', 'ID'),
            'date' => Yii::t('app/probank', 'Date'),
            'time' => Yii::t('app/probank', 'Time'),
            'user_id' => Yii::t('app/probank', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return DateTimePlannerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new DateTimePlannerQuery(get_called_class()))->with('user');
    }
}
