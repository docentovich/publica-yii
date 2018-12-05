<?php

namespace ImageAjaxUpload;

/**
 * Interface ImageInterface
 * @package ImageAjaxUpload
 */
interface ImageInterface
{
    /**
     * ex:
     *   public function getRelativeUploadPath()
     *   {
     *      return '/uploads/' . $this->getPath0();
     *   }
     *
     * @return string
     */
    public function getRelativeUploadPath(): string;
}