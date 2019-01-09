<?php

namespace DateTimePlanner\models;

use yii\base\Model;

/**
 * Class DateTimePlannerForm
 * @property array $time
 * @property string $date
 * @package DateTimePlanner\models
 */
class DateTimePlannerForm extends Model
{
    const TIME_RANGE = ['0-2', '2-4', '4-6', '6-8', '8-10', '10-12', '12-14', '14-16', '16-18', '18-20', '20-22', '22-24'];
    public $date;
    public $time;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'time'], 'required'],
            [['date'], 'string'],
            ['time', 'in', 'range' => self::TIME_RANGE, 'allowArray' => true],
        ];
    }
}