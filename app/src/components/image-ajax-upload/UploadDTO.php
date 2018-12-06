<?php

namespace ImageAjaxUpload;

use yii\base\Object;

/**
 * Class UploadDTO
 * @package ImageAjaxUpload
 */
class UploadDTO extends Object
{
    public $url;
    public $relative_path;
    public $path;
    public $name;

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'url' => $this->url,
            'relative_path' => $this->relative_path,
            'path' => $this->path,
            'name' => $this->name
        ];
    }
}