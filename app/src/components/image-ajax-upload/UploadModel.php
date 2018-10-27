<?php

namespace ImageAjaxUpload;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadModel extends Model
{
    public $id;
    public $url;
    public $file;
    public $files;

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


    public function upload( $relative_upload_dir, $file = null )
    {
        $file = ($file !== null) ? $file : UploadedFile::getInstance($this, 'file');

        $relative_upload_dir = trim(  $relative_upload_dir, '/uploads/');
        $full_upload_dir = \Yii::getAlias('@frontend') . '/web/uploads/' . $relative_upload_dir;
        $upload_url = \Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/' . $relative_upload_dir);

        if (!file_exists($full_upload_dir)) {
            mkdir($full_upload_dir, 0777, true);
        }

        if ($file != NULL && $this->validate()) {

            //уникальное имя файла
            $file_name = uniqid();

            if (!file_exists($full_upload_dir)) {
                mkdir($full_upload_dir);
            }

            $file_name = $file_name . "." . $file->extension;
            $full_file_name = $full_upload_dir . "/" . $file_name;

            //сохраняем оригинал
            $file->saveAs($full_file_name);

            return [
                'url' => $upload_url . '/' . $file_name,
                'relative_path' => $relative_upload_dir . '/' . $file_name
            ];
        }

        return false;
    }

    public function multiUpload($relative_upload_dir)
    {
        $files = UploadedFile::getInstances($this, 'file');
        $uploadedFiles = [];

        if ($files != NULL && $this->validate()) {
            foreach ($files as $file) {
                $uploadedFiles[] = $this->upload( $relative_upload_dir, $file );
            }
            return $uploadedFiles;
        }
        return false;
    }
}