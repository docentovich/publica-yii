<?php

namespace app\widgets\bgimg;

use app\models\Image;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class BackgroundImage extends Widget
{
    const COVER = 'bgimg-cover';
    const CONTAIN = 'bgimg-contain';

    /** @var Image */
    public $image;

    /** @var array */
    public $options = [];

    /** @var array|string */
    public $size;

    /** @var null|array  */
    public $wrapper_size;

    /** @var null|string */
    public $type = null;

    /** @var array */
    private $class = [];

    public function init()
    {
        if( is_string( $this->size )){
            $this->size  = explode('x', strtolower($this->size));
        }

        if( is_string( $this->wrapper_size )){
            $this->wrapper_size  = explode('x', strtolower($this->wrapper_size));
        }

        if(!isset($this->size) || !isset($this->image) || !( $this->image instanceof Image ) || !(is_array($this->size)) || (count($this->size) < 2)){
            throw new \InvalidArgumentException();
        }

        if($this->wrapper_size !== null){
            $this->wrapper_size = isset($this->wrapper_size) ?  $this->wrapper_size : $this->size;
        }
        $this->type = $this->type ?? self::COVER;

        $this->class = ArrayHelper::merge(
                [$this->options['class']] ?? [],
                ['bgimg', $this->type]
        );
    }

    public function run()
    {
        ?>
        <div class="<?= implode(" ", $this->class); ?>"
             style="background-image: url(<?= $this->image->getUrlImageSizeOf($this->size); ?>);
                     <?= ($this->wrapper_size !== null) ? "width: {$this->wrapper_size[0]}px;" : ''; ?>
                     <?= ($this->wrapper_size !== null) ? "height: {$this->wrapper_size[1]}px;" : '';?>"></div>
        <?php
    }
}