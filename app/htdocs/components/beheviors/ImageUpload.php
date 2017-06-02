<?php

namespace components\beheviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\imagine\Image;

/**
 * Сохраняем картинку, тумбифицируем ее, возварщаем JSON для AJAX по событию EVENT_AFTER_VALIDATE
 *
 * Class ImageUpload
 * @package components\beheviors
 */
class ImageUpload extends Behavior
{

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_VALIDATE => 'imageUpload'
        ];
    }

    /**
     * Обработчки загрузки картинки
     */
    public function imageUpload()
    {
        //поле file
        $file = yii\web\UploadedFile::getInstance($this->owner, 'file');
        //уникальное имя файла
        $fileName = uniqid();
        //пусть состоит из папки аплоадов и ИД юзера
        $filePatch = Yii::getAlias("@uploads") . "/" . Yii::$app->user->getId();
        //сохраняем оригинал
        $file->saveAs($filePatch . "/" . $fileName . "." . $file->extension);
        //получаем высоту и ширину тумбочки
        list($widh, $height) = explode("x", $this->owner->size);
        //сохраняем тумбочку
        Image::thumbnail($filePatch, $widh, $height)
            ->save($filePatch . "/" . $fileName . '_' . $this->owner->size . '.jpg', ['quality' => 80]);

        //сохраняем в модель имя файла
        $this->owner->name  = $file->name . "." . $file->extension;

        //сохраняем в модель jnyjcbnktmysq genm
        $this->owner->patch = Yii::$app->user->getId();

        //через модель передаем JSON для ajax
        $this->owner->json = json_encode([
            'url' => '/uploads/' . Yii::$app->user->getId(),
            'thumb' => $fileName . '_' . $this->owner->size . '.jpg'
        ]);
    }
}