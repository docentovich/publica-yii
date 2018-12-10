<?php

namespace app\widgets;

use yii\base\Widget;
use yii\web\View;

class Picture extends Widget
{
    /** TODO lazyLoad images aftrr vieweport */
    /** TODO lazyLoad images move to separete folder cause have asset */
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
    private $filePath;
    public $lazyLoadFn = null;

    public function init()
    {
        $t = explode('/', $this->src);
        $fileName = array_pop($t);
        $this->filePath = implode('/', $t);
        list($image_name, $this->originalImageExtension) = explode('.', $fileName);
        preg_match('/(.*)\[(.*)\]/', $image_name, $matches);
        list(, $this->originalImageName, $this->baseSize) = $matches;

        if (!empty($this->points)) {
            $this->sizes = [];
            array_walk($this->points, function ($val, $key) {
                foreach (self::POINTS as $name => $media) {
                    $key = str_replace($name, $media, $key);
                }
                $this->sizes[$key] = $val;
            });
        }

    }


    public function run()
    {
        $view = $this->getView();
        PictureAsset::register($view);

        $view->registerJs(
            "(function ($) {
                {$this->lazyLoadFn}
            })(jQuery);", View::POS_READY, "lazy-loader-{$this->originalImageName}");

        ob_start(); ?>
        <picture>
            <?php foreach ($this->sizes as $media => $size) { ?>
                <source data-attr="srcset" <?= $this->lazyLoadFn ? 'data-src' : 'srcset' ?>="<?= "{$this->filePath}/{$this->originalImageName}[{$size}].{$this->originalImageExtension}" ?>"
                media="<?= $media ?>">
            <?php } ?>
            <img <?= $this->lazyLoadFn ? "src='" . \app\constants\Constants::NO_IMAGE() . "'" : ''; ?>
                    data-attr="src"
            <?= $this->lazyLoadFn ? 'data-src' : 'src' ?>="<?= $this->src ?>" alt=""/>
        </picture>

        <?php return ob_get_clean();
    }
}