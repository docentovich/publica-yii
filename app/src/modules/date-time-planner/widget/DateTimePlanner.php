<?php

namespace DateTimePlanner\widget;


use yii\base\Model;
use yii\base\Widget;

class DateTimePlanner extends Widget
{
    /** @var Model */
    public $model;
    /** @var string */
    public $attribute;
    public $id;

    public function init()
    {
        $this->id = $this->id ?? uniqid();
    }


    public function run()
    {
        Assets::register($this->getView());
        ?>
        <div id="dtp-<?= $this->id ?>" class="date-time-picker">
            <div id="datepicker-<?= $this->id ?>" class="datepicker datepicker-inline"></div>
            <?php if (isset($this->model)) {
                echo \yii\helpers\Html::activeFileInput($this->model, $this->attribute, ['class' => 'dtp-input']);
            }
            ?>
            <div class="timepicker" id="timepicker-<?= $this->id ?>">
                <h2><?= \Yii::t('app', 'busy hours'); ?></h2>
                <div class="time-table-wrapper time-table" style="display: none"></div>
            </div>
        </div>
        <?php
    }
}