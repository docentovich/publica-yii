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
    private $_file;
    private $_files;
    private $_file0;
    private $_files0;
    private $_file1;
    private $_files1;
    public $uploaded;
    public $instance = '';

    public function __get($name)
    {
        if(property_exists ($this, '_' . $name . $this->instance)){
            return $this->{'_' . $name . $this->instance};
        }
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        try {
            if (property_exists($this, '_' . $name . $this->instance)) {
                return $this->{'_' . $name . $this->instance} = $value;
            }
        }catch (\Exception $e){
        }
        return parent::__set($name, $value);
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file' . $this->instance], 'required'],
            [['file' . $this->instance], 'file', 'extensions' => 'jpg,jpeg,gif,png'],
            [['files' . $this->instance], 'required'],
            [['files' . $this->instance], 'file', 'extensions' => 'jpg,jpeg,gif,png', 'maxFiles' => 8],
        ];
    }

    public function attributeLabels()
    {
        return ['file' => 'file'];
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
        $this->file = ($file !== null) ? $this->file : UploadedFile::getInstance($this, 'file' . $this->instance);
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
        $this->scenario = self::SCENARIO_MULTI_FILE;
        $this->files = UploadedFile::getInstances($this, 'files' . $this->instance);

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