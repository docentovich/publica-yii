<?php

namespace ImageAjaxUpload;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\InputWidget;
use yii\widgets\ActiveForm;

/**
 * Class UploadWidget
 * ex:
 * <?= $form->field($model->image, 'relativeUploadPath')
 *      ->widget(\ImageAjaxUpload\UploadWidget::className(), [
 *          'multiply' => false,
 *      ]); ?>
 *
 * where $model->image is model implemented @see ImageInterface
 * and second parameter always 'relativeUploadPath'
 * @package ImageAjaxUpload
 */
class UploadWidget extends InputWidget
{
    /** @var Model */
    public $model;
    /** @var string */
    public $attribute;
    /**
     * allows multiply or single upload
     * @var bool
     */
    public $multiply = true;
    /** @var array uploaded images */
    public $options = [];
    public $instance = '';
    public $relativePathAttribute = 'relativeUploadPath';
    private $_images = [];
    /**
     * @var ImageInterface|ImageInterface[]
     */
    private $_imagesModel;

    public function init()
    {
        if (!isset($this->model->{$this->attribute})) {
            throw new \Exception('The model mast set');
        }
        $this->_imagesModel = $this->model->{$this->attribute};

        if (!is_array($this->_imagesModel)){
            $this->_imagesModel = [$this->_imagesModel];
        }

        if (!($this->_imagesModel[0] instanceof ImageInterface)) {
            throw new \Exception('The model mast implements ' . ImageInterface::class);
        }

        foreach($this->_imagesModel as $imageModel){
            /** @var ImageInterface  $imageModel */
            $value = Html::getAttributeValue($imageModel, $this->relativePathAttribute);
            $this->_images[] = (object) ['model' => $imageModel, 'value' => $value];
        }

    }

    public function run()
    {
        $id = uniqid();
        $assets = UploadAsset::register($this->getView());
        $input_options = ArrayHelper::merge(
            ['style' => 'display: none'],
            (($this->multiply) ? ['multiple' => true] : [])
        );
        $upload_model = new UploadModel();
        /**
         * model of active field is @see UploadModel
         * all upload operations placed in there
         */
        ?>
        <div id="<?=$id?>" class="image-ajax-upload <?= $this->options['class'] ?? '' ?>" multiply="<?= $this->multiply ?>">
            <?= Html::fileInput('', '',
                 ArrayHelper::merge(['class' => 'trigger'], $input_options)
            ); ?>
            <?= Html::activeFileInput(
                $upload_model,
                'file' . (($this->multiply) ? 's' : '') . $this->instance . (($this->multiply) ? '[]' : ''),
                ArrayHelper::merge(['class' => 'uploader', 'id' => "ui_$id"], $input_options)
            ) ?>
            <div class="images">
                <?php
                foreach ($this->_images as $image) {
                    echo ($image) ? \yii\helpers\Html::img($image->value) : '';
                }
                if ($this->multiply) {
                    echo \yii\helpers\Html::img($assets->baseUrl . '/img/plus.png');
                }
                ?>
            </div>
        </div>
        <?php
    }
}