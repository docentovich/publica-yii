<?php

namespace beheviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\imagine\Image;

/**
 * Сохраняем картинку, тумбифицируем ее, возварщаем JSON для AJAX по событию EVENT_AFTER_VALIDATE
 *
 * Class ImageUpload
 * @package app\beheviors
 */
class ImageUpload extends Behavior
{

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'imageUpload'
        ];
    }

    /**
     * Обработчки загрузки картинки
     */
    public function imageUpload()
    {
        $file = yii\web\UploadedFile::getInstance($this->owner, 'file'); //поле file
        $fileName = uniqid(); //уникальное имя файла
        $filePatch = Yii::getAlias("@uploads") . "/" . Yii::$app->user->getId(); //пусть состоит из папки аплоадов и ИД юзера
        $file->saveAs($filePatch . "/" . $fileName . "." . $file->extension); //сохраняем оригинал
        list($widh, $height) = explode("x", $this->owner->size); //получаем высоту и ширину тумбочки
        Image::thumbnail($filePatch, $widh, $height) //сохраняем тумбочку
            ->save($filePatch . "/" . $fileName . '_' . $this->owner->size . '.jpg', ['quality' => 80]);
        $this->owner->name  = $file->name . "." . $file->extension;  //сохраняем в модель имя файла
        $this->owner->patch = Yii::$app->user->getId(); // сохраняем в модель jnyjcbnktmysq genm
        $this->owner->json = json_encode([ // через модель передаем JSON для ajax
            'url' => '/uploads/' . Yii::$app->user->getId(),
            'thumb' => $fileName . '_' . $this->owner->size . '.jpg'
        ]);
    }
}