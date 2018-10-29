<?php

namespace ImageAjaxUpload;

use yii\base\Model;
use yii\bootstrap\ActiveField;
use yii\helpers\BaseHtml;
use yii\jui\Widget;
use yii\widgets\ActiveForm;

class UploadWidget extends Widget
{
    /** @var Model */
    public $model;
    /** @var ActiveForm */
    public $activeForm;
    public $attribute;
    public $multiply = true;

    private $modelParameter;

    public function init()
    {
        $this->modelParameter = $this->model->{$this->attribute};
        if (!is_array($this->modelParameter)) {
            $this->modelParameter = [$this->modelParameter];
        }

        UploadAsset::register($this->getView());
    }

    public function run()
    {
        ?>
        <div class="image-ajax-upload" multiply="<?= $this->multiply ?>">
            <?= $this->activeForm->field(new UploadModel(), 'file')
                ->fileInput(['style' => 'display: none'])->label(false); ?>
            <?php foreach ($this->modelParameter as $model_src_field) { ?>
                <?= \yii\helpers\Html::img($model_src_field); ?>
            <?php } ?>
        </div>
        <?php
    }
}