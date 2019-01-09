<?php

namespace DateTimePlanner\widget;


use DateTimePlanner\models\DateTimePlannerForm;
use yii\base\Model;
use yii\base\Widget;

class DateTimePlanner extends Widget
{
    /** @var Model */
    public $model;
    /** @var string */
    public $attribute;
    public $id;
    public $user_id = null;
    public $date_attribute;
    private $data_time_input_html = '';
    private $data_date_input_html = '';

    public function init()
    {
        $this->id = $this->id ?? uniqid();

        if ($this->model && isset($this->attribute)) {
            $this->data_time_input_html = \yii\helpers\Html::activeHiddenInput(
                $this->model,
                $this->attribute . '[]',
                ['class' => 'dtp-time-input', 'id' => null]
            );
        } else {
            $this->data_time_input_html = \yii\helpers\Html::hiddenInput(
                'time[]',
                '',
                ['class' => 'dtp-time-input']
            );
        }

        $this->data_time_input_html = str_replace('"', "'", $this->data_time_input_html);
        if (isset($this->date_attribute)) {
            $this->data_date_input_html = \yii\helpers\Html::activeHiddenInput(
                $this->model,
                $this->date_attribute,
                ['class' => 'dtp-date-input']
            );
        } else {
            $this->data_date_input_html = \yii\helpers\Html::hiddenInput(
                'date',
                '',
                ['class' => 'dtp-date-input']
            );
        }
    }


    public function run()
    {
        Assets::register($this->getView());
        $this->getView()
            ->registerJs(
                "var timeDefaultServer = " . json_encode(DateTimePlannerForm::TIME_RANGE),
                \yii\web\View::POS_HEAD
            );
        ?>
        <div data-time-input-html="<?= $this->data_time_input_html; ?>"
             data-date=""
             data-time=""
             data-user_id="<?= $this->user_id; ?>"
             id="<?= $this->id ?>"
             class="date-time-picker calendar">
            <div class="datepicker datepicker-inline datepicker-wrapper"></div>
            <div class='date-input-wrapper'><?= $this->data_date_input_html; ?></div>
            <div class='time-inputs-wrapper'></div>
            <div class="timepicker" style="display: none">
                <h2><?= \Yii::t('app', 'busy hours'); ?></h2>
                <div class="time-table-wrapper time-table"></div>
            </div>
        </div>
        <?php
    }
}