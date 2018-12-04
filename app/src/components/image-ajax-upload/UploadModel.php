<?php

namespace ImageAjaxUpload;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Trait UploadModelTrait
 * UploadForm is the model behind the upload form.
 * @package ImageAjaxUpload
 */
class UploadModel extends Model
{
    const SCENARIO_SINGLE_FILE = 'ssf';
    const SCENARIO_MULTI_FILE = 'smf';
    public $file;
    public $files;
    public $uploaded;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'required'],
            [['file'], 'file', 'extensions' => 'jpg,jpeg,gif,png'],
            [['files'], 'required'],
            [['files'], 'file', 'extensions' => 'jpg,jpeg,gif,png', 'maxFiles' => 8],
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_SINGLE_FILE => ['file'],
            self::SCENARIO_MULTI_FILE => ['files'],
        ];
    }

    /**
     * @param string $relative_upload_dir
     * @param UploadedFile $file
     * @return array|bool
     */
    public function upload($relative_upload_dir, $file = null)
    {
        $this->scenario = self::SCENARIO_SINGLE_FILE;
        $this->file = ($file !== null) ? $this->file : UploadedFile::getInstance($this, 'file');
        if (!$this->validate()) {
            return false;
        }

        return $this->_upload($relative_upload_dir, $this->file);
    }

    /**
     * @param $relative_upload_dir
     * @param UploadedFile $file
     * @return array
     */
    private function _upload($relative_upload_dir, $file)
    {
        $relative_upload_dir = trim($relative_upload_dir, '/uploads/');
        $full_upload_dir = \Yii::getAlias('@frontend') . '/web/uploads/' . $relative_upload_dir;
        $upload_url = \Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/' . $relative_upload_dir);

        if (!file_exists($full_upload_dir)) {
            mkdir($full_upload_dir, 0777, true);
        }

        //уникальное имя файла
        $file_name = uniqid();

        if (!file_exists($full_upload_dir)) {
            mkdir($full_upload_dir);
        }

        $file_name = $file_name . "." . $file->extension;
        $full_file_name = $full_upload_dir . "/" . $file_name;

        //сохраняем оригинал
        $file->saveAs($full_file_name);

        return $this->uploaded = [
            'url' => $upload_url . '/' . $file_name,
            'relative_path' => $relative_upload_dir . '/' . $file_name,
            'path' => $relative_upload_dir,
            'name' => $file_name,
        ];
    }

    public function multiUpload($relative_upload_dir)
    {
        $this->files = UploadedFile::getInstances($this, 'files');
        $this->scenario = self::SCENARIO_MULTI_FILE;

        if (!$this->validate()) {
            return false;
        }

        $uploadedFiles = [];
        foreach ($this->files as $file) {
            $uploadedFiles[] = $this->_upload($relative_upload_dir, $file);
        }
        return $uploadedFiles;
    }

}