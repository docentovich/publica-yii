<?php

namespace app\widgets\picture;

use yii\base\Widget;

class Picture extends Widget
{
    const POINTS = [
        "xsm" => "(max-width: 768px)",
        "sm" => "(min-width: 768px) and (max-width: 992px)",
        "md" => "(min-width: 992px) and (max-width: 1200px)",
        "lg" => "(min-width: 1200px)"
    ];
    public $src;
    public $points;
    public $sizes = [];

    protected $originalImageName;
    protected $originalImageExtension;
    protected $baseSize;

    public function init()
    {
        list($image_name, $this->originalImageExtension) = explode('.', $this->src);
        preg_match('/(.*)\[(.*)\]/', $image_name, $matches);
        list(, $this->originalImageName, $this->baseSize) = $matches;
        if(!empty($this->points)){
            $this->sizes = [];
            array_walk($this->points, function($val, $key) {
                foreach(self::POINTS as $name => $media){
                    $key = str_replace($name, $media, $key);
                }
                $this->sizes[ $key ] = $val;
            });
        }
    }


    public function run()
    {
        ob_start(); ?>
        <picture>
            <?php foreach ($this->sizes as $media => $size) { ?>
                <source srcset="<?= "{$this->originalImageName}[{$size}].{$this->originalImageExtension}" ?>"
                        media="<?= $media ?>">
            <?php } ?>
            <?= \yii\helpers\Html::img($this->src) ?>
        </picture>
        <?php return ob_get_clean();
    }
}