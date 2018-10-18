<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadImage extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    /**
     * @var UploadedFile file attribute
     */
    public $files;
    /**
     * @var UploadedFile file attribute
     */
    public $new_name;

    /**
     * @var integer Ссылка на ресурс
     */
    public $id;
    /**
     * @var string путь
     */
    public $path;

    public $json;
    public $url;
    public $multiImages;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['file'], 'file', 'extensions' => 'jpg,jpeg,gif,png'],
            [['files'], 'file', 'extensions' => 'jpg,jpeg,gif,png', 'maxFiles' => 8],
        ];
    }


    public function upload($sizes = [])
    {
        $this->file = UploadedFile::getInstance($this, 'file');

        if ($this->file != NULL)
            if ($this->validate()) {

                //поле file
                //$file = \yii\web\UploadedFile::getInstance($this->file, 'file');
                //уникальное имя файла
                $fileName = uniqid();
                //пусть состоит из папки аплоадов и ИД юзера
                $filePatch = \Yii::getAlias("@uploads") . "/" . \Yii::$app->user->getId();

                if (!file_exists($filePatch)) {
                    mkdir($filePatch);
                }

                $full_file_name = $filePatch . "/" . $fileName . "." . $this->file->extension;
                $original = $fileName . "." . $this->file->extension;

                //сохраняем оригинал
                $this->file->saveAs($full_file_name);
                $thumbs = [];
                foreach ($sizes as $size) {
                    //получаем высоту и ширину тумбочки
                    list($widh, $height) = explode("x", $size);
                    //сохраняем тумбочку
                    Image::thumbnail($full_file_name, $widh, $height)
                        ->save($filePatch . "/" . $fileName . $size . '.jpg', ['quality' => 80]);

                    $thumbs[$size] = $fileName . $size . '.jpg';
                }


                $this->path = \Yii::$app->user->getId();
                $this->new_name = $fileName . "." . $this->file->extension;


                //через модель передаем JSON для ajax
                $this->json = [
                    'url' => '/uploads/' . \Yii::$app->user->getId(),
                    'original' => $original,
                    'thumbs' => $thumbs,
                ];

                return true;
            }
        return false;

    }

    public function multiUpload( $sizes=[] )
    {

        $this->files = UploadedFile::getInstances($this, 'file');

        if ($this->files != NULL)
            if ($this->validate()) {
                foreach ($this->files as $file) {


                    //поле file
                    //$file = \yii\web\UploadedFile::getInstance($this->file, 'file');
                    //уникальное имя файла
                    $fileName = uniqid();
                    //пусть состоит из папки аплоадов и ИД юзера
                    $filePatch = \Yii::getAlias("@uploads") . "/" . \Yii::$app->user->getId();

                    if (!file_exists($filePatch)) {
                        mkdir($filePatch);
                    }

                    $full_file_name = $filePatch . "/" . $fileName . "." . $file->extension;
                    $original = $fileName . "." . $file->extension;

                    //сохраняем оригинал
                    $file->saveAs($full_file_name);
                    $thumbs = [];
                    foreach ($sizes as $size) {
                        //получаем высоту и ширину тумбочки
                        list($widh, $height) = explode("x", $size);
                        //сохраняем тумбочку
                        Image::thumbnail($full_file_name, $widh, $height)
                            ->save($filePatch . "/" . $fileName . $size . '.jpg', ['quality' => 80]);

                        $thumbs[$size] = $fileName . $size . '.jpg';
                    }


                    $path = \Yii::$app->user->getId();
                    $new_name = $fileName . "." . $file->extension;


                    //через модель передаем JSON для ajax
                    $json = [
                        'url' => '/uploads/' . \Yii::$app->user->getId(),
                        'original' => $original,
                        'thumbs' => $thumbs,
                    ];

                    $this->multiImages[] = ["path" => $path, "new_name" => $new_name, "json" => $json];

                }
                return true;
            }
        return false;
    }
}