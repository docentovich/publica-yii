<?php

namespace app\models;

use ImageAjaxUpload\UploadModelTrait;
use Yii;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int $id
 * @property string $alt
 * @property string $path
 * @property string $name
 * @property string $extension
 * @property Profile[] $profiles
 * @property Comments[] comments
 * @property int likes
 * @property string $relativeUploadPath
 * @property string $path0
 * @property string desc
 */
class Image extends \yii\db\ActiveRecord
{
    const SCENARIO_LOAD_FILE = 'loadFile';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_LOAD_FILE => ['name', 'path']
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'alt', 'name'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alt' => Yii::t('app', 'Alt'),
            'path' => Yii::t('app', 'Path'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['avatar' => 'id']);
    }

    public function getRelativeUploadPath()
    {
        return '/uploads/' . $this->getPath0();
    }
//
//    public function setRelativeUploadPath($relativeUploadPath)
//    {
//        $this->_relativeUploadPath = $relativeUploadPath;
//    }
//
//    public function prepareFromRelativeUploadPath($options = []){
//        if(!$this->_relativeUploadPath){
//            return false;
//        }
//
//        $this->path = (!isset($options['base_folder']))
//            ? \Yii::$app->user->getId()
//            : $options['base_folder'];
//
//        $temp = explode('/', $this->_relativeUploadPath);
//        $this->name = end($temp);
//        $new_dir = \Yii::getAlias('@uploads') . '/' . $this->path;
//
//
//        if (!file_exists($new_dir)) {
//            mkdir($new_dir, 0777, true);
//        }
//
//        $full_upload_path = \Yii::getAlias('@uploads') . '/' . $this->_relativeUploadPath;
//
//        return copy($full_upload_path, $new_dir . '/' . $this->name);
//    }
//
//    public function getRelativeUploadPathImageSizeOf($size)
//    {
//        return '/uploads/' . $this->getRelativeUploadPathImageSizeOf($size);
//    }

    public function getPath0()
    {
        if ($this->name === null) {
            return 'noimage.png';
        }
        return $this->path . "/" . $this->name;
    }

    public function getPathImageSizeOf($size)
    {
        if ($this->name === null) {
            return 'noimage.png';
        }
        list($file_name, $file_extension) = explode('.', $this->name);
        return "{$this->path}/{$file_name}[{$size}].$file_extension";
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['image_id' => 'id']);
    }

}
