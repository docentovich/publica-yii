<?php

namespace ImageAjaxUpload;

use yii\base\Model;
use yii\bootstrap\ActiveField;
use yii\helpers\BaseHtml;
use yii\jui\Widget;

class UploadWidget extends Widget
{
    public $action;
    /** @var Model */
    public $model;
    public $onUploadFinished = 'function(){}';
    public $onUploadStart = 'function(){}';
    public $attribute;
    public $multiply = true;

    private $fileFieldName;
    private $modelFiledName;
    private $modelParameter;

    public function init()
    {
        $this->modelParameter = $this->model->{$this->attribute};
        if (!is_array($this->modelParameter )) {
            $this->modelParameter  = [$this->modelParameter ];
        }

        $this->fileFieldName = BaseHtml::getInputName(new UploadModel, $this->multiply ? 'files' : 'file');
        $this->modelFiledName = BaseHtml::getInputName($this->model, $this->attribute . ($this->multiply ? '[]' : ''));
        UploadAsset::register($this->getView());
    }

    public function run()
    {
        $uniqueId = uniqid();
        ?>
        <div id='uploader-<?=$uniqueId?>'
             class="image-ajax-upload"
             onUploadFinished="<?= $this->onUploadFinished; ?>"
             onUploadStart="<?= $this->onUploadStart; ?>"
             model-filed-name="<?= $this->modelFiledName ?>"
             action-url="<?= $this->action; ?>"
             multiply="<?= $this->multiply ?>">
            <input type="file" name="<?= $this->fileFieldName ?>" accept="image/*" style="display: none">

            <?php foreach ($this->modelParameter as $model_src_field) { ?>
                <?= \yii\helpers\Html::img($model_src_field); ?>

                <input type="hidden"
                       name="<?= $this->modelFiledName ?>"
                       value="<?= $model_src_field ?>"
                       accept="image/*"
                       style="display: none">
            <?php } ?>
        </div>
        <script>
            if(typeof bindArr === 'undefined'){
                var bindArr = [];
            }
            bindArr.push({
                id: '<?= $uniqueId ?>',
                onUploadFinished: <?= $this->onUploadFinished; ?>,
                onUploadStart: <?= $this->onUploadStart; ?>,
            });
        </script>
        <?php
    }
}